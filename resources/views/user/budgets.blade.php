@extends('layouts.dashboard')

@section('content')

    <budget-page-component
        :user="{{ Auth::User() }}"
        :budgets="{{ json_encode( $budgets ) }}"
        :accounts="{{ json_encode( $accounts ) }}"
        :totals="{{ json_encode($totals) }}"
        :month="{{ json_encode($month->format('F, Y')) }}"
        :previous-month="{{ json_encode(\Carbon\Carbon::parse($month)->subMonth(1) ) }}"
        :next-month="{{ json_encode(\Carbon\Carbon::parse($month)->addMonth(1) ) }}"
    />
@endsection
