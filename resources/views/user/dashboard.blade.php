@extends('layouts.dashboard')

@section('content')

    <dashboard-page-component
        :user="{{ json_encode( Auth::User() ) }}"
        :transactions="{{ json_encode( $transactions ) }}"
        :accounts="{{ json_encode( $accounts ) }}"
        :budgets="{{ json_encode($budgets) }}"
        :weekly-expenses="{{ json_encode( $weeklyExpenses) }}"
        :monthly-expenses="{{ json_encode( $monthlyExpenses) }}"
        :annual-expenses="{{ json_encode( $annualExpenses ) }}"
        :previous-monthly-transactions="{{ json_encode( $previousMonthlyTransactions ) }}"
        :vendors="{{ json_encode( $vendors ) }}"
        :income="{{ json_encode( $income ) }}"
        :expenses="{{ json_encode( $expenses ) }}"
        :categories="{{ json_encode( $categories ) }}"
    />

@endsection
