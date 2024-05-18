@extends('cmaster')

@section('title')
Makeup Hub | Book Appointment
@endsection

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@section('content')

<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-7 mx-auto">
            <h2 class="text-center">Book an Appointment with {{ $artist->user->name }}</h2>
            <br>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
                </div>
            @endif
            <form action="{{ route('appointment.store') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="artist_id" value="{{ $artist->id }}">

                <div class="form-group">
                    <label for="appointment_date">Appointment Date:</label>
                    <input type="date" id="appointment_date" name="appointment_date" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" class="form-control" required></textarea>
                </div>

                <button type="submit" class="m-2 btn btn-danger">Book Now</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#appointment_date').attr('min', new Date().toISOString().split('T')[0]);
    });
</script>
@endsection
