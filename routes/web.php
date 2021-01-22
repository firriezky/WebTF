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
Route::get('/notification/test', 'NotificationController@test');

Route::get('/notification/test/{title}/{body}', 'NotificationController@sendFromOutside');




Route::group(['middleware' => ['auth:web']], function () {

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

    Route::get('/admin/notification/broadcast', 'NotificationController@broadcast');
    Route::post('/notification/broadcast/send', 'NotificationController@sendBroadcast');

    Route::get('/admin/agenda/manage', 'AgendaController@adminSee');
    Route::get('/admin/agenda/create', 'AgendaController@vAdminCreate');

    // Agenda Operation
    Route::post('/admin/agenda/save', 'AgendaController@simpanByAdmin');
    Route::post('/admin/agenda/edit', 'AgendaController@editByAdmin');
    Route::post('/admin/agenda/delete', 'AgendaController@deleteByAdmin');
    
    
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

    Route::get('admin/task/manage', 'AdminTaskTahfidzController@manageTask')->name('admin.task.manage');
});
Route::get('admin/task/retrieve', 'AdminTaskTahfidzController@retrieveTask');


Route::group(['middleware’' => ['auth:student']], function () {
    Route::get('/student/task', 'TahfidzTaskController@viewStudent')->middleware('auth:student');
    Route::get('/student/task/create', 'TahfidzTaskController@viewCreate')->middleware('auth:student');
    Route::get('/student/group', 'HomeStudentController@view_group')->middleware('auth:student');

    // Profile Section
    Route::view('/student/profile', 'student.profile')->middleware('auth:student');
    Route::post('/student/profile/update', 'StudentController@update');
    Route::post('/student/profile/update-pass', 'StudentController@updatePassword')->name('student.update-password');
});

Route::group(['middleware’' => ['auth:mentor']], function () {
    Route::get('/mentor/tahfidz/task', 'MentorTaskController@manage')->middleware('auth:mentor');
    Route::get('/mentor/tahfidz/task/{task}', 'MentorTaskController@edit')->middleware('auth:mentor');
    Route::get('/mentor/tahfidz/task/group/{group}', 'MentorTaskController@taskByGroup')->middleware('auth:mentor');
    Route::get('/mentor/group', 'HomeStudentController@view_group')->middleware('auth:mentor');
    
    
    Route::get('/mentor/tahfidz/presensi', 'AbsensiController@v_mentor');
    Route::get('/mentor/tahfidz/presensi/{group}', 'AbsensiController@mentorInputGroup');
    Route::post('/mentor/tahfidz/presensi/save', 'AbsensiController@store');


    //Student
    Route::get('/mentor/student/tahfidz', 'MentorTaskController@getStudent')->middleware('auth:mentor');


    
    // Profile Section
    Route::view('/mentor/profile', 'mentor.profile')->middleware('auth:mentor');
    Route::post('/mentor/profile/update', 'MentorController@update');
    Route::post('/mentor/profile/update-pass', 'MentorController@updatePassword')->name('mentor.update-password');

    Route::post('tahfidz/group/announcement/save', 'GroupController@updateAnnouncement');

    Route::get('/mentor/tahfidz/quiz', 'TahfidzQuizController@manage');
    Route::post('/mentor/tahfidz/quiz/save', 'TahfidzQuizController@save');
    Route::post('/mentor/tahfidz/quiz/delete', 'TahfidzQuizController@delete');
    Route::post('/mentor/tahfidz/quiz/update', 'TahfidzQuizController@update');

    Route::post('/correction/save', 'MentorTaskController@updateTask')->middleware('auth:mentor');
    Route::get('/correction/deleteCorrectionAudio/{id}', 'MentorTaskController@deleteCorrectionAudio')->middleware('auth:mentor');
});




Route::post('/logout-student', 'Auth\LoginController@logoutStudent')->name('logout-student');
Route::post('/logout-mentor', 'Auth\LoginController@logoutMentor')->name('logout-mentor');

//WARNING NO MIDDLEWARE
Route::get('tahfidz/task/{id}/delete', 'MentorTaskController@delete');
Route::get('tahfidz/task/{id}/deleteFromStudent', 'TahfidzTaskController@deleteByStudent');
Route::post('task/save', 'TahfidzTaskController@simpan');

Route::get('/tahfidz/presensi/report', 'AbsensiController@vSeeReport');
Route::get('/tahfidz/presensi/report/{id}', 'AbsensiController@seeReport');




Route::get('/home', 'HomeController@index');

Route::get('/login/mentor', 'Auth\LoginController@showMentorLoginForm');
Route::get('/login/student', 'Auth\LoginController@showStudentLoginForm');
Route::get('/register/mentor', 'Auth\RegisterController@showMentorRegisterForm');
Route::get('/register/student', 'Auth\RegisterController@showStudentRegisterForm');

Route::post('/login/mentor', 'Auth\LoginController@mentorLogin')->name('login-mentor');
Route::post('/login/student', 'Auth\LoginController@studentLogin')->name('login-student');
Route::post('/register/mentor', 'Auth\RegisterController@createMentor')->name('regis-mentor');
Route::post('/register/student', 'Auth\RegisterController@createStudent')->name('regis-student');

Route::get('/admin', 'AdminHomeController@home')->middleware('auth');
Route::get('/mentor', 'MentorController@home')->middleware('auth:mentor');
Route::get('/student', 'StudentController@home')->middleware('auth:student');


Route::get('/students', 'StudentController@retrieveAll')->name('students');

Auth::routes();
