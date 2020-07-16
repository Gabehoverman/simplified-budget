@extends('layouts.dashboard')

@section('content')

    <dashboard-page-component
        :transactions="{{ json_encode( $transactions ) }}"
        :accounts="{{ json_encode( $accounts ) }}"
        :weekly-expenses="{{ json_encode( $weeklyExpenses) }}"
        :monthly-expenses="{{ json_encode( $monthlyExpenses) }}"
        :annual-expenses="{{ json_encode( $annualExpenses ) }}"
    />

@endsection
