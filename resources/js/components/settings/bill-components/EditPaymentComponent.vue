<template>
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title" id="billingModalLabel">
                Update Payment Method
            </h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- Stripe Elements Placeholder -->
            <div id="card-element"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="card-button" type="button" :class="'btn btn-primary' + ( this.saving ? ' disabled' : '')" @click="saveChanges()">Save changes</button>
        </div>
    </div>
</template>

<script>

export default {
    props: ['stripe-pk', 'intent'],
    data() {
        return {
            Stripe: null,
            cardElement: null,
            clientSecret: this.intent.client_secret,
            saving: false
        }
    },
    methods: {
        async saveChanges() {
            var self = this
            self.saving = true
              const { setupIntent, error } = await self.Stripe.confirmCardSetup(
                self.clientSecret, {
                    payment_method: {
                        card: self.cardElement,
                    }
                }
            );
            if (error) {
                // Display "error.message" to the user...
                self.saving = false
                self.showNotification('error', 'Could not connect card')
            } else {
                // The card has been verified successfully...
                self.asyncSendData( setupIntent, '/settings/billing/card', 'POST').then( function( response) {
                    self.$emit('updateCard', response);
                    self.saving = false
                })
            }
        }
    },
    mounted() {
        var self = this;
        $(document).ready( function() {
             self.Stripe = Stripe( self.stripePk )
            let elements = self.Stripe.elements()

            self.cardElement = elements.create('card');
            self.cardElement.mount('#card-element');
        })
    }
};
</script>
