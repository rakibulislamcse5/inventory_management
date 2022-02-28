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
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($category as $key => $Catlist)
                        <tr>
                            <td class="text-center text-muted">#{{ $Catlist->id }}</td>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">{{ $Catlist->category_name }}</div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="text-center">
                            @if( $Catlist->category_status == 0 )
                                <div class="badge badge-warning">Pending</div>
                            @elseif( $Catlist->category_status == 1 )
                                <div class="badge badge-success">Running</div>
                            @elseif( $Catlist->category_status == 2 )
                                <div class="badge badge-danger">Stoped</div>
                            @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ url('category/Update') }}/{{ $Catlist->id }}">
                                    <button type="button" id="PopoverCustomT-4" class="btn btn-success btn-sm">Update</button>
                                </a>
                                <a href="/category/deleteAction/{{ $Catlist->id }}">
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
                        {{ $category->links() }} 
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

