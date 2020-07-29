@extends('layouts.dashboard')

@section('content')

    <admin-settings-page-component
        :institutions="{{ json_encode( $institutions ) }}"
    />

@endsection
