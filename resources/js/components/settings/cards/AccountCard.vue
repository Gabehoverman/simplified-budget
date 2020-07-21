<template>
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3>Update Password</h3>
                </div>
            </div> <!-- / .row -->
        </div>
        <div class="card-body row">
            <div class="form-group row col-6">
                <label for="name" class="col-md-12 col-form-label">New Password</label>
                <div class="col-md-12">
                    <input id="email" type="password" :class="'form-control '+($v.dataUser.password.$error ? 'is-invalid ' : '')"
                                name="email" required autocomplete="name" v-model="dataUser.password">
                </div>
            </div>

            <div class="form-group row col-6">
                <label for="name" class="col-md-12 col-form-label">Confirm New Password</label>

                <div class="col-md-12">
                    <input id="email" type="password" :class="'form-control '+($v.dataUser.confirmPassword.$error ? 'is-invalid ' : '')"
                                name="email" required autocomplete="name" v-model="dataUser.confirmPassword">
                </div>
            </div>
            {{ $v.invalid }}
            <div class="form-group col-12 text-right mt-3">
                <button @click="updateProfile" class="btn btn-primary pull-right">Save</button>
            </div>
        </div>
    </div>
</template>

<script>
    import { required, minLength, sameAs } from 'vuelidate/lib/validators'

    export default {
        props: ['user'],
        data() {
            return {
                dataUser: this.user
            }
        },
        methods: {
            updateProfile() {
                this.$v.dataUser.$touch()
                if (!this.$v.$invalid) {
                    this.$emit('updateProfile', this.dataUser)
                }
            }
        },
        validations: {
            dataUser: {
                password: {
                    required
                },
                confirmPassword: {
                    required,
                    sameAsPassword: sameAs('password')
                }
            }
        }
    }
</script>
