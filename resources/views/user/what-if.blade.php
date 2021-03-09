@extends('layouts.dashboard')

@section('content')

    <what-if-page-component
        :user="{{ Auth::User() }}"
        :money-savers="{{ json_encode($moneySavers) }}"
        :accounts="{{ json_encode($accounts) }}"
        :moneysaver="{{ request()->input('moneysaver') ? : 0 }}"
        :budgets="{{ json_encode($budgets) }}"
    />
@endsection
