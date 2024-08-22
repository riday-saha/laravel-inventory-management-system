@extends('masterlayout.masterlayout')

{{-- title --}}
@section('title')
Employee Attendance
@endsection

{{-- page heading --}}
@section('page heading')
Take Attendance
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
    }

    th {
        border: 2px solid #446AD8;
        font-weight: bold;
    }

    td {
        border: 2px solid #446AD8;
    }

    .action_style {
        border: 2px solid #ff5c12;
        padding: 10px;
        border-radius: 5px;
    }

    .present-label {
        color: black;
    }

    .absent-label {
        color: black;
    }
</style>
@endpush

{{-- main content --}}
@section('content')

<div class="row">
    <div class="container">

        <form action="{{ route('take.attendance') }}" method="POST">
            @csrf
            <input type="date" name="date" class="form-control mb-3" required>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($atten_employee as $index => $atten_employees)
                        <tr>
                            <td>{{ $atten_employees->name }}</td>
                            <td>
                                <input type="hidden" name="employee_id[]" value="{{ $atten_employees->id }}">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input present-radio" type="radio" name="status[{{ $index }}]" id="present_{{ $index }}" value="1" required>
                                    <label class="form-check-label present-label" for="present_{{ $index }}">Present</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input absent-radio" type="radio" name="status[{{ $index }}]" id="absent_{{ $index }}" value="0">
                                    <label class="form-check-label absent-label" for="absent_{{ $index }}">Absent</label>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary mt-2">Submit Attendance</button>
        </form>   
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function(){
        $('.present-radio').click(function(){
            $(this).closest('td').find('.present-label').css('color', '#006ee4');
             $(this).closest('td').find('.absent-label').css('color', 'black'); // Reset the color of the absent label
            $(this).css('accent-color','#006ee4');
        });

        $('.absent-radio').click(function(){
            $(this).closest('td').find('.absent-label').css('color', 'red');
            $(this).closest('td').find('.present-label').css('color', 'black'); // Reset the color of the present label
            $(this).css('accent-color','red');
        });
    });
</script>

@endsection
