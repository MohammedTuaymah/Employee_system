@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">

        <div class="col-md-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Mail
                    
                </li>
              </ol>
            </nav>
             @if(Session::has('message'))
                <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif
            <form action="{{route('mails.store')}}" method="post" enctype="multipart/form-data">@csrf
            <div class="card">
                <div class="card-header">Send Email</div>

                <div class="card-body">
                   <div class="form-group">
                    <label>select</label>
                    <select id="mail" class="form-control">
                        <option value="0">Mail to all staff</option>
                        <option value="1">Choose Department</option>
                        <option value="2">Choose Person</option>
                        
                    </select>
                    <br>
                    <div id="department">
                        <select name="department" class="form-control">
                            <option value="">Select</option>
                            @foreach(App\Models\Department::all() as $department)
                            <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div id="person">
                        <select name="person" class="form-control">
                            <option value="">Select</option>
                            @foreach(App\Models\User::all() as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>

                   </div>
                   <div class="form-group">
                    <label>Body</label>
                    <textarea name="body" class="form-control @error('body') is-invalid @enderror"></textarea>
                      @error('body')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                   </div>

                   <div class="form-group">
                    <label>File</label>
                   <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                    @error('file')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                   </div>
                   <div class="form-group">
                  <button type="submit" class="btn btn-primary">Submit</button>
                   </div>


                </div>
            </div>
        </form>
        </div>
    </div>
</div>
<style type="text/css">
    #department{
        display: none;
    }
    #person{
        display: none;
    }
</style>
@endsection
