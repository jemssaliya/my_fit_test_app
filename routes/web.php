<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\InvitationsController;
use App\Http\Controllers\Manage\ManageFilesController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProtocolController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\AvailableDataController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\CompareTestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\SubscribersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ProfileController as AuthProfileController;
use App\Http\Controllers\Auth\Admin\AccessController;
use App\Http\Controllers\Auth\Groups\GroupsController;
use App\Http\Controllers\Auth\Abilities\AbilitiesController;
use App\Http\Controllers\Auth\Abilities\AbilityCategoriesController;
use EMedia\Oxygen\Http\Controllers\Auth\UsersController;
use EMedia\AppSettings\Http\Controllers\SettingsController;
use App\Http\Controllers\StripeWebhookController;

Route::get('/test-view', fn () => view('oxygen::auth.register'));

// Public Pages
Route::get('/', [LandingPageController::class, 'index']);
Route::get('/privacy-policy', [PagesController::class, 'privacyPolicy'])->name('pages.privacy-policy');
Route::get('/about-us', [PagesController::class, 'aboutUs'])->name('pages.about-us');
Route::get('/documents/privacy-policy', [DocumentController::class, 'privacyPolicy']);
Route::get('/terms-conditions', [PagesController::class, 'termsConditions'])->name('pages.terms-conditions');
Route::get('/faqs', [PagesController::class, 'faqs'])->name('pages.faqs');
Route::get('/articles', [PagesController::class, 'articles'])->name('articles');
Route::get('/testimonials', [PagesController::class, 'testimonials'])->name('testimonials');
Route::get('/videos', [PagesController::class, 'videos'])->name('videos');

Route::get('/contact-us', [PagesController::class, 'contactUs'])->name('contact-us');
Route::post('/contact-us', [PagesController::class, 'postContactUs']);

// Auth
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('logout', [LoginController::class, 'logout']);
Route::get('its-me', [LoginController::class, 'show2FA'])->name('its-me');

// Files
Route::get('files/{uuid}/{fileName?}', [ManageFilesController::class, 'publicView'])->name('files.show');
Route::get('files/{key}', [ManageFilesController::class, 'publicViewFront'])->name('files.front');

// Register
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password Reset
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Email Verification
Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

// Invitation
Route::get('invitations/join/{code}', [InvitationsController::class, 'showJoin'])->name('invitations.join');

// Authenticated Users
Route::middleware(['auth'])->group(function () {
    // Subscriptions
    Route::prefix('manage/subscription')->group(function () {
        Route::get('/', [SubscriptionController::class, 'manageSubscription'])->name('manage.subscription');
        Route::post('/update', [SubscriptionController::class, 'updateSubscription'])->name('subscription.update');
        Route::get('/cancel', [SubscriptionController::class, 'cancelSubscription'])->name('subscription.cancel');
        Route::get('/resume', [SubscriptionController::class, 'resumeSubscription'])->name('subscription.resume');
        Route::post('/new', [SubscriptionController::class, 'newSubscription'])->name('subscription.new');
        Route::get('/confirm', [SubscriptionController::class, 'confirmSubscription'])->name('subscription.confirm');
    });
});

