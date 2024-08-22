@extends('masterlayout.masterlayout')

{{-- title --}}
@section('title')
Inventoty - Dashboard
@endsection

{{-- page heading --}}
@section('page heading')
Dashboard
@endsection


{{-- custom css --}}
@push('styles')
    <style>
    .one{
        color:red;
    }
    </style>
@endpush
 

{{-- main content --}}
@section('content')

<div class="row">
    <h2>dashboard</h2>
</div>


@endsection