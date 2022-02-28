@extends('layouts.app')
@section('content')              
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Controls Types</h5>
        <form action="/product/addAction" method="POST">
        @csrf
            
            <div class="position-relative form-group"><label for="name" class="">Name</label><input name="name" id="name" placeholder="Enter Name" type="text" class="form-control" /></div>
            <div class="position-relative form-group">
                <label for="category" class="">Product category</label>
                <select name="category" id="category" class="form-control">
                        @foreach($category as $key => $Catlist)
                            <option value="{{ $Catlist->id }}">{{ $Catlist->category_name }}</option>
                        @endforeach
                </select>
            </div>
            <div class="position-relative form-group">
                <label for="status" class="">Product status</label>
                <select name="status" id="status" class="form-control">
                        <option value="0">Pending</option>
                        <option value="1">Running</option>
                        <option value="3">Hold</option>
                        <option value="4">End</option>
                </select>
            </div>
            <div class="position-relative form-group"><label for="price" class="">Price</label><input name="price" id="price" placeholder="Enter orginal Price" type="text" class="form-control" /></div>
            <div class="position-relative form-group"><label for="rp" class="">Regular Price</label><input name="regular_price" id="rp" placeholder="Enter Sale Price" type="text" class="form-control" /></div>
            <div class="position-relative form-group"><label for="stock" class="">Product Stock</label><input name="stock" id="stock" placeholder="Enter stock" type="text" class="form-control" /></div>
            <div class="position-relative form-group"><label for="description" class="">Description</label><textarea name="desc" id="description" class="form-control"></textarea></div>
            <button class="mt-1 btn btn-primary">Add New Product</button>
        </form>
    </div>
</div>
@endsection