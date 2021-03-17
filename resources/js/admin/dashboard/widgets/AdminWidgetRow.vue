<template>
    <div class="row">
        <div class="col-12 col-lg-6">

        <!-- Card -->
        <div class="card">
            <div class="card-body">
            <div class="row align-items-center">
                <div class="col">

                <!-- Title -->
                <h6 class="text-uppercase text-muted mb-2">
                    New Users
                </h6>

                <!-- Heading -->
                <span class="h2 mb-0">
                    {{ userGrowth }}
                </span>

                <!-- Badge -->
                <!-- <span class="badge badge-soft-success mt-n1">
                    +3.5%
                </span> -->

                </div>
                <div class="col-auto">

                <!-- Icon -->
                <span class="h2 fe fe-user text-muted mb-0"></span>

                </div>
            </div> <!-- / .row -->

            </div>
        </div>

        </div>
        <div class="col-12 col-lg-6">

        <!-- Card -->
        <div class="card">
            <div class="card-body">
            <div class="row align-items-center">
                <div class="col">

                <!-- Title -->
                <h6 class="text-uppercase text-muted mb-2">
                    Total Users
                </h6>

                <!-- Heading -->
                <span class="h2 mb-0">
                    {{ users.length }}
                </span>

                </div>
                <div class="col-auto">

                <!-- Icon -->
                <span class="h2 fe fe-users text-muted mb-0"></span>

                </div>
            </div> <!-- / .row -->

            </div>
        </div>

        </div>
        <div class="col-12 col-lg-6">

        <!-- Card -->
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">

                    <!-- Title -->
                    <h6 class="text-uppercase text-muted mb-2">
                        New Paid Subscriptions
                    </h6>

                    <div class="row align-items-center no-gutters">
                        <div class="col-auto">

                        <!-- Heading -->
                        <span class="h2 mr-5 mb-0">
                            {{ newPaidUsersCount }}
                        </span>

                        </div>
                        <div class="col">

                        <!-- Progress -->
                        <div class="progress progress-sm">
                            <div class="progress-bar" role="progressbar" :style="'width: '+newPaidUsersPercentage+'%'" :aria-valuenow="newPaidUsersPercentage" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        </div>
                    </div> <!-- / .row -->

                    </div>
                    <div class="col-auto mt-3">

                    <!-- Icon -->
                    <span class="h4 text-muted mb-0" >{{ newPaidUsersPercentage }}%</span>

                    </div>
                </div> <!-- / .row -->

            </div>
        </div>

        </div>
        <div class="col-12 col-lg-6">

        <!-- Card -->
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">

                    <!-- Title -->
                    <h6 class="text-uppercase text-muted mb-2">
                        Total Paid Subscriptions
                    </h6>

                    <div class="row align-items-center no-gutters">
                        <div class="col-auto">

                        <!-- Heading -->
                        <span class="h2 mr-5 mb-0">
                            {{ paidUsersCount }}

                        </span>

                        </div>
                        <div class="col">

                        <!-- Progress -->
                        <div class="progress progress-sm">
                            <div class="progress-bar" role="progressbar" :style="'width: '+paidUsersPercentage+'%'" :aria-valuenow="paidUsersPercentage" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        </div>
                    </div> <!-- / .row -->

                    </div>
                    <div class="col-auto mt-3">

                    <!-- Icon -->
                    <span class="h4 text-muted mb-0">{{ paidUsersPercentage }}%</span>

                    </div>
                </div> <!-- / .row -->

            </div>
        </div>

        </div>
    </div>
</template>

<script>
    export default {
        props: ['users', 'filter', 'weeklyNewUsers', 'monthlyNewUsers', 'annualNewUsers'],
        computed: {
            userGrowth() {
                var data = eval ('this.'+this.filter+'NewUsers')
                var count = 0;
                for (const [key, value] of Object.entries(data)) {
                    count += value.length
                }
                return count;
            },
            newPaidUsersCount() {
                var data = eval ('this.'+this.filter+'NewUsers')
                var count = 0;
                if ( this.userGrowth == 0 ) {
                    return 0;
                }
                for (const [key, value] of Object.entries(data)) {
                    value.forEach( function(user) {
                        if ( user.plan != 'free' && user.plan != null ) {
                            count++;
                        }
                    })
                }
                return count;
            },
            newPaidUsersPercentage() {
                  if ( this.userGrowth == 0 ) {
                    return 0;
                }
                return (this.newPaidUsersCount / this.userGrowth).toFixed(2) * 100;
            },
            paidUsersCount() {
                var count = 0;
                this.users.forEach( function( user ) {
                    if ( user.plan != 'free' && user.plan != null ) {
                        count++;
                    }
                })
                return count;
            },
            paidUsersPercentage() {
                return ( this.paidUsersCount / this.users.length).toFixed(2) * 100;
            }
        }
    }
</script>
