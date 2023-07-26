<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index(){
        $key=2;
        // $products=Product::select("*", DB::raw("count(*) as user_count"))
        // ->groupBy('qty')->get();

        // // $array=collect(['shami'=>['qty'=>15,'name'=>'name1'],'talha'=>['qty'=>10,'name'=>'name1']]);
        // // return $array->groupBy('name');
        // // return $products->whereIn('qty',[49,2])->map(function($q){
        // //     // $q->modify_qty=($q->user->id) > 100 ? ($q->qty + 10) : $q->qty;
        // //     return $q->concat(['name' => 'Johnny Doe']);
        // // });
        // return $products;
        // $products=DB::table('products');
        // $prod1=$products->clone()->where('qty','>',17)->get();
        // return $prod1;
        // return ($products->clone()->where('qty','<',17)->get());
        // $product=Product::findor(10002,function(){
        //     abort(403);
        // });
        // $product=Product::firstOrNew([
        //     'name' => 'Shirt3'
        // ],[
        //     'qty' => 1, 'desc' => '11:30'
        // ]);
        // $product->user_id=12;
        // return $product->save();
        // return clone $product;
        // return $product->replicate([
        //     // 'desc'
        // ])->fill([
        //     // 'desc' =>'Shirt'
        // ]);
        $product=Product::find(2);
        $product->name='Updated';
        $product->save();
        dd($product,$product->getOriginal('name'));
        return view('welcome',compact('products'));
    }


    public function show2(ProductRequest $request, Product $product){

    // $this->authorize('view', $product);
    // Gate::authorize('view', $product);
        return $product->load('user');
    // if(Gate::allows('view-product2',$product)){
    //     return $product;
    // }
    // abort(403);
    // return view('dashboard',compact('products'));
    }
}
