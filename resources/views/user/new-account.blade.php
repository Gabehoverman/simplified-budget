@extends('layouts.dashboard')

@section('content')

    <new-account-page-component
        :selected-account="{{ json_encode($account ? $account : null) }}"
        :institutions="{{ json_encode( $institutions ) }}"
        :user="{{ json_encode( Auth::User() ) }}"
    />

@endsection
