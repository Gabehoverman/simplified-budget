<template>
    <div>
        <h3 class="mb-5 card-lead">Select a Bank</h3>

        <div class="row">

            <!-- Project tags -->
            <div class="form-group col-md-12">
                <label>
                    Account Type
                </label>
                <select v-model="account.institution_id" name="institution" :class="'form-control '+(errors.institution_id.$error ? 'is-invalid ' : '')" data-toggle="select">
                    <option value="undefined" disabled>Select an Option</option>
                    <option v-for="institution in institutions" :key="institution.id" :value="institution.id">{{ institution.name }}</option>
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
