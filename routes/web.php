<?php

use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BkuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KamarControlleruser;
use App\Http\Controllers\Landing_pageController;
use App\Http\Controllers\LaporanlsController;
use App\Http\Controllers\LaporanRealisasiController;
use App\Http\Controllers\LapRekaptppController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\OpdController;
use App\Http\Controllers\PdfUploadController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\Realisasi_hd_Controller;
use App\Http\Controllers\Realisasi_HD_Controller as ControllersRealisasi_HD_Controller;
use App\Http\Controllers\RealisasiController;
use App\Http\Controllers\RealisasiControllerAdmin;
use App\Http\Controllers\RekapantppController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\ScanSp2dJsonController;
use App\Http\Controllers\SimpanSp2dsipdController;
use App\Http\Controllers\Sp2dController;
use App\Http\Controllers\Sp2dLogController;
use App\Http\Controllers\TarikSp2dController;
use App\Http\Controllers\UrusanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('Tampilan_tambahan.Landing_page');
// });

Route::get('/', [Landing_pageController::class, 'index']);
// Route::get('/', [MaintenanceController::class, 'index']);

// AUTH
Route::get('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/cek_login', [AuthController::class, 'cek_login']);
Route::get('/logout', [AuthController::class, 'logout']);

// HOME
Route::get('/home', [HomeController::class, 'index'])->middleware('auth:web','checkRole:Admin,User');

// DATA OPD
Route::get('/tampilopd', [OpdController::class, 'index'])->middleware('auth:web','checkRole:Admin,User');
Route::post('/opd/store', [OpdController::class, 'store'])->middleware('auth:web','checkRole:Admin');
Route::get('/opd/edit/{id}', [OpdController::class, 'edit'])->middleware('auth:web','checkRole:Admin');
Route::delete('/opd/destroy/{id}', [OpdController::class, 'destroy'])->middleware('auth:web','checkRole:Admin');

// DATA USER
Route::get('/tampiluser', [UserController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::post('/user/store', [UserController::class, 'store'])->middleware('auth:web','checkRole:Admin');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->middleware('auth:web','checkRole:Admin');
Route::delete('/user/destroy/{id}', [UserController::class, 'destroy'])->middleware('auth:web','checkRole:Admin');
Route::post('/user/aktif/{id}', [UserController::class, 'aktif'])->middleware('auth:web','checkRole:Admin');
Route::post('/user/nonaktif/{id}', [UserController::class, 'nonaktif'])->middleware('auth:web','checkRole:Admin');
Route::get('/user/opd', [UserController::class, 'getDataopd'])->middleware('auth:web','checkRole:Admin');


// DATA BKU
Route::get('/tampildatarealisasibelanja', [BkuController::class, 'index'])->middleware('auth:web','checkRole:User');
Route::get('/tampildatarealisasibelanjaadmin', [RealisasiControllerAdmin::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::get('/datarealisasi/export', [BkuController::class, 'export'])->middleware('auth:web','checkRole:User,User');
Route::get('/datarealisasiadmin/export', [RealisasiControllerAdmin::class, 'export'])->middleware('auth:web','checkRole:Admin');

// ======= DATA SP2D TPP =======
Route::get('/sp2dtpp', [LapRekaptppController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::get('/sp2dtpp/edit/{idhalaman}', [LapRekaptppController::class, 'editsp2dtpp'])->middleware('auth:web','checkRole:Admin');
Route::get('/sp2dtpp/update/{idhalaman}', [LapRekaptppController::class, 'updatesp2dtpp'])->middleware('auth:web','checkRole:Admin');
Route::get('/sp2dtpp/batal/{idhalaman}', [LapRekaptppController::class, 'batalsp2dtpp'])->middleware('auth:web','checkRole:Admin');
Route::post('/sp2dtpp/store', [LapRekaptppController::class, 'store'])->middleware('auth:web','checkRole:Admin');
Route::post('/sp2dtpp/batalupdate/{idhalaman}', [LapRekaptppController::class, 'batalupdate'])->middleware('auth:web','checkRole:Admin');
Route::post('/sp2dtpp/update/{idhalaman}', [LapRekaptppController::class, 'update'])->middleware('auth:web','checkRole:Admin');

// REKAPAN REKENING 
Route::get('/tampilrekapantpp', [RekapantppController::class, 'index'])->name('view.dataindex.index')->middleware('auth:web','checkRole:Admin');
Route::get('/tampilrekapantpp/{id}/tampilawal', [RekapantppController::class, 'viewdataindex'])->name('view.data.tampil')->middleware('auth:web','checkRole:Admin');
Route::get('/tampilrekapantpp/{id}/tampil', [RekapantppController::class, 'viewdataindex'])->name('view.data.tampil')->middleware('auth:web','checkRole:Admin');
Route::get('/bku/opd', [RekapantppController::class, 'getDataopd'])->middleware('auth:web','checkRole:Admin');

// LAPORAN REALISASI TES 
// Route::get('/tampillaprealisasi', [LaporanRealisasiController::class, 'index'])->name('view.dataindex.index')->middleware('auth:web','checkRole:Admin');
// Route::get('/tampillaprealisasi/{id}/tampilawal', [LaporanRealisasiController::class, 'viewdataindex'])->name('view.data.tampil')->middleware('auth:web','checkRole:Admin');
// Route::get('/tampillaprealisasi/{id}/tampil', [LaporanRealisasiController::class, 'viewdataindex'])->name('view.data.tampil')->middleware('auth:web','checkRole:Admin');

// SCAN SP2D JSON
Route::get('/tampilrsp2dupload', [ScanSp2dJsonController::class, 'index'])->name('view.dataindex.index')->middleware('auth:web','checkRole:Admin');
Route::post('/sp2d/upload', [ScanSp2dJsonController::class, 'upload'])->name('sp2d.upload')->middleware('auth:web','checkRole:Admin');

// SCAN SP2D JSON
Route::get('/tampilsp2dsipd', [SimpanSp2dsipdController::class, 'index'])->middleware('auth:web','checkRole:Admin');

// DATA SP2D
Route::post('/sp2d/upload-pdf', [PdfUploadController::class, 'upload'])->name('sp2d.upload')->middleware(['auth:web', 'checkRole:User']);
Route::get('/sp2d', [Sp2dController::class, 'index'])->name('sp2d.index')->middleware('auth:web','checkRole:User');
Route::get('/sp2d/data', [Sp2dController::class, 'getData'])->name('sp2d.data')->middleware('auth:web','checkRole:User');
Route::get('/sp2d/{id}', [Sp2dController::class, 'show'])->name('sp2d.show')->middleware('auth:web','checkRole:User');
Route::delete('/sp2d/{id}', [Sp2dController::class, 'destroy'])->middleware('auth:web','checkRole:User');
Route::get('/sp2d/log', [Sp2dLogController::class, 'index'])->name('sp2d.log')->middleware('auth:web','checkRole:User');
Route::post('/rekening-belanja/update-nilai', [Sp2dController::class, 'updateNilai'])->name('rekening.updateNilai')->middleware('auth:web','checkRole:User');

// URUSAN
Route::get('/dataurusan', [UrusanController::class, 'index'])->name('dataurusan.index')->middleware('auth:web','checkRole:Admin');
Route::post('/urusan/import', [UrusanController::class, 'importExcel'])->name('urusan.import')->middleware('auth:web','checkRole:Admin');
// Export Excel dari view (ambil data dari API)
Route::get('/urusan/export', [UrusanController::class, 'exportExcel'])
    ->name('urusan.export')
    ->middleware('auth:web', 'checkRole:Admin');