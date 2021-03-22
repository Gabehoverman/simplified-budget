<template>
    <div class="col-12">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3>Notifications</h3>
                    </div>

                    <div class="card-body row">

                        <div class="col-md-6">

                            <div class="form-group row col-12">
                                <label>Primary Admin Email</label>
                                <input class="form-control" type="text" v-model="adminSiteSettings.admin_email">
                            </div>

                            <div class="form-group row col-12">
                                <label>Additional Admin Emails (CC)</label>
                                <input class="form-control" type="text" v-model="adminSiteSettings.additional_admin_emails">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group row col-12" style="padding: 10px 25px;">
                                <toggle-button v-model="adminSiteSettings.email_new_member"
                                    name="email_new_member"
                                    color="#0095f7"
                                    :labels="{checked: 'Yes', unchecked: 'No'}"
                                />
                                <span>&nbsp &nbsp Receive New Member Signup Emails</span>
                            </div>

                            <div class="form-group row col-12" style="padding: 10px 25px;">
                                <toggle-button v-model="adminSiteSettings.email_daily_report"
                                    name="email_daily_report"
                                    color="#0095f7"
                                    :labels="{checked: 'Yes', unchecked: 'No'}"
                                />
                                <span>&nbsp &nbsp Receive Daily Reports on Site Activity</span>
                            </div>

                            <div class="form-group row col-12" style="padding: 10px 25px;">
                                <toggle-button v-model="adminSiteSettings.email_weekly_report"
                                    name="email_weekly_report"
                                    color="#0095f7"
                                    :labels="{checked: 'Yes', unchecked: 'No'}"
                                />
                                <span>&nbsp &nbsp Receive Weekly Reports on Site Activity</span>
                            </div>

                            <div class="form-group col-12 text-right">
                                <div class="col-12 text-right">
                                    <button @click="updateSettings()" class="btn btn-primary pull-right">Save</button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['admin-site-settings'],
        methods: {
            updateSettings() {
                console.log( this.adminSiteSettings )
                this.asyncSendData(this.adminSiteSettings, '/admin/settings/'+this.adminSiteSettings.id, 'PUT').then( function( response)  {
                    console.log( response );
                })
            }
        },
        mounted() {
        }
    }
</script>
