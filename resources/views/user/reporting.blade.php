@extends('layouts.dashboard')

@section('content')

    <reporting-page-component
        :categories="{{ json_encode($categories) }}"
        :vendors="{{ json_encode($vendors) }}"
        :income="{{ json_encode($income) }}"
        :expenses="{{ json_encode($expenses) }}"
        :monthly-transactions="{{ json_encode($monthlyTransactions) }}"
        :previous-monthly-transactions="{{ json_encode($previousMonthlyTransactions) }}"
    />

@endsection
