@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row offset-top">
          <div class="col-12">
            <a class="btn btn-outline-success float-right" href="{{ route('playlists.create') }}">Create playlist<span class="sr-only">(current)</span></a>
          </div>
        </div>
        <hr style="background-color:white;"/>
        <div class="row">
          <div class="col-12">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Infomation</th>
                  <th scope="col">Add songs</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody style="color:white;">

                @forelse($playlists as $playlist)
                  <tr>
                    <th scope="row">{{++$counter}}</th>
                    <td>{{$playlist->playlist_name}}</td>
                    <td>{{$playlist->playlist_info}}</td>
                    <td><a class="btn btn-outline-success btn-sm" href="/playlists/{{$playlist->id}}">Click here</a></td>
                    <td><a class="btn btn-outline-success btn-sm" href="/playlists/delete/{{$playlist->id}}">Delete</a></td>
                    <!-- <a class="no-playlist-decoration" href="/playlists/{{$playlist->id}}">Click here</a> -->
                  </tr>
                @empty

                @endforelse
              </tbody>
            </table>
          </div>
        </div>
    </div>
@endsection



<!-- Modal -->
<!-- <div class="modal fade" id="exampleModal{{$counter}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add song</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="" action="/songs" method="post">
          {{csrf_field()}}
          <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
            <label for="name">YouTube song URL:</label>
            <input id="name" type="text" class="form-control" name="name" required autofocus>
           @if ($errors->has('url'))
               <span class="help-block">
                   <strong>{{ $errors->first('url') }}</strong>
               </span>
           @endif
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="Submit" class="btn btn-primary">Add song</button>
          </div>
          <div class="button-height">
            <button id="submitButton" type="submit" class="btn btn-outline-success float-right" onclick="submitForm(this);">Create</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div> -->
