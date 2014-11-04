<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::group(['before'=>'auth'], function() {
	/* 
	 * Toutes les routes dans ce groupe demande une authorisation (user login) 
	 */
	Route::get('/','HomeController@index');

	
		/* Classes */
		Route::resource('classes', 'ClassesController');
		
		
		/* Travaux pratiques (TP) */
		Route::get('distributionTP/{id}', ['as' => 'distributionTP', 'uses' => 'TPsController@distribuer']);
		Route::post('doDistributionsTP/{id}',  ['as' => 'doDistributionTP', 'uses' => 'TPsController@doDistribuer']);
		Route::any('tpsPourClasse', ['as' => 'tpsPourClasse', 'uses' => 'TPsController@itemsFor2Filters']);     //pour l'appel AJAX  
		Route::resource('tps', 'TPsController');
		
		/* Passation des TPs */ 
		Route::any('tpsPassationPourClasse', ['as' => 'tpsPassationPourClasse', 'uses' => 'TPsPassationController@itemsFor2Filters']);     //pour l'appel AJAX
		Route::get('tpsPassationIndex', ['as' => 'tpsPassation.index', 'uses' => 'TPsPassationController@index']);
		Route::get('tpsPassationRepondre/{etudiantId}/{classeId}/{tpId}', ['as' => 'tpsPassation.repondre', 'uses' => 'TPsPassationController@repondre']);
		Route::any('tpsPassationDoRepondre/{etudiantId}/{classeId}/{tpId}', ['as' => 'tpsPassation.doRepondre', 'uses' => 'TPsPassationController@doRepondre']);
				
		
		/* Questions */
		Route::any('questionsPourTp', ['as' => 'questionsPourTp', 'uses' => 'QuestionsController@itemsFor2Filters' ]);     //pour l'appel AJAX
		Route::resource('questions', 'QuestionsController');
		
		/* Etudiants */
		Route::post('etudiantsPourClasse', ['as' => 'etudiantsPourClasse', 'uses' => 'EtudiantsController@itemsFor2Filters']);     //pour l'appel AJAX
		Route::resource('etudiants', 'EtudiantsController');
	
		
		// la création d'un usager ne peu se faire que par un usager déjà connecté. 
		// TODO: ajouter que seul les gestionnaires peuvent le faire. Mais j'ai besoin de Entrust pour ca
		Route::get( 'users/create',                 'UserController@create');
		
});

// Confide routes
Route::post('users',                        'UserController@store');
Route::get( 'users/login',                  'UserController@login');
Route::post('users/login',                  'UserController@do_login');
Route::get( 'users/confirm/{code}',         'UserController@confirm');
Route::get( 'users/forgot_password',        'UserController@forgot_password');
Route::post('users/forgot_password',        'UserController@do_forgot_password');
Route::get( 'users/reset_password/{token}', 'UserController@reset_password');
Route::post('users/reset_password',         'UserController@do_reset_password');
Route::get( 'users/logout',                 'UserController@logout');

// Dashboard route
Route::get('userpanel/dashboard', function(){ return View::make('userpanel.dashboard'); });

// Applies auth filter to the routes within admin/
Route::when('userpanel/*', 'auth');
