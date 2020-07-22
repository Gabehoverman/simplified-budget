<template>
    <div>

        <h3 class="mb-5 card-lead">Account Settings</h3>

        <div class="row">
            <!-- Project name -->
            <div class="form-group col-md-6">
                <label>
                    Account Name
                </label>
                <input v-model="account.name" name="name" type="text" :class="'form-control '+(errors.name.$error ? 'is-invalid ' : '')">
            </div>

            <!-- Project tags -->
            <div class="form-group col-md-6">
                <label>
                    Account Type
                </label>
                <select v-model="account.type" name="type" :class="'form-control '+(errors.type.$error ? 'is-invalid ' : '')" data-toggle="select">
                    <option value="undefined" disabled>Select an Option</option>
                    <option value="0">Checking</option>
                    <option value="1">Savings</option>
                </select>
            </div>
        </div>

        <div class="row">

            <!-- Project tags -->
            <div class="form-group col-md-6">
                <label>
                    Transaction Recording
                </label>
                <select v-model="account.tracking_type" name="tracking_type" :class="'form-control '+(errors.tracking_type.$error ? 'is-invalid ' : '')" data-toggle="select">
                    <option value="undefined" disabled>Select an Option</option>
                    <option value="1">Automatic</option>
                    <option value="0">Manual</option>
                </select>
            </div>

            <!-- Project tags -->
            <div class="form-group col-md-6">
                <label>
                    Tracking Options
                </label>
                <select v-model="account.tracking_options" name="tracking_options" :class="'form-control '+(errors.tracking_options.$error ? 'is-invalid ' : '')" data-toggle="select">
                    <option value="undefined" disabled>Select an Option</option>
                    <option value="0">Income & Expenses</option>
                    <option value="1">Income Only</option>
                    <option value="2">Expenses Only</option>
                </select>
            </div>

        </div>

    </div>
</template>

<script>
    export default {
        props: ['account', 'errors'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
