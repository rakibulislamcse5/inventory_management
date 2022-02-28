<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;
use Validator;

class Categories extends Controller
{
    public  function index(){
        $category = Category::where('is_deleted', 0)->orderBy('id','desc')->paginate(5);
        $user = $this->userData();
        $data = [
            'user' => $user,
            'category' => $category
        ];
        return view('product.category',$data);
    }
    public  function add(){
        $user = $this->userData();
        $data = [
            'user' => $user,
        ];
        return view('product.add-category',$data);
    }
    public  function update($id){
        $category = Category::find($id);
        $user = $this->userData();
        $data = [
            'user' => $user,
            'category' => $category
        ];
        return view('product.update-category',$data);
    }

    // category add action
    public  function ActionAdd( Request $add ){
        $input = $add->all();
        $rules = array(
            'name' => 'required',
            'desc' => 'required',
            'Category_status' => 'required'
        );
        $messages = array(
            'name.required' => 'Category Required.',
            'desc.required' => 'Category Description Required.',
            'status.required' => 'Category Status Required.'
        );
        $valid = Validator::make($input, $rules, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        DB::beginTransaction();
        try {
            $category = new Category();
            $category->category_name = $add->name;
            $category->category_desc = $add->desc;
            $category->category_status = $add->Category_status;
            if (!$category->save()) {
                throw new Exception("Query problem on creating record.");
            }
            DB::commit();
            return redirect('/category')->with('success', 'New record created successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    // category update action
    public  function ActionUpdate( Request $update , $id ){
        $input = $update->all();
        $rules = array(
            'name' => 'required',
            'desc' => 'required',
            'Category_status' => 'required'
        );
        $messages = array(
            'name.required' => 'Category Required.',
            'desc.required' => 'Category Description Required.',
            'desc.required' => 'Category Status Required.'
        );
        $valid = Validator::make($input, $rules, $messages);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        DB::beginTransaction();
        try {
            $category = Category::find($id);
            $category->category_name = $update->name;
            $category->category_desc = $update->desc;
            $category->category_status = $update->Category_status;
            if (!$category->save()) {
                throw new Exception("Query problem on Update record.");
            }
            DB::commit();
            return redirect('/category')->with('success', 'Record Update successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }

    // category delete action
    public  function ActionDelete( $id ){
        DB::beginTransaction();
        try {
            $category = Category::find($id);
            $category->is_deleted = 1;
            //$category->deleted_at = cur_date_time();
            if (!$category->save()) {
                throw new Exception("Query problem on Deleted record.");
            }
            DB::commit();
            return redirect('/category')->with('success', 'New record Deleted successfully.');
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