@extends('layouts.app')

@section('content')
@if(isset($error_msg))
 <div class="container">
   <div class="col-md-4 loginbg">
     <h1>Create channel</h1>
     <div class="alert alert-danger">
         {{ $error_msg }}
     </div>
     <form class="" action="" method="">
       <div class="form-group">
         <label for="name">Channel name</label>
         <input id="name" type="text" class="form-control" name="name" required autofocus readonly>
       </div>
       <div class="form-group">
         <label for="information">Channel informaton</label>
         <input id="info" type="text" class="form-control" name="info" required autofocus readonly>
       </div>
       <div class="button-height">
         <button type="button" class="btn btn-outline-success float-right" readonly>Create</button>
       </div>
     </form>
   </div>
 </div>
@else
<div class="container">
  <div class="col-md-4 loginbg">
    <h1>Create channel</h1>
    @if(session()->has('error_msg'))
     <div class="alert alert-success">
         {{ session()->get('error_msg') }}
     </div>
   @endif
    <form class="" action="/channels" method="post">
      <div class="form-group">
        <label for="name">Channel name</label>
        <input id="name" type="text" class="form-control" name="name" required autofocus>
      </div>
      <div class="form-group">
        <label for="information">Channel informaton</label>
        <input id="info" type="text" class="form-control" name="info" required autofocus>
      </div>
      <div class="button-height">
        <button type="submit" class="btn btn-outline-success float-right">Create</button>
      </div>
    </form>
  </div>
</div>
@endif

@endsection
