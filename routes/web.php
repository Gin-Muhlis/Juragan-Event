<?php

use App\Models\Event;
use App\Models\Juragan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\user\AuthController;
use App\Http\Controllers\user\BlogController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\user\AboutController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\TopicController;
use App\Http\Controllers\user\GoogleController;
use App\Http\Controllers\Admin\FormatController;
use App\Http\Controllers\Admin\GaleryController;
use App\Http\Controllers\Admin\RefundController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\JuraganController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\user\FacebookController;
use App\Http\Controllers\Admin\TopicMixController;
use App\Http\Controllers\Admin\VisitorsController;
use App\Http\Controllers\Admin\FormatMixController;
use App\Http\Controllers\Admin\OrganizerController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\user\TransactionController;
use App\Http\Controllers\Admin\AddressEventController;
use App\Http\Controllers\Admin\TransactionDetailController;
use App\Http\Controllers\Admin\TransactionHeadersController;
use App\Http\Controllers\user\HomeController as UserHomeController;
use App\Http\Controllers\user\EventController as UserEventController;
use App\Http\Controllers\user\GaleryController as UserGaleryController;
use App\Http\Controllers\user\ContactController as UserContactController;
use App\Http\Controllers\user\OrganizerController as UserOrganizerController;

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

// !admin routes

Route::prefix('auth/admeen')->group(function () {
    Auth::routes();
});

Route::prefix('admeen')

    ->middleware(['auth', 'super'])
    ->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::resource('/roles', RoleController::class);
        Route::resource('/permissions', PermissionController::class);

        Route::resource('/payments', PaymentController::class);
        Route::resource('/topics', TopicController::class);
        Route::resource('/address-events', AddressEventController::class);
        Route::resource('/posts', PostController::class);
        Route::resource('/topic-mixes', TopicMixController::class);
        Route::resource('/formats', FormatController::class);
        Route::resource(
            '/transaction-details',
            TransactionDetailController::class
        );
        Route::get('/all-transaction-headers', [
            TransactionHeadersController::class,
            'index',
        ])->name('all-transaction-headers.index');
        Route::post('/all-transaction-headers', [
            TransactionHeadersController::class,
            'store',
        ])->name('all-transaction-headers.store');
        Route::get('/all-transaction-headers/create', [
            TransactionHeadersController::class,
            'create',
        ])->name('all-transaction-headers.create');
        Route::get('/all-transaction-headers/{transactionHeaders}', [
            TransactionHeadersController::class,
            'show',
        ])->name('all-transaction-headers.show');
        Route::get('/all-transaction-headers/{transactionHeaders}/edit', [
            TransactionHeadersController::class,
            'edit',
        ])->name('all-transaction-headers.edit');
        Route::put('/all-transaction-headers/{transactionHeaders}', [
            TransactionHeadersController::class,
            'update',
        ])->name('all-transaction-headers.update');
        Route::delete('/all-transaction-headers/{transactionHeaders}', [
            TransactionHeadersController::class,
            'destroy',
        ])->name('all-transaction-headers.destroy');

        Route::resource('/format-mixes', FormatMixController::class);
        Route::resource('/partners', PartnerController::class);
        Route::resource('/events', EventController::class);
        Route::resource('/cities', CityController::class);
        Route::resource('/organizers', OrganizerController::class);
        Route::resource('/tickets', TicketController::class);
        Route::resource('/users', UserController::class);
        Route::resource('/contacts', ContactController::class);
        Route::get('all-visitors', [VisitorsController::class, 'index'])->name(
            'all-visitors.index'
        );
        Route::post('all-visitors', [VisitorsController::class, 'store'])->name(
            'all-visitors.store'
        );
        Route::get('all-visitors/create', [
            VisitorsController::class,
            'create',
        ])->name('all-visitors.create');
        Route::get('all-visitors/{visitors}', [
            VisitorsController::class,
            'show',
        ])->name('all-visitors.show');
        Route::get('all-visitors/{visitors}/edit', [
            VisitorsController::class,
            'edit',
        ])->name('all-visitors.edit');
        Route::put('all-visitors/{visitors}', [
            VisitorsController::class,
            'update',
        ])->name('all-visitors.update');
        Route::delete('all-visitors/{visitors}', [
            VisitorsController::class,
            'destroy',
        ])->name('all-visitors.destroy');

        Route::resource('galeries', GaleryController::class);
        Route::resource('juragans', JuraganController::class);
        Route::resource('refunds', RefundController::class);
        Route::post('/transaction/action/{transactionHeaders}', [TransactionHeadersController::class, 'action'])->name('transaction.action');
        Route::post('/refund/action/{refund}', [RefundController::class, 'action'])->name('refund.action');
    });

