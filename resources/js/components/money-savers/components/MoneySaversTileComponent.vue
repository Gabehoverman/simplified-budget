<template>
<div>
   <div class="card" v-if="moneySavers.length < 1">
        <div class="card-header">
            <h4 class="card-header-title">No Recommended Money Savers Yet</h4>
        </div>
        <div class="card-body">
            Check back later when you've added more accounts
        </div>
   </div>
  <div
    v-else
    id="list"
    class="list"
    data-toggle="lists"
    data-list='{"valueNames": ["moneySaver-name", "moneySaver-institution", "orders-amount", "orders-vendor", "orders-moneySaver", "orders-method"], "page": 6, "pagination": {"paginationClass": "list-pagination"}}'
  >

    <div class="card" >
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col">
            <!-- Search -->
            <form class="row align-items-center">
              <div class="col-auto pr-0">
                <span class="fe fe-search text-muted"></span>
              </div>
              <div class="col">
                <input
                  type="search"
                  class="form-control form-control-flush list-search"
                  placeholder="Search"
                />
              </div>
            </form>
          </div>
          <div class="col-auto">
            <!-- Button -->

            <div class="dropdown"></div>
          </div>
        </div>
        <!-- / .row -->
      </div>
    </div>
    <div class="list row">
      <div
        class="col-12 col-md-6 col-xl-6"
        v-for="(moneySaver, index) in dataMoneySavers"
        :key="index"
      >
        <!-- Card -->
        <div class="card">
          <div class="card-body" style="padding-bottom: 15px;">
            <!-- Header -->
            <div class="row align-items-center">
              <div class="col">
                <!-- Checkbox -->
                <div class="text-muted small" v-if="moneySaver.recommended">
                    <i class="fe fe-star"></i>
                    SB Recommended
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
                    <a href="#" class="dropdown-item"
                        data-toggle="modal"
                        data-target="#moneySaverModal"
                        @click="selectMoneySaver(moneySaver)"
                    >
                      Details
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!-- / .row -->

            <!-- Image -->
            <a href="#"
              :class="'avatar avatar-xl card-avatar text-center ' + getProgressClass( moneySaver )"
              style="width: 100px; height: 100px; border-radius: 50%;"
               data-toggle="modal"
               data-target="#moneySaverModal"
              @click="selectMoneySaver(moneySaver)"
            >
            <div style="padding-top: 26px" v-html="$transactionCategoryIcons[moneySaver.category]"></div>
            <!-- <svg viewBox="0 0 24 24" width="50" height="50" stroke="white" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg> -->

              <!-- <img
                :src="
                  moneySaver.institution
                    ? moneySaver.institution.asset
                    : asset('/img/logos/MX Bank Logo.png')
                "
                class="avatar-img rounded"
                style="width: 250px; height: auto; max-height: 80px"
                alt="..."
              /> -->
            </a>

            <!-- Body -->
            <div class="text-center">
              <!-- Heading -->
              <h2 class="card-title row">
                <div class="col-md-9 text-left">
                    <a href="#" class="item-name moneySaver-name"
                        data-toggle="modal"
                        data-target="#moneySaverModal"
                        @click="selectMoneySaver(moneySaver)">
                        {{ moneySaver.name }}
                    </a>
                </div>
                <div class="col-md-3 text-right">
                    {{ moneySaver.rating }}
                    <span class="text-muted small">/ 10</span>
                </div>

              </h2>
              <!-- <br /> -->
              <!-- <h3 class="card-title gray">${{ moneySaver.amount }} / Month</h3> -->
              <!-- Text -->
              <div class="row mt-2">
                <div class="col-md-4">
                  <!-- <p class="small text-muted mb-0">{{ getMoneySaverLabel( moneySaver.type ) }}</p> -->
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
                    <small>Category</small>
                  </div>
                  <div class="col-auto">
                    <!-- Text -->
                    <small class="item-industry">{{
                      moneySaver.category
                    }}</small>
                  </div>
                </div>
                <!-- / .row -->
              </div>
              <div class="list-group-item">
                <div class="row">
                  <div class="col">
                    <!-- Text -->
                    <small>Vendor</small>
                  </div>
                  <div class="col-auto">
                    <!-- Text -->
                    <small class="item-industry">{{
                      moneySaver.vendor
                    }}</small>
                  </div>
                </div>
                <!-- / .row -->
              </div>
              <div class="list-group-item" v-for="( feature, index ) in moneySaver.features" :key="index">
                <div class="row">
                  <div class="col">
                    <!-- Text -->
                    <small>{{ feature.label }}</small>
                  </div>
                  <div class="col-auto">
                    <!-- Text -->
                    <small class="item-industry">
                      {{ feature.value }}
                    </small>
                  </div>
                </div>
                <!-- / .row -->
                </div>
            </div>
          </div>
          <!-- / .row -->
        </div>
      </div>
    </div>

    <!-- Pagination -->
    <div class="row no-gutters">
      <!-- Pagination (prev) -->
      <ul
        class="col list-pagination-prev pagination pagination-tabs justify-content-start"
      >
        <li class="page-item">
          <a class="page-link" href="#">
            <i class="fe fe-arrow-left mr-1"></i> Prev
          </a>
        </li>
      </ul>

      <!-- Pagination -->
      <ul
        class="col list-pagination pagination pagination-tabs justify-content-center"
      ></ul>

      <!-- Pagination (next) -->
      <ul
        class="col list-pagination-next pagination pagination-tabs justify-content-end"
      >
        <li class="page-item">
          <a class="page-link" href="#">
            Next
            <i class="fe fe-arrow-right ml-1"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
  </div>
</template>

<script>
export default {
  name: "tile-component",
  props: ["money-savers"],
  components: {},
  data() {
    return {
      dataMoneySavers: this.moneySavers,
      selectedMoneySaver: null,
    };
  },
  methods: {
    unselectMoneySaver() {
      this.$emit("unselectMoneySaver");
    },
    selectMoneySaver(moneySaver) {
      this.$emit("selectMoneySaver", moneySaver);
    },
    saveMoneySaver(moneySaver) {
      this.$emit("saveMoneySaver");
    },
    deleteMoneySaver(moneySaver) {
      this.$emit("deleteMoneySaver", moneySaver);
    },
    calculatePercentage( amount, total ) {
      let percent = ((total / amount) * 100)
      return percent.toFixed(2)
    },
    getProgressClass( moneySaver ) {
      let percent = this.calculatePercentage(moneySaver.amount, moneySaver.total)
      if ( percent >= 100) {
        return 'bg-danger'
      } else if (percent >= 85) {
        return 'bg-warning'
      } else {
        return 'bg-primary'
      }
    }
  },
};
</script>
