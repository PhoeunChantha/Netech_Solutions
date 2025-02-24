<?php

use App\Models\Discount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Website\MacController;
use App\Http\Controllers\website\MapController;
use App\Http\Controllers\Backends\PosController;
use App\Http\Controllers\Backends\RoleController;
use App\Http\Controllers\Backends\UserController;
use App\Http\Controllers\Backends\BrandController;
use App\Http\Controllers\Backends\VideoController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Backends\ReportController;
use App\Http\Controllers\Backends\SliderController;
use App\Http\Controllers\Website\AccountController;
use App\Http\Controllers\Website\ContactController;
use App\Http\Controllers\Website\DesktopController;
use App\Http\Controllers\website\PaymentController;
use App\Http\Controllers\Website\ProfileController;
use App\Http\Controllers\Backends\InvoiceController;
use App\Http\Controllers\Backends\ProductController;
use App\Http\Controllers\Backends\ServiceController;
use App\Http\Controllers\Website\CheckoutController;
use App\Http\Controllers\Backends\CategoryController;
use App\Http\Controllers\Backends\CustomerController;
use App\Http\Controllers\Backends\DiscountController;
use App\Http\Controllers\Backends\EmployeeController;
use App\Http\Controllers\Backends\LanguageController;
use App\Http\Controllers\Backends\PurchaseController;
use App\Http\Controllers\Backends\SupplierController;
use App\Http\Controllers\Backends\DashboardController;
use App\Http\Controllers\Website\Auth\LoginController;
use App\Http\Controllers\Backends\NavigationController;
use App\Http\Controllers\Backends\EmailConfigController;
use App\Http\Controllers\Backends\FileManagerController;
use App\Http\Controllers\Backends\TransactionController;
use App\Http\Controllers\Website\FrontServiceController;
use App\Http\Controllers\Website\PolicyAndTermController;
use App\Http\Controllers\Backends\TermAndPolicyController;
use App\Http\Controllers\Website\ProductCategoryController;
use App\Http\Controllers\Backends\BusinessSettingController;
use App\Http\Controllers\Backends\EmailConfigurationController;
use App\Http\Controllers\Website\HomeController as WebsiteHomeController;
use App\Http\Controllers\Backends\BannerController as BackendsBannerController;
use App\Http\Controllers\Website\AboutUsController as WebsiteAboutUsController;
use App\Http\Controllers\Backends\ContactController as BackendsContactController;

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
// website
Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
    Route::get('/web/login', [LoginController::class, 'signin'])->name('web.login')->middleware('guest:web');
    Route::post('/login', [LoginController::class, 'login'])->name('userlogin')->middleware('guest:web');

    Route::get('/signup', [LoginController::class, 'signup'])->name('signup')->middleware('guest:web');
    Route::post('/register', [LoginController::class, 'register'])->name('register')->middleware('guest:web');

    Route::get('/recover', [LoginController::class, 'recover'])->name('password.request')->middleware('guest:web');
    Route::get('/change-password', [LoginController::class, 'changePassword'])->name('change-password')->middleware('guest:web');
});
Route::middleware(['CheckUserLogin', 'SetFrontendSession'])->group(function () {
    // Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', [WebsiteHomeController::class, 'index'])->name('home');
    Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {

        Route::get('/logout', [LoginController::class, 'userLogout'])->name('logout');
    });
    Route::post('/send-forget-password', [LoginController::class, 'sendForgetPassword'])->name('send-forget-password');
    Route::get('/verify-otp-form', [LoginController::class, 'showVerifyOtpForm'])->name('verifyOtp-Form');
    Route::post('/verify-otp', [LoginController::class, 'verifyOtp'])->name('verifyOtp');
    Route::get('/reset-password-otp', [LoginController::class, 'resetPasswordOtp'])->name('resetPasswordOtp');
    Route::post('/resend-otp', [LoginController::class, 'sendForgetPassword'])->name('resend-Otp');
    Route::post('/otp-new-password', [LoginController::class, 'otpNewPassword'])->name('otp-new-password');


    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('/google', [GoogleController::class, 'redirectToGoogle'])->name('google');
        Route::get('/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
    });
    // Term and Policy
    Route::get('/web/privacy_policy', [PolicyAndTermController::class, 'privacy_policy'])->name('privacy_policy');
    Route::get('/web/term_condition', [PolicyAndTermController::class, 'term_condition'])->name('term_condition');
    // Account page
    Route::group(['prefix' => 'account', 'as' => 'account.'], function () {
        Route::get('/profile', [AccountController::class, 'profile'])->name('profile');
        Route::put('/profile/{id}/update', [AccountController::class, 'profileUpdate'])->name('profile.update');
        Route::post('/profile/store', [AccountController::class, 'profileStore'])->name('profile.store');
        Route::get('/orders', [AccountController::class, 'orderHistory'])->name('orderHistory');
        Route::get('/orders details', [AccountController::class, 'orderDetails'])->name('orderDetails');
        Route::get('/rate details', [AccountController::class, 'rateDetails'])->name('rateDetails');
        Route::get('/customer address', [AccountController::class, 'cusAddress'])->name('address');
        Route::get('/edit-address', [AccountController::class, 'editAddress'])->name('editAddress');
    });
    // Route::get('/services', [ServiceController::class, 'index'])->name('services.show');
    // Route::get('/accessories/{slug}', [AccessoriesController::class, 'index'])->name('accessories.show');

    Route::get('/category/{slug}', [WebsiteHomeController::class, 'showCategoryProducts'])->name('category.show');
    Route::get('/web/service', [FrontServiceController::class, 'index'])->name('service.show');
    Route::get('/web/contact', [ContactController::class, 'index'])->name('contact.show');
    Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

    Route::get('/web/about-us', [WebsiteAboutUsController::class, 'index'])->name('aboutus.show');
    Route::get('/web/category', [DesktopController::class, 'showCategory'])->name('allcategory.show');

    Route::get('/products/search', [DesktopController::class, 'search'])->name('products.search');
    Route::get('/web/product-detail/{id}', [DesktopController::class, 'product_detail'])->name('product-detail');
    Route::get('/product-details/{id}', [DesktopController::class, 'getProductDetails'])->name('product.getDetails');

    Route::get('/web/shopping-cart', [DesktopController::class, 'shopping_cart'])->name('shopping-cart');
    // web.php (routes file)
    Route::get('/filter-products', [DesktopController::class, 'filterProducts'])->name('filter-products');
    Route::get('/clear-filters', [DesktopController::class, 'clearFilters'])->name('clear-filters');



    // checkout route
    Route::get('/web/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::get('/web/maps', [MapController::class, 'index'])->name('maps');
    Route::get('/web/payment', [PaymentController::class, 'index'])->name('payment');
});
// Route::get('/', [WebsiteHomeController::class, 'index'])->name('home');




