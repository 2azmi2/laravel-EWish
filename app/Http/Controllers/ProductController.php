<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function index(){
        $products = DB::table('products')->get();
        $data = DB::table('categories')->get();
        return view('landing.product',['title' => 'Product',])->with('products', $products)->with('data', $data);
    }
    //Filtering
    public function filter(Request $request){
        $products = DB::table('products')->where('category', $request->get('category'))->get();
        $data = DB::table('categories')->get();
        return view('landing.product',['title' => 'Product',])->with('products', $products)->with('data', $data);
    }
    //DASHBOARD
    public function allProduct(Product $model)
    {
        return view('product.product', ['products' => $model->paginate(100)]);
    }
    public function searchAllProduct(Request $request){
        $keyword = $request->search;
        $products = DB::table('products')
				->where('name', 'like', "%" . $keyword . "%")
				->paginate(10);

        return view('product.product', compact('products'))->with('i', (request()->input('page', 1) - 1) * 10);
    }
    public function detailProduct($product_id){
        $products = DB::table('products')->where('product_id', 'like', "%" . $product_id . "%")->get();
        $data = DB::table('categories')->get();
        return view('landing.detailProduct',['title' => 'Detail Product',])->with('products', $products)->with('data', $data);
    }
}
