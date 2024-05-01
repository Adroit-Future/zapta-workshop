<?php

use App\Actions\Car1;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Actions\RequestAction;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Route;
use App\Events\NewMessageNotification;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Redirect;
use App\Interfaces\MusicServiceInterface;
use App\Webhooks\StripeWebhookController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DependencyInjectionController;
use App\Livewire\Counter;

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

Route::get("/play-music", function () {
    dd(app()->make(MusicServiceInterface::class),
    app()->make(MusicServiceInterface::class));
    // dd($interfcae);
});

Route::get('car1', function (Car1 $car1) {
    return $car1->start();
  });




Route::get('/', function (RequestAction $request) {
    // dd($request);
    // $return = app()->make('foo');
    // // $return = resolve(Request::class);
    // // app('foo');
    // dd($return);
    return view('welcome');
});


Route::get('instance',[DependencyInjectionController::class,'index']);


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


Route::post('webhooks',[StripeWebhookController::class,'handle'])->withoutMiddleware(VerifyCsrfToken::class);

Route::get('create-webhooks',function(){
    $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
    $response=$stripe->webhookEndpoints->create([
        'url' => 'https://c8a9-119-155-24-49.ngrok-free.app/webhooks',
        'enabled_events' => [
            'checkout.session.completed',
        ],
    ]);
    dd($response);
});

Route::get('payment-success',function(Request $request){
    $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
    $session = $stripe->checkout->sessions->retrieve(request()->query('session_id'));
    dd($session);
});

Route::get('stripe-checkout',function(){
    $baseUrl = url('');
    $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
    $response =  $stripe->checkout->sessions->create([
        'success_url' =>  $baseUrl . '/payment-success?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => url()->previous(),
        'payment_method_types' => ['card'],
        'line_items' => [
            [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' =>'HP Laptop',
                    ],
                    'unit_amount_decimal' => 205*100,
                ],
                'quantity' => 1,
            ],
        ],
        'metadata'=>[
            'invoice_id' => 5,
            'user_id' => 10,
        ],
        'mode' => 'payment',
        'customer_email' => 'usman@gmail.com'
    ]);
    // dd($response);
    return Redirect::to($response['url']);
});


Route::view('components','components');
