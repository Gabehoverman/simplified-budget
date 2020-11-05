@extends('layouts.dashboard')

@section('content')

    <budget-page-component
        :user="{{ Auth::User() }}"
        :budgets="{{ json_encode( $budgets ) }}"
        :accounts="{{ json_encode( $accounts ) }}"
        :totals="{{ json_encode($totals) }}"
    />
@endsection
