@extends('layouts.dashboard')

@section('content')

    <new-account-page-component
        :institutions="{{ json_encode( $institutions ) }}"
    />

@endsection
