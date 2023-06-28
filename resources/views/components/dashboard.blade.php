@extends('layouts.main')

@section('content')

<div class="container">
    <div class="dashboard-ecommerce">
        <div class="container-fluid">
            @include('components.pageheader')
            @include('components.widgets')
        </div>
    </div>
    @include('components.footer')
</div>

@endsection