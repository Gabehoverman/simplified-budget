<template>
    <div>
        <h3 class="mb-5 card-lead">Select a Bank</h3>

        <div class="row">

            <!-- Project tags -->
            <div class="form-group col-md-12 text-right" v-if="user.plan != 'Free'">
                <div class="custom-control custom-checkbox form-group mb-0">
                    <input v-model="dataAccount.manual_account" class="custom-control-input" id="checklistOne" type="checkbox" />
                    <label class="custom-control-label" for="checklistOne"></label>
                    <span class="custom-control-caption">
                        Create A Manual Account
                    </span>
                </div>
            </div>

            <div class="form-group col-md-12" v-if="( dataAccount.manual_account == true && !onboarding ) || ( user.plan == 'Free' && !onboarding )">
                <label>
                    Institution
                </label>
                <select v-model="dataAccount.institution_id" name="type" :class="'form-control '+(errors.institution_id.$error ? 'is-invalid ' : '')" data-toggle="select">
                    <option value="null">Select Institution</option>
                    <option v-for="institution in institutions" :key="institution.id" :value="institution.id">{{ institution.name }}</option>
                </select>
            </div>

            <frame-widget-component
                v-if="dataAccount.manual_account != true && user.plan != 'Free'"
                :account="account"
                @updateAccount="updateAccount( $event )"
            />
        </div>
    </div>
</template>

<script>
    import FrameWidgetComponent from '../mx-integration/FrameWidgetComponent';

    export default {
        props: ['account', 'institutions', 'errors', 'onboarding', 'user'],
        components: {
            FrameWidgetComponent
        },
        data() {
            return {
                dataAccount: this.account
            }
        },
        methods: {
            updateAccount( $event ) {
                console.log('UPDATE')
                console.log($event)
                // this.dataAccount = $event;
                this.$emit('updateAccount', $event)
            },
            manualAccount() {
                var self = this;
                //todo: post to /accounts to create a new account, then pass that up
            }
        },
        mounted() {
            console.log('Component mounted.')
            if ( this.user.plan == 'Free' ) {
                this.dataAccount.manual_account = true;
            }
        }
    }
</script>
