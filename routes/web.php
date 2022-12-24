<?php

use App\Http\Controllers\ViewController;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\StatusKeluargaController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\KkController;
use App\Http\Controllers\JenisSuratController;
use App\Http\Controllers\FormatSuratController;
use App\Http\Controllers\DetailKkController;
use App\Http\Controllers\PermohonanSuratController;
use App\Http\Controllers\PengesahanController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\FormatPengesahanController;





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

//VIEW
Route::get('/admin/agamaview', [ViewController::class, 'agamaView'])->name('agama-view');
Route::get('/admin/pekerjaanview', [ViewController::class, 'pekerjaanView'])->name('pekerjaan-view');
Route::get('/admin/pendidikanview', [ViewController::class, 'pendidikanView'])->name('pendidikan-view');
Route::get('/admin/statuskeluargaview', [ViewController::class, 'statusKeluargaView'])->name('statuskeluarga-view');
Route::get('/admin/pendudukview', [ViewController::class, 'pendudukView'])->name('penduduk-view');
Route::get('/admin/kkview', [ViewController::class, 'kkView'])->name('kk-view');
Route::get('/admin/detailkkview/{nokk}', [ViewController::class, 'detailKkView'])->name('detail-kk-view');
Route::get('/admin/jenissuratview', [ViewController::class, 'jenisSuratView'])->name('jeniss-surat-view');
Route::get('/admin/formatsuratview', [ViewController::class, 'FormatSuratView'])->name('format-surat-view');
Route::get('/admin/permohonansuratview', [ViewController::class, 'permohonanSuratView'])->name('permohonan-surat-view');
Route::get('/admin/suratmasukview', [ViewController::class, 'suratMasukView'])->name('surat-masuk-view');
Route::get('/admin/suratkeluarview', [ViewController::class, 'suratKeluarView'])->name('surat-keluar-view');
Route::get('/admin/pengesahanview', [ViewController::class, 'pengesahanView'])->name('pengesahan-view');

Route::get('/admin/previewsurat', [ViewController::class, 'previewSuratView'])->name('preview-surat-view');

//AGAMA
Route::get('/admin/gettabelagama', [AgamaController::class, 'getTabelAgama'])->name('get-tabel-agama');
Route::get('/admin/getallagama', [AgamaController::class, 'getAllAgama'])->name('get-all-agama');
Route::get('/admin/getagama/{id}', [AgamaController::class, 'getAgamaById'])->name('get-agama-by-id');
Route::any('/admin/tambahagama', [AgamaController::class, 'tambahAgama'])->name('tambah-agama');
Route::post('/admin/updateagama', [AgamaController::class, 'updateAgama'])->name('update-agama');
Route::get('/admin/hapusagama/{id}', [AgamaController::class, 'hapusAgama'])->name('hapus-agama');

//PEKERJAAN
Route::get('/admin/gettabelpekerjaan', [PekerjaanController::class, 'getTabelPekerjaan'])->name('get-tabel-pekerjaan');
Route::get('/admin/getallpekerjaan', [PekerjaanController::class, 'getAllPekerjaan'])->name('get-all-pekerjaan');
Route::get('/admin/getpekerjaan/{id}', [PekerjaanController::class, 'getPekerjaanById'])->name('get-pekerjaan-by-id');
Route::any('/admin/tambahpekerjaan', [PekerjaanController::class, 'tambahPekerjaan'])->name('tambah-pekerjaan');
Route::post('/admin/updatepekerjaan', [PekerjaanController::class, 'updatePekerjaan'])->name('update-pekerjaan');
Route::get('/admin/hapuspekerjaan/{id}', [PekerjaanController::class, 'hapusPekerjaan'])->name('hapus-pekerjaan');

