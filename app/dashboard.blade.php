@extends('admin.master')

@section('title')
Makeup Hub | Dashboard
@endsection


@section('dashboard')
active
@endsection

@section('content')

	<div class="content">
        <div class="row" >
          <div class="col-md-12">
            <div class="card " style="text-transform: uppercase;" >
              <div class="card-header">
              </div>
              <div class="card-body text- ">

                <div class="row p-5 m-2">
                    <div class="col-md-4 p-3">
                        <h5>total users</h5><hr>
                        <h5>{{$data['total_user']}}</h5>
                    </div>
                    <div class="col-md-4 p-3">
                        <h5>total artists</h5><hr>
                        <h5>{{$data['total_artist']}}</h5>
                    </div>
                    <div class="col-md-4 p-3">
                      <h5>total appointments</h5><hr>
                      <h5>{{$data['total_appoint']}}</h5>
                    </div>

                   <div class="col-md-4 p-3">
                    <h5>total orders</h5><hr>
                    <h5>{{$data['total_order']}}</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
