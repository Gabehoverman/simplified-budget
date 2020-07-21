<template>

<div class="container-fluid">
    <notifications group="notification"/>

    <div class="row justify-content-center">
      <div class="col-12">


        <!-- Header -->
        <div class="header">
          <div class="header-body">
            <div class="row align-items-center">
              <div class="col">

                <!-- Pretitle -->
                <h6 class="header-pretitle">
                  Settings / Manage
                </h6>

                <!-- Title -->
                <h1 class="header-title mt-md-5">
                  Settings
                </h1>

              </div>
            </div> <!-- / .row -->
            <div class="row align-items-center">
              <div class="col">

                <!-- Nav -->
                <ul class="nav nav-tabs nav-overflow header-tabs">
                  <li class="nav-item">
                    <a @click="selectTab('account')" href="#!" :class="selectedTab == 'account' ? 'nav-link active' : 'nav-link'">
                        Account Settings
                      <!-- <span class="badge badge-pill badge-soft-secondary">823</span> -->
                    </a>
                  </li>
                  <li class="nav-item">
                    <a @click="selectTab('email')" href="#!" :class="selectedTab == 'email' ? 'nav-link active' : 'nav-link'">
                        Email Notifications
                      <!-- <span class="badge badge-pill badge-soft-secondary">823</span> -->
                    </a>
                  </li>
                </ul>

              </div>
            </div>
          </div>
        </div>

        <!-- Card -->
        <account-card v-if="selectedTab == 'account'"
            :user="dataUser"
            @updateProfile="updateProfile($event)"
        />

        <email-card v-if="selectedTab == 'email'"
            :user="dataUser"
        />

      </div>
    </div> <!-- / .row -->
  </div>
</template>

<script>
    import AccountCard from './cards/AccountCard';
    import EmailCard from './cards/EmailCard';

    export default {
        name: 'settings-page-component',
        props: [
            'user',
            'settings'
        ],
        components: {
            AccountCard,
            EmailCard
        },
        data() {
            return {
                selectedTab: 'account',
                dataUser: this.user
            }
        },
        methods: {
            selectTab( tab ) {
                this.selectedTab = tab;
            },
            updateProfile(data) {
                var self = this;
                this.asyncSendData(data, '/profile/update', 'PUT').then( function( response ) {
                    self.user = response;
                    self.showNotification('success', 'Profile Updated Successfully!')
                })
            }
        }
    }
</script>
