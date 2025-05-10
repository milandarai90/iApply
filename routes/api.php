<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\SearchApiController;
use App\Http\Controllers\BookingApiController;
use App\Http\Controllers\NotificationController;

Route::post('/register', [ApiController::class, 'register']);
Route::post('/verify_otp', [ApiController::class, 'verifyOtp']);
Route::post('/resend_otp', [ApiController::class, 'resendOtp']);
Route::post('/login', [ApiController::class, 'login'])->name('custom-login');

// Protect the /home route with auth.custom middleware
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/home', [ApiController::class, 'home']);
    Route::post('/logout', [ApiController::class, 'logout']);
    Route::get('/search', [SearchApiController::class, 'search']);
    Route::post('/book', [BookingApiController::class, 'book']);
    Route::get('/AfterBookingPage', [BookingApiController::class, 'AfterBookingPage']);
    Route::post('/cancelBooking', [BookingApiController::class, 'cancelBooking']);
    Route::get('/notifications', [NotificationController::class, 'notifications']);
    Route::get('/requested-booking', [ApiController::class, 'bookingRequested']);
    Route::post('/change-avatar', [ApiController::class, 'changeAvatar']);
});


Route::post('/github/webhook', function(){
    try {
        Log::info('Server = ', $_SERVER);
        $secret = "iapply@2025";
        $payload = file_get_contents("php://input");
        file_put_contents("webhook_request.log", $payload, FILE_APPEND);
        $signature = $_SERVER["HTTP_X_HUB_SIGNATURE_256"] ?? "";
        $hash = "sha256=" . hash_hmac("sha256", $payload, $secret);
        if (!hash_equals($hash, $signature)) {
            http_response_code(403);
            exit("Invalid Signature");
        }

        $data = json_decode($payload, true);
        Log::info('data = ', (array) $data);
        if ($data["ref"] === "refs/heads/main") {
            exec("cd ~/public_html/iapply && git pull origin main 2>&1", $output, $returnCode);
            // file_put_contents("webhook.log", implode('\n', $output), FILE_APPEND);
        }
        return response()->json('success', 200);
    } catch (Exception $e) {
        return response()->json($e->getMessage(), 500);
    }
});
