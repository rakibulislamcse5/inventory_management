@extends('layouts.app')
@section('content')              
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Controls Types</h5>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ Route('add.action.product') }}" method="POST">
        @csrf
            <div class="position-relative form-group"><label for="image" class="">Image Url</label><input name="image" id="name" placeholder="Enter Image Url" type="text" class="form-control" /></div>
            <div class="position-relative form-group"><label for="name" class="">Name</label><input name="name" id="name" placeholder="Enter Name" type="text" class="form-control" /></div>
            <div class="position-relative form-group">
                <label for="product_type" class="">Product Type</label>
                <select name="product_type" id="product_type" class="form-control">
                    
                        <option value="1">22</option>
                    
                </select>
            </div>
            <div class="position-relative form-group">
                <label for="Productcategory" class="">Product Category</label>
                <select name="category" id="Productcategory" class="form-control">
                    @foreach($data as key => $value)
                        <option value="11">22</option>
                    @endforeach
                </select>
            </div>
            <div class="position-relative form-group"><label for="price" class="">Price</label><input name="price" id="price" placeholder="Enter Price" type="text" class="form-control" /></div>
            <div class="position-relative form-group"><label for="description" class="">Description</label><textarea name="desc" id="description" class="form-control"></textarea></div>
            <button class="mt-1 btn btn-primary">Add New Product</button>
        </form>
    </div>
</div>
@endsection