Route::post('save_temp_file', [FileManagerController::class, 'saveTempFile'])->name('save_temp_file');
Route::get('remove_temp_file', [FileManagerController::class, 'removeTempFile'])->name('remove_temp_file');


// back-end

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('login', [AdminLoginController::class, 'adminLoginPage'])->name('login')->middleware('guest:user');
    Route::post('login', [AdminLoginController::class, 'storeLogin'])->name('store-login')->middleware('guest:user');
});
Route::middleware(['auth:user', 'CheckUserLogin', 'SetSessionData'])->group(function () {

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        // Route::get('login', [AdminLoginController::class, 'adminLoginPage'])->name('login');
        // Route::post('login', [AdminLoginController::class, 'storeLogin'])->name('store-login');
        Route::get('logout', [AdminLoginController::class, 'adminLogout'])->name('admin-logout');


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

        Route::get('/term and condition', [TermAndPolicyController::class, 'termAndCondition'])->name('term_and_condition');
        Route::put('/update/term', [TermAndPolicyController::class, 'updateterm'])->name('update-term');

        Route::get('/policy', [TermAndPolicyController::class, 'policy'])->name('policy');
        Route::put('/update/policy', [TermAndPolicyController::class, 'updatepolicy'])->name('update-policy');

        Route::get('user/update_status', [UserController::class, 'updateStatus'])->name('user.update_status');
        Route::resource('user', UserController::class);

        Route::resource('role', RoleController::class);
        Route::resource('header', NavigationController::class);

        Route::get('product/update_status', [ProductController::class, 'updateStatus'])->name('product.update_status');
        Route::resource('product', ProductController::class);

        Route::get('discount/update_status', [DiscountController::class, 'updateStatus'])->name('discount.update_status');
        Route::resource('discount', DiscountController::class);
        Route::resource('slider', SliderController::class);

        Route::get('customer/update_status', [CustomerController::class, 'updateStatus'])->name('customer.update_status');
        Route::resource('customer', CustomerController::class);

        Route::get('service/update_status', [ServiceController::class, 'updateStatus'])->name('service.update_status');
        Route::resource('service', ServiceController::class);

        Route::get('product-category/update_status', [CategoryController::class, 'updateStatus'])->name('product-category.update_status');
        Route::resource('product-category', CategoryController::class);

        Route::get('banner/update_status', [BackendsBannerController::class, 'updateStatus'])->name('banner.update_status');
        Route::resource('banner', BackendsBannerController::class);

        Route::resource('brand', BrandController::class);

        Route::get('video/update_status', [VideoController::class, 'updateStatus'])->name('video.update_status');
        Route::resource('video', VideoController::class);
        Route::get('employee/update_status', [EmployeeController::class, 'updateStatus'])->name('employee.update_status');
        Route::resource('employee', EmployeeController::class);

        Route::get('/contact-us', [BackendsContactController::class, 'index'])->name('contact.index');
        //click reply sms//
        Route::get('/contact-us/{id}', [BackendsContactController::class, 'show'])->name('contact.replysms');
        //sent sms//
        Route::post('/contact-us/sent-sms', [BackendsContactController::class, 'replycustomer'])->name('messages.sendReply');
        Route::delete('/contact-us/delete/{id}', [BackendsContactController::class, 'destroy'])->name('contact.destroy');

        //Config Mail//
        Route::get('/email-config', [EmailConfigController::class, 'showForm'])->name('email_config_form');
        Route::post('/update-email-config', [EmailConfigController::class, 'updateConfig'])->name('update_email_config');
        //email configuration//
        Route::get('email-configuration', [EmailConfigurationController::class, 'index'])->name('email-configuration');
        Route::put('update-email-configuraion', [EmailConfigurationController::class, 'update'])->name('update-email-configuraion');
        // transaction
        Route::resource('transactions', TransactionController::class);
        // purchase
        Route::resource('purchases', PurchaseController::class);
        Route::post('purchases/update_status', [PurchaseController::class, 'updateStatus'])->name('purchases.update_status');

        // supplier
        Route::resource('supplier', SupplierController::class);

        // pos
        Route::get('pos', [PosController::class, 'index'])->name('pos');
        Route::post('/pos-create-customer', [PosController::class, 'pos_customer_store'])->name('pos_customer_store');
        Route::get('pos/filter', [PosController::class, 'posfilterProducts'])->name('pos-filter-products');
        Route::post('pos/store', [PosController::class, 'store'])->name('pos_store');
        Route::post('pos/search', [PosController::class, 'search'])->name('pos_search_products');

        //invoice
        Route::get('invoice', [InvoiceController::class, 'index'])->name('invoice.index');

        //report
        Route::get('report', [ReportController::class, 'index'])->name('report.index');
        Route::get('/report/report-detail/{id}', [ReportController::class, 'reportDetail'])->name('report.report-detail');

        // pos
        Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
        Route::post('/pos-create-customer', [PosController::class, 'pos_customer_store'])->name('pos_customer_store');
        Route::get('/pos/filter', [PosController::class, 'posfilterProducts'])->name('pos-filter-products');
        //header
        Route::get('/header', [DashboardController::class, 'header']);
    });
});
