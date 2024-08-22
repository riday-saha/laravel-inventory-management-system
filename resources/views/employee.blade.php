@extends('masterlayout.masterlayout')

{{-- title --}}
@section('title')
Add - Employee
@endsection

{{-- page heading --}}
@section('page heading')
Add Employee
@endsection

{{-- custom css --}}
@push('styles')

<style>
    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    .form-group button {
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
    }

    .form-group button:hover {
        background-color: #0056b3;
    }

    .sup_form{
        margin: auto;
        width: 500px;
    }
</style>

@endpush

{{-- main content --}}
@section('content')

<div class="row">
    <div class="sup_form">
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <form action="{{route('add.employee')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="emp_name">Name</label>
                <input type="text" id="emp_name" name="emp_name" value="{{ old('emp_name') }}">
            </div>

            <div class="form-group">
                <label for="emp_fname">Father's Name</label>
                <input type="text" id="emp_fname" name="emp_fname" value="{{ old('emp_fname') }}">
            </div>

            <div class="form-group">
                <label for="emp_mname">Mother's Name</label>
                <input type="text" id="emp_mname" name="emp_mname" value="{{ old('emp_mname') }}">
            </div>
    
            <div class="form-group">
                <label for="emp_preaddress"> Present Address</label>
                <input type="text" id="emp_preaddress" name="emp_preaddress" value="{{ old('emp_preaddress') }}">
            </div>

            <div class="form-group">
                <label for="emp_peraddress"> Permanent Address</label>
                <input type="text" id="emp_peraddress" name="emp_peraddress" value="{{ old('emp_peraddress') }}">
            </div>

            <div class="form-group">
                <label for="emp_email">Email</label>
                <input type="email" id="emp_email" name="emp_email" value="{{ old('emp_email') }}">
            </div>
    
            <div class="form-group">
                <label for="emp_phone">Phone</label>
                <input type="text" id="emp_phone" name="emp_phone" value="{{ old('emp_phone') }}">
            </div>

            <div class="form-group">
                <label for="emp_age">Age</label>
                <input type="text" id="emp_age" name="emp_age" value="{{ old('emp_age') }}">
            </div>
    
            <div class="form-group">
                <label for="emp_nid">NID</label>
                <input type="text" id="emp_nid" name="emp_nid" value="{{ old('emp_nid') }}">
            </div>

            <div class="form-group">
                <label for="emp_experience">Experience</label>
                <input type="text" id="emp_experience" name="emp_experience" value="{{ old('emp_experience') }}">
            </div>

            <div class="form-group">
                <label for="emp_position">Position</label>
                <input type="text" id="emp_position" name="emp_position" value="{{ old('emp_position') }}">
            </div>
    
            <div class="form-group">
                <label for="emp_image">Image</label>
                <input type="file" id="emp_image" name="emp_image">
            </div>

            <div>
                <label for="emp_educational">Educational Qualification</label>
                <table>
                    <tr>
                        <th>SSC Result</th>
                        <th>HSC Result</th>
                        <th>Honor's</th>
                    </tr>
                    <tr>
                        <td><input type="text" id="ssc" name="ssc"></td>
                        <td><input type="text" id="hsc" name="hsc"></td>
                        <td><input type="text" id="bba" name="bba"></td>
                    </tr>
                </table>
            </div>

            <div class="form-group">
                <label for="emp_salary">Salary</label>
                <input type="text" id="emp_salary" name="emp_salary" value="{{ old('emp_salary') }}">
            </div>

            <div class="form-group">
                <label for="emp_join">Joining Date</label>
                <input type="date" id="emp_join" name="emp_join" value="{{ old('emp_join') }}">
            </div>

            <div class="form-group">
                <label for="emp_note">Note</label>
                <textarea id="emp_note" name="emp_note" cols="50" rows="4" placeholder="Make a note..">{{ old('emp_note') }}</textarea>
            </div>
    
            <button type="submit" class="btn btn-success">Add Employee</button>
        </form>
    </div>
    
</div>

















@endsection
