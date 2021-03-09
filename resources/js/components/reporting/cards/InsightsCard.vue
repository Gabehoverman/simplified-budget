<template>
    <div class="card" style="height: calc(100% - 25px)">
        <div class="card-header">
            <h4 class="card-header-title">Insights</h4>
        </div>
        <div class="card-body" style="height: calc(100% - 25px)">
            <p>{{ insights }}</p>

        </div>
    </div>
</template>

<script>
    export default {
        props: ['monthlyTransactions', 'previousMonthlyTransactions', 'categories'],
        computed: {
            insights() {
                let insights = '';
                insights += 'Your highest spending category of this month was '+Object.keys(this.categories)[0]+'.';
                return insights
            }
        }
    }
</script>
