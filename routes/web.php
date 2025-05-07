<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\DoctorAuthController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\PharmacistAuthController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\AvailabilityScheduleController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WilayaController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/mail-preview', function () {
    return new App\Mail\PasswordResetPreview();
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::get('/', function () {
            return view('patients.landingpage');
        })->name("welcome");


        Route::middleware(["auth", "role:doctor,patient"])->prefix('/documents')->group(
            function () {

                Route::get('/', [DocumentController::class, "index"])->name("documents.index");
                Route::get('/saved', [DocumentController::class, "saved"])->name("documents.saved");
                Route::get('/sent', [DocumentController::class, "sent"])->name("documents.sent");
                Route::get('/{id}/sender', [DocumentController::class, "documentsBySender"])->name("documents.sender");
                Route::get('/recived', [DocumentController::class, "recived"])->name("documents.recived");
                Route::view('/share', 'documents.share')->name("documents.share.page");
                Route::post('/share', [DocumentController::class, 'shareDocument'])->name("documents.share");

                Route::get('/received', [DocumentController::class, 'receivedDocuments'])->name("documents.recive");
                Route::post('/save/{id}', [DocumentController::class, 'saveDocument'])->name("documents.save-document");
            }
        );

        //Auth
        Route::middleware("guest")->group(function () {
            Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
            Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

            Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
            Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.store');
            // Patient
            Route::get("/login", [UserAuthController::class, "showLoginForm"])->name("login");
            Route::post("/login", [UserAuthController::class, "login"]);

            Route::get("/register", [UserAuthController::class, "showRegisterForm"])->name("register");
            Route::post("/register", [UserAuthController::class, "register"]);
            // Pharmacist
            Route::post("/pharmacist/register", [PharmacistAuthController::class, "register"]);

            Route::get("/register/options", [UserAuthController::class, "registerOptions"])->name('register.options');
            Route::post("/register/options/doctors", [DoctorAuthController::class, "register"])->name("doctor.register");
            Route::post("/register/options/pharmacist", [PharmacistAuthController::class, "register"])->name("pharmacist.register");

            // Wilayas
            Route::get("/wilayas", [WilayaController::class, "index"])->name("wilayas.index");
        });

// Pharmacist
        Route::prefix('dashboard/pharmacies')->group(function () {
            // Protected routes
            Route::middleware(["auth", "role:pharmacist"])->group(function () {
                Route::get("/", [PharmacyController::class, "index"])->name("pharmacies.index");
                Route::get("/create", [PharmacyController::class, "create"])->name("pharmacies.create");
                Route::post("/create", [PharmacyController::class, "store"])->name("pharmacies.store");
                Route::get("/{pharmacy}", [PharmacyController::class, "show"])->name("pharmacies.show");
                Route::put("/{pharmacy}", [PharmacyController::class, "edit"])->name("pharmacies.edit");
                Route::put("/toggle-status", [PharmacyController::class, "toggleStatus"])->name("pharmacies.toggleStatus");
                Route::delete("/{pharmacy}", [PharmacyController::class, "delete"])->name("pharmacies.delete");
            });

        });
// Doctor routes
        Route::prefix('dashboard/doctors')->group(function () {
            Route::middleware(["auth", "role:doctor"])->group(function () {
                Route::get("/{doctorId}/all-schedules", [AvailabilityScheduleController::class, "index"])->name("doctor.schedules");
                Route::get("/working-day", [AvailabilityScheduleController::class, "getWorkingDays"])->name("working-day");
                Route::get("/", [AvailabilityScheduleController::class, "create"])->name("working-day.create");
                Route::post('/availability', [AvailabilityScheduleController::class, 'store'])->name('availability.store');
                Route::post('/working-day/delete', [AvailabilityScheduleController::class, 'destroy'])->name('working-day.destroy');
                Route::patch('/availability-schedules/reset', [AvailabilityScheduleController::class, 'resetAll'])->name('availability-schedules.reset');
            });
        });

// Admin routes
        Route::middleware(['auth', 'role:admin'])->prefix('dashboard/admin')->group(function () {
            Route::get('/users', [AdminController::class, 'index'])->name('users.index');
            Route::put('/users/{user}/toggle-status', [AdminController::class, 'toggleStatus'])->name('admin.toggleStatus');
            Route::put('/users/{user}/update-role', [AdminController::class, 'updateRole'])->name('admin.updateRole');
        });

        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

            // Pharmacy
            Route::get("/find-pharmacy", [PharmacyController::class, "findPharmacies"])->name("find-pharmacy");
            // Appointment
            Route::get("/doctors/{doctorId}/available-schedules", [AvailabilityScheduleController::class, "getAvailableSchedules"]);
            Route::get("/doctors/search", [DoctorController::class, "searchDoctors"])->name("doctors.search");

            Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
            Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
            Route::post('/appointments/{id}', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
        });

    }
);
Route::get("/wilayas", [WilayaController::class, "index"])->name("wilayas.index");

require __DIR__.'/auth.php';