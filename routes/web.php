<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportDashboardOutletController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeMemberController;
use App\Http\Controllers\LoginMemberController;
use App\Http\Controllers\NonPersonaController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PendaftaranFaskesController;
use App\Http\Controllers\PendaftaranPasienController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReagenController;
use App\Http\Controllers\RequestAjaxController;
use App\Http\Controllers\ReserPasswordMember;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\RiwayatTindakanController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TargetGenController;
use App\Http\Controllers\TindakanController;
use App\Http\Controllers\TipeklienController;
use App\Http\Controllers\KlienController;
use App\Http\Controllers\TipePembayaranController;
use App\Http\Controllers\HasilTesController;
use App\Http\Controllers\HasilTesAntigenController;
use App\Http\Controllers\HasilTesAntigenFaskesController;
use App\Http\Controllers\HasilTesAntigenNonfaskeController;
use App\Http\Controllers\HasilTesPCRFaskesController;
use App\Http\Controllers\HasilTesPCRNonFaskesController;
use App\Http\Controllers\TransaksiRawatJalanController;
use App\Http\Controllers\GantiPasswordController;
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


Route::group(['middleware' => 'lastSignMember'], function () {
    Route::get('/', [LoginMemberController::class, 'index']);
    Route::get('/logout', [LoginMemberController::class, 'logout']);
    Route::get('/registration', [LoginMemberController::class, 'create']);
    //Route::post('/registration', [LoginMemberController::class, 'store']);
    Route::post('/registration', [LoginMemberController::class, 'store'])->name('inputRegistration');

    Route::get('roles', [
        RoleController::class, 'index'
    ]);
    Route::post('/signMember', [LoginMemberController::class, 'sigIn']);
    Route::get('/verifyLogin/{code_token}', [LoginMemberController::class, 'verifykasi']);
    Route::resource('resetPassword', ReserPasswordMember::class);
});

Route::group(['middleware' => 'checkMember'], function () {
    //Home Page Member
    Route::resource('home', HomeMemberController::class);
    //pendaftaran member
    Route::resource('pendaftaran', PendaftaranPasienController::class);
    Route::resource('personal', PersonalController::class);
    Route::resource('nonPersonal', NonPersonaController::class);
    Route::resource('carts', CartController::class);
    //pemesanan
    Route::resource('pemesanan', PemesananController::class);
    //Riwayatphp
    Route::resource('riwayat', RiwayatController::class);
    //profile
    Route::resource('profile', ProfileController::class);
});

Route::group(['middleware' => 'check'], function () {
    //Dashboard Admin
    Route::resource('dashboard', DashboardController::class);
    Route::resource('report-dashboard-outlet', ReportDashboardOutletController::class);
    Route::resource('outlet', OutletController::class);
    Route::resource('roles', RolesController::class);
    Route::resource('karyawan', EmployeeController::class);
    Route::resource('pasien', PasienController::class);
    Route::resource('rawatjalan', TransaksiRawatJalanController::class);
    Route::resource('riwayatTindakan', RiwayatTindakanController::class);
    Route::resource('faskes', PendaftaranFaskesController::class);
    Route::resource('tindakan', TindakanController::class);
    Route::resource('targetgen', TargetGenController::class);
    Route::resource('reagen', ReagenController::class);
    Route::resource('klien', KlienController::class);
    Route::resource('tipeklien', TipeklienController::class);
    Route::resource('tipepembayaran', TipePembayaranController::class);
    Route::resource('hasiltes', HasilTesController::class);
    Route::resource('hasil-tes-antigen', HasilTesAntigenController::class);
    Route::resource('hasil-tes-antigen-nonFaskes', HasilTesAntigenNonfaskeController::class);
    Route::resource('hasil-tes-antigen-Faskes', HasilTesAntigenFaskesController::class);
    Route::resource('hasil-tes-pcr-Faskes', HasilTesPCRFaskesController::class);
    Route::resource('hasil-tes-pcr-nonFaskes', HasilTesPCRNonFaskesController::class);
    Route::resource('gantiPassword', GantiPasswordController::class);

    // rooteAjax
    Route::post('/requestPasien', [RequestAjaxController::class, 'pasien']);
    Route::post('/requestTindakan', [RequestAjaxController::class, 'tindakan']);
    Route::post('/requestListTindakan', [RequestAjaxController::class, 'listTindakan']);
    Route::post('testPrice', [RequestAjaxController::class, 'testPrice'])->name('displayPrice');
    Route::get('logOut', [AdminController::class, 'logout']);
});
Route::group(['middleware' => 'lastSign'], function () {
    Route::get('admin', [AdminController::class, 'index']);
    Route::post('sigIn', [AdminController::class, 'store']);
});

