<template>
    <div>
        <admin-overview-graph-card
            :users="users"
            :weeklyNewUsers="weeklyNewUsers"
            :monthlyNewUsers="monthlyNewUsers"
            :annualNewUsers="annualNewUsers"
            @updateDate="updateData( $event )"
        />
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-12 col-xl-8">

                    <admin-widget-row
                        :users="users"
                        :filter="dataFilter"
                        :weeklyNewUsers="weeklyNewUsers"
                        :monthlyNewUsers="monthlyNewUsers"
                        :annualNewUsers="annualNewUsers"
                    />

                    <admin-user-graph-card
                        :analyticsData="analyticsData"
                    />
                </div>
                <!-- <div class="col-12 col-xl-3">
                    <admin-growth-graph-card

                    />
                </div> -->
                <div class="col-12 col-xl-4">
                    <admin-activity-card
                        :activity="activity"
                    />
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import AdminOverviewGraphCard from './cards/AdminOverviewGraphCard';
    import AdminUserGraphCard from './cards/AdminUserGraphCard';
    import AdminGrowthGraphCard from './cards/AdminGrowthGraphCard'
    import AdminActivityCard from './cards/AdminActivityCard'
    import AdminWidgetRow from './widgets/AdminWidgetRow'

    export default {
        name: 'admin-dashboard-page-component',
        props: [
            'users',
            'accounts',
            'transactions',
            'weeklyNewUsers',
            'monthlyNewUsers',
            'annualNewUsers',
            'activity',
            'analyticsData'
        ],
        components: {
            AdminOverviewGraphCard,
            AdminUserGraphCard,
            AdminGrowthGraphCard,
            AdminActivityCard,
            AdminWidgetRow
        },
        data() {
            return {
                dataFilter: 'weekly',
                dataSet: this.weeklyNewUsers
            }
        },
        methods: {
            updateData( data ) {
                this.dataFilter = data;
            }
        },
        mounted() {
        }
    }
</script>
