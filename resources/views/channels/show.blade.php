@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row offset-top">
          <div class="col-12">
            @if(Auth::user()->id==$channel->user_id)
                <li class="nav-item">
                    <a class="btn btn-outline-success float-right" href="{{ route('channels.edit',$channel->id) }}">Edit Channel<span class="sr-only">(current)</span></a>
                </li>
            @endif
          </div>
        </div>
        <hr style="background-color:white;">
        <div class="row">
          <div class="col-8">
            <select id="test" class="custom-select custom-select-lg mb-3 select-bg" onchange="showDiv(this)">
            <option selected>Select playlist</option>
            @forelse($playlists as $playlist)
            <option value="{{$playlist->id}}">{{$playlist->playlist_name}}</option>
            @empty
            @endforelse
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            @forelse($playlists as $playlist)
            <div id="{{$playlist->id}}" class="test" style="display: none;">
              <iframe style="background-color:black;" src="{{$urls[$counter++]['url']}}" style="position:relative;" width="100%" height="350px"></iframe>
            </div>
            @empty
            @endforelse
          </div>
          <div class="col-4" style="bakcground-color:white; height:350px;">
              <html lang="en">
              <head>
                  <meta charset="UTF-8">
                  <title>Document</title>
                  <meta name="csrf-token" content="{{ csrf_token() }}">

              </head>
              <body>
                  <div class="row" id="app">
                      <div class="" style="width:95%; height:350px;">
                          <li class="list-group-item chat-bg">Chat Room</li>
                          <ul style="color: #310a4b;" class="list-group chat-bg" v-chat-scroll>

                              <message
                                      v-for="value,index in chat.message"
                                      :key=value.index
                                      :color=chat.color[index]
                                      :user = chat.user[index]
                              >
                                  @{{ value }}
                              </message>
                          </ul>
                          <input style="background-color: #310a4b; color:white;" type="text" class="form-control" placeholder="your message" v-model="message"
                                 @keyup.enter="send">
                      </div>
                  </div>

              <script>
                  var array = @json($channel->id);
              </script>
              <script src="{{ asset('js/app.js') }}"></script>
              </body>
              </html>
          </div>
        </div>
    </div>
    <script src="{{URL::asset('js/change.js')}}">
    </script>

@endsection
