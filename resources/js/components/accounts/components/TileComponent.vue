<template>
<div id="list" class="list" data-toggle="lists" data-list='{"valueNames": ["account-name", "account-institution", "orders-amount", "orders-vendor", "orders-account", "orders-method"], "page": 10, "pagination": {"paginationClass": "list-pagination"}}'>
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">

                    <!-- Search -->
                    <form class="row align-items-center">
                        <div class="col-auto pr-0">
                        <span class="fe fe-search text-muted"></span>
                        </div>
                        <div class="col">
                            <input type="search" class="form-control form-control-flush list-search" placeholder="Search">
                        </div>
                    </form>

                    </div>
                    <div class="col-auto">

                    <!-- Button -->

                    <div class="dropdown">
                    </div>

                </div>
            </div> <!-- / .row -->
            </div>
        </div>
        <div class="list row" >
        <div class="col-12 col-md-6 col-xl-4" v-for="(account, index ) in dataAccounts" :key="index">
            <!-- Card -->
            <div class="card">
            <div class="card-body">
                <!-- Header -->
                <div class="row align-items-center">
                <div class="col">
                    <!-- Checkbox -->
                    <div class="custom-control custom-control-circle custom-checkbox">
                    <input
                        type="checkbox"
                        class="list-checkbox custom-control-input"
                        :id="'cardsCheckbox'+index"
                    />
                    <label class="custom-control-label" :for="'cardsCheckbox'+index"></label>
                    </div>
                </div>
                <div class="col-auto">
                    <!-- Dropdown -->
                    <div class="dropdown">
                    <a
                        href="#!"
                        class="dropdown-ellipses dropdown-toggle"
                        role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <i class="fe fe-more-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a :href="'/accounts/'+account.id" class="dropdown-item">
                            Edit
                        </a>
                        <a @click="deleteAccount( account )" href="#!" class="dropdown-item">
                            Delete
                        </a>
                    </div>
                    </div>
                </div>
                </div>
                <!-- / .row -->

                <!-- Image -->
                <a :href="'/accounts/'+account.id" class="avatar avatar-xl card-avatar text-center" style="width: 100%">
                <img
                    :src="account.institution ? account.institution.asset : asset('/img/logos/MX Bank Logo.png' )"
                    class="avatar-img rounded"
                    style="width: 250px; height: auto; max-height: 80px;"
                    alt="..."
                />
                </a>

                <!-- Body -->
                <div class="text-center">
                <!-- Heading -->
                <h2 class="card-title">
                    <a class="item-name account-name" :href="'/accounts/'+ account.id">{{ account.name }}</a>
                </h2>
                    <br/>
                <!-- Text -->
                <div class="row mt-2">
                    <div class="col-md-4">
                    <p class="small text-muted mb-0">{{ getAccountLabel( account.type ) }}</p>
                    </div>
                    <div class="col-md-4">
                        <p class="small text-muted mb-0">{{ getTrackingLabel( account.tracking) }}</p>
                    </div>
                    <div class="col-md-4">
                        <p class="small text-muted mb-0">{{ getTrackingTypeLabel( account.tracking_type) }}</p>
                    </div>
                </div>
                <!-- <p
                    class="small text-muted mb-0"
                >Launchday is a SaaS website builder with a focus on quality, easy to build product sites.</p> -->
                </div>

                <!-- Divider -->
                <hr class="card-divider mb-0" />

                <!-- List group -->
                <div class="list-group list-group-flush mb-n3">
                <div class="list-group-item">
                    <div class="row">
                    <div class="col">
                        <!-- Text -->
                        <small>Institution</small>
                    </div>
                    <div class="col-auto">
                        <!-- Link -->
                        <a :href="'/accounts/'+ account.id">
                        <small class="item-owner account-institution">{{ account.institution ? account.institution.name : null }}</small>
                        </a>
                    </div>
                    </div>
                    <!-- / .row -->
                </div>
                <div class="list-group-item">
                    <div class="row">
                    <div class="col">
                        <!-- Text -->
                        <small>Balance</small>
                    </div>
                    <div class="col-auto">
                        <!-- Text -->
                        <small class="item-industry">{{ account.balance ? account.balance : '$100,000' }}</small>
                    </div>
                    </div>
                    <!-- / .row -->
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>

        <!-- Pagination -->
        <div class="row no-gutters">
        <!-- Pagination (prev) -->
        <ul class="col list-pagination-prev pagination pagination-tabs justify-content-start">
            <li class="page-item">
            <a class="page-link" href="#">
                <i class="fe fe-arrow-left mr-1"></i> Prev
            </a>
            </li>
        </ul>

        <!-- Pagination -->
        <ul class="col list-pagination pagination pagination-tabs justify-content-center"></ul>

        <!-- Pagination (next) -->
        <ul class="col list-pagination-next pagination pagination-tabs justify-content-end">
            <li class="page-item">
            <a class="page-link" href="#">
                Next
                <i class="fe fe-arrow-right ml-1"></i>
            </a>
            </li>
        </ul>
        </div>
  </div>
</template>

<script>
export default {
  name: "tile-component",
  props: ["accounts"],
  components: {},
  data() {
    return {
      selectedAccount: null,
      dataAccounts: this.accounts,
    };
  },
  methods: {
    unselectAccount() {
      this.$emit("unselectAccount");
    },
    selectAccount(account) {
      this.$emit("selectAccount");
    },
    saveAccount(account) {
      this.$emit("saveAccount");
    },
    deleteAccount(account) {
      this.$emit("deleteAccount", account);
    },
  },
};
</script>
