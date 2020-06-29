@extends('layouts.dashboard')

@section('content')

    <profile-page-component
        :user="{{ json_encode(Auth::User() ) }}"
    />

@endsection
