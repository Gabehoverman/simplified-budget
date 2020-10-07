<template>
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
                  <!-- <a href="#!" class="small">
                    View all
                  </a> -->

                </div>
              </div> <!-- / .row -->
            </div> <!-- / .card-header -->
            <div class="card-body">

              <!-- List group -->
              <div class="list-group list-group-flush my--3">
                <a class="list-group-item px-0" href="#!" v-for="notification in notifications" :key="notification.id">

                  <div class="row">
                    <div class="col-auto">

                      <!-- Avatar -->
                      <div class="avatar avatar-sm" style="background: #2C7BE5; border-radius: 50%; padding: 10px;" v-html="getLogIcon(notification.log_name)">
                      </div>

                    </div>
                    <div class="col ml--2">

                      <!-- Content -->
                      <div class="small text-muted">
                        <strong class="text-body">{{ notification.description }}</strong>
                      </div>

                    </div>
                    <div class="col-auto">

                      <small class="text-muted">
                        {{ notification.created_at | moment("from", true) }}
                      </small>

                    </div>
                  </div> <!-- / .row -->

                </a>
              </div>
            </div>
          </div> <!-- / .dropdown-menu -->

        </div>
</template>

<script>
export default {
    props: ['notifications']
}
</script>
