@extends('layouts.dashboard')

@section('content')

    <new-account-page-component
        :selected-account="{{ json_encode($account) }}"
        :institutions="{{ json_encode( $institutions ) }}"
    />

@endsection
