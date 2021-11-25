<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

# Get All Resource
Route::get("/patients", [PatientController::class, 'index']);

# Add Resource
Route::post("/patients", [PatientController::class, 'store']);

# Get Detail Resource
Route::get("/patients/{id}", [PatientController::class, 'show']);

# Edit Resource PUT /patients/{id} update
Route::put("/patients/{id}", [PatientController::class, 'update']);

# Delete Resource DELETE /patients/{id} destroy
Route::delete("/patients/{id}", [PatientController::class, 'destroy']);

# Search Resource by name GET /patients/search/{name} search
Route::get("/patients/search/{name}", [PatientController::class, 'search']);

# Get Positive Resource GET /patients/status/positive positive
Route::get("/patients/status/positive", [PatientController::class, 'positive']);

# Get Recovered Resource GET /patients/status/recovered recovered
Route::get("/patients/status/recovered", [PatientController::class, 'recovered']);

# Get Dead Resource GET /patients/status/dead dead
Route::get("/patients/status/dead", [PatientController::class, 'dead']);
