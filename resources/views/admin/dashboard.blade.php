@extends('layouts.dashboard')

@section('content')

    <admin-dashboard-page-component
        :users="{{ json_encode($users) }}"
        :weekly-new-users="{{ json_encode($weeklyNewUsers) }}"
        :monthly-new-users="{{ json_encode($monthlyNewUsers) }}"
        :annual-new-users="{{ json_encode($annualNewUsers) }}"
    />

@endsection
