<template>
    <div>
        <h3 class="mb-5 card-lead">Select a Bank</h3>

        <div class="row">

            <!-- Project tags -->
            <div class="form-group col-md-12">
                <!-- <label>
                    Account Type
                </label>

                <select v-model="account.institution_id" name="institution" :class="'form-control '+(errors.institution_id.$error ? 'is-invalid ' : '')" data-toggle="select">
                    <option value="undefined" disabled>Select an Option</option>
                    <option v-for="institution in institutions" :key="institution.id" :value="institution.id">{{ institution.name }}</option>
                </select> -->

                <frame-widget-component
                    :account="account"
                    @updateAccount="updateAccount( $event )"
                />
            </div>
        </div>

    </div>
</template>

<script>
    import FrameWidgetComponent from '../mx-integration/FrameWidgetComponent';

    export default {
        props: ['account', 'institutions', 'errors'],
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
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
