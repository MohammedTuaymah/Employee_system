@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if (Session::has('message'))
                <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif
            <form action="{{route('departments.update',[$department->id])}}" method="POST">@csrf
                {{@method_field('PATCH')}}
                <div class="card">
                    <div class="card-header">{{ __('Update Department') }}</div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$department->name}}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror">
                                {{$department->description}}
                            </textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            @if(isset(auth()->user()->role->permission['name']['department']['can-edit']))
                                <button type="submit" class="btn btn-primary">Update</button>
                            @endif
                        </div>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
