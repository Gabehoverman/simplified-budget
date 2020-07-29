<template>
  <div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="newInstitutionModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="newInstitutionModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="newInstitutionModalLabel">Add Institution</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form>
                <div class="form-group">
                    <label for="nameInput">Name</label>
                    <input v-model="institution.name" type="text" name="institution_name"
                                :class="'form-control '+($v.institution.name.$error ? 'is-invalid ' : '')" id="nameInput" placeholder="Bank of America">
                </div>

                <div class="form-group">
                    <label for="vendorInput">Asset Link</label>
                    <input type="text" v-model="institution.asset" :class="'form-control '+($v.institution.asset.$error ? 'is-invalid ' : '')" id="vendorInput" placeholder="https://website/logolink.png">

                    <!-- <input type="file" @change="uploadAsset($event);" :class="'form-control '+($v.institution.asset.$error ? 'is-invalid ' : '')" id="vendorInput" placeholder="Target"> -->
                </div>

                 <div class="form-group">
                    <label for="statusSelect">Status</label>
                    <select v-model="institution.status" :class="'form-control '+($v.institution.status.$error ? 'is-invalid ' : '')" id="statusSelect">
                        <option value="1" selected>Active</option>
                        <option value="0" selected>Inactive</option>
                    </select>
                </div>

            </form>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>
            <button @click="saveInstitution()" type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { required, minLength, requiredIf } from 'vuelidate/lib/validators'

export default {
  name: 'new-institution-model',
  props: [
      'institution'
  ],
  data() {
      return {
        //   institution: {}
        image: ''
      }
  },
  methods: {
    uploadAsset(e) {
        var files = e.target.files || e.dataTransfer.files;
        if (!files.length)
            this.institution.asset = null;
            // this.createImage(files[0]);
          this.institution.asset = files[0];
    },
    saveInstitution() {
        this.$v.institution.$touch()
        if (!this.$v.$invalid) {
            this.$emit('saveInstitution', this.institution)
            $('#newInstitutionModal').modal('hide')
        }
    },
    createImage(file) {
        let reader = new FileReader();
        let vm = this;
        reader.onload = (e) => {
            vm.image = e.target.result;
        };
        reader.readAsDataURL(file);
    },
    uploadImage(){
        axios.post('/image/store',{image: this.image}).then(response => {
            if (response.data.success) {
                alert(response.data.success);
            }
        });
    }
  },
  validations: {
      institution: {
        name: {
            required
        },
        asset: {
            required
        },
        status: {
            required
        }
      }
  },
  mounted() {
  }
};
</script>
