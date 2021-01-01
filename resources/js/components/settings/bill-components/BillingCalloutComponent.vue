<template>
    <div class="col-12" v-if="!user.card_brand && !user.card_last_four && !user.on_trial && user.plan != 'Free'">
        <div class="card" style="border: 1px solid red;">
            <div class="card-body row">
                Please add a payment method to your account or downgrade to the free tier to continue using Simplified Budget
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['user']
}
</script>
