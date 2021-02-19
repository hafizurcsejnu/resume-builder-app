<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\ProfessionalSummaryController;
use App\Http\Controllers\AdditionalController;
use App\Http\Controllers\UserSectionController;
use App\Http\Controllers\DataProfessionalSummaryController;
use App\Http\Controllers\DataSkillController;
use App\Http\Controllers\DataDegreeProgramController;
use App\Http\Controllers\DataAwardSchoolController;
use App\Http\Controllers\DataAwardCollegeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\FileController;
use App\Http\Middleware\admin;
use App\Http\Middleware\user;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(session('user.user_type') == 'User'){
        return redirect('/dashboard');
    }
    else if(session('user.user_type') == 'Admin'){
        return redirect('/admin');
    }
    return view('user_login');
});
Route::get('/login', function () {
    if(session('user.user_type') == 'User'){
        return redirect('/dashboard');
    }
    else if(session('user.user_type') == 'Admin'){
        return redirect('/admin');
    }
    return view('user_login');
});


Route::get('/dashboard', function(){
    if(session('user.user_type') == 'User'){
        return view('home');
    }
    return redirect('/login');
});

Route::get('/admin', function(){
    if(session('user.user_type') == 'Admin'){
        return view('admin.index');
    }
    return redirect('/login');

});

// logout
Route::get('/logout', function(){
    if(session()->has('user')){
        session()->pull('user');
    }
    return redirect('/login');
});
Route::view('no-access', 'no_access');

/*user section*/
Route::post('create-user', [UserController::class, 'store']);
//Route::view('login', 'user_login')->name('login');
Route::post('access-user', [UserController::class, 'login']);
Route::get('profile', [UserController::class, 'edit']);
Route::post('update-user', [UserController::class, 'update']);
Route::view('main', 'home_main');

Route::get('verify', [UserController::class, 'verifyUser'])->name('verify.user');

Route::post('reset-password', [UserController::class, 'resetPassword']);
Route::get('reset', [UserController::class, 'resetPass'])->name('reset');
Route::view('new-password', 'new_password')->name('newPassword');
Route::post('new-password-store', [UserController::class, 'newPasswordStore']);

Route::middleware([user::class])->group(function () {
    // resume section

    Route::get('dashboard', [ResumeController::class, 'index']);
    Route::view('select-template', 'select_template');
    Route::post('store-section', [UserSectionController::class, 'store']);
    Route::post('update-section', [UserSectionController::class, 'update']);

    Route::get('sections/{id}',[UserSectionController::Class,'show']);
    Route::post('sections/update/{id}',[UserSectionController::Class,'update_section']);


    Route::get('create-resume', [ResumeController::class, 'create']);
    Route::get('select-resume', [ResumeController::class, 'select']);
    Route::get('my-resumes', [ResumeController::class, 'index']);
    Route::get('delete-my-resume/{id}', [ResumeController::class, 'delete']);

    Route::post('save_resume_name',[ResumeController::class,'save_resume_name']);

    Route::get('header', [HeaderController::class, 'index']);
    Route::post('headerStore', [HeaderController::class, 'store']);
    Route::post('headerUpdate', [HeaderController::class, 'update']);

    Route::get('education', [EducationController::class, 'index'])->name('education');
    Route::get('add-education', [EducationController::class, 'create']);
    Route::get('add-school', [EducationController::class, 'addSchool']);
    Route::get('add-college', [EducationController::class, 'addCollege']);
    Route::post('educationStore', [EducationController::class, 'store']);
    Route::get('education-edit/{id}', [EducationController::class, 'edit']);
    Route::post('educationUpdate', [EducationController::class, 'update']);
    Route::get('educationDelete/{id}', [EducationController::class, 'delete']);

    Route::get('work', [ExperienceController::class, 'index'])->name('work');

    Route::get('experience', [ExperienceController::class, 'index'])->name('experience');
    Route::get('add-experience', [ExperienceController::class, 'create']);
    Route::get('experience-details', [ExperienceController::class, 'experienceDetails'])->name('experience-details');
    Route::post('experienceStore', [ExperienceController::class, 'store']);
    Route::get('experience-edit/{id}', [ExperienceController::class, 'edit']);
    Route::post('experienceUpdate', [ExperienceController::class, 'update']);
    Route::post('updateExperienceDescription', [ExperienceController::class, 'updateExperienceDescription']);

    Route::get('experienceDelete/{id}', [ExperienceController::class, 'delete']);

    Route::get('skills', [SkillController::class, 'index'])->name('skills');
    Route::post('storeSkill', [SkillController::class, 'store']);
    Route::post('updateSkill', [SkillController::class, 'update']);


    Route::get('extra-curricular', [ActivityController::class, 'index'])->name('extra-curricular');
    Route::post('storeActivity', [ActivityController::class, 'store']);
    Route::post('updateActivity', [ActivityController::class, 'update']);

    Route::get('professional', [ProfessionalSummaryController::class, 'index'])->name('professional');
    Route::post('storeProfessional', [ProfessionalSummaryController::class, 'store']);
    Route::post('updateProfessional', [ProfessionalSummaryController::class, 'update']);


    Route::get('certifications', [CertificationController::class, 'index'])->name('certifications');
    Route::post('storeCertification', [CertificationController::class, 'store']);
    Route::post('updateCertification', [CertificationController::class, 'update']);
    Route::get('certification-edit/{id}', [CertificationController::class, 'edit']);
    Route::get('certificationDelete/{id}', [CertificationController::class, 'delete']);


    Route::get('additional', [AdditionalController::class, 'index'])->name('additional');
    Route::post('storeAdditional', [AdditionalController::class, 'store']);
    Route::post('updateAdditional', [AdditionalController::class, 'update']);



    Route::post('find_school',[EducationController::class,'find_school']);
    Route::post('find_college',[EducationController::class,'find_college']);
    Route::post('find_state',[EducationController::class,'find_state']);
    Route::get('find_experience',[ExperienceController::class,'find_experience']);



    Route::get('preview/{id}', [ResumeController::class, 'show']);
    Route::get('preview-resume', [ResumeController::class, 'preview'])->name('preview-resume');

    Route::get('resume/{id}', [ResumeController::class, 'pdf']);
    Route::get('resume-word/{id}', [ResumeController::class, 'word']);

    // Route::get('/resume/{id}', function () {
    //     $pdf = PDF::loadView('pdf.resume2');
    //     //$pdf = PDF::loadView('pdf.resume');
    //     return $pdf->download('resume.pdf');
    // });


    /**
     * Routes for Folder CRUD
     */
    Route::get('my-documents', [FolderController::class, 'index']);
    Route::get('get-folder-by-id/{folderId}', [FolderController::class, 'getFolderById']);
    Route::post('create-folder',[FolderController::class, 'create']);
    Route::post('sorting-folder',[FolderController::class, 'sorting']);
    Route::post('rename-folder',[FolderController::class, 'renameFolder']);
    Route::delete('delete-folder/{folderId}',[FolderController::class, 'deleteFolder']);
    Route::get('get-tree-data', [FolderController::class, 'getTreeData']);
    Route::post('upload', [FileController::class, 'create'])->name('createFile');
    Route::post('rename-file',[FileController::class, 'renameFile']);
    Route::delete('delete-file/{fileId}',[FileController::class, 'deleteFile']);
    Route::get('get-folder-files/{type}/{folderId}', [FileController::class, 'getFolderFiles']);
    Route::get('get-file-by-id/{fileId}', [FileController::class, 'getFileById']);
    Route::POST('copy-file', [FileController::class, 'copyFile']);
    Route::get('check-file-exist/{folderId}', [FolderController::class, 'checkFileExist']);
});


