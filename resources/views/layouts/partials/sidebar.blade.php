<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light" id="sidebar">
    <div class="container-fluid">

      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Brand -->
      <a class="navbar-brand" href="index.html">
        {{-- <img src="{{ asset('/img/logo.svg') }}" class="navbar-brand-img
        mx-auto" alt="..."> --}}
      </a>

      <!-- User (xs) -->
      <div class="navbar-user d-md-none">

        <!-- Dropdown -->
        <div class="dropdown">

          <!-- Toggle -->
          <a href="#!" id="sidebarIcon" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="avatar avatar-sm avatar-online">
              <img src="{{ asset('img/avatars/profiles/avatar.png') }}" class="avatar-img rounded-circle" alt="...">
            </div>
          </a>

          <!-- Menu -->
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="sidebarIcon">
            <a href="/profile" class="dropdown-item">Profile</a>
            <a href="/settings" class="dropdown-item">Settings</a>
            <hr class="dropdown-divider">
            <a href="/logout" class="dropdown-item">Logout</a>
          </div>

        </div>

      </div>

      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidebarCollapse">

        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
          <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fe fe-search"></span>
              </div>
            </div>
          </div>
        </form>

        <!-- Navigation -->
        <ul class="navbar-nav mt-6">
          <li class="nav-item">
            <a class="nav-link" href="/dashboard" >
              <i class="fe fe-home"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/transactions">
              <i class="fe fe-file"></i> Transactions
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/accounts">
              <i class="fe fe-clipboard"></i> Accounts
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/reporting">
             <span class="fe fe-grid"></span> Reporting
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/budgets">
             <span class="fe fe-credit-card"></span> Budgets
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/money-savers">
             <span class="fe fe-dollar-sign"></span> Money Savers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/what-if">
             <span class="fe fe-bar-chart"></span> What If
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/profile">
              <i class="fe fe-user"></i> Profile
            </a>
          </li>
          {{-- <li class="nav-item d-md-none">
            <a class="nav-link" href="#sidebarModalActivity" data-toggle="modal">
             <span class="fe fe-bell"></span> Notifications
            </a>
          </li>
          <li class="nav-item d-md-none">
            <a class="nav-link" href="/profile" data-toggle="modal">
             <span class="fe fe-bell"></span> Profile
            </a>
          </li> --}}
        </ul>

        <!-- Divider -->
        <hr class="navbar-divider my-3">

        <!-- Heading -->
        <h6 class="navbar-heading">
          Admin
        </h6>

        <!-- Navigation -->
        <ul class="navbar-nav mb-md-4">
          <li class="nav-item">
            <a class="nav-link " href="/admin/dashboard">
              <i class="fe fe-book"></i> Dashboard
            </a>
          </li>
          {{-- <li class="nav-item dropdown">
            <a class="nav-link" href="#sidebarComponents" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarComponents">
              <i class="fe fe-book-open"></i> Components
            </a>
            <div class="collapse " id="sidebarComponents">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a href="components.html#alerts" class="nav-link">
                    Alerts
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#avatars" class="nav-link">
                    Avatars
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#badges" class="nav-link">
                    Badges
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#breadcrumb" class="nav-link">
                    Breadcrumb
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#buttons" class="nav-link">
                    Buttons
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#button-group" class="nav-link">
                    Button group
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#cards" class="nav-link">
                    Cards
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#charts" class="nav-link">
                    Charts
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#dropdowns" class="nav-link">
                    Dropdowns
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#forms" class="nav-link">
                    Forms
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#icons" class="nav-link">
                    Icons
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#lists" class="nav-link">
                    Lists
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#loaders" class="nav-link">
                    Loaders
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#modal" class="nav-link">
                    Modal
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#navs" class="nav-link">
                    Navs
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#navbarExample" class="nav-link">
                    Navbar
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#page-headers" class="nav-link">
                    Page headers
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#pagination" class="nav-link">
                    Pagination
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#popovers" class="nav-link">
                    Popovers
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#progress" class="nav-link">
                    Progress
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#social-posts" class="nav-link">
                    Social post
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#tables" class="nav-link">
                    Tables
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#tooltips" class="nav-link">
                    Tooltips
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#typography" class="nav-link">
                    Typography
                  </a>
                </li>
                <li class="nav-item">
                  <a href="components.html#utilities" class="nav-link">
                    Utilities
                  </a>
                </li>
              </ul>
            </div>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link " href="/admin/money-savers">
              <i class="fe fe-git-branch"></i> Money Savers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="/admin/settings">
              <i class="fe fe-layers"></i> Site Settings
              {{-- <span class="badge badge-primary ml-auto">v1.3.1</span> --}}
            </a>
          </li>
        </ul>

        <!-- Push content down -->
        <div class="mt-auto"></div>


        <!-- Customize -->
        <a href="/settings" class="btn btn-block btn-primary mb-4">
          <i class="fe fe-sliders mr-2"></i> Settings
        </a>



        <!-- User (md) -->
        <div class="navbar-user d-none d-md-flex" id="sidebarUser">

          <!-- Icon -->
          <a href="#sidebarModalActivity" class="navbar-user-link" data-toggle="modal">
            <span class="icon">
              <i class="fe fe-bell"></i>
            </span>
          </a>

          <!-- Dropup -->
          <div class="dropup">

            <!-- Toggle -->
            <a href="#!" id="sidebarIconCopy" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="avatar avatar-sm avatar-online">
                <img src="{{ asset('img/avatars/profiles/avatar.png') }}" class="avatar-img rounded-circle" alt="...">
              </div>
            </a>

            <!-- Menu -->
            <div class="dropdown-menu" aria-labelledby="sidebarIconCopy">
              <a href="/profile" class="dropdown-item">Profile</a>
              <a href="/settings" class="dropdown-item">Settings</a>
              <hr class="dropdown-divider">
              <a href="/logout" class="dropdown-item">Logout</a>
            </div>

          </div>

          <!-- Icon -->
          <a href="#sidebarModalSearch" class="navbar-user-link" data-toggle="modal">
            <span class="icon">
              <i class="fe fe-search"></i>
            </span>
          </a>

        </div>


      </div> <!-- / .navbar-collapse -->

    </div>
  </nav>
