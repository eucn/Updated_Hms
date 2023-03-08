<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontdeskController;
use App\Http\Controllers\Admin\ManageRoomController;
use App\Http\Controllers\Admin\MRoomController;


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

//-------------- Admin Routes --------------//
Route::prefix('admin')->group(function (){
    Route::get('/login',[AdminController::class, 'Index'])->name('login_form');
    Route::post('/login/owner',[AdminController::class, 'Login'])->name('admin.login');
    // Hindi pwedeng maview ang dashboard ng admin hanggat di nag login dahil nilagyan ko sya ng middleware
    Route::get('/dashboard',[AdminController::class, 'Dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/logout',[AdminController::class, 'AdminLogout'])->name('admin.logout')->middleware('admin');

    Route::get('/register', [AdminController::class, 'AdminRegister'])->name('admin.register');
    Route::post('/register/create',[AdminController::class, 'AdminRegisterCreate'])->name('admin.register.create');

    // Change Password Route for Admin
    Route::get('/change-password', [AdminController::class, 'showChangePasswordForm'])->name('admin.changePassword');
    Route::post('/change-password', [AdminController::class, 'updatePassword'])->name('admin.updatePassword');

    // View of List Users
    Route::get('/guest-list', [AdminController::class, 'GuestList'])->name('admin.guestList');
    Route::get('/frontdesk-list', [AdminController::class, 'FrontdeskList'])->name('admin.frontdeskList');
    Route::get('/room-list', [AdminController::class, 'Rooms'])->name('admin.roomList');
    
  

    // Manage Rooms
    Route::prefix('room')->group(function () {
            Route::get('/', [ManageRoomController::class, 'index'])->name('admin.room.index')->middleware('admin');;
            Route::get('/create', [ManageRoomController::class, 'create'])->name('admin.room.create');
            Route::post('/', [ManageRoomController::class, 'store'])->name('admin.room.store');
            Route::get('/{room}', [RoomController::class, 'show'])->name('admin.room.show');
            Route::get('/{room}/edit', [RoomController::class, 'edit'])->name('admin.room.edit');
            Route::put('/{room}', [RoomController::class, 'update'])->name('admin.room.update');
            Route::delete('/{room}', [RoomController::class, 'destroy'])->name('admin.room.destroy');
        });

    // Rooms
//     Route::prefix('room')->group(function (){
//         Route::resource('/', MRoomController::class)->name('admin.room.index');
//         Route::resource('/', MRoomController::class)->names([
//     'index' => 'admin.admin_manage-rooms',
//     'create' => 'rooms.create',
//     'store' => 'rooms.store',
//     'show' => 'rooms.show',
//     'edit' => 'rooms.edit',
//     'update' => 'rooms.update',
//     'destroy' => 'rooms.destroy',
// ]);

//     });
});
//-------------- End Admin Routes --------------//



//-------------- Frontdesk Routes --------------//
Route::prefix('frontdesk')->group(function (){
    Route::get('/login',[FrontdeskController::class, 'Index'])->name('frontdesk_login_form');
    Route::post('/login/owner',[FrontdeskController::class, 'FrontdeskLogin'])->name('frontdesk.login');
    // Hindi pwedeng maview ang dashboard ng admin hanggat di nag login dahil nilagyan ko sya ng middleware
    Route::get('/dashboard',[FrontdeskController::class, 'Dashboard'])->name('frontdesk.dashboard')->middleware('frontdesk');
    Route::get('/logout',[FrontdeskController::class, 'FrontdeskLogout'])->name('frontdesk.logout')->middleware('frontdesk');

    Route::get('/register', [FrontdeskController::class, 'FrontdeskRegister'])->name('frontdesk.register');
    Route::post('/register/create',[FrontdeskController::class, 'FrontdeskRegisterCreate'])->name('frontdesk.register.create');
    Route::get('/reservation', [FrontdeskController::class, 'FrontdeskReservation'])->name('frontdesk.reservation');
    Route::get('/bookingdetails', [FrontdeskController::class, 'FrontdeskBookingDetails'])->name('frontdesk.bookingdetails');
});
//-------------- End Frontdesk Routes --------------//



//-------------- Guest Routes --------------//
Route::prefix('admin')->group(function (){
    Route::get('/login',[AdminController::class, 'Index'])->name('login_form');
    Route::post('/login/owner',[AdminController::class, 'Login'])->name('admin.login');
    // Hindi pwedeng maview ang dashboard ng admin hanggat di nag login dahil nilagyan ko sya ng middleware
    Route::get('/dashboard',[AdminController::class, 'Dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/logout',[AdminController::class, 'AdminLogout'])->name('admin.logout')->middleware('admin');

    // Register
    Route::get('/register', [AdminController::class, 'AdminRegister'])->name('admin.register');
    Route::post('/register/create',[AdminController::class, 'AdminRegisterCreate'])->name('admin.register.create');

});
//-------------- End Guest Routes --------------//

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
