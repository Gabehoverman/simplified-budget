<template>
    <!-- Modal -->
    <div class="form-group col-md-12">
        <content-loader v-if="!connect_widget_url"
            :width="400"
            :height="160"
            :speed="2"
            primaryColor="#f3f3f3"
            secondaryColor="#ecebeb"
        >
            <rect x="42" y="57" rx="4" ry="4" width="417" height="29" />
            <rect x="42" y="105" rx="4" ry="4" width="67" height="15" />
            <rect x="127" y="105" rx="4" ry="4" width="147" height="15" />
            <circle cx="739" cy="109" r="9" />
            <circle cx="765" cy="109" r="9" />
            <rect x="217" y="157" rx="4" ry="4" width="433" height="291" />
            <rect x="359" y="457" rx="4" ry="4" width="150" height="10" />
            <rect x="48" y="515" rx="4" ry="4" width="720" height="15" />
            <rect x="49" y="547" rx="4" ry="4" width="598" height="15" />
            <rect x="48" y="581" rx="4" ry="4" width="720" height="15" />
            <rect x="49" y="612" rx="4" ry="4" width="520" height="15" />
            <rect x="48" y="652" rx="4" ry="4" width="720" height="15" />
            <rect x="48" y="684" rx="4" ry="4" width="598" height="15" />
            <rect x="48" y="718" rx="4" ry="4" width="720" height="15" />
            <rect x="49" y="748" rx="4" ry="4" width="419" height="15" />
            <circle cx="713" cy="810" r="9" />
            <circle cx="739" cy="810" r="9" />
            <rect x="41" y="836" rx="4" ry="4" width="720" height="3" />
            <rect x="122" y="880" rx="4" ry="4" width="320" height="11" />
            <circle cx="79" cy="900" r="26" />
            <rect x="135" y="901" rx="4" ry="4" width="120" height="10" />
            <rect x="123" y="949" rx="4" ry="4" width="320" height="11" />
            <circle cx="80" cy="969" r="26" />
            <rect x="136" y="970" rx="4" ry="4" width="120" height="10" />
            <rect x="124" y="1021" rx="4" ry="4" width="320" height="11" />
            <circle cx="81" cy="1041" r="26" />
            <rect x="137" y="1042" rx="4" ry="4" width="120" height="10" />
            <rect x="125" y="1090" rx="4" ry="4" width="320" height="11" />
            <circle cx="82" cy="1110" r="26" />
            <rect x="138" y="1111" rx="4" ry="4" width="120" height="10" />
        </content-loader>
        <div id="addAccount"></div>
    </div>
</template>

<script>
    import { ContentLoader } from 'vue-content-loader'

    export default {
        props: ['account'],
        data() {
            return {
                connect_widget_url: null
            }
        },
        components: {
            ContentLoader
        },
        mounted() {
            // fetch iFrame url
            var self = this;
            this.asyncFetchData('/mx/widget')
            .then( function( response ) {
                self.connect_widget_url = response.user.connect_widget_url;
                var mxConnect = new MXConnect({
                    id: "addAccount",
                    url: response.user.connect_widget_url,
                    onLoad: function () {
                        // Connect widget successfully loaded
                        console.log("On Load");
                    },
                    onSuccess: function (reponse) {
                        console.log(reponse)
                        // Member created successfully
                        console.log("On Success");
                        // Fetch member data and preload remaing fields
                        self.asyncFetchData('/mx/members/'+reponse.member_guid+'/link').then( function(response) {
                            //todo: remove connection widget after successfully connecting
                            console.log(response);
                            self.connect_widget_url = null;
                            self.account = response;
                            self.$emit('updateAccount', self.account)
                            // mxConnect.destroy()
                        });
                    },
                });

                mxConnect.load();
            })
        }
    }
</script>

<style scoped>
    iframe {
        width: 100%;
        border: none;
        min-height: 350px;
    }
</style>
