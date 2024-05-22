@extends('cmaster')

@section('title')
Makeup Hub
@endsection

@section('content')

<div class="container-fluid background">
<h3 class="text-center mt-4">Our Cosmetics List</h3>

    <div class="row makeupdiv">



        @foreach($makeups as $makeup)
        <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12">
            <div class="card mt-3" style="width: 100%;">
                <a href="makeup-details/{{$makeup->id}}"><img class="card-img-top" src="uploads/{{$makeup->image ?? ''}}" alt="Card image cap" height="150px">
                </a>
                <div class="card-body">
                    <h5 class="card-title text-primary">{{$makeup->makeup_name}}</h5>
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
    <p class="text-center font-weight-bold list-title m-1">Recommendation for you</p><br>
    <div class="row makeupdiv">

        @if(Auth::User() and \Auth::user()->type == '1')
        @forelse($recommendation_ma as $r)
        <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12">
            <div class="card mt-3" style="width: 100%;">
                <a href="makeup-details/{{$r->id}}"><img class="card-img-top" src="uploads/{{$r->image ?? ''}}" alt="Card image cap" height="150px">
                </a>
                <div class="card-body">
                    <h5 class="card-title">{{$r->makeup_name}}</h5>
                </div>
                <ul class="list-group list-group-flush">

                    <li class="list-group-item font-weight-bold text-danger">Rs.{{$r->price}}</li>
                </ul>
                <div class="view">
                    <a href="makeup-details/{{$r->id}}" class="btn btn-danger"><i class="fa fa-eye"></i> View</a>
                </div>
            </div>
        </div>
        @empty
        <h4>recommendation for you</h4>
        @endforelse

        @elseif(Auth::User() and \Auth::user()->type == '2')
        @foreach($recommendation_ma1 as $rn)
        <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12">
            <div class="card mt-3" style="width: 100%;">
                <a href="makeup-details/{{$rn->id}}"><img class="card-img-top" src="uploads/{{$rn->image ?? ''}}" alt="Card image cap" height="150px">
                </a>
                <div class="card-body">
                    <h5 class="card-title">{{$rn->makeup_name}}</h5>
                </div>
                <ul class="list-group list-group-flush">

                    <li class="list-group-item font-weight-bold text-danger">Rs.{{$rn->price}}</li>
                </ul>
                <div class="view">
                    <a href="makeup-details/{{$rn->id}}" class="btn btn-danger"><i class="fa fa-eye"></i> View</a>
                </div>
            </div>
        </div>
        @endforeach

        @elseif(Auth::User())
        @foreach($recommendation_both as $rb)
        <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12">
            <div class="card mt-3" style="width: 100%;">
                <a href="makeup-details/{{$rb->id}}"><img class="card-img-top" src="uploads/{{$rb->image ?? ''}}" alt="Card image cap" height="150px">
                </a>
                <div class="card-body">
                    <h5 class="card-title">{{$rb->makeup_name}}</h5>
                </div>
                <ul class="list-group list-group-flush">

                    <li class="list-group-item font-weight-bold text-danger">Rs.{{$rb->price}}</li>
                </ul>
                <div class="view">
                    <a href="makeup-details/{{$rb->id}}" class="btn btn-danger"><i class="fa fa-eye"></i> View</a>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <h5><a href="{{asset('login')}}">Login</a> to view recommended cosmetics!</h5>
        @endif

    </div>
    <h3 class="text-center mt-4">Our Makeup Artists</h3>
    <div class="row makeupdiv">
        @foreach($artists as $artist)
        <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12">
            <div class="card mt-3" style="width: 100%;">
                <a href="artist-details/{{$artist->id}}">
                    <img class="card-img-top" src="artistimages/{{$artist->image ?? ''}}" alt="Card image cap" height="150px">
                </a>
                <div class="card-body">
                    <h5 class="card-title text-primary">{{$artist->user->name}}</h5>
                    <p class="card-title">Location: {{$artist->location}}</p>
                    <p class="card-title">Speciality: {{$artist->speciality}}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item font-weight-bold text-danger">Price: Rs.{{$artist->price}}</li>
                </ul>
                <div class="view">
                    <a href="artist-details/{{$artist->id}}" class="btn btn-danger"><i class="fa fa-eye"></i> View</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
<script>
    var msg = '{{Session::get('
    alert ')}}';
    var exist = '{{Session::has('
    alert ')}}';
    if (exist) {
        alert(msg);
    }
</script>
@endsection
