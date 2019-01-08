@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row loginbg">
        <div class="col-md-8 offset-md-2">
          <h1>Admin Panel</h1>
        </div>
      </div>
      <div class="row" style="margin-top:3%">
        <div class="col-md-4 offset-md-4">
          @if(session()->has('message'))
              <div class="alert alert-success">
                  {{ session()->get('message') }}
              </div>
          @endif
          @if(session()->has('error_msg'))
              <div class="alert alert-danger">
                  {{ session()->get('error_msg') }}
              </div>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 loginbg">
          <form class="" action="{{action('UsersController@destroy')}}" method="post">
            <h3>Delete user</h3>
            <hr style="background-color:white;">
              {{method_field('DELETE')}}
              {{csrf_field()}}
              <div class="form-group">
                  <label for="username" class="" >Username</label>
                  <input id="username" type="text" class="form-control" name="username" value=""
                         required autofocus>
              </div>
              <div class="button-height">
                  <button type="submit" class="btn btn-danger float-right">Delete User</button>
              </div>
          </form>
        </div>
        <div class="col-md-4 loginbg">

          <form class="" action="{{action('UsersController@ban')}}" method="post">
              <h3>Ban user</h3>
              <hr style="background-color:white;">
              {{method_field('POST')}}
              {{csrf_field()}}
              <div class="form-group">
                  <label for="username" class="">Username</label>
                  <input id="username" type="text" class="form-control" name="username" value=""
                         required autofocus>
              </div>
              <div class="button-height">
                  <button type="submit" class="btn btn-danger float-right">Ban User</button>
              </div>
          </form>
        </div>
      </div>
    </div>
@endsection
