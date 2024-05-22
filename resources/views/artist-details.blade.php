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
			<h2 class="text-center">Artist Details Page</h2>
			<br>
			<img src="{{asset('artistimages')}}/{{$data['details']->image ?? ''}}" height="200" width="300" class="img img-responsive img-thumbnail">
			<br>
			<br>
			<table class="table table-striped">
				<tr>
					<th colspan="2" class="text-danger">Artist Details</th>
				</tr>
				<tr>
					<th>Name</th>
					<td>{{$data['details']->user->name}}</td>
				</tr>
				<tr>
					<th>Email</th>
					<td>{{$data['details']->user->email}}</td>
				</tr>
				<tr>
					<th>Phone</th>
					<td>{{$data['details']->user->phone}}</td>
				</tr>
				<tr>
					<th>Location</th>
					<td>{{$data['details']->location}}</td>
				</tr>
				<tr>
					<th>Speciality</th>
					<td>{{$data['details']->speciality}}</td>
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
				<a href="{{asset('appointment')}}/{{$data['details']->id}}" class="btn btn-danger">Book Now</a>
			</div>
			<br><br>
			
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
