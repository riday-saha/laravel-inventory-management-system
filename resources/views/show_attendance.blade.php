@extends('masterlayout.masterlayout')

{{-- title --}}
@section('title')
Show - Attendance
@endsection

{{-- page heading --}}
@section('page heading')
Show Attendance
@endsection

{{-- custom css --}}
@push('styles')
<style>
    .add_cus {
        margin-left: auto;
        padding-right: 50px;
    }

    .sup_table {
        margin: auto;
        padding-top: 30px;
    }

    table {
        border: 2px solid #446AD8;
        text-align: center;
        color: black;
        font-size: 20px;
        width: 100%;
    }

    th, td {
        border: 2px solid #446AD8;
        font-weight: bold;
    }

    .action_style {
        border: 2px solid #ff5c12;
        padding: 10px;
        border-radius: 5px;
    }

    @media (max-width: 768px) {
        table {
            font-size: 14px;
        }

        th, td {
            padding: 8px;
        }
    }
</style>
@endpush

{{-- main content --}}
@section('content')

<div class="row">

    <div class="sup_table">

        <form action="/search-attendance" method="GET" class="mb-3">
            @csrf
            <div class="input-group">
                <input type="date" class="form-control" name="search_date">
                <div class="input-group-append">
                    <button class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Employee's Name</th>
                        <th>Attendance Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($show_attendance as $show_attendances)  
                    <tr>
                        {{-- <td>{{$show_attendances->Date}}</td> --}}
                        <td>{{ \Carbon\Carbon::parse($show_attendances->Date)->isoFormat('MMM Do YYYY')}}</td>
                        <td>{{$show_attendances->employee->name}}</td>
                        <td>
                            @if ($show_attendances->attendance == 0 )
                                <h5 style="color:red; font-weight:bold;">Absent</h5>
                            @else
                                <h5 style="color:rgb(0 20 175); font-weight:bold;">Present</h5>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- <a href="{{ url('export-attendance') }}" class="btn btn-success">Export to Excel</a> --}}

    </div>
</div>

@endsection
