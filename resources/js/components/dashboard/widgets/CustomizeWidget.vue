<template>
    <div>
        <div class="customize-widget">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Customize Dashboard
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Customize Dashboard</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <draggable v-model="customDashboardComponents" group="people" @start="drag=true" @end="drag=false">
                        <div v-for="element in customDashboardComponents" :key="element.key">
                        <div class="row col-12 draggable">
                            <div class="col-md-1">
                                <span class="fe fe-more-vertical mr-4"></span>
                            </div>
                            <div class="col-md-9">
                                {{ element.name }}
                            </div>
                            <div class="col-md-2">
                                <toggle-button v-model="element.show"
                                    color="#0095f7"
                                    :labels="{checked: 'Show', unchecked: 'Hide'}"
                                />
                            </div>
                            </div>
                        </div>
                    </draggable>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="saveChanges()">Save changes</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import draggable from 'vuedraggable'

    export default {
        props: ['user'],
        data() {
            return {
                userOrder: [],
                customDashboardComponents: []
            }
        },
        methods: {
            saveChanges() {
                this.$emit('updateCustomDashboard', this.customDashboardComponents)
            }
        },
        components: {
            draggable,
        },
        mounted() {
            this.customDashboardComponents = this.user.custom_dashboard
        }
    }
</script>

<style scoped>
    .customize-widget {
        position: fixed;
        bottom: 40px;
        right: 40px;
        z-index: 100;
        border-radius: 8px;
        box-shadow: 5px 5px 15px rgb(0 0 0 / 30%);
    }

    .draggable {
        margin: 5px 0px;
        border: 1px solid rgb(239, 239, 239);
        border-radius: 5px;
        padding: 15px 0px 5px;
        box-shadow: 0 0.75rem 1.5rem rgb(18 38 63 / 3%)
    }
</style>
