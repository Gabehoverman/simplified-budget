<nav class="navbar navbar-expand-md navbar-light d-none d-md-flex" id="topbar">
    <div class="container-fluid">

      <!-- Form -->
      <form class="form-inline mr-4 d-none d-md-flex">
        <div class="input-group input-group-flush input-group-merge" data-toggle="lists" data-lists-values='["name"]'>

            <div class="input-group-prepend" style="margin-right: 150px;">
                <a class="navbar-brand" href="/dashboard">
                    <img src="{{ asset('/img/logo2-01.png') }}" class="navbar-brand-img
                    mx-auto" alt="...">
                </a>
            </div>
            <search-bar-component
                :user="{{ Auth::User() }}"
            />
        </div>
      </form>

      <!-- User -->
      <div class="navbar-user">
        <div class="">
            <notification-component
                :notifications="{{ isset($notifications) ? json_encode($notifications) : json_encode([]) }}"
            />
        </div>
        <!-- Dropdown -->
        <div class="dropdown">

          <!-- Toggle -->
          <a href="#" class="avatar avatar-sm avatar-online dropdown-toggle toggler" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{ asset('img/avatars/profiles/avatar.png') }}" alt="..." class="avatar-img rounded-circle">
          </a>

          <!-- Menu -->
          <div class="dropdown-menu dropdown-menu-right">
            <a href="/profile" class="dropdown-item">Profile</a>
            <a href="/settings" class="dropdown-item">Settings</a>
            <hr class="dropdown-divider">
            <a href="/logout" class="dropdown-item">Logout</a>
          </div>

        </div>

      </div>

    </div>
  </nav>