//JENISSURAT
Route::get('/admin/gettabeljenissurat', [JenisSuratController::class, 'getTabelJenisSurat'])->name('get-tabel-jenissurat');
Route::get('/admin/getalljenissurat', [JenisSuratController::class, 'getAllJenisSurat'])->name('get-all-jenissurat');
Route::get('/admin/getjenissurat/{id}', [JenisSuratController::class, 'getJenisSuratById'])->name('get-jenissurat-by-id');
Route::any('/admin/tambahjenissurat', [JenisSuratController::class, 'tambahJenisSurat'])->name('tambah-jenissurat');
Route::post('/admin/updatejenissurat', [JenisSuratController::class, 'updateJenisSurat'])->name('update-jenissurat');
Route::get('/admin/hapusjenissurat/{id}', [JenisSuratController::class, 'hapusJenisSurat'])->name('hapus-jenissurat');

//FORMATSURAT
Route::get('/admin/gettabelformatsurat', [FormatSuratController::class, 'getTabelFormatSurat'])->name('get-tabel-formatsurat');
Route::get('/admin/getallformatsurat', [FormatSuratController::class, 'getAllFormatSurat'])->name('get-all-formatsurat');
Route::get('/admin/getformatsuratbyjenissurat/{jenissurat}', [FormatSuratController::class, 'getFormatSuratByJenisSurat'])->name('get-formatsurat-by-jenissurat');
Route::get('/admin/getformatsurat/{id}', [FormatSuratController::class, 'getFormatSuratById'])->name('get-formatsurat-by-id');
Route::any('/admin/tambahformatsurat', [FormatSuratController::class, 'tambahFormatSurat'])->name('tambah-formatsurat');
Route::post('/admin/updateformatsurat', [FormatSuratController::class, 'updateFormatSurat'])->name('update-formatsurat');
Route::get('/admin/hapusformatsurat/{id}', [FormatSuratController::class, 'hapusFormatSurat'])->name('hapus-formatsurat');
Route::get('/admin/lihatformatsurat/{id}', [FormatSuratController::class, 'lihatFormatSurat'])->name('lihat-formatsurat');


//PENDIDIKAN
Route::get('/admin/gettabelpendidikan', [PendidikanController::class, 'getTabelPendidikan'])->name('get-tabel-pendidikan');
Route::get('/admin/getallpendidikan', [PendidikanController::class, 'getAllPendidikan'])->name('get-all-pendidikan');
Route::get('/admin/getpendidikan/{id}', [PendidikanController::class, 'getPendidikanById'])->name('get-pendidikan-by-id');
Route::any('/admin/tambahpendidikan', [PendidikanController::class, 'tambahPendidikan'])->name('tambah-pendidikan');
Route::post('/admin/updatependidikan', [PendidikanController::class, 'updatePendidikan'])->name('update-pendidikan');
Route::get('/admin/hapuspendidikan/{id}', [PendidikanController::class, 'hapusPendidikan'])->name('hapus-pendidikan');

//STATUS KELUARGA
Route::get('/admin/gettabelstatuskeluarga', [StatusKeluargaController::class, 'getTabelStatusKeluarga'])->name('get-tabel-statuskeluarga');
Route::get('/admin/getallstatuskeluarga', [StatusKeluargaController::class, 'getAllStatusKeluarga'])->name('get-all-statuskeluarga');
Route::get('/admin/getstatuskeluarga/{id}', [StatusKeluargaController::class, 'getStatusKeluargaById'])->name('get-statuskeluarga-by-id');
Route::any('/admin/tambahstatuskeluarga', [StatusKeluargaController::class, 'tambahStatusKeluarga'])->name('tambah-statuskeluarga');
Route::post('/admin/updatestatuskeluarga', [StatusKeluargaController::class, 'updateStatusKeluarga'])->name('update-statuskeluarga');
Route::get('/admin/hapusstatuskeluarga/{id}', [StatusKeluargaController::class, 'hapusStatusKeluarga'])->name('hapus-statuskeluarga');

