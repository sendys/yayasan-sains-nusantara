<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/* langsung ke halaman login */
/* Route::get('/', function () {
     return redirect('/login');
}); */

/* frontend - web */

Route::get('/', [App\Http\Controllers\Frontend\WelcomeController::class, 'welcome']);

Route::get('/lang/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'id'], true)) {
        abort(404);
    }

    session(['locale' => $locale]);

    return redirect()->back();
})->name('lang.switch');

// Blog Routes (Frontend)
Route::get('/news', [App\Http\Controllers\Frontend\BlogController::class, 'index'])->name('frontend.blog.index');
Route::get('/news/{slug}', [App\Http\Controllers\Frontend\BlogController::class, 'show'])->name('frontend.blog.show');

// Event Routes (Frontend)
Route::get('/events', [App\Http\Controllers\Frontend\EventController::class, 'index'])->name('frontend.event.index');
Route::get('/events/all', [App\Http\Controllers\Frontend\EventController::class, 'all'])->name('frontend.event.all');
Route::get('/events/{uuid}', [App\Http\Controllers\Frontend\EventController::class, 'show'])->name('frontend.event.show');

Route::get('/kebijakan', function () {
    return view('kebijakanprivasi');
})->name('kebijakan');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

//Akses halaman depan Tentang Kami
Route::get('/tentang', [App\Http\Controllers\Frontend\TentangController::class, 'tentang'])->name('tentang');
Route::get('/sejarah', [App\Http\Controllers\Frontend\SejarahController::class, 'sejarah'])->name('sejarah');
Route::get('/pengurus', [App\Http\Controllers\Frontend\TentangController::class, 'pengurus'])->name('pengurus');
Route::get('/partner', function () {
    return view('frontend.partner');
})->name('partner');
Route::get('/donasi', function () {
    return view('frontend.donasi');
})->name('donasi');

Route::get('/legalitas', [App\Http\Controllers\Frontend\TentangController::class, 'legalitas'])->name('legalitas');
Route::get('/divisi', [App\Http\Controllers\Frontend\DivisiController::class, 'divisi'])->name('divisi');

// Gallery Routes (Frontend)
Route::get('/galeri', [App\Http\Controllers\Frontend\GalleryController::class, 'index'])->name('frontend.galeri.index');
Route::get('/galeri/kategori/{kategori}', [App\Http\Controllers\Frontend\GalleryController::class, 'byKategori'])->name('frontend.galeri.kategori');
Route::get('/galeri/{uuid}', [App\Http\Controllers\Frontend\GalleryController::class, 'show'])->name('frontend.galeri.show');

// Register user
Route::get('user/register', [App\Http\Controllers\UserController::class, 'register'])->name('user.register');
Route::post('/user/daftar', [App\Http\Controllers\UserController::class, 'daftar'])
    ->middleware('throttle:registration')
    ->name('user.daftar');

