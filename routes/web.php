<?php

use App\Http\Controllers\Admin\MagberController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginCustomeController;
use App\Http\Controllers\Auth\RegisterCostumeController;
use App\Http\Controllers\DependantDropdownController;
use App\Http\Controllers\FrontPage\ProfileController as FrontPageProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\Role\PermissionController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\NotarisController;
use App\Http\Controllers\Admin\ALBController;
use App\Http\Controllers\Admin\RiwayatMagangController;
use App\Http\Controllers\Admin\AlbEventController;
use App\Http\Controllers\Admin\MagberTransactionController;
use App\Http\Controllers\Page\HomeController;
use App\Http\Controllers\PreviewController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [HomeController::class,'index']);

Route::get('/login', [LoginCustomeController::class,'index'])->name('login');
Route::post('/login', [LoginCustomeController::class,'login'])->name('login');

Route::get('/register1', [RegisterCostumeController::class,'index'])->name('register1');
Route::post('/register1', [RegisterCostumeController::class,'register'])->name('register1');

Route::get('/register', [RegisterCostumeController::class,'index'])->name('register');
Route::post('/register', [RegisterCostumeController::class,'register'])->name('register');
Route::post('/register/check', [RegisterCostumeController::class,'check_user'])->name('register.check');

// Laravolt/indonesia
Route::get('provinces', [DependantDropdownController::class,'provinces'])->name('provinces');
Route::get('cities', [DependantDropdownController::class,'cities'])->name('cities');
Route::get('districts', [DependantDropdownController::class,'districts'])->name('districts');
Route::get('villages', [DependantDropdownController::class,'villages'])->name('villages');

// read dari qc code
Route::get('/barcode/{id}', [PreviewController::class,'readQr'])->name('.read_qr');

