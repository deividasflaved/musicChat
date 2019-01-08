@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      @forelse($channels as $channel)
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading">
                {{$channel->name}}
              </div>
              <div class="panel-body">
                {{$channel->info}}
              </div>
          </div>
      </div>
      @empty

      @endforelse
      <div class="col-md-8 col-md-offset-2" style="text-align: center;">
        {{$channels->links()}}
      </div>

    </div>
</div>
@endsection
