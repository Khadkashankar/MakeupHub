@extends('admin.master')

@section('title')
Makeup Hub | Total Artists
@endsection


@section('totalartists')
active
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

@endsection


@section('content')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Artists Table </h4>
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <div>
                        <table class="table" id="DataTable">
                            <thead class=" text-primary">
                                <th>
                                    Name
                                </th>
                                <th>
                                    Phone
                                </th>
                                <th>
                                    Location
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Speciality
                                </th>
                                <th>
                                    Description
                                </th>
                                <th>
                                    Action
                                </th>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach($artist as $a)
                                    <td>
                                        {{$a->name}}
                                    </td>
                                    <td>
                                        {{$a->phone}}
                                    </td>
                                    <td>
                                        {{$a->artist->location}}
                                    </td>
                                    <td>
                                        {{$a->email}}
                                    </td>
                                    <td>
                                    {{$a->artist->speciality}}
                                    </td>
                                    <td>
                                    {!! $a->artist->description !!}
                                    </td>
                                    <td class="text-right">
                                        <div class="d-flex">
                                            <form action="artistdelete" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$a->id}}">
                                                <button class="btn btn-danger" onclick="del(event)">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script>
    function del(e) {
        var msg = confirm('Are you sure to delete ?');
        if (msg) {
            $('form').submit();
        } else {
            e.preventDefault();
        }
    }

    $(document).ready(function() {
        $('#DataTable').DataTable();
    });
</script>
@endsection
