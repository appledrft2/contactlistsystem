<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\FriendRequestController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/update-password/{id}', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    Route::resource('users', UserController::class);
    Route::put('/users/update-access-level/{id}', [UserController::class, 'updateAccessLevel'])->name('users.updateAccessLevel');

    Route::resource('contacts', ContactController::class);
    Route::get('/contacts/share-contact/{id}', [ContactController::class, 'shareContact'])->name('contacts.shareContact');
    Route::post('/contacts/share-contact/{id}', [ContactController::class, 'shareContactStore'])->name('contacts.shareContactStore');

    Route::get('/friends', [FriendController::class, 'index'])->name('friends.index');
    Route::get('/friends/find', [FriendController::class, 'findFriend'])->name('friends.findFriend');
    Route::post('/friends/invite/{id}', [FriendController::class, 'inviteFriend'])->name('friends.inviteFriend');

    Route::get('/friend-requests', [FriendRequestController::class, 'index'])->name('friendRequests.index');
    Route::post('/friend-requests/accept/{id}', [FriendRequestController::class, 'acceptRequest'])->name('friendRequests.acceptRequest');
    Route::post('/friend-requests/deny/{id}', [FriendRequestController::class, 'denyRequest'])->name('friendRequests.denyRequest');

    Route::get('/friend-requests-count', [FriendRequestController::class, 'friendRequestsCount'])->name('friendRequests.friendRequestsCount');
});
