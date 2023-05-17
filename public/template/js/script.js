const app = new Vue({
  el: '#app',
  data: {
    products: []
  },
  methods: {
  	getProducts: function() {
      fetch("./user.json").then(function () {
        console.log('hello')
      })
    }
  }
})

app.getProducts()