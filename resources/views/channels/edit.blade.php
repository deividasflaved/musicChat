@extends('layouts.app')

@section('content')
    @if(isset($error_msg))
        <div class="container">
            <div class="col-md-4 loginbg">
                <h1>Edit channel</h1>
                <div class="alert alert-danger">
                    {{ $error_msg }}
                </div>
                <form class="" action="" method="">
                    <div class="form-group">
                        <label for="name">Channel name</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{$channel->name}}"
                               required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="information">Channel informaton</label>
                        <input id="info" type="text" class="form-control" name="info" value="{{$channel->info}}"
                               required autofocus readonly>
                    </div>
                    <div class="button-height">
                        <button type="button" class="btn btn-outline-success float-right" readonly>Update</button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="container">
            <div class="col-md-4 loginbg">
                <h1>Edit channel</h1>
                @if(session()->has('error_msg'))
                    <div class="alert alert-success">
                        {{ session()->get('error_msg') }}
                    </div>
                @endif
                <form class="" action="/channels/{{$channel->id}}}" method="post">
                    {{method_field('PUT')}}
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name">Channel name</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{$channel->name}}"
                               required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="information">Channel informaton</label>
                        <input id="info" type="text" class="form-control" name="info" value="{{$channel->info}}"
                               required autofocus>
                    </div>
                    <div class="button-height">
                        <button type="submit" class="btn btn-outline-success float-right">Update</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection
