@extends('cmaster')

@section('title')
Makeup Hub | Home
@endsection

<style type="text/css">
	.rating{
		display: flex;
		flex-direction: column;
		align-items: center;
	}
	.stars{
		padding: 15px;
		display: flex;
	}
	.star{
		list-style-type: none;
		padding-left: 7px;
		font-size: 24px;
		cursor: pointer;

	}
	.click{
		color: orange;
	}
	.mouseover{
		color: yellow;
	}
	.mouseout{
		color: black;
	}
	.butn{
		text-align: center !important;
	}
	.butn > a{
		border-radius: 30px;
	}
	  .butn a.btn,
    .rating .btn-success {
        margin: -12px 0; /* Adjust these values as needed */
    }

    .rating {
        margin-bottom: 50px; /* Adjust if more spacing is needed around the rating section */
    }

    .butn {
        margin-bottom: -10px; /* Adjust if more spacing is needed around the button section */
    }
</style>
@section('content')
<br>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-7 mx-auto">
			<h2 class="text-center">Cosmetic Details Page</h2>
			<br>
			<img src="{{asset('uploads')}}/{{$data['details']->image ?? ''}}" height="200" width="300" class="img img-responsive img-thumbnail">
			<br>
			<br>
			<table class="table table-striped">
				<tr>
					<th colspan="2" class="text-danger">Cosmetic Details</th>
				</tr>
				<tr>
					<th>Name</th>
					<td>{{$data['details']->makeup_name}}</td>
				</tr>
				<tr>
					<th>Description</th>
					<td>{!! $data['details']->description !!}</td>
				</tr>
				<tr>
					<th>Price</th>
					<td class="text-success font-weight-bold">Rs.{{$data['details']->price}}</td>
				</tr>
			</table>
			<div class="butn">
				<a href="{{asset('carts')}}/{{$data['details']->id}}" class="btn btn-danger">Add to cart</a>
			</div>
			<br><br>
			<div class="rating">
				<h3>Give Rating</h3>
				<ul class="stars" id="stars">
					<li class="star" id="star"><i class="fa-solid fa-star"></i></li>
					<li class="star" id="star"><i class="fa fa-star"></i></li>
					<li class="star" id="star"><i class="fa fa-star"></i></li>
					<li class="star" id="star"><i class="fa fa-star"></i></li>
					<li class="star" id="star"><i class="fa fa-star"></i></li>
				</ul>
				@if(auth()->user())
					<p id="result">@forelse($data['rating_value'] as $r)
						<p class="text-primary">You already gave {{$r->rating_value}} rating..</p>
						@empty
					@endforelse</p>
					@if($errors->any())
						<h5 class=" bg-primary">{{$errors->first()}}</h5>
					@endif
					<form method="post" action="/rating" name="ratingform">
						@csrf
						<input type="hidden" name="fid" value="{{$data['details']->id}}" required>
						<input type="hidden" name="ratingval" id="kr" required value="1">
						<button type="submit" class="btn btn-success">Submit</button>
					</form>
				@else
					<p><b style="font-size: 22px;">{{$data['total_rating']}}</b> people rate this product. Please <a href="/login">login</a> to give rating.</p>
				@endif
			</div>
		</div>
		<div class="col-md-5">
		</div>
	</div>
</div>

<script type="text/javascript">

	var stars = document.querySelectorAll('#star');
	var result = document.getElementById('result');
	var s = document.getElementById('star');


	for(let x=0; x<stars.length; x++){
		stars[x].starValue = (x+1);

		["click","mouseover","mouseout"].forEach(function(e){
		stars[x].addEventListener(e, getresult);

	});
}


	function getresult(e){
		let type = e.type;
		// console.log(type);
		let starvalue = this.starValue;
		// console.log(starvalue);

		if (type === 'click') {
					if (starvalue > 0) {
						result.innerHTML = "You select "+ starvalue + " Star";
						var kr = document.getElementById('kr');
						kr.value = starvalue;
					}
			}

		stars.forEach(function(element, index){

				if (type === 'click') {
					if (index < starvalue) {
					element.classList.add('click');
				}else{
					element.classList.remove('click');
				}
			}

			if (type === 'mouseover') {
					if (index < starvalue) {
					element.classList.add('mouseover');
				}else{
					element.classList.remove('mouseover');
				}
			}

			if (type === 'mouseout') {
					element.classList.remove('mouseover');

							}
		});
}
</script>
@endsection
