<script>
export default {
  name: "other-edit",
  data: function () {
    return {
      loading: false,
      loading_hero: false,
      publishing: false,
      publish_modal: false,
      ajax_errors: {},
      ajax_success: '',
      exception: false,
      post_created_id: '',

      errors: {
        description: [],
      },
      errors_debug: '',
      dother: {
        name: '',
        is_active: 0,
        image_show: '',
        description: '',
        other_flags_id: 1,
      },
      images: {
        other: '',
      }
    }
  },
  mounted() {
    this.getOther();
  },
  methods: {
    getOther() {
      var obj = this;
      let id = window.location.href.split('/').pop();
      this.loading = true;
      axios.get('/api/get-other/' + id)
          .then((response) => {
            this.dother = response.data.data[0];
            this.loading = false;
          })
          .catch(function (error) {
            obj.loading = false;
          });
    },
    onFileChangeItem: function (payload) {
      const file = payload.target.files[0];
      this.images.other = file;
      this.dother.img_is_uploaded = 1;
      this.dother.img_path = URL.createObjectURL(file);
      URL.revokeObjectURL(file);
    },


    checkDataForSubmit: function (event) {
      this.errors.description = [];

      //HERO VALIDATION
      if (!this.dother.name) {
        this.errors.hero.push("Hero's name is required.");
      }
      if (this.dother.name.length > 40) {
        this.errors.hero.push("Name is too long.");
      }
      if (!this.dother.image.length) {
        this.errors.hero.push("Hero's portrait is required.");
      }
      //SPELLS VALIDATION
      if (!this.spell_1.name.length) {
        this.errors.spells.push("Q spell's name is required.");
      }
      if (!this.spell_2.name.length) {
        this.errors.spells.push("W spell's name is required.");
      }
      if (!this.spell_3.name.length) {
        this.errors.spells.push("E spell's name is required.");
      }

      if (!this.spell_1.description.length) {
        this.errors.spells.push("Q spell's description is required.");
      }
      if (!this.spell_2.description.length) {
        this.errors.spells.push("W spell's description is required.");
      }
      if (!this.spell_3.description.length) {
        this.errors.spells.push("E spell's description is required.");
      }

      //TALENTS VALIDATION

      //TEXTS VALIDATION
      if (!this.dother.description.length) {
        this.errors.description.push('Description is required.');
      }

      if (!this.errors.description.length) {
        this.errors.description = [];

        this.startPublish();
        //enviar
      } else {
        //bypass
        this.startPublish();
      }
    },
    startPublish: function (event) {
      this.ajax_errors = {};
      this.publish_modal = true;
    },
    presetPostNotActive: function (event) {
      this.dother.is_active = 0;
      this.initiateAjaxPost();
    },
    presetPostActive: function (event) {
      this.dother.is_active = 1;
      this.initiateAjaxPost();
    },
    initiateAjaxPost: function (event) {

      this.publishing = true;
      let obj = this;

      const formData = new FormData();
      formData.append('other', JSON.stringify(this.dother));
      formData.append('image_other', this.images.other);

      // console.log(this.images);

      axios.post('/api/other-store', formData, {'content-type': 'multipart/form-data'})
          .then((response) => {
            this.publishing = false;
            if (response.data.status === 'success') {
              this.ajax_success = response.data.msg;
              this.post_created_id = '/post/other/' + response.data.post_id;
            } else if (response.data.status === 'error') {
              this.ajax_errors = response.data.errors;
              if (response.data.msg === 'Error Throwable' || response.data.msg === 'Error Exception') {
                this.exception = true;
              }
            }
            console.log(response.data);
          })
          .catch(function (error) {
            obj.publishing = false;
            // this.ajax_errors = ['Conection Error. Please try again.']
            // this.ajax_errors = error;
            // console.log(error);
          });
    }

  },
  computed: {}
}
</script>

<style scoped>

</style>
