@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center">
        @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if(Session::has('error'))
        <div class="alert alert-danger">{{Session::get('error')}}</div>
        @endif
        <form action="{{ route('user.update.profile',[auth()->user()->id]) }}" method="post" enctype="multipart/form-data">@csrf
            <div class="col-md-8">
                <div class="form-group">
                    <label for="logo">Profile picture</label>
                    <input type="file" class="form-control" id="logo" name="profile_pic">
                    @if(auth()->user()->profile_pic)
                        <img src="{{Storage::url(auth()->user()->profile_pic)}}" width="150" class="mt-3">
                    @endif
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{auth()->user()->name}}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="about" class="form-control summernote">{{ auth()->user()->about }}</textarea>

                </div>
                <div class="form-group mt-4">
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>

    <div class="row justify-content-center">
        <h2>Change your password</h2>

        <form action="{{ route('user.password',[auth()->user()->id]) }}" method="post">@csrf
            <div class="col-md-8">
                <div class="form-group">
                    <label for="current_password">Your current password</label>
                    <input type="password" name="current_password" class="form-control" id="current_password">
                    @if($errors->has('current_password'))
                            <span class="text-danger">{{ $errors->first('current_password')}}</span>
                            @endif
                </div>
                <div class="form-group">
                    <label for="password">Your new password</label>
                    <input type="password" class="form-control" name="password" id="password">
                    @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password')}}</span>
                            @endif
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">

                </div>
                <div class="form-group mt-4">
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@push('scripts')
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
  <script>
    $( function() {
      $( "#datepicker" ).datepicker();
    } );

    $('.summernote').summernote({

        tabsize: 2,
        height: 100
      });
    </script>
@endpush