// Auth + Subscription Middleware
Route::middleware(['auth', 'subscription'])->group(function () {
    Route::get('/clients', [ClientController::class, 'index'])->name('clients');
    Route::get('/clients/paginate', [ClientController::class, 'getClientList']);
    Route::get('/all-clients', [ClientController::class, 'viewAll'])->name('allClients');

    Route::get('/clients/create', [ClientController::class, 'create']);
    Route::get('/clients/edit/{id}', [ClientController::class, 'edit']);

    Route::get('/clients/{client}/tests', [ClientController::class, 'getTests'])->name('clients.tests');
    Route::get('/clients/{client}/view-tests/{test}', [ClientController::class, 'viewTest']);
    Route::delete('/clients/{client}/tests', [ClientController::class, 'deleteTests']);
    Route::put('/clients', [ClientController::class, 'update']);
    Route::resource('clients', ClientController::class);
    Route::get('/add-client', [ClientController::class, 'create']);


    Route::resource('tests', TestController::class);
    Route::get('/new-tests', [TestController::class, 'create']);
    Route::get('/view-test', [TestController::class, 'viewTest']);
    Route::get('/test-summery', [TestController::class, 'testSummery']);
    Route::post('/test/downloadPDF', [TestController::class, 'downloadPDF']);

    Route::resource('protocols', ProtocolController::class);
    Route::resource('programs', ProgramController::class);
    Route::post('/program/download', [ProgramController::class, 'download']);
    Route::get('/program/download', [ProgramController::class, 'download']);
    Route::resource('availabledata', AvailableDataController::class);
    Route::resource('tables', TableController::class);
    Route::resource('subscribe', SubscriptionController::class);

    Route::get('/compare-test-view', [CompareTestController::class, 'show']);
    Route::post('/compare-test/downloadPDF', [CompareTestController::class, 'downloadPDF']);
    Route::resource('compare-test', CompareTestController::class);

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware('isSuperAdmin')->name('dashboard');

    // Manage (Super Admin)
    Route::prefix('manage')->name('manage.')->middleware(['isSuperAdmin'])->group(function () {
        Route::get('files/view/{uuid}', [ManageFilesController::class, 'show'])->name('files.show');
        Route::get('files/download/{uuid}', [ManageFilesController::class, 'download'])->name('files.download');
        Route::resource('files', ManageFilesController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy');

        Route::get('articles/{article}/edit', [ArticleController::class, 'edit'])->name('article.edit');
        Route::resource('articles', ArticleController::class);
        Route::get('videos/{video}/edit', [VideoController::class, 'edit'])->name('video.edit');
        Route::resource('videos', VideoController::class);
        Route::get('subscribers', [SubscribersController::class, 'index'])->name('subscribers');

        // Settings (AppSettings)
        Route::prefix('settings')->group(function () {
            Route::get('/', [SettingsController::class, 'index'])->name('settings.index');
            Route::get('/new', [SettingsController::class, 'create'])->name('settings.create');
            Route::get('/{id}/edit', [SettingsController::class, 'edit'])->name('settings.edit');
            Route::post('/', [SettingsController::class, 'store'])->name('settings.store');
            Route::put('/{id}', [SettingsController::class, 'update'])->name('settings.update');
            Route::delete('/{id}', [SettingsController::class, 'destroy'])->name('settings.destroy');
        });

        // Groups, Permissions, Invitations, Users
        Route::prefix('account')->group(function () {
            Route::get('/access', [AccessController::class, 'index'])->name('access.index');

            Route::prefix('groups')->group(function () {
                Route::get('/', [GroupsController::class, 'index'])->name('access.groups.index');
                Route::get('/new', [GroupsController::class, 'create']);
                Route::post('/', [GroupsController::class, 'store']);
                Route::post('/users', [GroupsController::class, 'storeUsers']);
                Route::get('{id}/users', [GroupsController::class, 'showUsers']);
                Route::delete('/{roleId}/users/{userId}', [GroupsController::class, 'destroyUser']);
                Route::get('/{id}/edit', [GroupsController::class, 'edit']);
                Route::put('/{id}', [GroupsController::class, 'update']);
                Route::delete('/{id}', [GroupsController::class, 'destroy']);

                Route::prefix('{roleId}/permissions')->group(function () {
                    Route::get('/', [AbilitiesController::class, 'editRoleAbilities']);
                    Route::put('/', [AbilitiesController::class, 'updateRoleAbilities']);
                });
            });

            Route::prefix('permission-categories')->group(function () {
                Route::get('/', [AbilityCategoriesController::class, 'index'])->name('access.abilities.index');
            });

            Route::prefix('invitations')->group(function () {
                Route::get('/', [InvitationsController::class, 'index'])->name('access.invitations.index');
                Route::get('/create', [InvitationsController::class, 'create'])->name('access.invitations.create');
                Route::post('/', [InvitationsController::class, 'send']);
                Route::get('/{id}/edit', [InvitationsController::class, 'edit']);
                Route::put('/{id}', [InvitationsController::class, 'update']);
                Route::delete('/{id}', [InvitationsController::class, 'destroy']);
            });

            Route::resource('users', UsersController::class)->only('index', 'edit', 'update', 'destroy');
            Route::get('users/{user}/edit-password', [UsersController::class, 'editPassword'])->name('users.edit-password');
            Route::put('users/{user}/edit-password', [UsersController::class, 'updatePassword']);
            Route::put('users/{user}/update-disabled', [UsersController::class, 'updateDisabled'])->name('users.update-disabled');
        });
    });

    // Profile Routes
    Route::prefix('user')->group(function () {
        Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');
        Route::put('/profile', [AuthProfileController::class, 'updateProfile']);
        Route::get('/password/edit', [ProfileController::class, 'editPsw'])->name('user.password');
        Route::put('/password/edit', [ResetPasswordController::class, 'updatePassword']);
        Route::delete('/profile', [AuthProfileController::class, 'deleteLogo']);
    });

    Route::prefix('account')->group(function () {
        Route::get('/profile', [AuthProfileController::class, 'getProfile'])->name('account.profile');
        Route::put('/profile', [AuthProfileController::class, 'updateProfile']);
        Route::get('/email/edit', [AuthProfileController::class, 'getEmail'])->name('account.email');
        Route::put('/email/edit', [AuthProfileController::class, 'updateEmail']);
        Route::get('/password/edit', [ResetPasswordController::class, 'editPassword'])->name('account.password');
        Route::put('/password/edit', [ResetPasswordController::class, 'updatePassword']);
    });
});

// Stripe Webhook
Route::post('stripe/webhook', [StripeWebhookController::class, 'handleWebhook'])->middleware('web');
