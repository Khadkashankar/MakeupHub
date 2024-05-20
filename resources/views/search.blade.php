@extends('cmaster')

@section('title')
Get cosmetics products delivered to your home
@endsection

<style type="text/css">
  .background {
    background: #fff;
    background-repeat: no-repeat;
    background-size: cover;
    padding: 50px 0px;
  }
  .makeupdiv {
    margin: -70px 0px 30px 30px !important;
    padding: 20px 20px !important;
    padding-bottom: 40px !important;
    box-shadow: 1px 1px 4px 1px gray;
    border-radius: 5px;
    background-color: #fff;
  }
  .card {
    border-radius: 10px !important;
    border: none !important;
    text-align: center;
    height: 450px;
    padding: 10px !important;
  }
  img {
    border-radius: 10px !important;
    height: 250px !important;
  }
  .card:hover {
    box-shadow: 0px 0px 15px 1px gray;
    transition: all 0.3s ease-in-out;
  }
  .view > a {
    border-radius: 30px;
  }
  .list-title {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 90px;
    display: inline-block;
    color: #ec3934;
  }
</style>

@section('content')
<h4 class="text-primary p-3">Search Results: {{$makeupcount + $artistcount}} result(s) for '{{ $value ?? 'all' }}'</h4><br>

@if ($makeupcount > 0)
<div class="container-fluid background">
    <div class="row makeupdiv">
        @foreach($makeupsearch as $makeup)
        <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12">
            <div class="card mt-3" style="width: 100%;">
                <a href="makeup-details/{{$makeup->id}}">
                    <img class="card-img-top" src="uploads/{{$makeup->image ?? ''}}" alt="Card image cap" height="150px">
                </a>
                <div class="card-body">
                    <h5 class="card-title">{{$makeup->makeup_name}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item font-weight-bold text-danger">Rs.{{$makeup->price}}</li>
                </ul>
                <div class="view">
                    <a href="makeup-details/{{$makeup->id}}" class="btn btn-danger"><i class="fa fa-eye"></i> View</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <center>
        <p style="text-align: center;">{{ $makeupsearch->links() }}</p>
    </center>
</div>
@endif

@if ($artistcount > 0)
<div class="container-fluid background">
    <div class="row makeupdiv">
        @foreach($artistsearch as $artist)
        <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12">
            <div class="card mt-3" style="width: 100%;">
                <a href="artist-details/{{$artist->id}}">
                    <img class="card-img-top" src="artistimages/{{$artist->image ?? 'default-artist-image.jpg'}}" alt="Card image cap" height="150px">
                </a>
                <div class="card-body">
                    <h5 class="card-title">{{$artist->name}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item font-weight-bold text-danger">Rs.{{$artist->price}}</li>
                </ul>
                <div class="view">
                    <a href="artist-details/{{$artist->id}}" class="btn btn-danger"><i class="fa fa-eye"></i> View</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <center>
        <p style="text-align: center;">{{ $artistsearch->links() }}</p>
    </center>
</div>
@endif

<script>
    var msg = '{{ Session::get('alert') }}';
    var exist = '{{ Session::has('alert') }}';
    if (exist) {
        alert(msg);
    }
</script>
@endsection
