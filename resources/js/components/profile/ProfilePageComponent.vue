<template>
    <div class="container-fluid ">
    <notifications group="notification"/>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-12 col-xl-12">

                <!-- Header -->
                <div class="header mt-md-5">
                    <div class="">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Pretitle -->
                                <h6 class="header-pretitle">
                                    Profile / Manage
                                </h6>

                                <!-- Title -->
                                <!-- <h1 class="header-title">
                                Create a new project
                                </h1> -->

                            </div>
                        </div>
                    </div> <!-- / .row -->
                </div>
            </div>

            <div class="col-12 col-lg-12">
                <div class="card row" style="flex-direction: row; padding: 25px;">
                    <div class="card-header col-12" style="border-bottom: 0px;">
                        <h3>My Profile</h3>
                    </div>

                    <div class="col-4 card" style="padding: 25px;">
                        <img height="150" width="150" :src="asset('/img/avatars/profiles/avatar.png')" alt="..." class="rounded-circle" style="margin: auto">
                        <h5>Profile</h5>
                        <span>{{ user.first_name }} {{ user.last_name }}</span>
                        <span>{{ user.email }}</span>
                    </div>

                    <div class="col-8 row">
                        <h4 class="col-12 mt-3 mb-4">Update Details</h4>

                        <div class="form-group row col-6">
                            <label for="first_name" class="col-md-12 col-form-label">First Name</label>

                            <div class="col-md-12">
                                <input id="first_name" type="text" :class="'form-control '+($v.user.first_name.$error ? 'is-invalid ' : '')"
                                            name="first_name" required autocomplete="first_name" v-model="user.first_name">
                            </div>
                        </div>

                        <div class="form-group row col-6">
                            <label for="last_name" class="col-md-12 col-form-label">Last Name</label>

                            <div class="col-md-12">
                                <input id="last_name" type="text" :class="'form-control '+($v.user.last_name.$error ? 'is-invalid ' : '')"
                                            name="last_name" required autocomplete="last_name" v-model="user.last_name">
                            </div>
                        </div>

                        <div class="form-group row col-6">
                            <label for="name" class="col-md-12 col-form-label">Email</label>

                            <div class="col-md-12">
                                <input id="email" type="text" :class="'form-control '+($v.user.email.$error ? 'is-invalid ' : '')"
                                            name="email" required autocomplete="name" v-model="user.email">
                            </div>
                        </div>

                        <div class="form-group row col-6">
                            <label for="name" class="col-md-12 col-form-label">Phone</label>

                            <div class="col-md-12">
                                <vue-mask type="text" class="form-control" name="phone" mask="000-000-0000" v-model="user.phone" :options="{raw: true}"/>
                            </div>
                        </div>

                        <div class="form-group row col-6">
                            <label for="income" class="col-md-12 col-form-label">Annual Income</label>

                            <div class="col-md-12">
                                <input id="income" type="text" :class="'form-control '+($v.user.income.$error ? 'is-invalid ' : '')"
                                            name="income" required autocomplete="income" v-model="user.income">
                            </div>
                        </div>

                        <div class="form-group row col-6">
                            <label for="pay" class="col-md-12 col-form-label">Monthly Take Home Pay</label>

                            <div class="col-md-12">
                                <input id="pay" type="text" :class="'form-control '+($v.user.pay.$error ? 'is-invalid ' : '')"
                                            name="pay" required autocomplete="pay" v-model="user.pay">
                            </div>
                        </div>

                        <div class="form-group row col-12">
                            <label for="pay" class="col-md-12 col-form-label">Financial Goals</label>

                            <div class="col-md-12">
                                <select v-model="user.goals" :class="'form-control '+($v.user.goals.$error ? 'is-invalid ' : '')">
                                    <option value="0">Save More Money</option>
                                    <option value="1">Pay Down Debt</option>
                                    <option value="2">Track My Spending</option>
                                </select>
                            </div>
                        </div>

                        <!-- <div class="form-group row col-6">
                            <label for="name" class="col-md-12 col-form-label">New Password (optional)</label>
                            <div class="col-md-12">
                                <input id="email" type="password" :class="'form-control '+($v.user.password.$error ? 'is-invalid ' : '')"
                                            name="email" required autocomplete="name" v-model="user.password">
                            </div>
                        </div>

                        <div class="form-group row col-6">
                            <label for="name" class="col-md-12 col-form-label">Confirm New Password</label>

                            <div class="col-md-12">
                                <input id="email" type="password" :class="'form-control '+($v.user.confirmPassword.$error ? 'is-invalid ' : '')"
                                            name="email" required autocomplete="name" v-model="user.confirmPassword">
                            </div>
                        </div> -->

                        <!-- <div class="form-group row col-12" style="padding: 10px 25px;">
                            <toggle-button v-model="user.notifications"
                                color="#0095f7"
                                :labels="{checked: 'Yes', unchecked: 'No'}"
                            />
                            <span>&nbsp &nbsp Receive Notifications and Alerts</span>

                        </div> -->

                        <div class="col-12 text-right">
                            <button @click="updateProfile()" class="btn btn-primary">Submit</button>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import { required, minLength, sameAs } from 'vuelidate/lib/validators'

    export default {
        name: 'profile-page-component',
        props: ['user'],
        data() {
            return {
                dataUser: this.user
            }
        },
        methods: {
            updateProfile() {
                var self = this;
                this.$v.user.$touch()
                if (!this.$v.$invalid) {
                    this.asyncSendData(this.user, '/profile/update', 'PUT').then( function( response ) {
                        self.user = response;
                        self.showNotification('success', 'Profile Updated Successfully!')
                    })
                }
            }
        },
        watch: {
            "user.income": function() {
                this.user.pay = (this.user.income / 12).toFixed(2);
            }
        },
        validations: {
            user: {
                first_name: {
                    required
                },
                last_name: {
                    required
                },
                email: {
                    required
                },
                income: {
                    required
                },
                pay: {
                    required
                },
                goals: {
                    required
                },
                // password: {
                //     // required: requiredUnless('isOptional'),
                // },
                // confirmPassword: {
                //     sameAsPassword: sameAs('password')
                // }
            }
        }
    }
</script>
