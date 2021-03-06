@extends('layouts.app')

@section('content')
 
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
            <div class="panel-heading">
                  Create a new category
            </div>

            <div class="panel-body">
                  <form action="{{ route('categories.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                              <label for="name">Name</label>
                              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                              @error('name') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                              <div class="text-center">
                                    <button class="btn btn-success" type="submit">
                                          Store category
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