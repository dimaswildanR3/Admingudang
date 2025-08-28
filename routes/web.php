<?php

use App\Http\Controllers\ActivityLogController;
use App\Models\Supplier;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HakAksesController;
use App\Http\Controllers\LaporanBarangKeluarController;
use App\Http\Controllers\LaporanBarangMasukController;
use App\Http\Controllers\LaporanStokController;
use App\Http\Controllers\ManajemenUserController;
use App\Http\Controllers\UbahPasswordController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\SuratPengajuanController;
use App\Http\Controllers\StokCabangController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TulisSuratController;
use App\Http\Controllers\SuratController;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\PengumumanController;

Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');


Route::middleware('auth')->group(function () {
    Route::resource('perusahaan', PerusahaanController::class);
    Route::resource('surat-pengajuan', SuratPengajuanController::class);
    Route::resource('stok-cabang', StokCabangController::class);
    Route::get('/notification/{id}/read', [App\Http\Controllers\NotificationController::class, 'read'])->name('notification.read');

Route::resource('surat', SuratController::class);
Route::resource('tulis', TulisSuratController::class);
Route::post('/surat/{surat}/approve', [SuratController::class, 'approve'])->name('surat.approve');
Route::post('/surat/{surat}/reject', [SuratController::class, 'reject'])->name('surat.reject');
Route::get('/stok-cabang/view/{cabang_id}', [StokCabangController::class, 'viewByCabang']);
// Route::prefix('surat/tulis')->group(function() {
//     Route::get('/', [SuratTulisController::class, 'index'])->name('tulis.index');
//     Route::post('/', [SuratTulisController::class, 'store'])->name('tulis.store');
// });
    Route::get('/perusahaan/get-data', [App\Http\Controllers\PerusahaanController::class, 'getData']);

    
    Route::group(['middleware' => 'checkRole:superadmin'], function(){
        Route::get('/data-pengguna/get-data', [ManajemenUserController::class, 'getDataPengguna']);
        Route::get('/api/role/', [ManajemenUserController::class, 'getRole']);
        Route::resource('/data-pengguna', ManajemenUserController::class);
    
        Route::get('/hak-akses/get-data', [HakAksesController::class, 'getDataRole']);
        Route::resource('/hak-akses', HakAksesController::class);
    });

    Route::group(['middleware' => 'checkRole:superadmin,kepala gudang'], function(){
        Route::resource('/aktivitas-user', ActivityLogController::class);
        
    });

    Route::group(['middleware' => 'checkRole:kepala gudang,superadmin,admin gudang'], function(){
        Route::resource('/dashboard', DashboardController::class);
        Route::get('/', [DashboardController::class, 'index']);
        
        Route::get('/laporan-stok/get-data', [LaporanStokController::class, 'getData']);
        Route::get('/laporan-stok/print-stok', [LaporanStokController::class, 'printStok']);
        Route::get('/api/satuan/', [LaporanStokController::class, 'getSatuan']);
        Route::resource('/laporan-stok', LaporanStokController::class);
       
        Route::get('/laporan-barang-masuk/get-data', [LaporanBarangMasukController::class, 'getData']);
        Route::get('/laporan-barang-masuk/print-barang-masuk', [LaporanBarangMasukController::class, 'printBarangMasuk']);
        Route::get('/api/supplier/', [LaporanBarangMasukController::class, 'getSupplier']);
        Route::resource('/laporan-barang-masuk', LaporanBarangMasukController::class);
    
        Route::get('/laporan-barang-keluar/get-data', [LaporanBarangKeluarController::class, 'getData']);
        Route::get('/laporan-barang-keluar/print-barang-keluar', [LaporanBarangKeluarController::class, 'printBarangKeluar']);
        Route::get('/api/customer/', [LaporanBarangKeluarController::class, 'getCustomer']);
        Route::resource('/laporan-barang-keluar', LaporanBarangKeluarController::class);

        Route::get('/ubah-password', [UbahPasswordController::class,'index']);
        Route::POST('/ubah-password', [UbahPasswordController::class, 'changePassword']);
    });


    Route::group(['middleware' => 'checkRole:superadmin,admin gudang'], function(){
        Route::get('/barang/get-data', [BarangController::class, 'getDataBarang']);
        Route::resource('/barang', BarangController::class);
    
        Route::get('/jenis-barang/get-data', [JenisController::class, 'getDataJenisBarang']);
        Route::resource('/jenis-barang', JenisController::class);
    
        Route::get('/satuan-barang/get-data', [SatuanController::class, 'getDataSatuanBarang']);
        Route::resource('/satuan-barang', SatuanController::class);
    
        Route::get('/supplier/get-data', [SupplierController::class, 'getDataSupplier']);
        Route::resource('/supplier', SupplierController::class);
    
        Route::get('/customer/get-data', [CustomerController::class, 'getDataCustomer']);
        Route::resource('/customer', CustomerController::class);
    
        Route::get('/api/barang-masuk/', [BarangMasukController::class, 'getAutoCompleteData']);
        Route::get('/barang-masuk/get-data', [BarangMasukController::class, 'getDataBarangMasuk']);
        Route::get('/api/satuan/', [BarangMasukController::class, 'getSatuan']);
        Route::resource('/barang-masuk', BarangMasukController::class);
    
        Route::get('/api/barang-keluar/', [BarangKeluarController::class, 'getAutoCompleteData']);
        Route::get('/barang-keluar/get-data', [BarangKeluarController::class, 'getDataBarangKeluar']);
        Route::get('/api/satuan/', [BarangKeluarController::class, 'getSatuan']);
        Route::resource('/barang-keluar', BarangKeluarController::class);
    });


});

require __DIR__.'/auth.php';
