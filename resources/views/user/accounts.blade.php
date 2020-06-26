@extends('layouts.dashboard')

@section('content')

    <accounts-page-component
        :accounts="{{ json_encode( $accounts ) }}"
    />

@endsection
