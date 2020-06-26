@extends('layouts.dashboard')

@section('content')

    <dashboard-page-component
        :transactions="{{ json_encode( $transactions ) }}"
        :accounts="{{ json_encode( $accounts ) }}"
    />

@endsection
