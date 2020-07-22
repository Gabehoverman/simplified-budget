@extends('layouts.dashboard')

@section('content')

    <show-account-page-component
        :selected-account="{{ json_encode($account) }}"
        :transactions="{{ json_encode($transactions) }}"
    />

@endsection