//PENDUDUK
Route::get('/admin/gettabelpenduduk', [PendudukController::class, 'getTabelPenduduk'])->name('get-tabel-penduduk');
Route::get('/admin/getallpenduduk', [PendudukController::class, 'getAllPenduduk'])->name('get-all-penduduk');
Route::get('/admin/getpenduduk/{id}', [PendudukController::class, 'getPendudukById'])->name('get-penduduk-by-id');
Route::get('/admin/getpendudukbynik/{nik}', [PendudukController::class, 'getPendudukByNik'])->name('get-penduduk-by-nik');
Route::any('/admin/tambahpenduduk', [PendudukController::class, 'tambahPenduduk'])->name('tambah-penduduk');
Route::post('/admin/updatependuduk', [PendudukController::class, 'updatePenduduk'])->name('update-penduduk');
Route::get('/admin/hapuspenduduk/{id}', [PendudukController::class, 'hapusPenduduk'])->name('hapus-penduduk');

//KARTU KELUARGA
Route::get('/admin/gettabelkk', [KkController::class, 'getTabelKk'])->name('get-tabel-kk');
Route::get('/admin/getallkk', [KkController::class, 'getAllKk'])->name('get-all-kk');
Route::get('/admin/getkk/{nokk}', [KkController::class, 'getKkByNoKk'])->name('get-kk-by-id');
Route::any('/admin/tambahkk', [KkController::class, 'tambahKk'])->name('tambah-kk');
Route::post('/admin/updatekk', [KkController::class, 'updateKk'])->name('update-kk');
Route::get('/admin/hapuskk/{id}', [KkController::class, 'hapusKk'])->name('hapus-kk');

//DETAIL KARTU KELUARGA
Route::get('/admin/gettabeldetailkk/{nokk}', [DetailKkController::class, 'getTabelDetailKk'])->name('get-tabel-detailkk');
Route::get('/admin/getalldetailkk', [DetailKkController::class, 'getAllDetailKk'])->name('get-all-detailkk');
Route::get('/admin/getdetailkk/{id}', [DetailKkController::class, 'getDetailKkById'])->name('get-detailkk-by-id');
Route::get('/admin/getdetailkkbykk/{nokk}', [DetailKkController::class, 'getDetailKkByNoKk'])->name('get-detailkk-by-nokk');
Route::any('/admin/tambahdetailkk', [DetailKkController::class, 'tambahDetailKk'])->name('tambah-detailkk');
Route::post('/admin/updatedetailkk', [DetailKkController::class, 'updateDetailKk'])->name('update-detailkk');
Route::get('/admin/hapusdetailkk/{id}', [DetailKkController::class, 'hapusDetailKk'])->name('hapus-detailkk');

// SURAT MASUK
Route::get('/admin/gettabelsuratmasuk', [SuratMasukController::class, 'getTabelSuratMasuk'])->name('get-tabel-suratmasuk');
Route::get('/admin/getallsuratmasuk', [SuratMasukController::class, 'getAllSuratMasuk'])->name('get-all-suratmasuk');
Route::get('/admin/getsuratmasuk/{id}', [SuratMasukController::class, 'getSuratMasukById'])->name('get-suratmasuk-by-id');
Route::any('/admin/tambahsuratmasuk', [SuratMasukController::class, 'tambahSuratMasuk'])->name('tambah-suratmasuk');
Route::post('/admin/updatesuratmasuk', [SuratMasukController::class, 'updateSuratMasuk'])->name('update-suratmasuk');
Route::get('/admin/hapussuratmasuk/{id}', [SuratMasukController::class, 'hapusSuratMasuk'])->name('hapus-suratmasuk');

