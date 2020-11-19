@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a new product</div>

                <div class="panel-body">
                    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                              <label for="name">Name</label>
                              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                              @error('name') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                              <label for="category">Select a Category</label>
                              <select name="category_id" id="category" class="form-control @error('category_id') is-invalid @enderror">
                                    @foreach($categories as $category)
                                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                              </select>
                              @error('category_id') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                              <label for="image">Price</label>
                              <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                              @error('price') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                              <label for="image">Image</label>
                              <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                              @error('image') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                              <label for="description">Description</label>
                              <textarea name="description" id="description" cols="30" rows="10" class="form-control @error('description') {{ $message }} @enderror">{{ old('description') }}</textarea>
                              @error('description') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                              <button class="form-control btn btn-success">Save Product</button>
                        </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
