@extends('admin.master')

@section('title')
Makeup Hub | City
@endsection


@section('city')
active
@endsection

@section('content')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">city</h4>
                    <hr>

                </div>

                <div class="card-body">

                    <div style="border: 1px solid black; padding: 30px;">
                        <h3 class="text-primary">City</h3>
                        <hr>
                        <form action="{{ asset('addcity')}}" method="post">

                            @csrf
                            <select class="form-control" style="font-size: 18px; height: 42px; margin-bottom: 10px" name="district_id" required>
                                <option>select district</option>
                                @foreach($district as $dis)
                                <option value="{{ $dis->id}}">{{ $dis->name}}</option>
                                @endforeach
                            </select>
                            <input type="text" name="name" placeholder="Enter city.." class="form-control" style="font-size: 18px; height: 42px;" required><br>
                            <input type="submit" name="submit" class="btn btn-primary" value="Add">
                        </form>

                    </div>
                    <hr><br>

                    @if(Session::has('success'))
                    <p class="alert alert-success">{{ Session::get('success')}}</p>
                    @endif

                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>
                                    S.N
                                </th>
                                <th>
                                    District
                                </th>
                                <th>
                                    City
                                </th>
                                <th colspan="2" class="text-right">
                                    Action
                                </th>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php $i = 1 ?>
                                    @forelse($city as $cit)
                                    <td>
                                        {{$i}}
                                    </td>
                                    <td>
                                        {{$cit->districts->name}}
                                    </td>
                                    <td>
                                        {{$cit->name}}
                                    </td>

                                    <td class="text-right">

                                        <form id="delete-form-{{$cit->id}}" action="citydelete/{{$cit->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger delete-btn" data-id="{{$cit->id}}">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                                @empty
                                <h5 class="bg-danger">No city Found !!</h5>
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
<script>
    $(document).ready(function() {
        $('.delete-btn').on('click', function() {
            var id = $(this).data('id');
            var confirmation = confirm('Are you sure to delete?');
            if (confirmation) {
                $('#delete-form-' + id).submit();
            }
        });
    });
</script>
@endsection
