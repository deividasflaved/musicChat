@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row offset-top">
          <div class="col-12">
            <a class="btn btn-outline-success float-right" href="" data-toggle="modal" data-target="#exampleModal">Add song<span class="sr-only">(current)</span></a>
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
                  <th scope="col">Duration</th>
                  <th scope="col">Delete?</th>
                </tr>
              </thead>
              <tbody style="color:white;">
                @forelse($songs as $song)
                  <tr>
                    <th scope="row">{{++$counter}}</th>
                    <td><a class="no-playlist-decoration"  href="{{$song->url}}">{{$song->title}}</a></td>
                    <td>{{$song->duration}}</td>
                    <td><a class="btn btn-outline-success btn-sm" href="/songs/delete/{{$song->id}}">Click here</a></td>
                  </tr>
                @empty

                @endforelse

              </tbody>
            </table>
          </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add song</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="" action="/songs/add/{{$id}}" method="post">
              {{csrf_field()}}
              @if (session('status'))
              <script>
                  $(function() {
                    $('#exampleModal').modal('show');
                  });
              </script>
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
              @endif
              <div class="form-group">
                <label for="name">YouTube song URL:</label>
                <input id="name" type="text" class="form-control" name="url" required autofocus>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="Submit" class="btn btn-primary" onclick="submitForm(this);">Add song</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection

@if (session('status'))
  <script>
      $(function() {
        $('#exampleModal').modal('show');
      });
  </script>
@endif
<script>
function submitForm(btn) {
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
