@extends('layouts.app')
@section('content')                    
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Controls Types</h5>
        <form action="/category/updateAction/{{ $category->id }}" method="POST">
        @csrf
            <div class="position-relative form-group"><label for="name" class="">Name</label>
            <input name="name" id="name" value="{{ $category->category_name }}" type="text" class="form-control" />
            </div>
            <div class="position-relative form-group">
                <label for="status" class="">Status</label>
                <select name="Category_status" id="status" class="form-control">
                    <option value="0">Pending</option>
                    <option value="1">Running</option>
                    <option value="2">Stoped</option>
                </select>
            </div>
            <div class="position-relative form-group"><label for="description" class=""> Desctiption </label>
            <textarea name="desc" id="description" class="form-control">{{ $category->category_desc }}</textarea>
            </div>
            <button class="mt-1 btn btn-primary">Update Category</button>
        </form>
    </div>
</div>
@endsection
