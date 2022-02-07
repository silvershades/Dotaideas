<script>
export default {

  name: "post-credits",
  data: function () {
    return {
      publishing: false,
      vote: 1,
      has_voted: 0,
      post: undefined,
      response: 0,
      ajax_success: '',
      ajax_errors: {},
      ajax_auth_errors: '',
    }
  }, mounted() {
    this.hasVoted();
  },
  methods: {
    hasVoted: function (event) {
      const formData = new FormData();
      formData.append('post', this.post);
      axios.post('/api/has_voted', formData)
          .then((response) => {
            if (response.data.status === 'success') {
              this.has_voted = response.data.msg;
              switch (this.has_voted) {
                case -10: {
                  this.vote = '-1';
                  break;
                }
                case 10: {
                  this.vote = '1';
                  break;
                }
                case 20: {
                  this.vote = '2';
                  break;
                }
                case 30: {
                  this.vote = '3';
                  break;
                }
                default: {
                  this.vote = '1';
                }
              }
            } else if (response.data.status === 'error') {
              this.ajax_auth_errors = response.data.msg;
            }
            // console.log( response.data.msg)
          })
          .catch(function (error) {
          });
    },
    checkAuth: function (event) {
      let obj = this;
      if (this.publishing == false) {
      this.publishing = true;
      this.response = 0;
      axios.post('/api/check-auth')
          .then((response) => {
            if (response.data.status === 'success') {
              this.initiateAjaxPost();
            } else if (response.data.status === 'error') {
              this.response = 3;
              this.publishing = false;
              this.ajax_auth_errors = response.data.msg;
            }
          })
          .catch(function (error) {
            obj.publishing = false;
          });
    }
    },
    initiateAjaxPost: function (event) {

        let obj = this;

        const formData = new FormData();
        formData.append('post', this.post);
        formData.append('vote', this.vote);

        axios.post('/api/vote_post', formData)
            .then((response) => {
              this.publishing = false;
              if (response.data.status === 'success') {
                this.has_voted = 1;
                this.response = 1;
                this.ajax_success = response.data.msg;
                  Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span> Vote Casted', {type: 'success', className: 'font-title', position: "top-right", duration: 10000});

              } else if (response.data.status === 'error') {
                this.response = 2;
                this.ajax_errors = response.data.errors;
              }
              console.log(response.data);
            })
            .catch(function (error) {
              obj.publishing = false;
            });
      }
  }
}
</script>

<style scoped>

</style>
