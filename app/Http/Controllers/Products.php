<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;
use Validator;

class Products extends Controller
{
    public  function index(){
        $product = Product::where('is_deleted', 0)->orderBy('id','desc')->paginate(15);
        $user = $this->userData();
        $data = [
            'user' => $user,
            'product' => $product
        ];
        return view('index',$data);
    }
    public  function add(){
        $category = Category::where('is_deleted', 0)->get();
        $user = $this->userData();
        $data = [
            'user' => $user,
            'category' => $category
        ];
        return view('product.add-product',$data);
    }
    public  function update($id){
        $product = Product::find($id);
        $category = Category::where('is_deleted', 0)->get();
        $user = $this->userData();
        $data = [
            'product' =>  $product,
            'category' => $category,
            'user'     => $user
        ];
        return view('product.update-product',$data);
    }

    // Product Data add action
    public  function ActionAdd( Request $add ){
        $input = $add->all();
        $rules = array(
            'name' => 'required',
            'desc' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'status' => 'required',
            'regular_price' => 'required',
            'category' => 'required'
        );
        $messages = array(
            'name.required' => 'Category Required.',
            'desc.required' => 'Desc Description Required.',
            'status.required' => 'Status Required.',
            'stock.required' => 'Stock Required.',
            'price.required' => 'Price Required.',
            'regular_price.required' => 'Rerular Price Required.',
            'category.required' => 'Category Required.'
        );
        $valid = Validator::make($input, $rules, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        DB::beginTransaction();
        try {
            $product = new Product();
            $product->product_name      = $add->name;
            $product->product_desc      = $add->desc;
            $product->product_stock     = $add->stock;
            $product->product_price     = $add->price;
            $product->product_status    = $add->status;
            $product->regular_price     = $add->regular_price;
            $product->category_id       = $add->category;

            if (!$product->save()) {
                throw new Exception("Query problem on creating record.");
            }
            DB::commit();
            return redirect('/product')->with('success', 'New record created successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    // Product data update Action
    public  function ActionUpdate( Request $update , $id ){
        $user = $this->userData();
        $input = $update->all();
        $rules = array(
            'name' => 'required',
            'desc' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'status' => 'required',
            'regular_price' => 'required',
            'category' => 'required'
        );
        $messages = array(
            'name.required' => 'Category Required.',
            'desc.required' => 'Desc Description Required.',
            'status.required' => 'Status Required.',
            'stock.required' => 'Stock Required.',
            'price.required' => 'Price Required.',
            'regular_price.required' => 'Rerular Price Required.',
            'category.required' => 'Category Required.'
        );
        $valid = Validator::make($input, $rules, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        DB::beginTransaction();
        try {
            $product =Product::find($id);
            $product->product_name      = $update->name;
            $product->product_desc      = $update->desc;
            $product->product_stock     = $update->stock;
            $product->product_price     = $update->price;
            $product->product_status    = $update->status;
            $product->regular_price     = $update->regular_price;
            $product->category_id       = $update->category;

            if (!$product->save()) {
                throw new Exception("Query problem on creating record.");
            }
            DB::commit();
            return redirect('/product')->with('success', 'New record created successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    // Product Data delete Action
    public  function ActionDelete(  $id ){
        $user = $this->userData();
        DB::beginTransaction();
        try {
            $product = Product::find($id);
            $product->is_deleted = 1;
            //$category->deleted_at = cur_date_time();
            if (!$product->save()) {
                throw new Exception("Query problem on Deleted record.");
            }
            DB::commit();
            return redirect('/product')->with('success', 'New record Deleted successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    // user data 
    public function userData(){
        $userId = Auth::id();
        $user = User::find($userId);
        return $user;
    }

}