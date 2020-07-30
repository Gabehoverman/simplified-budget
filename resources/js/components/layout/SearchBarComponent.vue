<template>
    <div>
    <!-- Input -->
    <div class="input-group-prepend" style="display: inline-block;">
        <div class="input-group-text" style="border: none;">
        <i class="fe fe-search"></i>
        </div>
    </div>
    <input v-model="searchInput" @input="updateSearchResults" type="search" class="form-control form-control-prepended dropdown-toggle toggler search" data-toggle="dropdown" placeholder="Search" aria-label="Search">


    <!-- Menu -->
    <div class="dropdown-menu dropdown-menu-card" style="left: 225px;">
        <div v-if="awaitingSearch" class="card-body" >
              <content-loader
                :width="400"
                :height="160"
                :speed="2"
                primaryColor="#f3f3f3"
                secondaryColor="#ecebeb"
            >
            <rect x="47" y="8" rx="3" ry="3" width="177" height="6" />
            <rect x="47" y="25" rx="3" ry="3" width="152" height="6" />
            <circle cx="20" cy="20" r="20" />
            <circle cx="24" cy="85" r="20" />
            <rect x="51" y="90" rx="3" ry="3" width="152" height="6" />
            <rect x="51" y="72" rx="3" ry="3" width="177" height="6" />
            </content-loader>
        </div>
        <div v-else-if="accountResults < 1 && transactionResults < 1" class="card-body" >
            No Results
        </div>
        <div v-else class="card-body" >
        <!-- List group -->
        <div class="list-group list-group-flush list my--3">
            <h3 v-if="accountResults > 0" class="mt-2" >Accounts</h3>
            <a v-for="(account) in accountResults" :key="account.id"
                    :href="'/accounts/'+account.id" class="list-group-item px-0">
                <div class="row align-items-center">
                    <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar">
                        <img :src="asset('/img/avatars/teams/team-logo-1.jpg')" alt="..." class="avatar-img rounded">
                    </div>

                    </div>
                    <div class="col ml--2">

                    <!-- Title -->
                    <h4 class="text-body mb-1 name">
                        {{ account.name }}
                    </h4>

                    <!-- Time -->
                    <p class="small text-muted mb-0">
                        <span class="fe fe-clock"></span> <time datetime="2018-05-24">{{ account.created_at }}</time>
                    </p>

                    </div>
                </div> <!-- / .row -->
            </a>
            <h3 v-if="transactionResults.length > 0" class="mt-4">Transactions</h3>
            <a v-for="(transaction) in transactionResults" :key="transaction.id" href="/transactions" class="list-group-item px-0">
                <div class="row align-items-center">
                    <div class="col-auto">

                        <!-- Avatar -->
                        <div class="avatar">
                            <img :src="asset('/img/avatars/teams/team-logo-2.jpg')" alt="..." class="avatar-img rounded">
                        </div>

                        </div>
                        <div class="col ml--2">

                        <!-- Title -->
                        <h4 class="text-body mb-1 name">
                            {{ transaction.vendor }}: {{ transaction.amount }}
                        </h4>

                        <!-- Time -->
                        <p class="small text-muted mb-0">
                            <span class="fe fe-clock"></span> <time datetime="2018-05-24">{{ transaction.created_at }}</time>
                        </p>

                    </div>
                </div> <!-- / .row -->
            </a>
            <!-- <h3 class="mt-4">Search</h3>
            <a v-for="(result, index) in searchResults" :key="result" href="project-overview.html" class="list-group-item px-0">

                <div class="row align-items-center">
                    <div class="col-auto">

                        <div class="avatar avatar-4by3">
                            <img :src="asset('/img/avatars/projects/project-1.jpg')" alt="..." class="avatar-img rounded">
                        </div>

                        </div>
                        <div class="col ml--2">

                        <h4 class="text-body mb-1 name">
                            Homepage Redesign
                        </h4>

                        <p class="small text-muted mb-0">
                            <span class="fe fe-clock"></span> <time datetime="2018-05-24">Updated 4hr ago</time>
                        </p>

                    </div>
                </div>

            </a> -->

        </div>

        </div>
    </div> <!-- / .dropdown-menu -->
</div>
</template>

<script>
import { ContentLoader } from 'vue-content-loader'

export default {
    props: ['user'],
    components: {
        ContentLoader
    },
    data() {
        return {
            searchInput: null,
            accountResults: [],
            transactionResults: [],
            searchResults: [3,4],
            awaitingSearch: false,
        }
    },
    methods: {
        updateSearchResults() {
            var self = this;
            if (!this.awaitingSearch) {
                setTimeout(() => {
                    // this.fetchResults({ query: this.search })
                    console.log(this.searchInput);
                    this.searchAccounts()
                    this.searchTransactions()
                    this.awaitingSearch = false;
                }, 1000); // 1 sec delay
            }
            this.awaitingSearch = true;
        },
        searchAccounts() {
            var self = this;
            this.asyncFetchData('/search/accounts?keyword='+this.searchInput).then( function( response ) {
                console.log(response)
                self.accountResults = response;
            })
        },
        searchTransactions() {
            var self = this;
            this.asyncFetchData('/search/transactions?keyword='+this.searchInput).then( function( response ) {
                console.log(response)
                self.transactionResults = response;
            })
        },
        searchAll() {

        }
    }
}
</script>
