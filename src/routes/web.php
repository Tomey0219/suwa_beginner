<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\RoutePath;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BreakController;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;

// use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;
// use Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController;
// use Laravel\Fortify\Http\Controllers\ConfirmedTwoFactorAuthenticationController;
// use Laravel\Fortify\Http\Controllers\NewPasswordController;
// use Laravel\Fortify\Http\Controllers\PasswordController;
// use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
// use Laravel\Fortify\Http\Controllers\ProfileInformationController;
// use Laravel\Fortify\Http\Controllers\RecoveryCodeController;
// use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;
// use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController;
// use Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController;
// use Laravel\Fortify\Http\Controllers\TwoFactorSecretKeyController;

Route::middleware('verified')->group(function () {
    Route::get('/', [AttendanceController::class, 'attInpDisp']);

    Route::post('/workstart', [AttendanceController::class, 'workStart']);

    Route::post('/workend', [AttendanceController::class, 'workEnd']);

    Route::post('/breakstart', [BreakController::class, 'breakStart']);

    Route::post('/breakend', [BreakController::class, 'breakEnd']);

    Route::get('/attendance', [AttendanceController::class, 'attTblDisp']);

    Route::post('/attendance', [AttendanceController::class, 'attTblDisp']);

    Route::get('/alluser', [AttendanceController::class, 'allUserDisp']);

    Route::get('/eachuser', [AttendanceController::class, 'eachUserDisp']);

    Route::post('/eachuser', [AttendanceController::class, 'eachUserDisp']);
});


Route::group(['middleware' => config('fortify.middleware', ['web'])], function () {
    $enableViews = config('fortify.views', true);

    // Authentication...
    if ($enableViews) {
        Route::get(RoutePath::for('login', '/login'), [AuthenticatedSessionController::class, 'create'])
            ->middleware(['guest:'.config('fortify.guard')])
            ->name('login');
    }

    $limiter = config('fortify.limiters.login');
    $twoFactorLimiter = config('fortify.limiters.two-factor');
    $verificationLimiter = config('fortify.limiters.verification', '6,1');

    Route::post(RoutePath::for('login', '/login'), [AuthenticatedSessionController::class, 'store'])
        ->middleware(array_filter([
            'guest:'.config('fortify.guard'),
            $limiter ? 'throttle:'.$limiter : null,
        ]));

    Route::post(RoutePath::for('logout', '/logout'), [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    
    // Registration...
    if (Features::enabled(Features::registration())) {
        if ($enableViews) {
            Route::get(RoutePath::for('register', '/register'), [RegisteredUserController::class, 'create'])
                ->middleware(['guest:'.config('fortify.guard')])
                ->name('register');
        }

        Route::post(RoutePath::for('register', '/register'), [RegisteredUserController::class, 'store'])
            ->middleware(['guest:'.config('fortify.guard')]);
    }

    // Email Verification...
    if (Features::enabled(Features::emailVerification())) {
        if ($enableViews) {
            Route::get(RoutePath::for('verification.notice', '/email/verify'), [EmailVerificationPromptController::class, '__invoke'])
                ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')])
                ->name('verification.notice');
        }

        Route::get(RoutePath::for('verification.verify', '/email/verify/{id}/{hash}'), [VerifyEmailController::class, '__invoke'])
            ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard'), 'signed', 'throttle:'.$verificationLimiter])
            ->name('verification.verify');

        Route::post(RoutePath::for('verification.send', '/email/verification-notification'), [EmailVerificationNotificationController::class, 'store'])
            ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard'), 'throttle:'.$verificationLimiter])
            ->name('verification.send');
    }

});
