<template>
    <div>
        <h3 class="mb-5 card-lead">Select a Bank</h3>

        <div class="row">

            <!-- Project tags -->
            <div class="form-group col-md-12">
                <label>
                    Account Type
                </label>
                <select v-model="account.institution" name="institution" :class="'form-control '+(errors.institution.$error ? 'is-invalid ' : '')" data-toggle="select">
                    <option value="undefined" disabled>Select an Option</option>
                    <option value="Bank of America">Bank of America</option>
                    <option value="Wells Fargo">Wells Fargo</option>
                    <option value="Ally Financial">Ally Financial</option>
                    <option value="Citi Bank">Citi Bank</option>
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
