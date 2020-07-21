<template>

     <div class="tab-pane fade show active" id="wizardStepOne">

        <!-- Header -->
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6 text-center">

                <!-- Pretitle -->
                <h6 class="mb-4 text-uppercase text-muted">
                    Step 1 of 4
                </h6>

                <!-- Title -->
                <h1 class="mb-3">
                    Let’s start with the basics.
                </h1>

                <!-- Subtitle -->
                <p class="mb-5 text-muted">
                    We'll need to make sure your profile information is correct.
                </p>

            </div>
        </div> <!-- / .row -->

        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group ">
                    <!-- Label -->
                    <label>
                        First Name
                    </label>
                    <!-- Input -->
                    <input v-model="dataUser.first_name" name="first_name" type="text" :class="'form-control '+(errors.first_name.$error ? 'is-invalid ' : '')">
                </div>
            </div>

            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <!-- Label -->
                    <label>
                        Last Name
                    </label>
                    <!-- Input -->
                    <input v-model="dataUser.last_name" name="last_name" type="text" :class="'form-control '+(errors.last_name.$error ? 'is-invalid ' : '')">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">

                <label class="mb-1">
                    Email Address
                </label>

                <input v-model="dataUser.email" name="email" type="email" :class="'form-control '+(errors.email.$error ? 'is-invalid ' : '')">
            </div>

            <div class="form-group col-md-6">

                <label class="mb-1">
                    Phone Number
                </label>

                <input v-model="dataUser.phone" name="phone" type="phone" :class="'form-control '+(errors.phone.$error ? 'is-invalid ' : '')">
            </div>
        </div>


        <!-- Warning -->
        <!-- <div class="card bg-light border">
            <div class="card-body">
            <h4 class="mb-2">
                <i class="fe fe-alert-triangle"></i> Secure
            </h4>
            <p class="small text-muted mb-0">
                All data is kept secure on our servers.
            </p>
            </div>
        </div> -->

        <!-- Divider -->
        <!-- <hr class="my-5"> -->

        <div class="row">
            <div class="form-group col-md-6">

                <label class="mb-1">
                    Estimated Annual Income
                </label>

                <input v-model="dataUser.income" name="income" type="income" :class="'form-control '+(errors.income.$error ? 'is-invalid ' : '')">
            </div>

            <div class="form-group col-md-6">

                <label class="mb-1">
                    Monthly Take Home Pay
                </label>

                <input v-model="dataUser.pay" name="pay" type="pay" :class="'form-control '+(errors.income.$error ? 'is-invalid ' : '')">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">

                <label class="mb-1">
                    Financial Goals
                </label>

                <select v-model="dataUser.goals" :class="'form-control '+(errors.goals.$error ? 'is-invalid ' : '')">
                    <!-- <option value="undefined">Select An Option</option> -->
                    <option value="0">Save More Money</option>
                    <option value="1">Pay Down Debt</option>
                    <option value="2">Track My Spending</option>
                </select>
            </div>

        </div>

    </div>
</template>

<script>
    export default {
        props: ['user', 'errors'],
        data() {
            return {
                dataUser: this.user
            }
        }
    }
</script>
