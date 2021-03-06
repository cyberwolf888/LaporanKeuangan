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
            Route::get('/tarif/{id}',['uses'=>'Petugas\PungutanController@getTarifHarian']);
        });

        Route::group(['prefix'=>'bulanan', 'as'=>'.bulanan'], function () {
            Route::get('/',['uses'=>'Petugas\PungutanController@indexBulanan']);
            Route::get('/create',['uses'=>'Petugas\PungutanController@createBulanan']);
            Route::post('/create',['uses'=>'Petugas\PungutanController@storeBulanan']);
            Route::get('/datatable',['uses'=>'Petugas\PungutanController@dataTableBulanan', 'middleware' => 'ajax']);
            Route::get('/detail/{id}',['uses'=>'Petugas\PungutanController@showBulanan']);
            Route::get('/tarif/{id}',['uses'=>'Petugas\PungutanController@getTarifBulanan']);
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

    Route::group(['prefix'=>'profile', 'as'=>'profile'], function () {
        Route::get('/',['uses'=>'Petugas\ProfileController@index']);
        Route::post('/overview',['uses'=>'Petugas\ProfileController@overview']);
        Route::post('/avatar',['uses'=>'Petugas\ProfileController@avatar']);
        Route::post('/password',['uses'=>'Petugas\ProfileController@password']);
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

    Route::group(['prefix'=>'laporan', 'as'=>'laporan'], function () {
        Route::get('/keuangan',['uses'=>'Operator\LaporanController@indexKeuangan']);
        Route::post('/keuangan',['uses'=>'Operator\LaporanController@indexKeuangan']);
        Route::get('/keuangan/result/{start_date}/{end_date}/{pasar}/{sts_pungutan}',['uses'=>'Operator\LaporanController@resultKeuangan', 'as'=>'.resultKeuangan']);

        Route::get('/dagang',['uses'=>'Operator\LaporanController@indexDagang']);
        Route::post('/dagang',['uses'=>'Operator\LaporanController@indexDagang']);
        Route::get('/dagang/result/{start_date}/{end_date}/{pasar}/{komoditas}/{sts_dagang}',['uses'=>'Operator\LaporanController@resultDagang', 'as'=>'.resultDagang']);
    });

    Route::group(['prefix'=>'profile', 'as'=>'profile'], function () {
        Route::get('/',['uses'=>'Operator\ProfileController@index']);
        Route::post('/overview',['uses'=>'Operator\ProfileController@overview']);
        Route::post('/avatar',['uses'=>'Operator\ProfileController@avatar']);
        Route::post('/password',['uses'=>'Operator\ProfileController@password']);
    });

});

/*
 * End Routes
 */

/*
 * Router for user Dirut
 */
Route::group(['middleware' => ['auth', 'rbac:is,dirut'], 'prefix' => 'dirut'], function () {
    Route::get('/',['as'=>'dashboard','uses'=>'Dirut\DashboardController@index']);

    Route::group(['prefix'=>'pasar', 'as'=>'pasar'], function () {
        Route::get('/',['uses'=>'Dirut\PasarController@index']);
        Route::get('/create',['uses'=>'Dirut\PasarController@create']);
        Route::post('/create',['uses'=>'Dirut\PasarController@store']);
        Route::get('/datatable',['uses'=>'Dirut\PasarController@dataTable', 'middleware' => 'ajax']);
        Route::delete('/delete/{id}',['uses'=>'Dirut\PasarController@destroy', 'middleware' => 'ajax']);
        Route::get('/edit/{id}',['uses'=>'Dirut\PasarController@edit']);
        Route::post('/edit/{id}',['uses'=>'Dirut\PasarController@update']);
    });

    Route::group(['prefix'=>'dagang', 'as'=>'dagang'], function () {
        Route::get('/',['uses'=>'Dirut\DagangController@index']);
        Route::get('/create',['uses'=>'Dirut\DagangController@create']);
        Route::post('/create',['uses'=>'Dirut\DagangController@store']);
        Route::get('/datatable',['uses'=>'Dirut\DagangController@dataTable', 'middleware' => 'ajax']);
        Route::delete('/delete/{id}',['uses'=>'Dirut\DagangController@destroy', 'middleware' => 'ajax']);
        Route::get('/edit/{id}',['uses'=>'Dirut\DagangController@edit']);
        Route::post('/edit/{id}',['uses'=>'Dirut\DagangController@update']);
        Route::post('/approved/{id}',['uses'=>'Dirut\DagangController@approved']);
        Route::post('/pending/{id}',['uses'=>'Dirut\DagangController@pending']);
    });

    Route::group(['prefix'=>'laporan', 'as'=>'laporan'], function () {
        Route::get('/keuangan',['uses'=>'Dirut\LaporanController@indexKeuangan']);
        Route::post('/keuangan',['uses'=>'Dirut\LaporanController@indexKeuangan']);
        Route::get('/keuangan/result/{start_date}/{end_date}/{pasar}/{sts_pungutan}',['uses'=>'Dirut\LaporanController@resultKeuangan', 'as'=>'.resultKeuanganDirut']);

        Route::get('/dagang',['uses'=>'Dirut\LaporanController@indexDagang']);
        Route::post('/dagang',['uses'=>'Dirut\LaporanController@indexDagang']);
        Route::get('/dagang/result/{start_date}/{end_date}/{pasar}/{komoditas}/{sts_dagang}',['uses'=>'Dirut\LaporanController@resultDagang', 'as'=>'.resultDagangDirut']);
    });

    Route::group(['prefix'=>'tarif', 'as'=>'tarif'], function () {
        Route::get('/',['uses'=>'Dirut\TarifController@index']);
        Route::get('/edit/{id}',['uses'=>'Dirut\TarifController@edit']);
        Route::post('/edit/{id}',['uses'=>'Dirut\TarifController@update']);
    });

    Route::group(['prefix'=>'pegawai', 'as'=>'pegawai'], function () {
        Route::get('/dirut',['uses'=>'Dirut\PegawaiController@dirut']);
        Route::get('/dirut/create',['uses'=>'Dirut\PegawaiController@createDirut']);
        Route::post('/dirut/create',['uses'=>'Dirut\PegawaiController@storeDirut']);
        Route::get('/dirut/edit/{id}',['uses'=>'Dirut\PegawaiController@editDirut']);
        Route::post('/dirut/edit/{id}',['uses'=>'Dirut\PegawaiController@updateDirut']);

        Route::get('/operator',['uses'=>'Dirut\PegawaiController@operator']);
        Route::get('/operator/create',['uses'=>'Dirut\PegawaiController@createOperator']);
        Route::post('/operator/create',['uses'=>'Dirut\PegawaiController@storeOperator']);
        Route::get('/operator/edit/{id}',['uses'=>'Dirut\PegawaiController@editOperator']);
        Route::post('/operator/edit/{id}',['uses'=>'Dirut\PegawaiController@updateOperator']);

        Route::get('/petugas',['uses'=>'Dirut\PegawaiController@petugas']);
        Route::get('/petugas/create',['uses'=>'Dirut\PegawaiController@createPetugas']);
        Route::post('/petugas/create',['uses'=>'Dirut\PegawaiController@storePetugas']);
        Route::get('/petugas/edit/{id}',['uses'=>'Dirut\PegawaiController@editPetugas']);
        Route::post('/petugas/edit/{id}',['uses'=>'Dirut\PegawaiController@updatePetugas']);
    });

    Route::group(['prefix'=>'profile', 'as'=>'profile'], function () {
        Route::get('/',['uses'=>'Dirut\ProfileController@index']);
        Route::post('/overview',['uses'=>'Dirut\ProfileController@overview']);
        Route::post('/avatar',['uses'=>'Dirut\ProfileController@avatar']);
        Route::post('/password',['uses'=>'Dirut\ProfileController@password']);
    });

});
/*
 * End Routes
 */