Route::middleware('auth')->group(function () {
    // Route::get('/homes', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [ProfileController::class,'index'])->name('profile');
    Route::put('/profile', [ProfileController::class,'update'])->name('profile');
    Route::put('/profile/password', [ProfileController::class,'update_password'])->name('profile.password');
    // Route::put('/profile/attr', [ProfileController::class,'update'])->name('profile');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    Route::name('profile')->prefix('/profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index']);
        Route::put('/', [ProfileController::class, 'update']);
        Route::put('/password', [ProfileController::class, 'update_password'])->name('.password');
        Route::put('/photo', [ProfileController::class, 'update_photo'])->name('.photo');
    });

    //logout
    Route::post('/logout', [LoginCustomeController::class,'logout'])->name('logout');

    // role
    Route::name('role')->prefix('roles')->group(function(){
        Route::get('/', [RoleController::class,'index']);
        Route::post('/', [RoleController::class, 'store']);
        Route::delete('/', [RoleController::class, 'destroy']);
        Route::put('/', [RoleController::class, 'update']);
        Route::get('/data', [RoleController::class,'data'])->name('.data');
        Route::get('/getPermission', [RoleController::class,'getPermission'])->name('.getPermission');
        Route::get('/show', [RoleController::class,'show'])->name('.show');

    
    });
    //permission
    Route::name('permission')->prefix('/permission')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('.index');
        Route::post('/', [PermissionController::class, 'store']);
        Route::put('/', [PermissionController::class, 'update']);
        Route::get('/data', [PermissionController::class, 'data'])->name('.data');
        Route::delete('/', [PermissionController::class, 'destroy'])->name('.delete');
        Route::get('/show', [PermissionController::class,'show'])->name('.show');
    });
    //masterdata
    Route::name('master_data')->prefix('/master_data')->group(function () {
        Route::get('/', [MasterDataController::class, 'index'])->name('.index');
        Route::post('/', [MasterDataController::class, 'store']);
        Route::put('/', [MasterDataController::class, 'update']);
        Route::get('/data', [MasterDataController::class, 'data'])->name('.data');
        Route::delete('/', [MasterDataController::class, 'destroy'])->name('.delete');
        Route::get('/show', [MasterDataController::class,'show'])->name('.show');
        Route::get('/download/{id}', [MasterDataController::class,'download'])->name('.download');
       
    });

    //Notaris
    Route::name('notaris')->prefix('/notaris')->group(function () {
        Route::get('/data_diri', [NotarisController::class, 'data_diri'])->name('.data_diri');
        Route::post('/data_diri', [NotarisController::class, 'store'])->name('.data_diri');
        Route::get('/data_diri/edit', [NotarisController::class, 'data_diri_edit'])->name('.data_diri.edit');
    });

    //ALB
    Route::name('alb')->prefix('/alb')->group(function () {
        Route::get('/data_diri', [ALBController::class, 'data_diri'])->name('.data_diri');
        Route::post('/data_diri', [ALBController::class, 'store'])->name('.data_diri');
        Route::get('/data_diri/edit', [ALBController::class, 'data_diri_edit'])->name('.data_diri.edit');
        
        Route::get('/berkas', [ALBController::class, 'berkas'])->name('.berkas');
        Route::post('/berkas', [ALBController::class, 'store_berkas'])->name('.berkas');
        Route::get('/berkas/edit', [ALBController::class, 'berkas_edit'])->name('.berkas.edit');

        Route::get('/magang', [RiwayatMagangController::class, 'index'])->name('.magang');
        Route::get('/magang/riwayat', [RiwayatMagangController::class, 'data'])->name('.magang.riwayat');
        Route::post('/magang/riwayat', [RiwayatMagangController::class, 'store'])->name('.magang.riwayat');

        Route::get('/ttmb/riwayat', [RiwayatMagangController::class, 'data_ttmb'])->name('.ttmb.riwayat');
        Route::post('/ttmb/riwayat', [RiwayatMagangController::class, 'store_ttmb'])->name('.ttmb.riwayat');
    });

    // Maber
        // list
        Route::name('maber')->prefix('/maber')->group(function () {
            Route::get('/', [MagberController::class, 'index'])->name('.index');
            Route::post('/', [MagberController::class, 'store']);
            Route::put('/', [MagberController::class, 'update']);
            Route::get('/data', [MagberController::class, 'data'])->name('.data');
            Route::delete('/', [MagberController::class, 'destroy'])->name('.delete');
            Route::get('/show', [MagberController::class,'show'])->name('.show');
        });
        Route::name('bendahara_maber')->prefix('/bendahara/maber/')->group(function () {
            Route::get('/{id}', [MagberTransactionController::class, 'bendaharaIndex'])->name('.index');
            Route::get('get/datas', [MagberTransactionController::class, 'bendahara'])->name('.data');
            Route::get('show/{user}', [MagberTransactionController::class, 'show'])->name('.show');
           
        });
    

    // end maber

    // ALb trans
    Route::name('alb_event')->prefix('/alb_event')->group(function () {
        Route::get('/', [AlbEventController::class, 'index'])->name('.index');
        Route::post('/', [AlbEventController::class, 'store']);
        Route::put('/', [AlbEventController::class, 'update']);
        Route::get('/data', [AlbEventController::class, 'data'])->name('.data');
        Route::delete('/', [AlbEventController::class, 'destroy'])->name('.delete');
        Route::get('/show', [AlbEventController::class,'show'])->name('.show');
    });


    // end alb
    

    /** begin FRONT PAGE */
        //profile
        Route::name('profile_page')->prefix('/profile_page')->group(function () {
            Route::get('/', [FrontPageProfileController::class, 'index'])->name('.index');
            Route::post('/', [FrontPageProfileController::class, 'store']);
            Route::put('/', [FrontPageProfileController::class, 'update']);
            Route::get('/data', [FrontPageProfileController::class, 'data'])->name('.data');
            Route::delete('/', [FrontPageProfileController::class, 'destroy'])->name('.delete');
            Route::get('/show', [FrontPageProfileController::class,'show'])->name('.show');
        });

    /** end FRONT PAGE */
});
//pendaftaran maber
Route::get('/event_magber/{id}/', [MagberController::class,'eventMagber'])->name('event_magber');
Route::post('/event_magber', [MagberController::class,'eventMagberStore'])->name('event_magber_store');
Route::post('/event_magber_check', [MagberController::class,'eventMagberCheck'])->name('event_magber.check');
Route::get('/event_magber_success/{id}', [MagberController::class,'eventMagberSuccess'])->name('event_magber.success');

//pendaftaran alb
Route::get('/event_alb/{id}/daftar', [AlbEventController::class,'eventAlb'])->name('event_alb');
Route::post('/event_alb/register', [AlbEventController::class,'registerAlb'])->name('event_alb.register');
Route::get('/event_alb_success/{id}', [AlbEventController::class,'eventAlbSuccess'])->name('event_alb.success');

// Route::view('/table', 'components.table');
// Route::view('/form', 'components.form');
// Route::view('/register', 'components.register');
