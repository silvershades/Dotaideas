<template>

</template>

<script>
export default {
  name: "opinion",
  data: function () {
    return {
      loading: false,
      message: '',
      sent: false,


    }
  },
  mounted() {

  },
  methods: {
    send() {
      var obj = this;
      if (this.message == '') {
        Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span> Message is empty', {type: 'error', className: 'font-title', position: "top-right", duration: 10000});
      } else {
        this.loading = true;
        const formData = new FormData();
        formData.append('message', this.message);
        axios.post('/api/send-opinion', formData)
            .then((response) => {
              this.loading = false;
              if (response.data.status === 'success') {

                this.message = '';
                this.sent = true;
                Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span>' + response.data.msg, {type: 'success', className: 'font-title', position: "top-right", duration: 10000});
              } else {
                Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span>' + response.data.msg, {type: 'error', className: 'font-title', position: "top-right", duration: 10000});
              }
            })
            .catch(function (error) {
              obj.loading = false;
            });
      }
    },
  }
}
</script>

<style scoped>

</style>