@extends('masterlayout.masterlayout')

{{-- title --}}
@section('title')
All - Employee
@endsection

{{-- page heading --}}
@section('page heading')
All Employee
@endsection

{{-- custom css --}}
@push('styles')
<style>
    
    .add_cus{
        margin-left: auto;
        padding-right: 50px;
    }

    .sup_table{
        margin: auto;
        padding-top: 30px;
    }
    table{
        border: 2px solid #446AD8;
        text-align: center;
        color:black;
        font-size: 20px;
        
    }
    th{
        border: 2px solid #446AD8;
        font-weight: bold;
    }
    td{
        border: 2px solid #446AD8;

    }

    .action_style{
        border: 2px solid #ff5c12;
        padding: 10px;
        border-radius: 5px;
    }
</style>
@endpush

{{-- main content --}}
@section('content')

<div class="row">

    <div class="sup_table">
        <table>
            <tr>
                <th class="col-md-2">Date</th>
                <th class="col-md-2">Employee's Name</th>
                <th class="col-md-2">Attendance Status</th>
            </tr>
            @foreach ($attended_user as $attended_users)  
            <tr>
                <td class="col-md-2">{{$attended_users->Date}}</td>
                <td class="col-md-2">{{$attended_users->employee->name}}</td>
                <td class="col-md-2">
                    @if ($attended_users->attendance == 0 )
                        @php
                            echo ' <h5 style = "color:red;font-weight:bold;">Absent</h5> ';
                        @endphp
                    @else
                         @php
                            echo ' <h5 style = "color:rgb(0 20 175);font-weight:bold;">Present</h5> ';
                        @endphp
                    @endif
                </td>
             
            </tr>
            @endforeach
        </table>
    </div>
</div>

@endsection

