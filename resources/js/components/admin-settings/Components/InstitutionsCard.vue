<template>
    <div class="container col-12">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card" data-toggle="lists" data-lists-values='["institutions-id", "institutions-name", "institutions-asset"'>
                    <div class="card-header">
                        <div class="row">
                                <div class="col">
                                    <h3>Institutions</h3>
                                </div>
                                <div class="col-auto pull-right">
                                    <button
                                        @click="newInstitution()"
                                        type="button"
                                        class="btn btn-sm btn-primary"
                                        data-toggle="modal"
                                        data-target="#newInstitutionModal"
                                        >Add Institution
                                    </button>

                                    <new-institution-modal
                                        :key="modalKey"
                                        :institution="selectedInstitution"
                                        @saveInstitution="saveInstitution($event)"
                                    />
                                </div>
                            </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm table-nowrap card-table">
                        <thead>
                            <tr>
                            <th>
                                <a href="#" class="text-muted sort" data-sort="institutions-id">
                                    #
                                </a>
                            </th>
                            <th>
                                <a href="#" class="text-muted sort" data-sort="institutions-name">
                                Name
                                </a>
                            </th>
                                <th>
                                <a href="#" class="text-muted sort" data-sort="institutions-asset">
                                Asset
                                </a>
                            </th>
                            <th colspan="2">
                                <a href="#" class="text-muted">
                                Actions
                                </a>
                            </th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <tr v-for="(institution, index ) in dataInstitutions" :key="index">
                            <td class="institutions-order">
                                {{ index + 1 }}
                            </td>
                            <td class="institutions-category">
                                <!-- <a href="#" @click="editInstitution(institution)"> -->
                                <a @click="editInstitution( institution )" href="#!" class="dropdown-item" data-toggle="modal" data-target="#newInstitutionModal">
                                    {{ institution.name }}
                                </a>
                            </td>
                            <td class="institutions-institution">
                                <div style="max-height: 50px; overflow: hidden;">
                                    <img :src="institution.asset" width="200">
                                </div>
                                <!-- {{ institution.asset }} -->
                            </td>
                            <td class="text-right">
                                <div class="dropdown">
                                    <a href="#!" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="window">
                                        <i class="fe fe-more-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a @click="editInstitution( institution )" href="#!" class="dropdown-item" data-toggle="modal" data-target="#newInstitutionModal">
                                        Edit
                                        </a>
                                        <a @click="deleteInstitution( institution )" href="#!" class="dropdown-item">
                                        Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import NewInstitutionModal from './Institutions/NewInstitutionModal'

    export default {
        props: ['institutions'],
        components: {
            NewInstitutionModal
        },
        data() {
            return {
                dataInstitutions: this.institutions,
                selectedInstitution: {},
                modalKey: 0
            }
        },
        methods: {
            editInstitution ( institution ) {
                this.selectedInstitution = institution
            },
            newInstitution() {
                this.selectedInstitution = {};
            },
            saveInstitution( institution ) {
                var self = this;
                let url = '/institutions' + ( institution.id ? '/'+institution.id : '')
                let method = institution.id ? 'PUT' : 'POST'
                this.asyncSendData(institution, url, method).then( function( response ) {
                    if (!institution.id) {
                        self.$set(self.institutions, self.institutions.length, response)
                        self.showNotification('success', 'Institution Posted Successfully!')
                    } else {
                        self.showNotification('success', 'Institution Updated Successfully!')
                    }
                    self.modalKey += 1;
                })
            },
            deleteInstitution( institution ) {
                var self = this;
                this.asyncSendData(institution, '/institutions/'+institution.id, 'DELETE').then( function( response ) {
                    let index = self.institutions.map(function (x) { return x.id; }).indexOf(institution.id);
                    self.$delete(self.institutions, index)
                    self.showNotification('success', 'Institution Successfully Removed!')
                })
            }
        },
        mounted() {
        }
    }
</script>
