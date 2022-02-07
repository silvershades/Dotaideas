<script>
export default {
  name: "post-comments",
  data: function () {
    return {
      loading: false,
      loading_send: false,
      comments: [],
      comments_total: 0,
      new_comment: {
        message: '',
      },

      post: undefined,
      response: 0,
      ajax_success: '',
      ajax_errors: {},
      ajax_auth_errors: '',
    }
  }, mounted() {
    this.initiateAjaxPost();
  },
  methods: {
    getTotalNumber: function (event) {
      this.comments_total = 0;
      var comments_array = this.comments;
      this.comments_total += comments_array.length;
      for (let i = 0; i < comments_array.length; i++) {
        this.comments_total += comments_array[i].replies.length;
      }
    },
    toggleBox: function (box) {
      if (box.show_reply_box == 1) {
        box.show_reply_box = 0;
      } else {
        box.show_reply_box = 1;
      }
    },
    addNewComment: function (event) {
      if (this.new_comment.message != '' && this.loading_send == 0) {
        this.initiateAjaxPost_sendComment()
      }else{
        //alertar error
      }
    },
    addNewReply: function (comment) {
      if (comment.reply != '' && comment.loading == 0) {
        this.initiateAjaxPost_sendCommentReply(comment)
      }else{
        //alertar error
      }
    },

    initiateAjaxPost: function (event) {
      let obj = this;
      this.loading = true;
      const formData = new FormData();
      formData.append('post', this.post);
      axios.post('/api/post-comments', formData)
          .then((response) => {
            this.loading = false;
            if (response.data.status === 'success') {
              this.comments = response.data.data;
              this.getTotalNumber();
            } else {
              // console.log(response.data)
            }
          })
          .catch(function (error) {
            obj.loading = false;
          });
    },

    initiateAjaxPost_sendComment: function (event) {
      this.loading_send = true;
      let obj = this;
      const formData = new FormData();
      formData.append('post', this.post);
      formData.append('comment', JSON.stringify(this.new_comment));
      axios.post('/api/send-comment', formData)
          .then((response) => {
            this.loading_send = false;
            if (response.data.status === 'success') {
              this.initiateAjaxPost();
              this.new_comment.message = '';
            }
            console.log(response.data)
          })
          .catch(function (error) {
            obj.loading_send = false;
          });
    },
    initiateAjaxPost_sendCommentReply: function (comment) {
      comment.loading = 1;
      const formData = new FormData();
      formData.append('post', this.post);
      formData.append('reply', JSON.stringify(comment));
      axios.post('/api/send-reply', formData)
          .then((response) => {
            comment.loading = 0;
            if (response.data.status === 'success') {
              this.initiateAjaxPost();
              this.comment.reply = '';
            }
            console.log(response.data)
          })
          .catch(function (error) {
            comment.loading = 0;
          });
    }
  }
}
</script>

<style scoped>
.slide-fade-enter-active {
  transition: all .3s ease;
}

.slide-fade-leave-active {
  transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}

.slide-fade-enter, .slide-fade-leave-to
  /* .slide-fade-leave-active below version 2.1.8 */
{
  transform: translateX(10px);
  opacity: 0;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity .5s
}

.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */
{
  opacity: 0
}
</style>
