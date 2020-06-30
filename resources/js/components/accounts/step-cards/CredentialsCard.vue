<template>
    <div>

        <h3 class="mb-5">Credentials</h3>

        <div class="row">
            <!-- Project name -->
            <div class="form-group col-md-6">
                <label>
                    Username
                </label>
                <input v-model="account.username" name="name" type="text" :class="'form-control '+(errors.username.$error ? 'is-invalid ' : '')">
            </div>


            <div class="form-group col-md-6">
                <label>
                    Password
                </label>
                <input v-model="account.password" name="name" type="text" :class="'form-control '+(errors.password.$error ? 'is-invalid ' : '')">
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
