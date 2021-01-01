@extends('layouts.dashboard')

@section('content')

    <money-savers-page-component
        :user="{{ Auth::User() }}"
        :money-savers="{{ json_encode($moneySavers) }}"
        :accounts="{{ json_encode($accounts) }}"
    />
@endsection