// Google OAuth Routes
Route::get('/auth/google', [App\Http\Controllers\UserController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [App\Http\Controllers\UserController::class, 'handleGoogleCallback'])->name('auth.google.callback');
Route::post('/auth/google/complete', [App\Http\Controllers\UserController::class, 'completeGoogleRegistration'])
    ->middleware('throttle:registration')
    ->name('auth.google.complete');

// Account Activation Routes
Route::get('/account/activate/{token}', [App\Http\Controllers\UserController::class, 'activateAccount'])->name('account.activate');
Route::get('/account/resend-activation', function () {
    return view('user.resend-activation');
})->name('account.resend-activation.form');

Route::post('/account/resend-activation', [App\Http\Controllers\UserController::class, 'resendActivationEmail'])
    ->middleware('throttle:registration')
    ->name('account.resend-activation');

/* Route::get('/otp', [LoginController::class, 'showOtpForm'])->name('otp.form');
Route::post('/otp', [LoginController::class, 'verifyOtp'])->name('otp.verify'); */

Auth::routes();
// Ganti middleware group untuk routes yang memerlukan validasi lisensi:

Route::middleware(['auth', 'check.activation', 'check.license'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::middleware([
    'auth',
    'check.license', // Tambahkan middleware check.license
    'role:' . implode('|', config('roles.access_super_admin_routes')),
])->group(function () {
    // Routes untuk super admin...
    // permission
    Route::get('/permission', [App\Http\Controllers\PermissionController::class, 'index'])->name('permission.index');
    Route::get('/permission/create', [App\Http\Controllers\PermissionController::class, 'create'])->name('permission.create');
    Route::post('/permission', [App\Http\Controllers\PermissionController::class, 'store'])->name('permission.store');
    Route::get('/permission/{permission}/edit', [App\Http\Controllers\PermissionController::class, 'edit'])->name('permission.edit');
    Route::put('/permission/{permission}', [App\Http\Controllers\PermissionController::class, 'update'])->name('permission.update');
    Route::delete('/permission/{permission}', [App\Http\Controllers\PermissionController::class, 'destroy'])->name('permission.destroy');

    // Role
    Route::get('/role', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::get('/role/create', [App\Http\Controllers\RoleController::class, 'create'])->name('roles.create');
    Route::post('/role', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
    Route::get('/role/{role}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/role/{role}', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
    Route::delete('/role/{role}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');

    // Group Perusahaan
    Route::get('/perusahaan', [App\Http\Controllers\PerusahaanController::class, 'index'])->name('perusahaan.index');
    Route::get('/perusahaan/create', [App\Http\Controllers\PerusahaanController::class, 'create'])->name('perusahaan.create');
    Route::post('/perusahaan', [App\Http\Controllers\PerusahaanController::class, 'store'])->name('perusahaan.store');
    Route::get('/perusahaan/{perusahaan}', [App\Http\Controllers\PerusahaanController::class, 'show'])->name('perusahaan.show');
    Route::get('/perusahaan/{perusahaan}/edit', [App\Http\Controllers\PerusahaanController::class, 'edit'])->name('perusahaan.edit');
    Route::put('/perusahaan/{id}', [App\Http\Controllers\PerusahaanController::class, 'update'])->name('perusahaan.update');
    Route::delete('/perusahaan/{perusahaan}', [App\Http\Controllers\PerusahaanController::class, 'destroy'])->name('perusahaan.destroy');
});


Route::middleware([
    'auth',
])->group(function () {

    // Chart of Account
    Route::get('/accouting', [App\Http\Controllers\CoaController::class, 'index'])->name('akun.index');
    Route::get('/accouting/create', [App\Http\Controllers\CoaController::class, 'create'])->name('akun.create');
    Route::post('/accouting', [App\Http\Controllers\CoaController::class, 'store'])->name('akun.store');
    Route::get('/accouting/{accouting}', [App\Http\Controllers\CoaController::class, 'edit'])->name('akun.edit');
    Route::put('/accouting/{id}', [App\Http\Controllers\CoaController::class, 'update'])->name('akun.update');
    Route::delete('/accouting/{accouting}', [App\Http\Controllers\CoaController::class, 'destroy'])->name('akun.destroy');
    Route::get('/kasbank', [App\Http\Controllers\CoaController::class, 'kasBank'])->name('akun.kasbank');

    // pembelian
    Route::get('/pembelian', [App\Http\Controllers\CoaController::class, 'pembelian'])->name('purchasing.pembelian');
    Route::get('/pos', [App\Http\Controllers\CoaController::class, 'pos'])->name('akun.pos');

    // Group User
    Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
    Route::post('/user', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::get('/user/{user}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');

    // Group Customer
    Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer/create', [App\Http\Controllers\CustomerController::class, 'create'])->name('customer.create');
    Route::post('/customer', [App\Http\Controllers\CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customer/{customer}', [App\Http\Controllers\CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('/customer/{id}', [App\Http\Controllers\CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customer/{customer}', [App\Http\Controllers\CustomerController::class, 'destroy'])->name('customer.destroy');

    // Group Supplier
    Route::get('/supplier', [App\Http\Controllers\SupplierController::class, 'index'])->name('supplier.index');
    Route::get('/supplier/create', [App\Http\Controllers\SupplierController::class, 'create'])->name('supplier.create');
    Route::post('/supplier', [App\Http\Controllers\SupplierController::class, 'store'])->name('supplier.store');
    Route::get('/supplier/{supplier}', [App\Http\Controllers\SupplierController::class, 'edit'])->name('supplier.edit');
    Route::put('/supplier/{supplier}', [App\Http\Controllers\SupplierController::class, 'update'])->name('supplier.update');
    Route::delete('/supplier/{supplier}', [App\Http\Controllers\SupplierController::class, 'destroy'])->name('supplier.destroy');

    // Group Gudang
    Route::get('/gudang', [App\Http\Controllers\GudangController::class, 'index'])->name('gudang.index');
    Route::get('/gudang/create', [App\Http\Controllers\GudangController::class, 'create'])->name('gudang.create');
    Route::get('/gudang/bulk-import', [App\Http\Controllers\GudangController::class, 'bulkImport'])->name('gudang.bulk-import');
    Route::post('/gudang/bulk-import', [App\Http\Controllers\GudangController::class, 'processBulkImport'])->name('gudang.process-bulk-import');
    Route::get('/gudang/download-template', [App\Http\Controllers\GudangController::class, 'downloadTemplate'])->name('gudang.download-template');
    Route::post('/gudang', [App\Http\Controllers\GudangController::class, 'store'])->name('gudang.store');
    Route::get('/gudang/{gudang}', [App\Http\Controllers\GudangController::class, 'edit'])->name('gudang.edit');
    Route::put('/gudang/{gudang}', [App\Http\Controllers\GudangController::class, 'update'])->name('gudang.update');
    Route::delete('/gudang/{gudang}', [App\Http\Controllers\GudangController::class, 'destroy'])->name('gudang.destroy');

    // kategori
    Route::get('/kategori', [App\Http\Controllers\KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [App\Http\Controllers\KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [App\Http\Controllers\KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{kategori}', [App\Http\Controllers\KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{kategori}', [App\Http\Controllers\KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{kategori}', [App\Http\Controllers\KategoriController::class, 'destroy'])->name('kategori.destroy');

    // Brand routes
    Route::prefix('brand')->name('brand.')->group(function () {
        // Routes statis harus ditempatkan SEBELUM routes dinamis
        Route::get('/bulk/import', [BrandController::class, 'bulkImport'])->name('bulk-import');
        Route::post('/bulk/process', [BrandController::class, 'processBulkImport'])->name('process-bulk-import');
        Route::get('/template/download', [BrandController::class, 'downloadTemplate'])->name('download-template');

        // Routes dinamis ditempatkan setelah routes statis
        Route::get('/', [BrandController::class, 'index'])->name('index');
        Route::post('/', [BrandController::class, 'store'])->name('store');
        Route::get('/{uuid}', [BrandController::class, 'show'])->name('show');
        Route::put('/{uuid}', [BrandController::class, 'update'])->name('update');
        Route::delete('/{uuid}', [BrandController::class, 'destroy'])->name('destroy');
        Route::post('/{uuid}/upload-image', [BrandController::class, 'uploadImage'])->name('upload-image');
    });


    // product
    Route::get('/product/generate-barcode', [App\Http\Controllers\ProductController::class, 'generateBarcode'])->name('product.generate-barcode');
    Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');
    Route::get('/product/{product}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/products/search', [App\Http\Controllers\ProductController::class, 'select2Product'])->name('products.search');

    // Admin Tentang Kami Routes
    Route::get('/tentang-kami', [App\Http\Controllers\Backend\AdminTentangController::class, 'index'])->name('admin.tentang.index');
    Route::get('/tentang/create', [App\Http\Controllers\Backend\AdminTentangController::class, 'create'])->name('admin.tentang.create');
    Route::post('/tentang', [App\Http\Controllers\Backend\AdminTentangController::class, 'store'])->name('admin.tentang.store');
    Route::get('/tentang/{id}', [App\Http\Controllers\Backend\AdminTentangController::class, 'show'])->name('admin.tentang.show');
    Route::get('/tentang/{id}/edit', [App\Http\Controllers\Backend\AdminTentangController::class, 'edit'])->name('admin.tentang.edit');
    Route::put('/tentang/{id}', [App\Http\Controllers\Backend\AdminTentangController::class, 'update'])->name('admin.tentang.update');
    Route::get('/tentang/{id}/delete', [App\Http\Controllers\Backend\AdminTentangController::class, 'delete'])->name('tentang.delete');
    Route::delete('/tentang/{id}', [App\Http\Controllers\Backend\AdminTentangController::class, 'destroy'])->name('admin.tentang.destroy');
    Route::post('/tentang/{id}/logo', [App\Http\Controllers\Backend\AdminTentangController::class, 'uploadLogo'])->name('admin.tentang.upload-logo');

    // Admin Sejarah Routes
    Route::get('/sejarah-kami', [App\Http\Controllers\Backend\SejarahController::class, 'index'])->name('admin.sejarah.index');
    Route::get('/sejarah-kami/create', [App\Http\Controllers\Backend\SejarahController::class, 'create'])->name('admin.sejarah.create');
    Route::post('/sejarah-kami', [App\Http\Controllers\Backend\SejarahController::class, 'store'])->name('admin.sejarah.store');
    Route::get('/sejarah-kami/{id}', [App\Http\Controllers\Backend\SejarahController::class, 'show'])->name('admin.sejarah.show');
    Route::get('/sejarah-kami/{id}/edit', [App\Http\Controllers\Backend\SejarahController::class, 'edit'])->name('admin.sejarah.edit');
    Route::put('/sejarah-kami/{id}', [App\Http\Controllers\Backend\SejarahController::class, 'update'])->name('admin.sejarah.update');
    Route::delete('/sejarah-kami/{id}', [App\Http\Controllers\Backend\SejarahController::class, 'destroy'])->name('admin.sejarah.destroy');

    //Admin Blog Routes
    Route::get('/blog', [App\Http\Controllers\Backend\BlogController::class, 'index'])->name('admin.blog.index');
    Route::get('/blog/create', [App\Http\Controllers\Backend\BlogController::class, 'create'])->name('admin.blog.create');
    Route::post('/blog', [App\Http\Controllers\Backend\BlogController::class, 'store'])->name('admin.blog.store');
    Route::get('/blog/{uuid}', [App\Http\Controllers\Backend\BlogController::class, 'show'])->name('admin.blog.show');
    Route::get('/blog/{uuid}/edit', [App\Http\Controllers\Backend\BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::put('/blog/{uuid}', [App\Http\Controllers\Backend\BlogController::class, 'update'])->name('admin.blog.update');
    Route::delete('/blog/{uuid}', [App\Http\Controllers\Backend\BlogController::class, 'destroy'])->name('admin.blog.destroy');

    // Event Routes (Backend/Admin)
    Route::get('/event', [App\Http\Controllers\Backend\EventController::class, 'index'])->name('admin.event.index');
    Route::get('/event/create', [App\Http\Controllers\Backend\EventController::class, 'create'])->name('admin.event.create');
    Route::post('/event', [App\Http\Controllers\Backend\EventController::class, 'store'])->name('admin.event.store');
    Route::get('/event/{uuid}', [App\Http\Controllers\Backend\EventController::class, 'show'])->name('admin.event.show');
    Route::get('/event/{uuid}/edit', [App\Http\Controllers\Backend\EventController::class, 'edit'])->name('admin.event.edit');
    Route::put('/event/{uuid}', [App\Http\Controllers\Backend\EventController::class, 'update'])->name('admin.event.update');
    Route::delete('/event/{uuid}', [App\Http\Controllers\Backend\EventController::class, 'destroy'])->name('admin.event.destroy');

    // Admin Divisi Routes
    Route::get('/divisi-new', [App\Http\Controllers\Backend\DivisiController::class, 'index'])->name('admin.divisi.index');
    Route::get('/divisi/create', [App\Http\Controllers\Backend\DivisiController::class, 'create'])->name('admin.divisi.create');
    Route::post('/divisi', [App\Http\Controllers\Backend\DivisiController::class, 'store'])->name('admin.divisi.store');
    Route::get('/divisi/{id}', [App\Http\Controllers\Backend\DivisiController::class, 'show'])->name('admin.divisi.show');
    Route::get('/divisi/{id}/edit', [App\Http\Controllers\Backend\DivisiController::class, 'edit'])->name('admin.divisi.edit');
    Route::put('/divisi/{id}', [App\Http\Controllers\Backend\DivisiController::class, 'update'])->name('admin.divisi.update');
    Route::get('/divisi/{id}/delete', [App\Http\Controllers\Backend\DivisiController::class, 'delete'])->name('divisi.delete');
    Route::delete('/divisi/{id}', [App\Http\Controllers\Backend\DivisiController::class, 'destroy'])->name('admin.divisi.destroy');

    // Admin Gallery Routes
    Route::get('/gallery', [App\Http\Controllers\Backend\GalleryController::class, 'index'])->name('admin.gallery.index');
    Route::get('/gallery/create', [App\Http\Controllers\Backend\GalleryController::class, 'create'])->name('admin.gallery.create');
    Route::post('/gallery', [App\Http\Controllers\Backend\GalleryController::class, 'store'])->name('admin.gallery.store');
    Route::get('/gallery/{uuid}', [App\Http\Controllers\Backend\GalleryController::class, 'show'])->name('admin.gallery.show');
    Route::get('/gallery/{uuid}/edit', [App\Http\Controllers\Backend\GalleryController::class, 'edit'])->name('admin.gallery.edit');
    Route::put('/gallery/{uuid}', [App\Http\Controllers\Backend\GalleryController::class, 'update'])->name('admin.gallery.update');
    Route::delete('/gallery/{uuid}', [App\Http\Controllers\Backend\GalleryController::class, 'destroy'])->name('admin.gallery.destroy');

    // Admin Banner Routes (static routes dulu)
    Route::get('/banner', [App\Http\Controllers\Backend\BannerController::class, 'index'])->name('admin.banner.index');
    Route::get('/banner/create', [App\Http\Controllers\Backend\BannerController::class, 'create'])->name('admin.banner.create');
    Route::post('/banner', [App\Http\Controllers\Backend\BannerController::class, 'store'])->name('admin.banner.store');
    Route::delete('/banner/{banner}', [App\Http\Controllers\Backend\BannerController::class, 'destroy'])->name('admin.banner.destroy');
    Route::post('/banner/{banner}/toggle', [App\Http\Controllers\Backend\BannerController::class, 'toggle'])->name('admin.banner.toggle');

    // product

    Route::post('/translate', [App\Http\Controllers\TranslateController::class, 'translate'])->name('translate');
});
