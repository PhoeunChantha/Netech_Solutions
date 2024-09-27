<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\Website\MacController;
use App\Http\Controllers\Backends\RoleController;
use App\Http\Controllers\Backends\UserController;
use App\Http\Controllers\Backends\BrandController;
use App\Http\Controllers\Website\LaptopController;
use App\Http\Controllers\Website\AccountController;
use App\Http\Controllers\Website\DesktopController;
use App\Http\Controllers\Website\ServiceController;
use App\Http\Controllers\Backends\ProductController;
use App\Http\Controllers\Website\CheckoutController;
use App\Http\Controllers\Backends\CategoryController;
use App\Http\Controllers\Backends\LanguageController;
use App\Http\Controllers\Backends\DashboardController;
use App\Http\Controllers\Website\Auth\LoginController;
use App\Http\Controllers\Backends\NavigationController;
use App\Http\Controllers\Website\AccessoriesController;
use App\Http\Controllers\Backends\FileManagerController;
use App\Http\Controllers\Website\ProductCategoryController;
use App\Http\Controllers\Backends\BusinessSettingController;
use App\Http\Controllers\Website\HomeController as WebsiteHomeController;
use App\Http\Controllers\Backends\BannerController as BackendsBannerController;
use App\Http\Controllers\Website\Auth\LoginController as WebsiteAuthLoginController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    $language = \App\Models\BusinessSetting::where('type', 'language')->first();
    session()->put('language_settings', $language);
    return redirect()->back();
})->name('change_language');

Auth::routes();

// save temp file
Route::post('save_temp_file', [FileManagerController::class, 'saveTempFile'])->name('save_temp_file');
Route::get('remove_temp_file', [FileManagerController::class, 'removeTempFile'])->name('remove_temp_file');

// Route::get('/', function () {
//     return view('login');
// });
// Route::redirect('/', '/admin/dashboard');

Route::middleware(['SetFrontendSession'])->group(function () {
    Route::get('/', [WebsiteHomeController::class, 'index'])->name('home');
    Route::post('/web/login', [WebsiteAuthLoginController::class, 'login'])->name('web.login');
    Route::get('/web/logout', [WebsiteAuthLoginController::class, 'logout'])->name('web.logout');

    // Account page
    Route::get('/account/profile', [AccountController::class, 'profile'])->name('account.profile');
    Route::put('/account/profile/{id}/update', [AccountController::class, 'profileUpdate'])->name('account.profile.update');
    Route::post('/account/profile/store', [AccountController::class, 'profileStore'])->name('account.profile.store');


    //desktop route has start
    Route::get('/desktop/{slug}',[DesktopController::class, 'index'])->name('desktop.show');
    //laptop route has start
    Route::get('/laptop/{slug}', [LaptopController::class, 'index'])->name('laptop.show');
    //mac route has start
    Route::get('/mac/{slug}',[MacController::class, 'index'])->name('mac.show');

    Route::get('/services/{slug}',[ServiceController::class, 'index'])->name('services.show');
    Route::get('/accessories/{slug}',[AccessoriesController::class, 'index'])->name('accessories.show');

    Route::get('/category/{slug}',[ProductCategoryController::class, 'showCategoryProducts'])->name('category.show');

    // checkout route
    Route::get('/checkout',[CheckoutController::class, 'index'])->name('checkout');
});
// Route::get('/', [WebsiteHomeController::class, 'index'])->name('home');




Route::post('save_temp_file', [FileManagerController::class, 'saveTempFile'])->name('save_temp_file');
Route::get('remove_temp_file', [FileManagerController::class, 'removeTempFile'])->name('remove_temp_file');

// back-end
Route::middleware(['auth', 'CheckUserLogin', 'SetSessionData'])->group(function () {

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // setting
        Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
            Route::get('/', [BusinessSettingController::class, 'index'])->name('index');
            Route::put('/update', [BusinessSettingController::class, 'update'])->name('update');

            // language setup
            Route::group(['prefix' => 'language', 'as' => 'language.'], function () {
                Route::get('/', [LanguageController::class, 'index'])->name('index');
                Route::get('/create', [LanguageController::class, 'create'])->name('create');
                Route::post('/', [LanguageController::class, 'store'])->name('store');
                Route::get('/edit', [LanguageController::class, 'edit'])->name('edit');
                Route::put('/update', [LanguageController::class, 'update'])->name('update');
                Route::delete('delete/', [LanguageController::class, 'delete'])->name('delete');

                Route::get('/update-status', [LanguageController::class, 'updateStatus'])->name('update-status');
                Route::get('/update-default-status', [LanguageController::class, 'update_default_status'])->name('update-default-status');
                Route::get('/translate', [LanguageController::class, 'translate'])->name('translate');
                Route::post('translate-submit/{lang}', [LanguageController::class, 'translate_submit'])->name('translate.submit');
            });
        });

        Route::resource('user', UserController::class);
        Route::post('user/change-status', [UserController::class, 'ChangeUserStatus'])->name('user_change_status');

        Route::resource('role', RoleController::class);
        Route::resource('header', NavigationController::class);

        Route::resource('product', ProductController::class);

        Route::get('product-category/update_status', [CategoryController::class, 'updateStatus'])->name('product-category.update_status');
        Route::resource('product-category', CategoryController::class);

        Route::get('banner/update_status', [BackendsBannerController::class, 'updateStatus'])->name('banner.update_status');
        Route::resource('banner', BackendsBannerController::class);

        Route::resource('brand', BrandController::class);


        //header
        Route::get('/header', [DashboardController::class, 'header']);




    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
