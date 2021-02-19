<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        return view('admin.users', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login( Request $req)
    {
         $user = User::where(['email'=>$req->email])->first();          
         
         if($user){

                if($user->is_verified != 1)
                {
                    $req->session()->put('exception', 'Your account is not verified. Pleae check your email!');
                    return redirect('/login');
                }   

                
                if(!$user || !Hash::check($req->password, $user->password))
                {
                    $req->session()->put('exception', 'Email or password is not matched!');
                    return redirect('/login');
                }   
                else{
                    $req->session()->put('user', $user);
                    if($user->user_type == 'Admin'){
                        return redirect('/admin');
                    }        
                    return redirect('/dashboard');
                }
        }else{
            $req->session()->put('exception', 'User not found!');
            return redirect('/login');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required|min:6'
        ]);

        $is_user = User::where(['email'=>$request->email])->first();
        if($is_user){
            return redirect()->back()->with(session()->flash('alert-danger', 'This email is already registered.'));
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email; 
        $user->password = Hash::make($request->password);
        $user->user_type = 'User';
        $user->verification_code = sha1(time());
        $user->save();
        
        if($user!=null)
        {
            //send email
            MailController::signupEmail($user->name, $user->email, $user->verification_code);
            //show message
            return redirect()->back()->with(session()->flash('alert-success', 'Your account has been created. Please check your email for verification link.'));
        }
        
        //error message
        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong'));
    }

    public function storeUser(Request $request){
        $data = new User;
        $data->name = $request->name;
        $data->email = $request->email; 
        $data->password = Hash::make($request->password);
        $data->user_type = $request->user_type;
        $data->is_verified = '1';
        $data->verification_code = sha1(time());
        $data->save();
        return redirect()->back()->with(session()->flash('alert-success', 'New user created.'));
    }
   


    public function verifyUser(Request $request){
        $verification_code = \Illuminate\Support\Facades\Request::get('code');
        $user = User::where(['verification_code' => $verification_code])->first();
        if($user != null){
            $user->is_verified = 1;
            $user->save();
            return redirect()->route('login')->with(session()->flash('alert-success', 'Your account is verified. Please login!'));
        }

        return redirect()->route('login')->with(session()->flash('alert-danger', 'Invalid verification code!'));
    }

    public function resetPassword(Request $request)
    {
        $email = $request->email; 
        $reset_pass_code = sha1(time());

        $user = User::where(['email' => $email])->first();
        if($user != null){
            $user->reset_pass_code =  $reset_pass_code;
            $user->save();

            MailController::resetPasswordEmail($email, $reset_pass_code);
            return redirect()->back()->with(session()->flash('alert-success', 'Please check your email for reset password link.'));
        }
        return redirect()->route('login')->with(session()->flash('alert-danger', 'Something went wrong. Please try again!'));      
       
    }
    public function resetPass(Request $request){
        $reset_pass_code = \Illuminate\Support\Facades\Request::get('code');
        $user = User::where(['reset_pass_code' => $reset_pass_code])->first();
        if($user != null){
            return redirect()->route('newPassword')->with(session()->flash('alert-success', 'Please reset your password.'));
        }

        return redirect()->route('login')->with(session()->flash('alert-danger', 'Something went wrong. Please try again!'));
    }

  
    

    public function newPasswordStore(Request $request){
        $reset_pass_code = $request->reset_pass_code;
       
        $user = User::where(['reset_pass_code' => $reset_pass_code])->first();     
        
        if($user != null){
            $user->password = Hash::make($request->new_password);            
            $user->reset_pass_code = '';            
            $user->save();
            return redirect()->route('login')->with(session()->flash('alert-success', 'Your password has been changed successfully.'));
        }

        return redirect()->route('login')->with(session()->flash('alert-danger', 'Something went wrong. Please try again!'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user_id = session('user.id');
        $user = User::find($user_id);
        return view('profile', ['data'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user_id = session('user.id');
        $user = User::find($user_id);   
        
        $user->name = $request->name; 
        if($request->file('profile_image')!= null){
            $user->image = $request->file('profile_image')->store('images');
        } 
        if($request->new_password!= null){
            $user->password = Hash::make($request->new_password);
        }
        $user->save();
        return redirect()->back()->with(session()->flash('alert-success', 'Information updated successfully.'));        
    }
    
    public function updateUser(Request $request)
    {
        //dd($request);
        $data = User::find($request->id); 
        $data->name = $request->name; 
        $data->user_type = $request->user_type;       
        $data->save();
        return redirect()->back()->with(session()->flash('alert-success', 'Data updated successfully.'));        
    }

    public function deleteUser($id){
        $data = User::find($id);
        $data->delete();

        return redirect()->back()->with(session()->flash('alert-success', 'Data  deleted successfully.'));
    }
}
