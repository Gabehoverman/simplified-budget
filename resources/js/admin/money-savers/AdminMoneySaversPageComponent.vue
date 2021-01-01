<template>
    <div class="container-fluid ">
    <notifications group="notification"/>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-12 col-xl-12">

                <!-- Header -->
                <div class="header">
                    <div class="header-body">
                        <div class="row align-items-center mt-md-5">
                            <div class="col">

                                <!-- Pretitle -->
                                <h6 class="header-pretitle">
                                    Money Savers / Manage
                                </h6>

                                <!-- Title -->
                                <h1 class="header-title">
                                    Money Savers
                                </h1>

                            </div>
                            <div class="col text-right">
                                <button
                                    v-if="selectedTab == 'money-savers'"
                                    type="button"
                                    :class="'btn btn-primary ' + (moneySaverTypes.length < 1 ? 'disabled' : '' )"
                                    :disabled="(moneySaverTypes.length < 1 ? true : false )"
                                    data-toggle="modal"
                                    data-target="#moneySaverModal"
                                    @click="unselectMoneySaver()"
                                    >New Money Saver
                                </button>

                                <button
                                    v-if="selectedTab == 'types'"
                                    type="button"
                                    class="btn btn-primary"
                                    data-toggle="modal"
                                    data-target="#moneySaverTypeModal"
                                    @click="unselectMoneySaverType()"
                                    >New Money Saver Type
                                </button>
                            </div>
                        </div> <!-- / .row -->
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Nav -->
                                <ul class="nav nav-tabs nav-overflow header-tabs">
                                    <li class="nav-item">
                                        <a @click="selectTab('money-savers')" href="#!" :class="selectedTab == 'money-savers' ? 'nav-link active' : 'nav-link'">
                                            Money Savers
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a @click="selectTab('types')" href="#!" :class="selectedTab == 'types' ? 'nav-link active' : 'nav-link'">
                                            Types
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <money-savers-table-component
                    v-if="selectedTab == 'money-savers'"
                    :money-savers="moneySavers"
                    @editMoneySaver="editMoneySave($event)"
                    @deleteMoneySaver="deleteMoneySaver($event)"
                />

                <money-saver-type-table-component
                    v-if="selectedTab == 'types'"
                    :money-saver-types="moneySaverTypes"
                    @editMoneySaverType="editMoneySaverType($event)"
                    @deleteMoneySaverType="deleteMoneySaverType($event)"
                />
            </div>

            <money-saver-modal-component
                :key="modalKey"
                :moneySaver="selectedMoneySaver"
                :moneySaverTypes="moneySaverTypes"
                :categories="$transactionCategories"
                @saveMoneySaver="saveMoneySaver($event)"
                @deleteMoneySaver="deleteMoneySaver($event)"
            />

            <money-saver-type-modal-component
                :key="modalKeyTypes"
                :moneySaverType="selectedMoneySaverType"
                :categories="$transactionCategories"
                :institutions="institutions"
                @saveMoneySaverType="saveMoneySaverType($event)"
                @deleteMoneySaverType="deleteMoneySaverType($event)"
            />

        </div>
    </div>
</template>

<script>
    import MoneySaversTableComponent from './components/MoneySaversTableComponent'
    import MoneySaverModalComponent from './components/MoneySaverModalComponent'
    import MoneySaverTypeTableComponent from './type-components/MoneySaverTypeTableComponent'
    import MoneySaverTypeModalComponent from './type-components/MoneySaverTypeModalComponent'

    export default {
        props: ['money-savers', 'money-saver-types' ,'institutions'],
        data() {
            return {
                selectedTab: 'money-savers',
                dataMoneySavers: this.moneySavers,
                dataMoneySaverTypes: this.moneySaverTypes,
                selectedMoneySaver: {},
                selectedMoneySaverType: {},
                modalKey: 0,
                modalKeyTypes: 999
            }
        },
        components: {
            MoneySaversTableComponent,
            MoneySaverModalComponent,
            MoneySaverTypeTableComponent,
            MoneySaverTypeModalComponent
        },
        methods: {
            selectTab( tab ) {
                this.selectedTab = tab;
            },
            editMoneySave( moneySaver ) {
                this.selectedMoneySaver = moneySaver;
            },
            editMoneySaverType( moneySaverType ) {
                this.selectedMoneySaverType = moneySaverType;
            },
            unselectMoneySaver() {
                this.selectedMoneySaver = {};
            },
            unselectMoneySaverType() {
                this.selectedMoneySaverType = {};
            },
            saveMoneySaver( moneySaver ) {
                var self = this;
                let url = '/admin/money-savers' + ( moneySaver.id ? '/'+moneySaver.id : '')
                let method = moneySaver.id ? 'PUT' : 'POST'
                this.asyncSendData(moneySaver, url, method).then( function( response ) {
                    if (!moneySaver.id) {
                        self.$set(self.moneySavers, self.moneySavers.length, response)
                        self.showNotification('success', 'Money Saver Created Successfully!')
                    } else {
                        let index = self.moneySavers.map(function (x) { return x.id; }).indexOf(response.id);
                        self.$set(self.moneySavers, index, response)
                        if (response.id == self.selectedMoneySaver.id) {
                            self.$set(self.selectedMoneySaver, response)
                            self.selectedMoneySaver = response;
                        }
                        self.showNotification('success', 'Money Saver Updated Successfully!')
                    }
                    self.modalKey += 1;
                })
            },
            deleteMoneySaver( moneySaver ) {
                var self = this;
                this.asyncSendData(moneySaver, '/admin/money-savers/'+moneySaver.id, 'DELETE').then( function( response ) {
                    let index = self.moneySavers.map(function (x) { return x.id; }).indexOf(moneySaver.id);
                    self.$delete(self.moneySavers, index)
                    self.showNotification('success', 'Money Savers Successfully Removed!')
                })
            },
            saveMoneySaverType( moneySaverType ) {
                var self = this;
                let url = '/admin/money-saver-types' + ( moneySaverType.id ? '/'+moneySaverType.id : '')
                let method = moneySaverType.id ? 'PUT' : 'POST'
                this.asyncSendData(moneySaverType, url, method).then( function( response ) {
                    if (!moneySaverType.id) {
                        self.$set(self.moneySaverTypes, self.moneySaverTypes.length, response)
                        self.showNotification('success', 'Money Saver Type Created Successfully!')
                    } else {
                        let index = self.moneySaverTypes.map(function (x) { return x.id; }).indexOf(response.id);
                        self.$set(self.moneySaverTypes, index, response)
                        if (response.id == self.selectedMoneySaverType.id) {
                            self.$set(self.selectedMoneySaverType, response)
                            self.selectedMoneySaverType = response;
                        }
                        self.showNotification('success', 'Money Save Type Updated Successfully!')
                    }
                    self.modalKeyTypes += 1;
                })
            },
            deleteMoneySaverType( moneySaverType ) {
                var self = this;
                this.asyncSendData(moneySaverType, '/admin/money-saver-types/'+moneySaverType.id, 'DELETE').then( function( response ) {
                    let index = self.moneySaverTypes.map(function (x) { return x.id; }).indexOf(moneySaverType.id);
                    self.$delete(self.moneySaverTypes, index)
                    self.showNotification('success', 'Money Savers Type Successfully Removed!')
                })
            },
        }
    }
</script>
