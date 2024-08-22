@extends('masterlayout.masterlayout')

{{-- title --}}
@section('title')
View - Employee
@endsection

{{-- page heading --}}
@section('page heading')
Details of a Employee
@endsection

{{-- custom css --}}
@push('styles')

<style>
    .emp_info{
        /* margin: auto; */
        /* display: inline; */
        width: 500px;
        padding-top: 50px;
        padding-left: 100px;
        background-color: white;
        /* margin-bottom: 50px; */
    }

    .emp_info h5{
        font-weight: bold;
        color: black;
    }

    .info{
        color:red!important;
        text-transform: uppercase;

    }

    .emp_att{
        background-color: rgb(255, 255, 255);
        color: black;
        /* height: max-content; */
        padding-top: 50px;
        padding-bottom: 50px;

    }

    .emp_sal{
        background-color: rgb(255, 255, 255);
        color: black;
        padding-top: 50px;
        padding-bottom: 50px;
        /* height: max-content; */
    }

    .att_head{
        text-align: center;
        font-weight: bold;
        color: #4D72DE;
    }

    table{
     
        margin: auto;
        border: 2px solid black;
        
    }
    
    th{
        text-align: center;
        border: 2px solid black;
        padding: 10px;
    }
    td{
        text-align: center;
        border: 2px solid black;
    }



</style>

@endpush

{{-- main content --}}
@section('content')

<div class="row">
    <div class="emp_info col-md-6">
        <img src="{{asset('employeePic/' .$detail_employee->image)}}" style="height:200px; width:200px; text-align:center; padding-bottom:15px; " alt="">
        <h5 class="info">{{$detail_employee->name}}</h5>
        <h5>Father's Name</h5>
        <h5 class="info">{{$detail_employee->father_name}}</h5>
        <h5>Mother's Name</h5>
        <h5 class="info">{{$detail_employee->mother_name}}</h5>
        <h5>Present Address</h5>
        <h5 class="info">{{$detail_employee->present_address}}</h5>
        <h5>Permanent Address</h5>
        <h5 class="info">
            @php
                $permant_address = $detail_employee->permanent_address ?? "Has No Permanent Address";
            @endphp
            {{$permant_address}}
        </h5>
        <h5>Email</h5>
        <h5 class="info">{{$detail_employee->email}}</h5>
        <h5>Phone</h5>
        <h5 class="info">{{$detail_employee->phone}}</h5>
        <h5>Age</h5>
        <h5 class="info">{{$detail_employee->age}}</h5>
        <h5>NID</h5>
        <h5 class="info">{{$detail_employee->nid}}</h5>
        <h5>Experience</h5>
        <h5 class="info">{{$detail_employee->experience}}</h5>
        <h5>SSC Result</h5>
        <h5 class="info">
            @php
                $a = $detail_employee->ssc;
                $b = "--";
                $c = $a ?? $b; 
            @endphp
           {{$c}}   
        </h5>
        <h5>HSC Result</h5>
        <h5 class="info">
            @php
                $a = $detail_employee->hsc;
                $b = "--";
                $c = $a ?? $b; 
            @endphp
           {{$c}}
        </h5>
        <h5>Honor's Result</h5>
        <h5 class="info">
            @php
                $a =$detail_employee->bba;
                $b = "--";
                $c = $a ?? $b; 
            @endphp
           {{$c}}
        </h5>
        <h5>Salary</h5>
        <h5 class="info">{{$detail_employee->salary}}</h5>
        <h5>Position</h5>
        <h5 class="info">{{$detail_employee->position}}</h5>
        <h5>Joining Date</h5>
        <h5 class="info">  
            @php
                use Carbon\Carbon;
                $formattedDate = Carbon::parse($detail_employee->joining_date)->format('jS F Y');
            @endphp
            {{$formattedDate}}
        </h5>
        <h5>Note</h5>
        <h5 class="info">
            @php
            $a = $detail_employee->note;
            $b = "No Note About This Employee";
            $c = $a ?? $b; 
            @endphp
            {{$c}}

        </h5>    
    </div>

    <div class="emp_att col-md-3">
        <h5 class="att_head">Attendance Detail</h5>
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Month Name</th>
                        <th>Present</th>
                        <th>Absent</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendance as $record)
                    <tr>
                        <td>{{ \Carbon\Carbon::create()->month($record->month)->format('M') }}</td>
                        <td>{{ $record->days_present }}</td>
                        <td>{{ $record->days_absent }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="emp_sal col-md-3">
        <h5 class="att_head">Salary Detail</h5>
        <table>
            <tr>
                <th>Month Name</th>
                <th>Status</th>
            </tr>
            <tr>
                <td>Jan</td>
                <td>Paid</td>
            </tr>
            <tr>
                <td>Feb</td>
                <td>Paid</td>
            </tr>
            <tr>
                <td>Mar</td>
                <td>Paid</td>
            </tr>
            <tr>
                <td>Api</td>
                <td>Paid</td>
            </tr>
            <tr>
                <td>May</td>
                <td>Paid</td>
            </tr>
            <tr>
                <td>June</td>
                <td>Paid</td>
            </tr>
            <tr>
                <td>July</td>
                <td>Due</td>
            </tr>
            <tr>
                <td>Aug</td>
                <td>Due</td>
            </tr>
            <tr>
                <td>Sep</td>
                <td>Due</td>
            </tr>
            <tr>
                <td>Oct</td>
                <td>Due</td>
            </tr>
            <tr>
                <td>Nov</td>
                <td>Due</td>
            </tr>
            <tr>
                <td>Dec</td>
                <td>Due</td>
            </tr>
        </table>
    </div>















</div>

















@endsection
