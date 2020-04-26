<?php

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

Auth::routes();

Route::get('/user', 'UsersController@index')->name('user');
Route::get('/search', 'SearchController@search');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');


Route::get('/skills/{profile}','SkillsController@index')->name('skill.show');
Route::get('/skills/{profile}/create','SkillsController@create');
Route::get('/skills/{skill}/edit', 'SkillsController@edit')->name('skills.edit');
Route::patch('/skills/{skill}', 'SkillsController@update')->name('skill.update');
Route::post('/skills','SkillsController@store');
Route::delete('/skills/{skill}', 'SkillsController@delete');

Route::get('/edu/{profile}', 'EducationController@index')->name('education');

Route::post('/api/edu/{profile}','EducationController@store');
Route::patch('/api/edu/{education}','EducationController@update');
Route::get('/api/edu/{profile}', 'EducationController@get');
Route::delete('/api/edu/{education}', 'EducationController@delete');

Route::get('/work/{profile}','WorkController@index')->name('work.show');
Route::get('/work/{profile}/create','WorkController@create');
Route::get('/work/{work}/edit', 'WorkController@edit')->name('work.edit');
Route::patch('/work/{work}', 'WorkController@update')->name('work.update');
Route::post('/work','WorkController@store');
Route::delete('/work/{work}', 'WorkController@delete');
Route::get('/work/del/{workdesc}', 'WorkController@delDesc');

Route::get('/api/users', 'UsersController@getAll');
Route::post('/api/users', 'UsersController@store');
Route::patch('/api/users/{user}', 'UsersController@update');
Route::delete('/api/users/{user}', 'UsersController@delete');
