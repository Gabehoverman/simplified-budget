<template>
    <div class="container col-12">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Account Details</div>

                    <div class="card-body">
                        <div class="row" style="display: flex; justify-content: space-between">
                            <p>Account Name</p>
                            <p>{{ account.name }}</p>
                        </div>
                        <div class="row" style="display: flex; justify-content: space-between">
                            <p>Institution</p>
                            <p>{{ account.institution }}</p>
                        </div>
                        <div class="row" style="display: flex; justify-content: space-between">
                            <p>Balance</p>
                            <p>{{ account.balance ? account.balance : '--' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['account'],
        mounted() {
        }
    }
</script>