/************************************************************
 admin section
 ************************************************************/

Route::middleware([admin::class])->group(function () {
    Route::view('resume-list', 'resume_list');
    Route::resource('sections', SectionController::class);

    Route::get('templates', [TemplateController::class, 'index']);
    Route::post('template_store', [TemplateController::class, 'store']);
    Route::post('template_update', [TemplateController::class, 'update']);
    Route::get('template_delete/{id}', [TemplateController::class, 'destroy']);

    Route::get('users', [UserController::class, 'index']);

    Route::post('storeUser', [UserController::class, 'storeUser']);
    Route::post('updateUser', [UserController::class, 'updateUser']);
    Route::get('deleteUser/{id}', [UserController::class, 'deleteUser']);

    Route::get('data_professional_summary', [DataProfessionalSummaryController::class, 'index']);
    Route::post('data_professional_summary_store', [DataProfessionalSummaryController::class, 'store']);
    Route::post('data_professional_summary_update', [DataProfessionalSummaryController::class, 'update']);
    Route::get('data_professional_summary_delete/{id}', [DataProfessionalSummaryController::class, 'destroy']);

    Route::get('data_skill', [DataSkillController::class, 'index']);
    Route::post('data_skill_store', [DataSkillController::class, 'store']);
    Route::post('data_skill_update', [DataSkillController::class, 'update']);
    Route::get('data_skill_delete/{id}', [DataSkillController::class, 'destroy']);

    Route::get('data_degree_program', [DataDegreeProgramController::class, 'index']);
    Route::post('data_degree_program_store', [DataDegreeProgramController::class, 'store']);
    Route::post('data_degree_program_update', [DataDegreeProgramController::class, 'update']);
    Route::get('data_degree_program_delete/{id}', [DataDegreeProgramController::class, 'destroy']);

    Route::get('data_award_school', [DataAwardSchoolController::class, 'index']);
    Route::post('data_award_school_store', [DataAwardSchoolController::class, 'store']);
    Route::post('data_award_school_update', [DataAwardSchoolController::class, 'update']);
    Route::get('data_award_school_delete/{id}', [DataAwardSchoolController::class, 'destroy']);

    Route::get('data_award_college', [DataAwardCollegeController::class, 'index']);
    Route::post('data_award_college_store', [DataAwardCollegeController::class, 'store']);
    Route::post('data_award_college_update', [DataAwardCollegeController::class, 'update']);
    Route::get('data_award_college_delete/{id}', [DataAwardCollegeController::class, 'destroy']);
});












