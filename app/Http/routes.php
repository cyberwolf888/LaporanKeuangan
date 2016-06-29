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

    Route::group(['prefix'=>'pungutan', 'as'=>'pungutan'], function () {
    //Route::get('/getDagang/{id}',['uses'=>'Petugas\PungutanController@getDagang']);

        Route::group(['prefix'=>'harian', 'as'=>'.harian'], function () {
            Route::get('/',['uses'=>'Petugas\PungutanController@indexHarian']);
            Route::get('/create',['uses'=>'Petugas\PungutanController@createHarian']);
            Route::post('/create',['uses'=>'Petugas\PungutanController@storeHarian']);
            Route::get('/datatable',['uses'=>'Petugas\PungutanController@dataTableHarian', 'middleware' => 'ajax']);
            Route::get('/detail/{id}',['uses'=>'Petugas\PungutanController@showHarian']);
        });

        Route::group(['prefix'=>'bulanan', 'as'=>'.bulanan'], function () {
            Route::get('/',['uses'=>'Petugas\PungutanController@indexBulanan']);
            Route::get('/create',['uses'=>'Petugas\PungutanController@createBulanan']);
            Route::post('/create',['uses'=>'Petugas\PungutanController@storeBulanan']);
            Route::get('/datatable',['uses'=>'Petugas\PungutanController@dataTableBulanan', 'middleware' => 'ajax']);
            Route::get('/detail/{id}',['uses'=>'Petugas\PungutanController@showBulanan']);
        });

    });

    Route::group(['prefix'=>'tunggakan', 'as'=>'tunggakan'], function () {
        Route::group(['prefix'=>'harian', 'as'=>'.harian'], function () {
            Route::get('/create',['uses'=>'Petugas\PungutanController@createTunggakanHarian']);
            Route::get('/create/{date}',['uses'=>'Petugas\PungutanController@createTunggakanHarian']);
            Route::post('/create/{date}',['uses'=>'Petugas\PungutanController@storeTunggakanHarian']);
        });
        Route::group(['prefix'=>'bulanan', 'as'=>'.bulanan'], function () {
            Route::get('/create',['uses'=>'Petugas\PungutanController@createTunggakanBulanan']);
            Route::get('/create/{date}',['uses'=>'Petugas\PungutanController@createTunggakanBulanan']);
            Route::post('/create/{date}',['uses'=>'Petugas\PungutanController@storeTunggakanBulanan']);
        });
    });
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

    Route::group(['prefix'=>'setoran', 'as'=>'setoran'], function () {
        Route::get('/',['uses'=>'Operator\SetoranController@index']);
        Route::post('/',['uses'=>'Operator\SetoranController@index']);
        Route::get('/getPetugas',['uses'=>'Operator\SetoranController@getPetugas']);
        Route::get('/setor/{tgl}/{pasar}/{petugas}',['uses'=>'Operator\SetoranController@setor', 'as'=>'.setor']);
        Route::post('/setor/{tgl}/{pasar}/{petugas}',['uses'=>'Operator\SetoranController@update']);
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