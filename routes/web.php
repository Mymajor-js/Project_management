<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mapController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\testController;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Notifications\NewMarkerCreated;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TeacherController;

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

Route::post('/cpassword', [mapController::class, 'changePassword'])->name('user.change-password');


Route::post('/notifications/mark-read', function () {
    Auth::user()->unreadNotifications->markAsRead();
    return back();
})->name('notifications.markAllAsRead');

Route::post('/notifications/read/{id}', function ($id) {
    $notification = auth()->user()->notifications()->findOrFail($id);
    $notification->markAsRead();
    return response()->json(['status' => 'read']);
});

Route::delete('/notifications/read-all', [App\Http\Controllers\NotificationController::class, 'deleteRead'])
    ->name('notifications.deleteRead');

Route::post('/markers/create', [mapController::class, 'store'])->name('markers.store');

Route::get('/test-notify', function () {
    $admin = User::where('level', 'admin')->first();
    
    $fakeMarker = (object)[
        'id' => 123,
        'Nactivity' => 'ทดสอบระบบแจ้งเตือน',
    ];

    $admin->notify(new NewMarkerCreated($fakeMarker));

    return 'ส่งแจ้งเตือนทดสอบเรียบร้อย';
});



Route::post('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
Route::delete('/notifications/delete/{id}', [NotificationController::class, 'delete'])->name('notifications.delete');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [App\Http\Controllers\mapController::class, 'showlist'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/map', function () {
    return view('map'); 
});
Route::get('/mesavex', function () {
    return view('add-l-l');
})->name('mesavex'); 


Route::get('/sent_activity', [mapController::class, 'sent_activity'])->name('sent_activity');
Route::get('/marker-detail/{lat}/{lng}', [mapController::class, 'show']);

Route::get('/updatex/{Nactivity}', [mapController::class, 'show_b_up'])->name('updatex');

Route::delete('/delx/{Nactivity}', [mapController::class, 'del'])->name('delx');
Route::post('/update_success/{Nactivity}', [mapController::class, 'update_success'])->name('update_success');
Route::post('/update/{Nactivity}', [mapController::class, 'update'])->name('update');

Route::put('/user/update-profile', [mapController::class, 'updateProfilex'])->name('updateProfilex');

Route::post('/delrow/{id}', [mapController::class, 'delRow'])->name('delrow');
Route::post('/deleteperson/{id}', [mapController::class, 'deleteperson'])->name('deleteperson');
Route::post('/deletenumber/{id}', [mapController::class, 'deletenumber'])->name('deletenumber');
Route::post('/deletetarget/{id}', [mapController::class, 'deletetarget'])->name('deletetarget');
Route::post('/deleteresult/{id}', [mapController::class, 'deleteresult'])->name('deleteresult');
Route::post('/deleteactivity/{id}', [mapController::class, 'deleteactivity'])->name('deleteactivity');
Route::post('/deletebenefit/{id}', [mapController::class, 'deletebenefit'])->name('deletebenefit');

Route::get('/add-marker-info', [mapController::class, 'showAddForm']);

Route::get('/get-markers', [mapController::class, 'getMarkers']);
Route::get('/search', [mapController::class, 'search'])->name('search');
Route::get('/chart', [mapController::class, 'showChart'])->name('chart');
Route::get('/download-pdf/{id}', [PDFController::class, 'generatePDF'])->name('download.pdf');


Route::get('/add_user', [ProfileController::class, 'adduser'])->name('add_user');
Route::post('/save_userx', [ProfileController::class, 'registerx'])->name('registerx');
Route::get('/listmarker', [mapController::class, 'alldata'])->name('alldata');
Route::get('/alldata', [mapController::class, 'alldata'])->name('alldata');
Route::get('/alldatalist', [mapController::class, 'alldatalist'])->name('alldatalist');
Route::get('/show-data', [mapController::class, 'showData'])->name('show.data');
Route::get('/show-map', [mapController::class, 'showMap'])->name('show.map');

Route::post('/upload-multiple-images', [ImageController::class, 'uploadImage'])->name('upload-multiple-images');
Route::post('/delete-image', [ImageController::class, 'deleteImage'])->name('deleteImage');

Route::post('/Mesave', [mapController::class, 'Mesave'])->name('Mesave');
Route::post('/Sentsave', [mapController::class, 'Sentsave'])->name('Sentsave');
Route::post('/add_activitys', [mapController::class, 'admin_add'])->name('admin_add');

Route::get('/add_activity', [mapController::class, 'add_activity'])->name('add_activity');

Route::get('/test', [testController::class, 'viewx'])->name('test');
Route::post('/store', [testController::class, 'store'])->name('project.store');
Route::post('/testsave', [testController::class, 'testsave'])->name('testsave');
Route::get('/testtwo', [testController::class, 'viewinput'])->name('testtwo');

Route::post('/storex', [TeacherController::class, 'store'])->name('storex');