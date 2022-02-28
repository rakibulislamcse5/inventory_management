@extends('layouts.app')
@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header">
                All Products
                <div class="btn-actions-pane-right">
                    <div role="group" class="btn-group-sm btn-group">
                        <button class="active btn btn-focus">Last Week</button>
                        <button class="btn btn-focus">All Month</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Product Name</th>
                            <th class="text-center">Regular Price</th>
                            <th class="text-center">Stock</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $key => $products) 
                        <tr>
                            <td class="text-center text-muted">#{{ $products->id }}</td>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left">
                                                <img width="100" src="{{ $products->image }}" alt="" />
                                            </div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">{{ $products->product_name }}</div>
                                            <div class="widget-subheading opacity-7">Price : {{ $products->product_price }} BDT</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">{{ $products->regular_price }}</td>
                            <td class="text-center">{{ $products->product_stock }} Unit</td>
                            <td class="text-center">{{ $products->category->category_name }}</td>
                            <td class="text-center">
                                @if( $products->product_status == 0 )
                                    <div class="badge badge-warning">Pending</div>
                                @elseif( $products->product_status == 1 )
                                    <div class="badge badge-success">Running</div>
                                @elseif( $products->product_status == 2 )
                                    <div class="badge badge-info">In Hold</div>
                                @else
                                    <div class="badge badge-danger">Stoped</div>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="/product/Update/{{ $products->id }}">
                                    <button type="button" id="PopoverCustomT-4" class="btn btn-success btn-sm">Update</button>
                                </a>
                                <a href="/product/deleteAction/{{ $products->id }}">
                                    <button type="button" id="PopoverCustomT-4" class="btn btn-danger btn-sm">Delete</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-block text-center card-footer">   
                {{ $product->links() }} 

            </div>
        </div>
    </div>
</div>
@endsection