// PERMOHONAN SURAT MASUK
Route::get('/admin/gettabelpermohonansurat', [PermohonanSuratController::class, 'getTabelPermohonanSurat'])->name('get-tabel-permohonansurat');
Route::get('/admin/gettabelriwayatpermohonansurat', [PermohonanSuratController::class, 'getTabelRiwayatPermohonanSurat'])->name('get-tabel-riwayat-permohonansurat');
Route::get('/admin/getallpermohonansurat', [PermohonanSuratController::class, 'getAllPermohonanSurat'])->name('get-all-permohonansurat');
Route::get('/admin/getpermohonansurat/{id}', [PermohonanSuratController::class, 'getPermohonanSuratById'])->name('get-permohonansurat-by-id');
Route::any('/admin/tambahpermohonansurat', [PermohonanSuratController::class, 'tambahPermohonanSurat'])->name('tambah-permohonansurat');
Route::post('/admin/updatepermohonansurat', [PermohonanSuratController::class, 'updatePermohonanSurat'])->name('update-permohonansurat');
Route::get('/admin/hapuspermohonansurat/{id}', [PermohonanSuratController::class, 'hapusPermohonanSurat'])->name('hapus-permohonansurat');
Route::get('/admin/terimapermohonansurat/{id}', [PermohonanSuratController::class, 'terimaPermohonanSurat'])->name('terima-permohonansurat');
Route::get('/admin/tolakpermohonansurat/{id}', [PermohonanSuratController::class, 'tolakPermohonanSurat'])->name('tolak-permohonansurat');



// PENGESAHAN / TTD
Route::get('/admin/datatabelpengesahan', [PengesahanController::class, 'getTabelPengesahan'])->name('tabel-pengesahan');
Route::get('/admin/dataallpengesahan', [PengesahanController::class, 'getAllPengesahan'])->name('get-all-pengesahan');
Route::get('/admin/datapengesahan/{id}', [PengesahanController::class, 'getPengesahan'])->name('get-pengesahan');
Route::any('/admin/insertpengesahan', [PengesahanController::class, 'insertPengesahan'])->name('insert-pengesahan');
Route::get('/admin/deletepengesahan/{id}', [PengesahanController::class, 'deletePengesahan'])->name('delete-pengesahan');
Route::any('/admin/updatepengesahan', [PengesahanController::class, 'updatePengesahan'])->name('update-pengesahan');

// SURAT KELUAR
Route::get('/admin/gettabelsuratkeluar', [SuratKeluarController::class, 'getTabelSuratKeluar'])->name('get-tabel-suratkeluar');
Route::get('/admin/gettabelsuratkeluarapprove', [SuratKeluarController::class, 'getTabelSuratKeluarApprove'])->name('get-tabel-suratkeluar-approve');
Route::get('/admin/getallsuratkeluar', [SuratKeluarController::class, 'getAllSuratKeluar'])->name('get-all-suratkeluar');
Route::get('/admin/getsuratkeluar/{id}', [SuratKeluarController::class, 'getSuratKeluarById'])->name('get-suratkeluar-by-id');
Route::any('/admin/tambahsuratkeluar', [SuratKeluarController::class, 'tambahSuratKeluar'])->name('tambah-suratkeluar');
Route::post('/admin/updatesuratkeluar', [SuratKeluarController::class, 'updateSuratKeluar'])->name('update-suratkeluar');
Route::get('/admin/hapussuratkeluar/{id}', [SuratKeluarController::class, 'hapusSuratKeluar'])->name('hapus-suratkeluar');

// FORMAT PENGESAHAN / KAKI SURAT
Route::get('/admin/datatabelformatpengesahan', [FormatPengesahanController::class, 'getTabelFormatPengesahan'])->name('tabel-formatpengesahan');
Route::get('/admin/dataallformatpengesahan', [FormatPengesahanController::class, 'getAllFormatPengesahan'])->name('get-all-formatpengesahan');
Route::get('/admin/dataformatpengesahan/{id}', [FormatPengesahanController::class, 'getFormatPengesahan'])->name('get-formatpengesahan');
Route::any('/admin/insertformatpengesahan', [FormatPengesahanController::class, 'insertFormatPengesahan'])->name('insert-formatpengesahan');
Route::get('/admin/deleteformatpengesahan/{id}', [FormatPengesahanController::class, 'deleteFormatPengesahan'])->name('delete-formatpengesahan');
Route::any('/admin/updateformatpengesahan', [FormatPengesahanController::class, 'updateFormatPengesahan'])->name('update-formatpengesahan');
