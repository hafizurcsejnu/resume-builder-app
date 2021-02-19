<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start(); //this will control back btn click effect

class UserController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.my_account')->with('main_content');
    }
    public function login()
    {
        return view('pages.customer_login')->with('main_content');
    }

    public function symptomChecker()
    {
        return view('pages.symptom_checker')->with('main_content');
    }


    public function authCheck()
    {
      $customer_id = Session::get('customer_id');
      $name = Session::get('name');

      if ($customer_id) {
        return Redirect::to('/my-account')->send();
    }else{
        return Redirect::to('/')->send();
    }
}

public function customerLogin(Request $request)
{
        //$this->authCheck();
    
    $email= $request->email;
    $password= $request->password;
    // var_dump($_POST);    

    $result = DB::table('customers')
    ->where('email', $email)
    ->where('password', md5($password))
    ->first();
    

    if ($result) {
        Session::put('customer_name', $result->name);
        Session::put('customer_id', $result->id);
        Session::put('message', 'Login Successfully!');
        return Redirect::to('/my-quotations');
    }else{
        
        Session::put('exception', 'Invalid user id or password!');
        return Redirect::to('/login');

    }

}

public function register()
{
    return view('pages.customer_resigter')->with('main_content');
}

public function customerRegistration(Request $request)
{
    $data=array();
    $data['name']=$request->name;
    $data['email']=$request->email;
    $data['active']=0;
    $data['password']=md5($request->password);

    $customer_id = DB::table('customers')->insertGetId($data);

    if ($customer_id) {
        // Session::put('customer_id',$customer_id);
        // Session::put('customer_name',$request->name);

        return Redirect::to('/');
    }
}



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function customerLogout()
    {
     Session::put('name');
     Session::put('user_id');
     Session::put('customer_id');
     Session::put('message','You are successfully logout!');
     return Redirect::to('/');

 }
}
