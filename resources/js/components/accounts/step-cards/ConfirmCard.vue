<template>
    <div>

        <h3 class="mb-5">Confirmation</h3>

        <div class="row">
            <!-- Project name -->
            <div class="form-group col-md-6">
                <label>
                    Account Name:
                </label>
                {{ account.name }}
            </div>

               <div class="form-group col-md-6">
                <label>
                    Account Type:
                </label>
                {{ getAccountLabel(account.type) }}
            </div>

            <div class="form-group col-md-6">
                <label>
                    Tracking Type:
                </label>
                {{ getTrackingTypeLabel(account.tracking_type) }}
            </div>

            <div class="form-group col-md-6">
                <label>
                    Tracking Options:
                </label>
                {{ getTrackingLabel(account.tracking_options) }}
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
