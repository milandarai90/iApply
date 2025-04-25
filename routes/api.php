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
Route::middleware('auth:sanctum')->get('/home', [ApiController::class, 'home']);
Route::middleware('auth:sanctum')->post('/logout', [ApiController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/search', [SearchApiController::class, 'search']);
Route::middleware('auth:sanctum')->post('/book', [BookingApiController::class, 'book']);
Route::middleware('auth:sanctum')->get('/AfterBookingPage', [BookingApiController::class, 'AfterBookingPage']);
Route::middleware('auth:sanctum')->post('/cancelBooking', [BookingApiController::class, 'cancelBooking']);
Route::middleware('auth:sanctum')->get('/notifications', [NotificationController::class, 'notifications']);


Route::post('/github/webhook', function(){
    try {
        Log::info('Server = '. $_SERVER);
        $secret = "iapply@2025";
        $payload = file_get_contents("php://input");
        // file_put_contents("webhook_request.log", $payload, FILE_APPEND);
        $signature = $_SERVER["HTTP_X_HUB_SIGNATURE_256"] ?? "";
        $hash = "sha256=" . hash_hmac("sha256", $payload, $secret);
        if (!hash_equals($hash, $signature)) {
            http_response_code(403);
            exit("Invalid Signature");
        }

        $data = json_decode($payload, true);
        Log::info('data = ', $data);
        if ($data["ref"] === "refs/heads/main") {
            exec("cd ~/public_html/iapply && git pull origin main 2>&1", $output, $returnCode);
            // file_put_contents("webhook.log", implode('\n', $output), FILE_APPEND);
        }
        return response()->json('success', 200);
    } catch (Exception $e) {
        return response()->json($e->getMessage(), 500);
    }
});
