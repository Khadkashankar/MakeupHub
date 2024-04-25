@extends('cmaster')

@section('title')
Makeup Hub | Menu List
@endsection

@section('menuactive')
active
@endsection

@section('content')
<h1 class="text-center text-danger">Makeup Menu List</h1>
<div id="accordion">
  <div class="card-menu-list">
    <div class="card-header bg-success" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <h3 class="text-white"> -> Skincare makeup</h3>
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <ol class="flist">
        	@forelse($data['skincare_makeup'] as $skincare_makeup)
        	<li>
        		<a href="makeup-details/{{$skincare_makeup->id}}" class="text-success">{{ $skincare_makeup->makeup_name}} -> Rs.{{$skincare_makeup->price}}/-</a>
        	</li>
        	@empty
        	<li>Skincare makeup list not available.</li>
        	@endforelse
        </ol>
      </div>
    </div>
  </div>
  <div>
    <div class="card-header bg-danger" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        	<h3 class="text-white"> -> Beauty makeup</h3>
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <ol class="flist">
        	@forelse($data['beauty_makeup'] as $beauty_makeup)
        	<li>
        		<a href="makeup-details/{{$beauty_makeup->id}}" class="text-danger">{{ $beauty_makeup->makeup_name}} -> Rs.{{$beauty_makeup->price}}/-</a>
        	</li>
        	@empty
        	<li>beauty_makeup list not available.</li>
        	@endforelse
        </ol>
      </div>
    </div>
  </div>
  <div class="card-menu-list">
    <div class="card-header bg-warning" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
          <h3 class="text-white"> -> Haircare makeup</h3>
        </button>
      </h5>
    </div>

    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        <ol class="flist">
          @forelse($data['haircare_makeup'] as $haircare_makeup)
          <li>
            <a href="makeup-details/{{$haircare_makeup->id}}" class="text-warning">{{ $haircare_makeup->makeup_name}} -> Rs.{{$haircare_makeup->price}}/-</a>
          </li>
          @empty
          <li>haircare_makeup list not available.</li>
          @endforelse
        </ol>
      </div>
    </div>
  </div>
</div>
@endsection
