<template>
    <div class="container-fluid ">
    <notifications group="notification"/>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-12 col-xl-12">

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
                                        <a @click="selectTab('settings')" href="#!" :class="selectedTab == 'settings' ? 'nav-link active' : 'nav-link'">
                                            Site Settings
                                        <!-- <span class="badge badge-pill badge-soft-secondary">823</span> -->
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a @click="selectTab('notifications')" href="#!" :class="selectedTab == 'notifications' ? 'nav-link active' : 'nav-link'">
                                            Notification Settings
                                        <!-- <span class="badge badge-pill badge-soft-secondary">823</span> -->
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="col-12 col-lg-12">
                <div class="card row" style="flex-direction: row; padding: 25px;">
                    <div class="card-header col-12" style="border-bottom: 0px;">
                        <h3>Site Settings</h3>
                    </div>

                </div>
            </div> -->
              <!-- Card -->
                <settings-card v-if="selectedTab == 'settings'"
                />

                <notifications-card v-if="selectedTab == 'notifications'"
                />
        </div>
    </div>
</template>

<script>
    import SettingsCard from './Components/SettingsCard'
    import NotificationsCard from './Components/NotificationsCard';

    export default {
        props: [],
        data() {
            return {
                selectedTab: 'settings'
            }
        },
        components: {
            SettingsCard,
            NotificationsCard
        },
        methods: {
            selectTab( tab ) {
                this.selectedTab = tab;
            },
        }
    }
</script>
