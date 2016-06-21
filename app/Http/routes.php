<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/', function(){
    $isOperator = Auth::user()->hasRole('operator');
    $isPetugas = Auth::user()->hasRole('petugas');
    $isDirut = Auth::user()->hasRole('dirut');
    if($isPetugas){
        return redirect('/petugas');
    }
    if($isOperator){
        return redirect('/operator');
    }
    if($isDirut){
        return redirect('/dirut');
    }
})->middleware(['auth']);

/*
 * Router for user Petugas
 */
Route::group(['middleware' => ['auth', 'rbac:is,petugas'], 'prefix' => 'petugas'], function () {

    Route::get('/',['as'=>'dashboard','uses'=>'Petugas\DashboardController@index']);

});

/*
 * End Routes
 */

/*
 * Router for user Operator
 */
Route::group(['middleware' => ['auth', 'rbac:is,operator'], 'prefix' => 'operator'], function () {

    Route::get('/',['as'=>'dashboard','uses'=>'Operator\DashboardController@index']);

    Route::group(['prefix'=>'pasar', 'as'=>'pasar'], function () {
        Route::get('/',['uses'=>'Operator\PasarController@index']);
        Route::get('/create',['uses'=>'Operator\PasarController@create']);
        Route::post('/create',['uses'=>'Operator\PasarController@store']);
        Route::get('/datatable',['uses'=>'Operator\PasarController@dataTable', 'middleware' => 'ajax']);
        Route::delete('/delete/{id}',['uses'=>'Operator\PasarController@destroy', 'middleware' => 'ajax']);
        Route::get('/edit/{id}',['uses'=>'Operator\PasarController@edit']);
        Route::post('/edit/{id}',['uses'=>'Operator\PasarController@update']);
    });

    Route::group(['prefix'=>'komoditas', 'as'=>'komoditas'], function () {
        Route::get('/',['uses'=>'Operator\KomoditasController@index']);
        Route::get('/create',['uses'=>'Operator\KomoditasController@create']);
        Route::post('/create',['uses'=>'Operator\KomoditasController@store']);
        Route::get('/datatable',['uses'=>'Operator\KomoditasController@dataTable', 'middleware' => 'ajax']);
        Route::delete('/delete/{id}',['uses'=>'Operator\KomoditasController@destroy', 'middleware' => 'ajax']);
        Route::get('/edit/{id}',['uses'=>'Operator\KomoditasController@edit']);
        Route::post('/edit/{id}',['uses'=>'Operator\KomoditasController@update']);
    });

    Route::group(['prefix'=>'dagang', 'as'=>'dagang'], function () {
        Route::get('/',['uses'=>'Operator\DagangController@index']);
        Route::get('/create',['uses'=>'Operator\DagangController@create']);
        Route::post('/create',['uses'=>'Operator\DagangController@store']);
        Route::get('/datatable',['uses'=>'Operator\DagangController@dataTable', 'middleware' => 'ajax']);
        Route::delete('/delete/{id}',['uses'=>'Operator\DagangController@destroy', 'middleware' => 'ajax']);
        Route::get('/edit/{id}',['uses'=>'Operator\DagangController@edit']);
        Route::post('/edit/{id}',['uses'=>'Operator\DagangController@update']);
    });

});

/*
 * End Routes
 */

/*
 * Router for user Dirut
 */
Route::get('/dirut',function(){
    return 'Dirut';
})->middleware(['auth', 'rbac:is,dirut']);
/*
 * End Routes
 */