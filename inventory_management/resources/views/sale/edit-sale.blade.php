@extends('layouts.app')
@section('content')
                        
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Add Sales</h5>
    <form action="/Sales/updateAction/{{ $sale->id }}" method="POST">
        @csrf
            <div class="position-relative form-group">
                <label for="product" class="">Select Product</label>
                <select name="product" id="product" class="form-control">
                    @foreach($product as $key => $products)
                        @if( $sale->product_id == $products->id)
                            <option value="{{ $products->id }}" selected>{{ $products->product_name }} (Buy Price : {{$products->product_price}} BDT) (Regular Price : {{$products->regular_price}} BDT) | Stock : {{$products->product_stock}}</option>
                        @else
                            <option value="{{ $products->id }}">{{ $products->product_name }} (Buy Price : {{$products->product_price}} BDT) (Regular Price : {{$products->regular_price}} BDT) | Stock : {{$products->product_stock}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            
            <div class="position-relative form-group"><label for="today" class="">Today Total Sale (Unit)</label><input name="today_sale" id="today" value="{{$sale->today_sale}}" type="number" class="form-control" /></div>
            <div class="position-relative form-group"><label for="today" class="">Product Stock (Unit)</label><input name="total_product" id="today" value="{{$sale->total_product}}" type="number" class="form-control" /></div>

            <div class="position-relative form-group"><label for="sale_price" class="">Sale Price</label><input name="sale_price" id="name" value="{{$sale->sale_price}}" type="text" class="form-control" /></div>

            <button class="mt-1 btn btn-primary">Update Sales</button>
        </form>
    </div>
</div>
@endsection