@extends('layouts.dashboard')

@section('content')

    <settings-page-component
        :user="{{ json_encode(Auth::User()) }}"
    />

@endsection
