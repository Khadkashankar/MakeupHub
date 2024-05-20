@extends('admin.master')

@section('title')
Makeup Hub | Cosmetics Menu
@endsection


@section('makeupmenu')
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
                    <h4 class="card-title"> Cosmetics Menu</h4>
                </div>
                <hr>
                <div class="card-body">

                    <a href="addmakeup" class="btn btn-primary float-right">Add Cosmetics</a>
                    <div class="table-responsive">
                        <h3><u>Manage Cosmetics</u></h3>
                        @if(Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success')}}</p>
                        @endif
                        <table class="table" id="DataTable">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th> Category Name</th>
                                    <th>Item Name</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php $i = 1; ?>
                                    @forelse($makeups as $makeup)
                                    <td>
                                        {{$i}}
                                    </td>
                                    <td>
                                        {{$makeup->category}}
                                    </td>
                                    <td>
                                        {{$makeup->makeup_name}}

                                    </td>
                                    <td>
                                        {{$makeup->price}}

                                    </td>
                                    <td class="text-right">
                                        <div class="d-flex">
                                            <a href="makeupedit/{{$makeup->id}}" class="btn btn-success mr-2">Edit</a>
                                            <form action="makeupdelete/{{$makeup->id}}">
                                                <input type="submit" onclick="myfun(event)" class="btn btn-danger" value="Delete" />
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                                @empty
                                <td colspan="5" class="text-danger">No Data Found</td>
                                @endforelse
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
    function myfun(e) {
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
