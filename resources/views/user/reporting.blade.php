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
        :month="{{ json_encode($month->format('F, Y')) }}"
        :previous-month="{{ json_encode(\Carbon\Carbon::parse($month)->subMonth(1) ) }}"
        :next-month="{{ json_encode(\Carbon\Carbon::parse($month)->addMonth(1) ) }}"
        :timestamp="{{ json_encode($month) }}"
    />

@endsection
