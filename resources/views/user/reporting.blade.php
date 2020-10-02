@extends('layouts.dashboard')

@section('content')

    <reporting-page-component
        :user="{{ json_encode(Auth::User()) }}"
        :categories="{{ json_encode($categories) }}"
        :vendors="{{ json_encode($vendors) }}"
        :income="{{ json_encode($income) }}"
        :expenses="{{ json_encode($expenses) }}"
        :monthly-transactions="{{ json_encode($monthlyTransactions) }}"
        :previous-monthly-transactions="{{ json_encode($previousMonthlyTransactions) }}"
        :budgets="{{ json_encode($budgets) }}"
    />

@endsection
