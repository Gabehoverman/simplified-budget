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

            <div class="form-group col-md-6">
                <label>
                    Institution
                </label>
                <select v-model="account.institution_id" name="type" :class="'form-control '" data-toggle="select">
                    <option value="null">Select Institution</option>
                    <option v-for="institution in institutions" :key="institution.id" :value="institution.id">{{ institution.name }}</option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label>
                    Account Balance
                </label>
                <input v-model="account.balance" name="balance" type="text" :class="'form-control'">
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
                    <option value="2">Credit</option>
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
                    <option value="1" :disabled="!account.mx_member_guid">Automatic</option>
                    <option value="0" :disabled="account.mx_member_guid">Manual</option>
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
        props: ['account', 'institutions', 'errors'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
