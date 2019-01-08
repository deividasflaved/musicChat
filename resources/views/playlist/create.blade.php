@extends('layouts.app')

@section('content')
 <div class="container">
   <div class="col-md-4 loginbg">
     <h1>Create playlist</h1>

     @if(isset($amount))
         <div class="alert alert-danger">
             {{$amount}}
         </div>
         <form class="" action="" method="">
           {{csrf_field()}}
           <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
             <label for="name">Playlist name</label>
             <input id="name" type="text" class="form-control" name="name" required autofocus readonly>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
           </div>
           <div class="form-group{{ $errors->has('info') ? ' has-error' : '' }}">
             <label for="name">Playlist information</label>
             <input id="name" type="text" class="form-control" name="info" required autofocus readonly>
             @if ($errors->has('info'))
                 <span class="help-block">
                     <strong>{{ $errors->first('info') }}</strong>
                 </span>
             @endif
           </div>
           <div class="button-height">
             <button type="button" class="btn btn-outline-success float-right" readonly>Create</button>
           </div>
         </form>
     @else
     <form class="" action="/playlists" method="post">
       {{csrf_field()}}
       <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
         <label for="name">Playlist name</label>
         <input id="name" type="text" class="form-control" name="name" required autofocus>
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
       </div>
       <div class="form-group{{ $errors->has('info') ? ' has-error' : '' }}">
         <label for="name">Playlist information</label>
         <input id="name" type="text" class="form-control" name="info" required autofocus>
         @if ($errors->has('info'))
             <span class="help-block">
                 <strong>{{ $errors->first('info') }}</strong>
             </span>
         @endif
       </div>
       <div class="button-height">
         <button id="submitButton" type="submit" class="btn btn-outline-success float-right" onclick="submitForm(this);">Create</button>
       </div>
     </form>
     @endif



   </div>
 </div>
@endsection

<script>
function submitForm(btn) {
        // disable the button
        //btn.disabled = true;
        // submit the form
        if(btn.form.checkValidity()){
          btn.form.submit();
          btn.disabled = true;
        }
        else{
          document.getElementById('name').validationMessage;
        }
    }
</script>
