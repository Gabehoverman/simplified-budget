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

        <!-- Dropdown -->
        <div class="dropdown mr-4 d-none d-md-flex">

          <!-- Toggle -->
          <a href="#" class="text-muted" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="icon active">
              <i class="fe fe-bell"></i>
            </span>
          </a>

          <!-- Menu -->
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col">

                  <!-- Title -->
                  <h5 class="card-header-title">
                    Notifications
                  </h5>

                </div>
                <div class="col-auto">

                  <!-- Link -->
                  <a href="#!" class="small">
                    View all
                  </a>

                </div>
              </div> <!-- / .row -->
            </div> <!-- / .card-header -->
            <div class="card-body">

              <!-- List group -->
              <div class="list-group list-group-flush my--3">
                <a class="list-group-item px-0" href="#!">

                  <div class="row">
                    <div class="col-auto">

                      <!-- Avatar -->
                      <div class="avatar avatar-sm">
                        <img src="{{ asset('img/avatars/profiles/avatar.png') }}" alt="..." class="avatar-img rounded-circle">
                      </div>

                    </div>
                    <div class="col ml--2">

                      <!-- Content -->
                      <div class="small text-muted">
                        <strong class="text-body">Dianna Smiley</strong> shared your post with <strong class="text-body">Ab Hadley</strong>, <strong class="text-body">Adolfo Hess</strong>, and <strong class="text-body">3 others</strong>.
                      </div>

                    </div>
                    <div class="col-auto">

                      <small class="text-muted">
                        2m
                      </small>

                    </div>
                  </div> <!-- / .row -->

                </a>
                <a class="list-group-item px-0" href="#!">

                  <div class="row">
                    <div class="col-auto">

                      <!-- Avatar -->
                      <div class="avatar avatar-sm">
                        <img src="{{ asset('img/avatars/profiles/avatar-2.jpg') }}" alt="..." class="avatar-img rounded-circle">
                      </div>

                    </div>
                    <div class="col ml--2">

                      <!-- Content -->
                      <div class="small text-muted">
                        <strong class="text-body">Ab Hadley</strong> reacted to your post with a 😍
                      </div>

                    </div>
                    <div class="col-auto">

                      <small class="text-muted">
                        2m
                      </small>

                    </div>
                  </div> <!-- / .row -->

                </a>
                <a class="list-group-item px-0" href="#!">

                  <div class="row">
                    <div class="col-auto">

                      <!-- Avatar -->
                      <div class="avatar avatar-sm">
                        <img src="{{ asset('img/avatars/profiles/avatar-3.jpg') }}" alt="..." class="avatar-img rounded-circle">
                      </div>

                    </div>
                    <div class="col ml--2">

                      <!-- Content -->
                      <div class="small text-muted">
                        <strong class="text-body">Adolfo Hess</strong> commented <blockquote class="text-body">“I don’t think this really makes sense to do without approval from Johnathan since he’s the one...” </blockquote>
                      </div>

                    </div>
                    <div class="col-auto">

                      <small class="text-muted">
                        2m
                      </small>

                    </div>
                  </div> <!-- / .row -->

                </a>
                <a class="list-group-item px-0" href="#!">

                  <div class="row">
                    <div class="col-auto">

                      <!-- Avatar -->
                      <div class="avatar avatar-sm">
                        <img src="{{ asset('img/avatars/profiles/avatar-4.jpg') }}" alt="..." class="avatar-img rounded-circle">
                      </div>

                    </div>
                    <div class="col ml--2">

                      <!-- Content -->
                      <div class="small text-muted">
                        <strong class="text-body">Daniela Dewitt</strong> subscribed to you.
                      </div>

                    </div>
                    <div class="col-auto">

                      <small class="text-muted">
                        2m
                      </small>

                    </div>
                  </div> <!-- / .row -->

                </a>
                <a class="list-group-item px-0" href="#!">

                  <div class="row">
                    <div class="col-auto">

                      <!-- Avatar -->
                      <div class="avatar avatar-sm">
                        <img src="{{ asset('img/avatars/profiles/avatar-5.jpg') }}" alt="..." class="avatar-img rounded-circle">
                      </div>

                    </div>
                    <div class="col ml--2">

                      <!-- Content -->
                      <div class="small text-muted">
                        <strong class="text-body">Miyah Myles</strong> shared your post with <strong class="text-body">Ryu Duke</strong>, <strong class="text-body">Glen Rouse</strong>, and <strong class="text-body">3 others</strong>.
                      </div>

                    </div>
                    <div class="col-auto">

                      <small class="text-muted">
                        2m
                      </small>

                    </div>
                  </div> <!-- / .row -->

                </a>
                <a class="list-group-item px-0" href="#!">

                  <div class="row">
                    <div class="col-auto">

                      <!-- Avatar -->
                      <div class="avatar avatar-sm">
                        <img src="{{ asset('img/avatars/profiles/avatar-6.jpg') }}" alt="..." class="avatar-img rounded-circle">
                      </div>

                    </div>
                    <div class="col ml--2">

                      <!-- Content -->
                      <div class="small text-muted">
                        <strong class="text-body">Ryu Duke</strong> reacted to your post with a 😍
                      </div>

                    </div>
                    <div class="col-auto">

                      <small class="text-muted">
                        2m
                      </small>

                    </div>
                  </div> <!-- / .row -->

                </a>
                <a class="list-group-item px-0" href="#!">

                  <div class="row">
                    <div class="col-auto">

                      <!-- Avatar -->
                      <div class="avatar avatar-sm">
                        <img src="{{ asset('img/avatars/profiles/avatar-7.jpg') }}" alt="..." class="avatar-img rounded-circle">
                      </div>

                    </div>
                    <div class="col ml--2">

                      <!-- Content -->
                      <div class="small text-muted">
                        <strong class="text-body">Glen Rouse</strong> commented <blockquote class="text-body">“I don’t think this really makes sense to do without approval from Johnathan since he’s the one...” </blockquote>
                      </div>

                    </div>
                    <div class="col-auto">

                      <small class="text-muted">
                        2m
                      </small>

                    </div>
                  </div> <!-- / .row -->

                </a>
                <a class="list-group-item px-0" href="#!">

                  <div class="row">
                    <div class="col-auto">

                      <!-- Avatar -->
                      <div class="avatar avatar-sm">
                        <img src="{{ asset('img/avatars/profiles/avatar-8.jpg') }}" alt="..." class="avatar-img rounded-circle">
                      </div>

                    </div>
                    <div class="col ml--2">

                      <!-- Content -->
                      <div class="small text-muted">
                        <strong class="text-body">Grace Gross</strong> subscribed to you.
                      </div>

                    </div>
                    <div class="col-auto">

                      <small class="text-muted">
                        2m
                      </small>

                    </div>
                  </div> <!-- / .row -->

                </a>
              </div>

            </div>
          </div> <!-- / .dropdown-menu -->

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
