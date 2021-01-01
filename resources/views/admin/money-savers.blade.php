@extends('layouts.dashboard')

@section('content')

    <admin-money-savers-page-component
        :money-savers="{{ json_encode( $moneySavers ) }}"
        :money-saver-types="{{ json_encode( $moneySaverTypes ) }}"
        :institutions="{{ json_encode( $institutions ) }}"
    />

@endsection
