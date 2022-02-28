@extends('layouts.app')
@section('content')                    
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Controls Types</h5>
        <form action="/category/addAction" method="POST">
        @csrf
            <div class="position-relative form-group"><label for="name" class="">Name</label><input name="name" id="name" placeholder="Enter Name" type="text" class="form-control" /></div>
            <div class="position-relative form-group">
                <label for="ProductType" class="">Product Type</label>
                <select name="Category_status" id="ProductType" class="form-control">
                    <option value="0">Pending</option>
                    <option value="1">Running</option>
                    <option value="2">Stoped</option>
                </select>
            </div>
            <div class="position-relative form-group"><label for="description" class="">Description</label><textarea name="desc" id="description" class="form-control"></textarea></div>
            <button class="mt-1 btn btn-primary">Add New Product</button>
        </form>
    </div>
</div>
@endsection