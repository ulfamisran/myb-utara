<?php

use App\Http\Controllers\ViewController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\TpsController;
use App\Http\Controllers\PallawaController;
use App\Http\Controllers\PatappaController;
use App\Http\Controllers\PemilihController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DownloadExcel;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\VwDataDashboardController;


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

Route::any('/ceklogin', [LoginController::class, 'cekLogin'])->name('cek-login');
Route::get('/logout', [LoginController::class, 'logOut'])->name('logout');


Route::get('/', function () {
    return view('landingpage.login');
});



Route::get('/ceksuratkeluar/{nik}', [LandingPageController::class, 'getCekSuratKeluarApprove'])->name('getCekSuratKeluarApprove');
Route::get('/lihatsuratapprove/{id}', [SuratPdfController::class, 'lihatSuratApprove'])->name('get-lihat-surat-approve-pdf');



// Route::middleware(['auth'])->group(function (){
    //VIEW

    Route::get('/admin/dashboardview', [ViewController::class, 'dashboardView'])->name('dashboard-view');
    Route::get('/admin/persebarantpsview', [ViewController::class, 'persebaranTpsView'])->name('persebaran-tps-view');
    Route::get('/admin/kecamatanview', [ViewController::class, 'kecamatanView'])->name('kecamatan-view');
    Route::get('/admin/kelurahanview/{id_kecamatan}', [ViewController::class, 'kelurahanView'])->name('kecamatan-view');
    Route::get('/admin/tpsview/{id_kecamatan}/{id_kelurahan}', [ViewController::class, 'tpsView'])->name('kecamatan-view');
    Route::get('/admin/pallawaview', [ViewController::class, 'pallawaView'])->name('pallawa-view');
    Route::get('/admin/patappaview/{id_pallawa}', [ViewController::class, 'patappaView'])->name('patappa-view');
    Route::get('/admin/pemilihbytimview/{id_pallawa}/{id_patappa}', [ViewController::class, 'pemilihByTimView'])->name('kecamatan-view');
    Route::get('/admin/pemilihbytpsview/{id_kecamatan}/{id_kelurahan}/{id_tps}', [ViewController::class, 'pemilihByTpsView'])->name('kecamatan-view');
    Route::get('/admin/persebarantpsview/{id_kecamatan}/{id_kelurahan}', [ViewController::class, 'persebaranTpsView'])->name('persebarantps-view');
    Route::get('/admin/persebarantimview/{id_pallawa}/{id_patappa}', [ViewController::class, 'persebaranTimView'])->name('persebarantim-view');



    //DASHBOARD
    Route::get('/admin/getdatadash', [VwDataDashboardController::class, 'getAllDataDashboard'])->name('get-data-dash');

    //KECAMATAN
    Route::get('/admin/gettabelkecamatan', [KecamatanController::class, 'getTabelKecamatan'])->name('get-tabel-kecamatan');
    Route::get('/admin/getallkecamatan', [KecamatanController::class, 'getAllKecamatan'])->name('get-all-kecamatan');
    Route::get('/admin/getkecamatan/{id}', [KecamatanController::class, 'getKecamatanById'])->name('get-kecamatan-by-id');
    Route::any('/admin/tambahkecamatan', [KecamatanController::class, 'tambahKecamatan'])->name('tambah-kecamatan');
    Route::post('/admin/updatekecamatan', [KecamatanController::class, 'updateKecamatan'])->name('update-kecamatan');
    Route::get('/admin/hapuskecamatan/{id}', [KecamatanController::class, 'hapusKecamatan'])->name('hapus-kecamatan');

    //KELURAHAN
    Route::get('/admin/gettabelkelurahan', [KelurahanController::class, 'getTabelKelurahan'])->name('get-tabel-kelurahan');
    Route::get('/admin/gettabelkelurahan/bykecamatan/{id_kec}', [KelurahanController::class, 'getTabelKelurahanByKecamatan'])->name('get-tabel-kelurahan-bykecamatan');
    Route::get('/admin/getallkelurahan', [KelurahanController::class, 'getAllKelurahan'])->name('get-all-kelurahan');
    Route::get('/admin/getkelurahan/{id}', [KelurahanController::class, 'getKelurahanById'])->name('get-kelurahan-by-id');
    Route::get('/admin/getkelurahan/bykecamatan/{id_kec}', [KelurahanController::class, 'getKelurahanByIdKecamatan'])->name('get-kelurahan-by-id-kecamatan');
    Route::any('/admin/tambahkelurahan', [KelurahanController::class, 'tambahKelurahan'])->name('tambah-kelurahan');
    Route::post('/admin/updatekelurahan', [KelurahanController::class, 'updateKelurahan'])->name('update-kelurahan');
    Route::get('/admin/hapuskelurahan/{id}', [KelurahanController::class, 'hapusKelurahan'])->name('hapus-kelurahan');

    //TPS
    // Route::get('/admin/gettabeltps', [TpsController::class, 'getTabelTps'])->name('get-tabel-tps');
    Route::get('/admin/gettabeltps/bykecamatan/{id_kec}', [TpsController::class, 'getTabelTpsByKecamatan'])->name('get-tabel-tps-bykecamatan');
    Route::get('/admin/gettabeltps/bykecamatan/bykelurahan/{id_kec}/{id_kel}', [TpsController::class, 'getTabelTps'])->name('get-tabel-tps-bykecamatan');
    Route::get('/admin/getalltps', [TpsController::class, 'getAllTps'])->name('get-all-tps');
    Route::get('/admin/gettps/{id}', [TpsController::class, 'getTpsById'])->name('get-tps-by-id');
    Route::get('/admin/gettps/bykecamatan/bykelurahan/{id_kec}/{id_kel}', [TpsController::class, 'getTpsByIdKecamatanKelurahan'])->name('get-tps-by-id-kecamatan');
    Route::get('/admin/gettps/bykecamatan/bykelurahan/bytps/{id_kec}/{id_kel}/{id_tps}', [TpsController::class, 'getTpsByIdKecamatanKelurahanTps'])->name('get-tps-by-id-kecamatan-kelurahan-tps');
    Route::any('/admin/tambahtps', [TpsController::class, 'tambahTps'])->name('tambah-tps');
    Route::post('/admin/updatetps', [TpsController::class, 'updateTps'])->name('update-tps');
    Route::get('/admin/hapustps/{id}', [TpsController::class, 'hapusTps'])->name('hapus-tps');

    //PALLAWA
    Route::get('/admin/gettabelpallawa', [PallawaController::class, 'getTabelPallawa'])->name('get-tabel-pallawa');
    Route::get('/admin/getallpallawa', [PallawaController::class, 'getAllPallawa'])->name('get-all-pallawa');
    Route::get('/admin/getpallawa/{id}', [PallawaController::class, 'getPallawaById'])->name('get-pallawa-by-id');
    Route::any('/admin/tambahpallawa', [PallawaController::class, 'tambahPallawa'])->name('tambah-pallawa');
    Route::post('/admin/updatepallawa', [PallawaController::class, 'updatePallawa'])->name('update-pallawa');
    Route::get('/admin/hapuspallawa/{id}', [PallawaController::class, 'hapusPallawa'])->name('hapus-pallawa');

    //PATAPPA
    Route::get('/admin/gettabelpatappa', [PatappaController::class, 'getTabelPatappa'])->name('get-tabel-patappa');
    Route::get('/admin/gettabelpatappa/bypallawa/{id_kec}', [PatappaController::class, 'getTabelPatappaByPallawa'])->name('get-tabel-patappa-bypallawa');
    Route::get('/admin/getallpatappa', [PatappaController::class, 'getAllPatappa'])->name('get-all-patappa');
    Route::get('/admin/getpatappa/{id}', [PatappaController::class, 'getPatappaById'])->name('get-patappa-by-id');
    Route::get('/admin/getpatappa/bypallawa/{id_kec}', [PatappaController::class, 'getPatappaByIdPallawa'])->name('get-patappa-by-id-pallawa');
    Route::any('/admin/tambahpatappa', [PatappaController::class, 'tambahPatappa'])->name('tambah-patappa');
    Route::post('/admin/updatepatappa', [PatappaController::class, 'updatePatappa'])->name('update-patappa');
    Route::get('/admin/hapuspatappa/{id}', [PatappaController::class, 'hapusPatappa'])->name('hapus-patappa');

    //PEMILIH
    Route::get('/admin/gettabelpemilih/bypallawa/bypatappa/{id_pallawa}/{id_patappa}', [PemilihController::class, 'getTabelPemilihByTim'])->name('get-tabel-pemilih-bypallawa');
    Route::get('/admin/gettabelpemilih/bytps/{id_kec}/{id_kel}/{id_tps}', [PemilihController::class, 'getTabelPemilihByTps'])->name('get-tabel-pemilih-bypallawa');
    Route::get('/admin/getallpemilih', [PemilihController::class, 'getAllPemilih'])->name('get-all-pemilih');
    Route::get('/admin/getpemilih/{id}', [PemilihController::class, 'getPemilihById'])->name('get-pemilih-by-id');
    Route::get('/admin/getpemilih/bypallawa/bypatappa/{id_pallawa}/{id_patappa}', [PemilihController::class, 'getPemilihByIdKecamatanKelurahan'])->name('get-pemilih-by-id-pallawa');
    Route::get('/admin/getpemilih/groupbytps/bypallawa/bypatappa/{id_pallawa}/{id_patappa}', [PemilihController::class, 'getTpsPemilihByTim'])->name('get-tps-pemilih-by-tim');
    Route::any('/admin/tambahpemilih', [PemilihController::class, 'tambahPemilih'])->name('tambah-pemilih');
    Route::post('/admin/updatepemilih', [PemilihController::class, 'updatePemilih'])->name('update-pemilih');
    Route::get('/admin/hapuspemilih/{id}', [PemilihController::class, 'hapusPemilih'])->name('hapus-pemilih');

    //DOWNLOAD EXCEL
    Route::post('/download-excel', [DownloadExcel::class, 'downloadExcel'])->name('get-data-dash');

// });
//ACCOUNT
Route::get('/admin/datatabelaccount', [AccountController::class, 'getTabelAccount'])->name('tabel-account');
Route::get('/admin/dataaccountall', [AccountController::class, 'getAllAccount'])->name('get-all-account');
Route::get('/admin/dataaccount/{id}', [AccountController::class, 'getAccount'])->name('get-account');
Route::any('/admin/insertaccount', [AccountController::class, 'insertAccount'])->name('insert-account');
Route::any('/admin/deleteaccount/{id}', [AccountController::class, 'deleteAccount'])->name('delete-account');
Route::any('/admin/resetaccount/{id}', [AccountController::class, 'resetAccount'])->name('reset-account');
Route::any('/admin/updatepassword/', [AccountController::class, 'updatePassword'])->name('reset-akun');
Route::get('/admin/userview', [ViewController::class, 'userView'])->name('user-surat-view');
