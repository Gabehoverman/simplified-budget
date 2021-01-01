@extends('layouts.dashboard')

@section('content')

    <settings-page-component
        :user="{{ json_encode( $user ) }}"
        :stripe-pk="{{ json_encode( env('STRIPE_KEY') ) }}"
        :intent="{{ json_encode($intent) }}"
    />

@endsection
