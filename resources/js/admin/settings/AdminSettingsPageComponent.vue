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
                                    <li class="nav-item">
                                        <a @click="selectTab('institutions')" href="#!" :class="selectedTab == 'institutions' ? 'nav-link active' : 'nav-link'">
                                            Manage Institutions
                                        <!-- <span class="badge badge-pill badge-soft-secondary">823</span> -->
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


              <!-- Card -->
                <settings-card v-if="selectedTab == 'settings'"
                />

                <notifications-card v-if="selectedTab == 'notifications'"
                />

                <institutions-card v-if="selectedTab == 'institutions'"
                    :institutions="institutions"
                />
        </div>
    </div>
</template>

<script>
    import SettingsCard from './Components/SettingsCard'
    import NotificationsCard from './Components/NotificationsCard';
    import InstitutionsCard from './Components/InstitutionsCard';

    export default {
        props: ['institutions'],
        data() {
            return {
                selectedTab: 'settings'
            }
        },
        components: {
            SettingsCard,
            NotificationsCard,
            InstitutionsCard
        },
        methods: {
            selectTab( tab ) {
                this.selectedTab = tab;
            },
        }
    }
</script>
