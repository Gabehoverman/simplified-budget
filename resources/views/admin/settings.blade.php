@extends('layouts.dashboard')

@section('content')

    <admin-settings-page-component
        :institutions="{{ json_encode( $institutions ) }}"
        :admin-site-settings="{{ json_encode( $adminSiteSettings ) }}"
    />

@endsection
