@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
            <div class="panel-heading">
                  Categories
            </div>
            <div class="panel-body">
                  <table class="table table-hover">
                        <thead>
                              <th>
                                    Category name
                              </th>
                              <th>
                                    Editing 
                              </th>
                              <th>
                                    Deleting
                              </th>
                        </thead>

                        <tbody>
                              @if($categories->count() > 0)
                                    @foreach($categories as $category)
                                          <tr>
                                                <td>
                                                      {{ $category->name }}
                                                </td>
                                                <td>
                                                      <a href="{{ route('categories.edit', $category->id ) }}" class="btn btn-xs btn-info">
                                                            Edit
                                                      </a>
                                                </td>

                                                <td>
                                                       
                                                      <form action="{{ route('categories.destroy',$category->id) }}" method="post">
                                                      {{ csrf_field() }}
                                                      {{ method_field('DELETE') }}
                                                      <button class="btn btn-xs btn-danger">Delete</button>
                                                </form>
                                                </td>
                                          </tr>
                                    @endforeach
                              @else
                                     <tr>
                                          <th colspan="5" class="text-center">No categories yet.</th>
                                    </tr>
                              @endif
                        </tbody>
                        <tfoot >
                                <tr>
                                    <td colspan="6">
                                        {{$categories->links()}}
                                    </td>
                                </tr>
                                </tfoot>
                  </table>
            </div>
      </div>
      </div>
      </div>

@stop