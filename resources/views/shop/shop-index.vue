<template>

</template>

<script>
export default {
  name: "shop-index",
  data: function () {
    return {
      loading: false,
      loading_buy: false,
      balance: 0,
      selected_item: {},
      shop_items: [],
    }
  },
  mounted() {
    this.loadItems();
    this.getBalance();
    this.paypal();
  },
  methods: {
    async loadItems() {
      await this.fetchItems();
    },
    fetchItems() {
      var obj = this;
      axios.get('/api/shop-items')
          .then((response) => {
            this.shop_items = response.data.data;
            this.loading = false;
          })
          .catch(function (error) {
            obj.loading = false;
            console.log(error)
          });
    },
    getBalance() {
      axios.get('/api/user-balance')
          .then((response) => {
            this.balance = response.data.coins;
          })
          .catch(function (error) {
            // console.log(error)
          });
    },
    openOptions(item) {
      for (let x = 0; x < this.shop_items.length; x++) {
        for (let y = 0; y < this.shop_items[x].data.length; y++) {
          this.shop_items[x].data[y].menu_opened = false;
        }
      }
      item.menu_opened = true;
    },
    closeOptions(item) {
      item.menu_opened = false;
    },
    buyItem(item) {
      if (this.loading_buy) {
        Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span> Transaction on course', {type: 'error', className: 'font-title', position: "top-right", duration: 10000});
      } else {
        var obj = this;
        if (item.value > this.balance) {
          Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span> Insuficient Shards', {type: 'error', className: 'font-title', position: "top-right", duration: 10000});
        } else {
          this.loading_buy = true;
          this.selected_item = item;
          const formData = new FormData();
          formData.append('shop_item', JSON.stringify(item));
          axios.post('/api/shop-item', formData)
              .then((response) => {
                // console.log(response.data)
                this.loading_buy = false;
                if (response.data.status === 'success') {
                  Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span>'+ response.data.msg , {type: 'success', className: 'font-title', position: "top-right", duration: 10000});
                  this.loadItems();
                  this.getBalance();
                } else {
                  Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span>'+ response.data.msg , {type: 'error', className: 'font-title', position: "top-right", duration: 10000});
                }

              })
              .catch(function (error) {
                obj.loading_buy = false;
                // console.log(error)
              });
        }
      }
    },
      paypal(){
          paypal.Buttons({

              // Sets up the transaction when a payment button is clicked
              createOrder: function(data, actions) {
                  return actions.order.create({
                      purchase_units: [{
                          amount: {
                              value: '77.44' // Can reference variables or functions. Example: `value: document.getElementById('...').value`
                          }
                      }]
                  });
              },

              // Finalize the transaction after payer approval
              onApprove: function(data, actions) {
                  return actions.order.capture().then(function(orderData) {
                      // Successful capture! For dev/demo purposes:
                      console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                      var transaction = orderData.purchase_units[0].payments.captures[0];
                      alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                      // When ready to go live, remove the alert and show a success message within this page. For example:
                      // var element = document.getElementById('paypal-button-container');
                      // element.innerHTML = '';
                      // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                      // Or go to another URL:  actions.redirect('thank_you.html');
                  });
              }
          }).render('#paypal-button-container');

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
