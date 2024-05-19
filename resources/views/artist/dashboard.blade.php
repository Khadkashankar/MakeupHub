@extends('artist.master')

@section('title')
Artist Dashboard
@endsection


@section('artist-dashboard')
active
@endsection

@section('content')

	<div class="content">
        <div class="row" >
          <div class="col-md-12">
            <div class="card " style="text-transform: uppercase;" >
              <div class="card-header">
                <h4 class="card-title">All Details</h4>
              </div>
              <div class="card-body text- ">

                <div class="row p-5 m-2">
                  <div class="col-md-4 p-3">
                    <h5>total users</h5><hr>
                    <h5>{{ $data['total_users'] }}</h5>
                  </div>
                  <div class="col-md-4 p-3">
                    <h5>total Appointments</h5><hr>
                    <h5>{{ $data['total_appointments'] }}</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


@endsection
