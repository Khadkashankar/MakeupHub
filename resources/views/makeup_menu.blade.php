@extends('cmaster')

@section('title')
Makeup Hub | Menu List
@endsection

@section('menuactive')
active
@endsection

@section('content')
<h1 class="text-center text-black">Cosmetics Menu List</h1>
<div id="accordion">
  <div class="card-menu-list">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link custom-btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <h3 class="text-white">Skincare Makeup</h3>
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <ol class="flist">
          @forelse($data['skincare_makeup'] as $skincare_makeup)
          <li>
            <a href="makeup-details/{{$skincare_makeup->id}}" class="text-success no-underline">{{ $skincare_makeup->makeup_name}} -> Rs.{{$skincare_makeup->price}}/-</a>
          </li>
          @empty
          <li>Skincare Makeup list not available</li>
          @endforelse
        </ol>
      </div>
    </div>
  </div>
  <div class="card-menu-list">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link custom-btn collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <h3 class="text-white">Beauty Makeup</h3>
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <ol class="flist">
          @forelse($data['beauty_makeup'] as $beauty_makeup)
          <li>
            <a href="makeup-details/{{$beauty_makeup->id}}" class="text-danger no-underline">{{ $beauty_makeup->makeup_name}} -> Rs.{{$beauty_makeup->price}}/-</a>
          </li>
          @empty
          <li>Beauty Makeup list not available.</li>
          @endforelse
        </ol>
      </div>
    </div>
  </div>
  <div class="card-menu-list">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link custom-btn" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
          <h3 class="text-white">Haircare Makeup</h3>
        </button>
      </h5>
    </div>

    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        <ol class="flist">
          @forelse($data['haircare_makeup'] as $haircare_makeup)
          <li>
            <a href="makeup-details/{{$haircare_makeup->id}}" class="text-warning no-underline">{{ $haircare_makeup->makeup_name}} -> Rs.{{$haircare_makeup->price}}/-</a>
          </li>
          @empty
          <li>Haircare Makeup list not available</li>
          @endforelse
        </ol>
      </div>
    </div>
  </div>
</div>

<style>
  .custom-btn {
    background-color: #000;
    color: #fff;
    text-decoration: none;
    border: 1px solid #000;
    border-radius: 8px;
    width: 100%;
    padding: 15px;
    margin-bottom: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s, box-shadow 0.3s;
  }

  .custom-btn:hover {
    background-color: #031;
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
  }

  .custom-btn:focus {
    outline: none;
  }

  .custom-btn:hover h3 {
    text-decoration: none;
  }

  .card-menu-list {
    border: 1px solid #ccc;
    border-radius: 10px;
    margin-bottom: 20px;
  }

  .card-menu-list:hover .custom-btn {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  /* Remove underline from anchor elements */
  .no-underline {
    text-decoration: none;
  }
</style>
@endsection
