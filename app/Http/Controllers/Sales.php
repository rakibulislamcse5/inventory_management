<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Sale;
use App\Models\User;
use DB;
use Validator;

class Sales extends Controller
{
    public  function index(){
        $sale = Sale::where([
            ['is_deleted','=', 0]
            ])->orderBy('id','desc')->paginate(15);
        $user = $this->userData();
        $data = [
            'user' => $user,
            'sale' => $sale
        ];
        return view('sale.sales',$data);
    }
    public  function add(){
        $product = Product::where([
            ['is_deleted','=', 0],
            ['product_stock','>', 0]
            ])->get();
        $user = $this->userData();
        $data = [
            'user' => $user,
            'product' => $product
        ];
        return view('sale.add-sales',$data);
    }
    public  function update($id){
        $sale = Sale::find($id);
        $product = Product::where([
            ['is_deleted','=', 0]
            ])->get();
        $user = $this->userData();
        $data = [
            'product' => $product,
            'sale' => $sale,
            'user' => $user
        ];
        return view('sale.edit-sale', $data);
    }

    // Action New Sale add
    public  function ActionAdd( Request $add ){
        $input = $add->all();
        $rules = array(
            'today_sale' => 'required',
            'sale_price' => 'required',
        );
        $messages = array(
            'today_sale.required' => 'Total Unite Required.',
            'sale_price.required' => 'Sale Price Required.',
        );
        $valid = Validator::make($input, $rules, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $id = $add->product;
        $product = Product::find($id);
        $product_stock = $product->product_stock;
        $product_price = $product->product_price;
        $sale_price = $add->sale_price;
        if(!$product_stock > 0 or $add->today_sale <= $product_stock){
            $profit = $this->profit($product_price,$sale_price,$product_stock);
            $profitStatus = $this->profitStatus($product_price,$sale_price,$product_stock);
            $current_stock = $product_stock - $add->today_sale;
            
            DB::beginTransaction();
            try {
                $sale = new Sale();
                $sale->product_id           = $id;
                $sale->today_sale           = $add->today_sale;
                $sale->total_profit         = $profit;
                $sale->total_product        = $product->product_stock;
                $sale->sale_price           = $add->sale_price;
                $sale->sale_status          = $profitStatus;
                $product->product_stock     = $current_stock;

                if (!$product->save()) {
                    throw new Exception("Query problem on creating record.");
                }elseif(!$sale->save()){
                    throw new Exception("Query problem on creating record.");
                }
                DB::commit();
                return redirect('/Sales')->with('success', 'New record created successfully.');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->with('danger', $e->getMessage());
            }

        }else{
            return redirect('/Sales/Add')->with('stock.not.avilable', 'Out of Product Stock.');
        }
    }

    // Sale action Update
    public  function ActionUpdate( Request $update, $id ){
        $input = $update->all();
        $rules = array(
            'today_sale' => 'required',
            'sale_price' => 'required',
            'total_product' => 'required'
        );
        $messages = array(
            'today_sale.required' => 'Total Unite Required.',
            'sale_price.required' => 'Sale Price Required.',
            'total_product.required' => 'Total Product Required.'
        );
        $valid = Validator::make($input, $rules, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $product_id = $update->product;
        $product = Product::find($product_id);
        $product_stock = $update->total_product;
        $product_price = $product->product_price;
        $sale_price = $update->sale_price;
        if(!$product_stock > 0 or $update->today_sale <= $product_stock){
            $profit = $this->profit($product_price,$sale_price,$product_stock);
            $profitStatus = $this->profitStatus($product_price,$sale_price,$product_stock);
            $current_stock = $product_stock - $update->today_sale;
            
            DB::beginTransaction();
            try {
                $sale = Sale::find($id);
                $sale->product_id           = $id;
                $sale->today_sale           = $update->today_sale;
                $sale->total_profit         = $profit;
                $sale->total_product        = $update->total_product;
                $sale->sale_price           = $update->sale_price;
                $sale->sale_status          = $profitStatus;
                $product->product_stock     = $current_stock;

                if (!$product->save()) {
                    throw new Exception("Query problem on creating record.");
                }elseif(!$sale->save()){
                    throw new Exception("Query problem on creating record.");
                }
                DB::commit();
                return redirect('/Sales')->with('success', 'New record created successfully.');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->with('danger', $e->getMessage());
            }

        }else{
            return redirect('/Sales/Add')->with('stock.not.avilable', 'Out of Product Stock.');
        }
    }

    //sale action delete
    public  function ActionDelete( $id ){
        DB::beginTransaction();
        try {
            $sale = Sale::find($id);
            $sale->is_deleted = 1;
            //$category->deleted_at = cur_date_time();
            if (!$sale->save()) {
                throw new Exception("Query problem on Deleted record.");
            }
            DB::commit();
            return redirect('/product')->with('success', 'New record Deleted successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    private function profit($product_price , $regular_price , $total_unite){
        if(!empty($product_price) && !empty($regular_price)){
            $profit = $regular_price - $product_price;
            if($regular_price > $product_price){
                $total_profit = $profit*$total_unite;
                return $total_profit;
            }else{
                $total_profit = $profit*$total_unite;
                return $total_profit;
            }
        }
    }
    private function profitStatus($product_price , $regular_price , $total_unite){
        if(!empty($product_price) && !empty($regular_price)){
            $profit = $regular_price - $product_price;
            if($regular_price > $product_price){
                $total_profit = $profit*$total_unite;
                return '1';
            }else{
                $total_profit = $profit*$total_unite;
                return '0';
            }
        }
    }
    // user data 
    public function userData(){
        $userId = Auth::id();
        $user = User::find($userId);
        return $user;
    }

}