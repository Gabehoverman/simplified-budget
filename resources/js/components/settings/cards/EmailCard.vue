<template>
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3>Email Preferences</h3>
                </div>
            </div> <!-- / .row -->
        </div>
        <div class="card-body">
            <div class="form-group row col-12" style="padding: 10px 25px;">
                <toggle-button v-model="user.notifications"
                    color="#0095f7"
                    :labels="{checked: 'Yes', unchecked: 'No'}"
                />
                <span>&nbsp &nbsp Receive Notifications and Alerts</span>
            </div>
            <div class="form-group row col-12" style="padding: 10px 25px;">
                <toggle-button v-model="user.notifications"
                    color="#0095f7"
                    :labels="{checked: 'Yes', unchecked: 'No'}"
                />
                <span>&nbsp &nbsp Receive Marketing Emails & Promotions</span>
            </div>
            <div class="form-group col-12 text-right">
                <div class="col-12 text-right">
                    <button class="btn btn-primary pull-right">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { required, minLength, sameAs } from 'vuelidate/lib/validators'

    export default {
        props: ['user']
    }
</script>
