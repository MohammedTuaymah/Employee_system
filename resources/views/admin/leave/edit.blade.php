@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Leave form
                    
                </li>
              </ol>
            </nav>
            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif
        <form action="{{route('leaves.update',[$leave->id])}}" method="post">@csrf
            {{method_field('PATCH')}}

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create leave</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>From date</label>
                        <input type="text" name="from" class="form-control @error('from') is-invalid @enderror" required="" id="datepicker" value="{{$leave->from}}">
                         @error('from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                    </div>
                    <div class="form-group">
                        <label>To date</label>
                        <input type="text" name="to" class="form-control @error('to') is-invalid @enderror" required="" id="datepicker1" value="{{$leave->to}}">
                         @error('to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="form-group">
                        <label>Type of leave</label>
                        <select class="form-control" name="type">
                            <option value="annualleave">Annual Leave</option>
                            <option value="sickleave">Sick Leave</option>
                            <option value="parental">Parental Leave</option>
                            <option value="other">Other Leave</option>
                        </select>
                        

                    </div>
                    
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control">{{$leave->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary " type="submit">Update</button>
                    </div>
                </div>
        </div>
        </form>

  

            

    </div>

</div>
    
@endsection
