<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

//Symlink !important pisan atuh nih
Route::get('/command/foo', function () {
    Artisan::call('storage:link');
});

Route::get('/command/migrate_reset', function () {
    Artisan::call('migrate:reset');
});

Route::get('/command/migrate', function () {
    Artisan::call('migrate');
});

Route::get('/command/seeder', function () {
    Artisan::call('db:seed');
});




Route::group(['middleware' => ['auth']], function () {

    Route::get('/admin/student/all', 'AdminStudentController@allStudent')->name('admin.student.all');
    Route::get('/admin/student/manage', 'AdminStudentController@manageStudent')->name('admin.student.manage');

    Route::delete('student/destroy/{student}', 'StudentController@destroy')->name('student.destroy');
    Route::post('student/simpan', 'StudentController@simpan')->name('student.simpan');
    Route::post('student/edit', 'StudentController@edit')->name('student.edit');
    Route::post('student/reset_password', 'StudentController@resetPassword')->name('student.reset-password');
    Route::get('studet/getStudents', 'StudentController@getStudents')->name('student.getStudents');


    Route::get('/admin/student/create', 'AdminStudentController@createStudent')->name('admin.student.create');
    Route::get('/admin/group/create', 'GroupController@create');
    Route::get('/admin/mentor/create', 'AdminMentorController@create');
    Route::get('/admin/mentor/manage', 'AdminMentorController@manage');

    //Mentor
    Route::post('/admin/mentor/store', 'AdminMentorController@simpan')->name('admin.mentor.create');
    Route::delete('/mentor/destroy/{mentor}', 'AdminMentorController@destroy')->name('admin.mentor.destroy');
    Route::post('/mentor/reset_password', 'AdminMentorController@resetPassword')->name('mentor.reset-password');
    Route::get('/admin/mentor/{mentor}/edit', 'AdminMentorController@edit')->name('admin.mentor.edit');



    Route::delete('/group/destroy/{group}', 'GroupController@destroy')->name('group.destroy');
    Route::get('/group/{group}/edit', 'GroupController@update')->name('group.update');
    Route::post('/group/changeMentor', 'GroupController@change_mentor')->name('group.change_mentor');
    Route::post('/group/remove_student/', 'GroupController@remove_student')->name('group.remove-student');
    Route::post('/group/insert_student/', 'GroupController@insert_student')->name('group.insert-student');
    Route::get('/admin/group/manage', 'GroupController@allGroup');
    Route::post('/admin/group/store', 'GroupController@simpan')->name('admin.group.create');
    Route::get('/admin/student/manage', 'AdminStudentController@manageStudent')->name('admin.student.manage');
});







Route::get('/home', 'HomeController@index');

Route::get('/login/mentor', 'Auth\LoginController@showMentorLoginForm');
Route::get('/login/student', 'Auth\LoginController@showStudentLoginForm');
Route::get('/register/mentor', 'Auth\RegisterController@showMentorRegisterForm');
Route::get('/register/student', 'Auth\RegisterController@showStudentRegisterForm');

Route::post('/login/mentor', 'Auth\LoginController@mentorLogin')->name('login-mentor');
Route::post('/login/student', 'Auth\LoginController@studentLogin')->name('login-student');
Route::post('/register/mentor', 'Auth\RegisterController@createMentor')->name('regis-mentor');
Route::post('/register/student', 'Auth\RegisterController@createStudent')->name('regis-student');

Route::view('/admin', 'admin.home')->middleware('auth');
Route::view('/mentor', 'mentor.home')->middleware('auth');
Route::view('/student', 'student.home')->middleware('auth');


Route::get('/students', 'StudentController@retrieveAll')->name('students');

Auth::routes();
