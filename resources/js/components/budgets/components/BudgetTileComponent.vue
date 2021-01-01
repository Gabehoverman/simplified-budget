<template>
  <div
    id="list"
    class="list"
    data-toggle="lists"
    data-list='{"valueNames": ["budget-name", "budget-institution", "orders-amount", "orders-vendor", "orders-budget", "orders-method"], "page": 6, "pagination": {"paginationClass": "list-pagination"}}'
  >
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
        class="col-12 col-md-6 col-xl-4"
        v-for="(budget, index) in dataBudgets"
        :key="index"
      >
        <!-- Card -->
        <div class="card">
          <div class="card-body" style="padding-bottom: 15px;">
            <!-- Header -->
            <div class="row align-items-center">
              <div class="col">
                <!-- Checkbox -->
                <div
                  class="custom-control custom-control-circle custom-checkbox"
                >
                  <input
                    type="checkbox"
                    class="list-checkbox custom-control-input"
                    :id="'cardsCheckbox' + index"
                  />
                  <label
                    class="custom-control-label"
                    :for="'cardsCheckbox' + index"
                  ></label>
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
                        data-target="#budgetModal"
                        @click="selectBudget(budget)"
                    >
                      Edit
                    </a>
                    <a
                      @click="deleteBudget(budget)"
                      href="#!"
                      class="dropdown-item"
                    >
                      Delete
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!-- / .row -->

            <!-- Image -->
            <a href="#"
              :class="'avatar avatar-xl card-avatar text-center ' + getProgressClass( budget )"
              style="width: 100px; height: 100px; border-radius: 50%;"
               data-toggle="modal"
               data-target="#budgetModal"
              @click="selectBudget(budget)"
            >
            <div style="padding-top: 26px" v-html="$transactionCategoryIcons[budget.category]"></div>
            <!-- <svg viewBox="0 0 24 24" width="50" height="50" stroke="white" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg> -->

              <!-- <img
                :src="
                  budget.institution
                    ? budget.institution.asset
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
              <h2 class="card-title">
                <a href="#" class="item-name budget-name"
                    data-toggle="modal"
                    data-target="#budgetModal"
                    @click="selectBudget(budget)"
                  >{{ budget.category }}</a
                >
              </h2>
              <!-- <br /> -->
              <!-- <h3 class="card-title gray">${{ budget.amount }} / Month</h3> -->
              <!-- Text -->
              <div class="row mt-2">
                <div class="col-md-4">
                  <!-- <p class="small text-muted mb-0">{{ getBudgetLabel( budget.type ) }}</p> -->
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
                    <small>Budgeted Amount</small>
                  </div>
                  <div class="col-auto">
                    <!-- Text -->
                    <small class="item-industry">{{
                      budget.monthly_amount ? '$'+budget.monthly_amount : ""
                    }}</small>
                  </div>
                </div>
                <!-- / .row -->
              </div>
              <div class="list-group-item">
                <div class="row">
                  <div class="col">
                    <!-- Text -->
                    <small>Timeframe</small>
                  </div>
                  <div class="col-auto">
                    <!-- Text -->
                    <small class="item-industry">{{
                      budget.timeframe == 1 ? 'Annually' : "Monthly"
                    }}</small>
                  </div>
                </div>
                <!-- / .row -->
              </div>
              <div class="list-group-item">
                <div class="row">
                  <div class="col">
                    <!-- Text -->
                    <small>Monthly Spend</small>
                  </div>
                  <div class="col-auto">
                    <!-- Text -->
                    <small class="item-industry">{{
                      budget.total ? '$'+budget.total : "$0"
                    }}</small>
                  </div>
                </div>
                <!-- / .row -->
                </div>
            </div>
          </div>
          <div class="card-footer card-footer-boxed">
            <div class="row align-items-center">
              <div class="col">
                <div class="row align-items-center no-gutters">
                  <div class="col-auto">
                    <!-- Value -->
                    <small class="mr-2">{{ calculatePercentage( budget.monthly_amount, budget.total ) }}%</small>
                  </div>
                  <div class="col">
                    <!-- Progress -->
                    <div class="progress progress-sm">
                      <div
                        :class="'progress-bar ' + getProgressClass( budget )"
                        role="progressbar"
                        :style="'width: '+ calculatePercentage( budget.monthly_amount, budget.total ) +'%'"
                        :aria-valuenow="calculatePercentage( budget.monthly_amount, budget.total )"
                        aria-valuemin="0"
                        aria-valuemax="100"
                      ></div>
                    </div>
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
</template>

<script>
export default {
  name: "tile-component",
  props: ["budgets"],
  components: {},
  data() {
    return {
      dataBudgets: this.budgets,
      selectedBudget: null,
    };
  },
  methods: {
    unselectBudget() {
      this.$emit("unselectBudget");
    },
    selectBudget(budget) {
      this.$emit("selectBudget", budget);
    },
    saveBudget(budget) {
      this.$emit("saveBudget");
    },
    deleteBudget(budget) {
      this.$emit("deleteBudget", budget);
    },
    calculatePercentage( amount, total ) {
      let percent = ((total / amount) * 100)
      return percent.toFixed(2)
    },
    getProgressClass( budget ) {
      let percent = this.calculatePercentage(budget.monthly_amount, budget.total)
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
