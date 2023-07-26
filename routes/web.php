<?php

use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Route;
use App\Events\NewMessageNotification;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $products=Product::where('user_id',auth()->user()->id)->orWHere('id',48)->get();
    $products->load('user');
    return view('dashboard',compact('products'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('test',function(){

     // message is being sent
     $message = new Message;
     $message->setAttribute('from', 1);
     $message->setAttribute('to', 2);
     $message->setAttribute('message', 'Demo message from user 1 to user 2');
     $message->save();

     // want to broadcast NewMessageNotification event
     event(new NewMessageNotification($message));

})->middleware(['auth']);

Route::view('pusher','pusher')->middleware(['auth']);


Route::get('/dashboard/product/{product}',[ProductController::class,'show2'])->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

require __DIR__.'/client.php';

require __DIR__.'/admin.php';
