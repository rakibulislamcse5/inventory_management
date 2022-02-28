@extends('layouts.app')
@section('content')              
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Controls Types</h5>
        <form action="/product/updateAction/{{ $product->id }}" method="POST">
        @csrf
            
            <div class="position-relative form-group"><label for="name" class="">Name</label><input name="name" id="name" value="{{ $product->product_name }}" type="text" class="form-control" /></div>
            <div class="position-relative form-group">
                <label for="category" class="">Product category</label>
                <select name="category" id="category" class="form-control">
                    @foreach ($category as $key => $catList)
                        @if( $catList->id == $product->category_id )
                            <option value="{{ $catList->id }}"  selected>{{ $catList->category_name }}</option>
                        @else
                            <option value="{{ $catList->id }}">{{ $catList->category_name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="position-relative form-group">
                <label for="status" class="">Product status</label>
                <select name="status" id="status" class="form-control">
                        @if( $product->product_status  == 0 )
                            <option value="0" selected>Pending</option>
                            <option value="1">Running</option>
                            <option value="2">Hold</option>
                            <option value="4">End</option>
                        @elseif( $product->product_status  == 1 )
                        <option value="0">Pending</option>
                            <option value="1" selected>Running</option>
                            <option value="2">Hold</option>
                            <option value="4">End</option>
                        @elseif( $product->product_status  == 2 )
                        <option value="0">Pending</option>
                            <option value="1">Running</option>
                            <option value="2" selected>Hold</option>
                            <option value="3">End</option>
                        @elseif( $product->product_status  == 3 )
                        <option value="0">Pending</option>
                            <option value="1">Running</option>
                            <option value="2">Hold</option>
                            <option value="3" selected>End</option>
                        @endif
                </select>
            </div>
            <div class="position-relative form-group"><label for="price" class="">Price</label><input name="price" id="price" value="{{ $product->product_price }}" type="text" class="form-control" /></div>
            <div class="position-relative form-group"><label for="rp" class="">Regular Price</label><input name="regular_price" id="rp" value="{{ $product->regular_price }}" type="text" class="form-control" /></div>
            <div class="position-relative form-group"><label for="stock" class="">Product Stock</label><input name="stock" id="stock" value="{{ $product->product_stock }}" type="text" class="form-control" /></div>
            <div class="position-relative form-group"><label for="description" class="">Description</label><textarea name="desc" id="description" class="form-control">{{ $product->product_desc }}</textarea></div>
            <button class="mt-1 btn btn-primary">Add New Product</button>
        </form>
    </div>
</div>
@endsection