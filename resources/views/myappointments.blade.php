@extends('cmaster')

@section('title', 'Makeup Hub | My Appointments')

@section('content')
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2 class="text-center">My Appointments</h2>
            <br>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Artist Name</th>
                        <th>Appointment Date</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->artist->user->name }}</td>
                            <td>{{ $appointment->appointment_date }}</td>
                            <td>{{ $appointment->description }}</td>
                            <td>{{ $appointment->artist->price }}</td>
                            <td>{{ $appointment->status }}</td>
                            <td>
                                <form action="{{ route('appointment.cancel', $appointment->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No appointments found.</td>
                    </tr>
                    <tr>
                        <td>Click <a href="/">here</a> book makeup artist.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
