<template>

</template>

<script>
export default {
  name: "contact",
  data: function () {
    return {
      loading_contact: false,
      loading_bug: false,
      loading_request: false,
      contact: {
        name: '',
        email: '',
        message: '',
      },
      bug: {
        name: '',
        email: '',
        message: '',
      },
      request: {
        name: '',
        email: '',
        message: '',
      },


    }
  },
  mounted() {

  },
  methods: {
    sendContact() {
      var obj = this;
      if (this.contact.name == '' || this.contact.email == '' || this.contact.message == '') {
        Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span> Please fill all three fields', {type: 'error', className: 'font-title', position: "top-right", duration: 10000});
      } else {
        this.loading_contact = true;
        const formData = new FormData();
        formData.append('contact_type', '1');
        formData.append('contact', JSON.stringify(this.contact));
        axios.post('/api/send-contact', formData)
            .then((response) => {
              this.loading_contact = false;
              if (response.data.status === 'success') {
                this.contact.name = '';
                this.contact.email = '';
                this.contact.message = '';
                Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span>' + response.data.msg, {type: 'success', className: 'font-title', position: "top-right", duration: 10000});
              } else {
                Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span>' + response.data.msg, {type: 'error', className: 'font-title', position: "top-right", duration: 10000});
              }
            })
            .catch(function (error) {
              obj.loading_contact = false;
            });
      }
    },
    sendBug() {
      if (this.bug.name == '' || this.bug.email == '' || this.bug.message == '') {
        Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span> Please fill all three fields', {type: 'error', className: 'font-title', position: "top-right", duration: 10000});
      } else {
        this.loading_bug = true;
        const formData = new FormData();
        formData.append('contact_type', '2');
        formData.append('contact', JSON.stringify(this.bug));
        axios.post('/api/send-contact', formData)
            .then((response) => {
              this.loading_bug = false;

              if (response.data.status === 'success') {
                this.bug.name = '';
                this.bug.email = '';
                this.bug.message = '';
                Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span>' + response.data.msg, {type: 'success', className: 'font-title', position: "top-right", duration: 10000});
              } else {
                Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span>' + response.data.msg, {type: 'error', className: 'font-title', position: "top-right", duration: 10000});
              }
            })
            .catch(function (error) {
              obj.loading_bug = false;
            });
      }
    },
    sendRequest() {
      if (this.request.name == '' || this.request.email == '' || this.request.message == '') {
        Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span> Please fill all three fields', {type: 'error', className: 'font-title', position: "top-right", duration: 10000});
      } else {
        this.loading_request = true;
        const formData = new FormData();
        formData.append('contact_type', '3');
        formData.append('contact', JSON.stringify(this.request));
        axios.post('/api/send-contact', formData)
            .then((response) => {
              this.loading_request = false;
              if (response.data.status === 'success') {
                this.request.name = '';
                this.request.email = '';
                this.request.message = '';
                Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span>' + response.data.msg, {type: 'success', className: 'font-title', position: "top-right", duration: 10000});
              } else {
                Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span>' + response.data.msg, {type: 'error', className: 'font-title', position: "top-right", duration: 10000});
              }
            })
            .catch(function (error) {
              obj.loading_request = false;
            });
      }
    }
  }
}
</script>

<style scoped>
.slide-fade-enter-active {
  transition: all .3s ease-in;
}

.slide-fade-leave-active {
  transition: none;
}

.slide-fade-enter, .slide-fade-leave-to
  /* .slide-fade-leave-active below version 2.1.8 */
{
  transform: translateX(10px);
  opacity: 0;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity 1s
}

.fade-leave-to {
  opacity: 0
}
</style>