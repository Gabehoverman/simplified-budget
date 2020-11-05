@extends('layouts.dashboard')

@section('content')

    <transactions-page-component
        :accounts="{{ json_encode( $accounts ) }}"
        :transactions="{{ json_encode( $transactions ) }}"
        :rules="{{ json_encode( $rules ) }}"
    />

@endsection
