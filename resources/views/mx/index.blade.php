@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">

        <!-- Header -->
        <div class="header">
          <div class="header-body">
            <div class="row align-items-center">
              <div class="col">

                <!-- Pretitle -->
                <h6 class="header-pretitle">
                  MX / All
                </h6>

                <!-- Title -->
                <h1 class="header-title mt-md-5">
                  Users
                </h1>

              </div>
              <div class="col-auto">

                <!-- Button -->
                <a href="/accounts/new" class="btn btn-primary">
                  Add User
                </a>

              </div>
            </div> <!-- / .row -->
          </div>
        </div>

        @php var_dump( $data ) @endphp

        @if ( isset( $data['users'] ) )
          {{-- {{ $data['users'] }} --}}
              <table>
                <h5>Users</h5>
                @foreach($data['users'] as $user)
                    <tr>
                        <td>
                            {{ $user }}
                        </td>
                        <td>
                            <a class="btn btn-success" href="/mx/members/{{ $user['guid'] }}">List Connections</a>
                        </td>
                        <td>
                          <form action="/mx/{{ $user['guid'] }}" method="post">
                            <input type="hidden" name="_method" value="delete" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-danger">Remove</a>
                          </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif

        @if ( isset( $data['members'] ) )
            <table>
                <h5>Members</h5>
                @foreach($data['members'] as $member)
                    <tr>
                        <td>
                            {{ $member }}
                        </td>
                        <td>
                            <a class="btn btn-success" href="/mx/transactions/{{ $member['guid'] }}">List Transactions</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="/mx/members/{{ $member['guid'] }}/remove/{{ $member['user_guid'] }}">Remove</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif

        @if ( isset($data['transactions']) )
        <table>
            <h5>Members</h5>
            @foreach($data['transactions'] as $transaction)
                <tr>
                    <td>
                        {{ $transaction }}
                    </td>
                </tr>
            @endforeach
        </table>
        @endif

        <h5>Create User</h5>

        <div class="row">

        <a href="/mx" class="btn btn-primary">List Users</a>

        <form action="/mx" method="POST">
            @csrf

            <button type="submit" class="btn btn-primary">Create User</button>
        </form>

        <a href="/mx/accounts" class="btn btn-primary col-auto">List Accounts</a>

        <a href="/mx/members" class="btn btn-primary">List Members (connections)</a>

        <form action="/mx/accounts" method="POST">
            @csrf

            <button type="submit" class="btn btn-primary">Create Account</button>
        </form>

        <a href="/mx/widget" class="btn btn-primary">Widget</a>

        @if ( isset( $data['user']['connect_widget_url']) )
            <iframe src="{{ $data['user']['connect_widget_url'] }}" width="600" height="600"/>
            <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
            <script src="https://atrium.mx.com/connect.js"></script>
            <script>
                $(document).ready( function() {

                    var mxConnect = new MXConnect({
                        id: "addAccount",
                        url:
                        "{{ $data['user']['connect_widget_url'] }}",
                        onLoad: function () {
                        // Connect widget successfully loaded
                        console.log("On Load");
                        },
                        onSuccess: function (memberGuid) {
                        // Member created successfully
                        console.log("On Success");
                        },
                    });

                    var addAccountClick = function () {
                        mxConnect.load();
                    };
                })

            </script>

        @endif
        </div>
      </div>
    </div>
</div>

@endsection
