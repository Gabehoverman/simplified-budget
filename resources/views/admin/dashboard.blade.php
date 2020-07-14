@extends('layouts.dashboard')

@section('content')

    <admin-dashboard-page-component
        :users="{{ json_encode($users) }}"
    />

@endsection
