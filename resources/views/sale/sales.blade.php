@extends('layouts.app')
@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header">
                All Saless
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
                            <th>Sales Name</th>
                            <th>Sale Price</th>
                            <th>Category</th>
                            <th>Total Product</th>
                            <th>Today Sale</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sale as $key => $sales)
                        <tr>
                        <td class="text-center text-muted">#{{ $sales->id}}</td>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left">
                                                <img width="100" src="{{ url('assets/images/product/accer.jpg') }}" alt="" />
                                            </div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                        <div class="widget-heading">{{ $sales->product->product_name}}</div>
                                            <div class="widget-subheading opacity-7">Price : {{ $sales->product->regular_price}} BDT</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $sales->sale_price }} BDT</td>
                            <td>{{ $sales->product->category->category_name}}</td>
                            <td>{{ $sales->total_product }} Unit</td>
                            <td>{{ $sales->today_sale }} Unit</td>
                            <td>
                                @if($sales->sale_status == 0)
                                <div class="badge badge-danger">Loss ( {{ $sales->total_profit}} BDT )</div>
                                @else
                                <div class="badge badge-success">Profited ( {{ $sales->total_profit}} BDT )</div>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="/Sales/Update/{{ $sales->id }}">
                                    <button type="button" id="PopoverCustomT-4" class="btn btn-success btn-sm">Update</button>
                                </a>
                                <a href="/Sales/deleteAction/{{ $sales->id }}">
                                    <button type="button" id="PopoverCustomT-4" class="btn btn-danger btn-sm">Delete</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                       
                    </tbody>
                </table>
            </div>
            <div class="d-block text-center card-footer">
                <nav class="" aria-label="Page navigation example">
                    <ul class="pagination">
                        {{ $sale->links() }} 
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

