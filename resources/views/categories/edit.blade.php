@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
            <div class="panel-heading">
                  Update category: {{ $category->name }}
            </div>
           
            <div class="panel-body">
                  <form action="{{ route('categories.update', $category->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" name="id" value="{{ $category->id }}">
                        <div class="form-group">
                              <label for="name">Name</label>
                              <input type="text" name="name" value="{{ $category->name }}" class="form-control @error('name') is-invalid @enderror">
                              @error('name') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                              <div class="text-center">
                                    <button class="btn btn-success" type="submit">
                                          Update category
                                    </button>
                              </div>
                        </div>
                  </form>
            </div>
      </div>
      </div>
      </div>
      </div>
@stop