// !user Routes


// !User routes
Route::middleware('HTMLMinifier')->group(function () {
    Route::get('/', [UserHomeController::class, 'index'])->name('welcome');
    // Event
    Route::get('/event', [UserEventController::class, 'index'])->name('events');
    Route::get('/event/search', [UserEventController::class, 'index'])->name('events.filter');
    // Detail Event (Deskripsi)
    Route::get('/event/detail/{slug}', [UserEventController::class, 'show'])->name('event.detail');

    // event category
    Route::post('/event/category', [UserEVentController::class, 'choicedCategoryEvent']);
    // event search
    Route::post('/eventSearch', [UserEventController::class, 'searchEvent']);

    // city search
    Route::post('/citySearch', [UserEventController::class, 'searchCity']);

    // format search
    Route::post('/formatSearch', [UserEventController::class, 'searchFormat']);

    // format search
    Route::post('/topicSearch', [UserEventController::class, 'searchTopic']);


    // Tentang
    Route::get('/tentang', [AboutController::class, 'index']);


    // Blog
    Route::get('/blog', [BlogController::class, 'index'])->name('blog');

    Route::get('/addArticle', [BlogController::class, 'addBlog']);
    // Detail Berita
    Route::get('blog/detailBlog/{slug}', [BlogController::class, 'show'])->name('blog.detail')->middleware('trackVisitors');

    // Galery
    Route::get('/galeri', [UserGaleryController::class, 'index'])->name('galeri.index');
    Route::get('/moreImage', [UserGaleryController::class, 'moreImage']);


    // Hubungi Kami
    Route::get('/hubungiKami', [UserContactController::class, 'index']);
    Route::post('/contactSend', [UserContactController::class, 'send'])->name('contact.send');


    // login
    Route::prefix('auth')->group(function () {
        Route::middleware('guest')->group(function () {

            Route::get('/login', [AuthController::class, 'login'])->name('user.login');

            Route::get('/daftar', [AuthController::class, 'daftar'])->name('user.register');

            Route::get('/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
            Route::get('/google/callback', [GoogleController::class, 'callbackGoogle'])->name('auth.redirect');

            Route::get('/facebook', [FacebookController::class, 'redirectToFacebook'])->name('auth.facebook');
            Route::get('/facebook/callback', [FacebookController::class, 'callbackFacebook'])->name('facebook.redirect');
        });
        // User
        Route::get('/account', [ProfileController::class, 'profile'])->name('profile.index');

        Route::put('/editAccount/{user}', [ProfileController::class, 'editProfile'])->name('profile.update');

        Route::put('/editAccountPassword/{user}', [ProfileController::class, 'editPassword'])->name('profile.password.update');

        Route::get('/organizer/{name}', [UserOrganizerController::class, 'show']);
    });

    Route::post('/transaction', [TransactionController::class, 'show'])->name('transaction.make')->middleware('authTransaction');
    Route::put('/transaction/cancel', [TransactionController::class, 'cancel'])->name('transaction.cancel');

    Route::middleware('auth')->group(function () {
        Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
        Route::get('/transaction/detail/{no_transaction}', [TransactionController::class, 'detail'])->name('transaction.detail');
        Route::post('/transaction/refund', [TransactionController::class, 'refund']);
    });

    Route::post('/transaction/proof', [TransactionController::class, 'proof'])->name('transaction.proof');
});
