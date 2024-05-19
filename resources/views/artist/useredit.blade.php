@extends('artist.master')

@section('title')
Edit User
@endsection


@section('registered-user')
       active
@endsection

@section('content')

    <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Edit User</h4>
              </div>
              <div class="card-body">

                <form method="post" action="{{ asset('updateuser')}}">
                  @csrf

                  <input type="hidden" name="id" value="{{$user->id}}">
                  <div class="form-group">
                    <label for="name">Name</label>
                  <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}">
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                  <input type="email" id="email" name="email" class="form-control" value="{{$user->email}}">
                  </div>

                  <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone" class="form-control" value="{{ $user->phone }}">
    </div>


                  <div class="form-group">
                    <input type="submit" name="submit" value="Update" class="btn btn-success">
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>


@endsection
