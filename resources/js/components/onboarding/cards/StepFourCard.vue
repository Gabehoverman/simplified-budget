<template>
    <div class="tab-pane fade show active mb-5" id="wizardStepTwo" role="tabpanel" aria-labelledby="wizardTabTwo">

        <!-- Header -->
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 text-center">

                <!-- Pretitle -->
                <h6 class="mb-4 text-uppercase text-muted">
                    Step 4 of 4
                </h6>

                <!-- Title -->
                <h1 class="mb-3">
                    Congrats, you're ready to go!
                </h1>

                <!-- Subtitle -->
                <p class="mb-5 text-muted">
                    That's all the info we need to get started. We'll take you to your dashbord next.
                </p>

            </div>

            <div class="row">
                <div class="col-12">
                    <div class="checklist" tabindex="0">
                        <div class="custom-control custom-checkbox checklist-control" tabindex="0">
                            <input class="custom-control-input" id="checklistTwo" type="checkbox" checked="" disabled>
                            <label class="custom-control-label" for="checklistTwo"></label>
                            <span class="custom-control-caption">
                                Set up your profile
                            </span>
                        </div>
                        <div class="custom-control custom-checkbox checklist-control" tabindex="0">
                            <input class="custom-control-input" id="checklistFive" type="checkbox" checked="" disabled>
                            <label class="custom-control-label" for="checklistFive"></label>
                            <span class="custom-control-caption">
                                Reviewed your financial goals
                            </span>
                        </div>
                        <div class="custom-control custom-checkbox checklist-control" tabindex="0">
                            <input class="custom-control-input" id="checklistThree" type="checkbox" checked="" disabled>
                            <label class="custom-control-label" for="checklistThree"></label>
                            <span class="custom-control-caption">
                                Added your first account
                            </span>
                        </div>
                        <div class="custom-control custom-checkbox checklist-control" tabindex="0">
                            <input class="custom-control-input" id="checklistFour" type="checkbox" checked="" disabled>
                            <label class="custom-control-label" for="checklistFour"></label>
                            <span class="custom-control-caption">
                                Recorded some transactions
                            </span>
                        </div>

                        </div>
                </div>
            </div>
        </div> <!-- / .row -->
    </div>
</template>

<script>
    import BankCard from '../../accounts/step-cards/BankCard'
    import CredentialsCard from '../../accounts/step-cards/CredentialsCard'
    import SettingsCard from '../../accounts/step-cards/SettingsCard'

    export default {
        props: ['account', 'errors'],
    }
</script>


<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
        transition: opacity .5s
    }
    .custom-control-label:after, .custom-control-label:before {
        top: -12px;
    }
</style>

