@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row loginbg">
    <div class="col-md-8 offset-md-2">
      <h1>Account settings</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 loginbg">
      <form class="" action="settings/{{$id}}" method="post">
         {{ csrf_field() }}
         <h3>Change password</h3>
         <hr style="background-color:white;">
         <div class="form-group{{ $errors->has('oldpassword') ? ' has-error' : '' }}">
           @if(session()->has('pass_message'))
            <div class="alert alert-success">
                {{ session()->get('pass_message') }}
            </div>
          @endif
           <label for="password">Old password</label>
           <input id="password" type="password" class="form-control" name="oldpassword" required>

             @if ($errors->has('oldpassword'))
                 <span class="help-block">
                     <strong>{{ $errors->first('oldpassword') }}</strong>
                 </span>
             @endif
         </div>
         <div class="form-group{{ $errors->has('newpassword') ? ' has-error' : '' }}">
            <label for="password">New password</label>
            <input id="password" type="password" class="form-control" name="newpassword" required>

             @if ($errors->has('newpassword'))
                 <span class="help-block">
                     <strong>{{ $errors->first('newpassword') }}</strong>
                 </span>
             @endif
         </div>
        <div class="button-height">
          <button type="submit" class="btn btn-outline-success float-right">Confirm</button>
        </div>
      </form>
    </div>
    <div class="col-md-4 loginbg">
      <form class="" action="/settings/{{$id}}" method="post">
        {{ csrf_field() }}
        <h3>Change E-mail</h3>
        <hr style="background-color:white;">
          @if(session()->has('mail_message'))
           <div class="alert alert-success">
               {{ session()->get('mail_message') }}
           </div>
         @endif
        <div class="form-group">
          <label for="information">New e-mail</label>
          <input id="info" type="email" class="form-control" name="email" autofocus required>
        </div>
        <div class="button-height">
          <button type="submit" class="btn btn-outline-success float-right">Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
