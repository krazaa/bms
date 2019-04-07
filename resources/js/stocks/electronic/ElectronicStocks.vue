<template>
<div class="box">
    <div class="columns">
        <div class="column is-12">
            <nav class="level bd-structure-item bd-is-structure-container" title="level">
                <div class="level-left bd-structure-item" title="level-left">
                    <div class="level-item">
                        <p class="subtitle is-5">
                            <strong>Product Information</strong>
                        </p>
                    </div>
                    <div class="level-item">
                    </div>
                </div>
                <div class="level-right bd-structure-item" title="level-right">
                    <p class="level-item">
                        <router-link class="button is-primary is-small" :to="{ name: 'autos'}">
                        Back to Products
                        </router-link>
                    </p>
                </div>
            </nav>
            <div class="box">
                        
                        <table class="table">
                            <thead>
                                <th>code</th>
                                <th>product</th>
                                <th>qty</th>
                                <th>cost</th>
                            </thead>
                            <tbody>
                                <tr v-for="pro in product">
                                    <td>{{ pro.products.code }}</td>
                                    <td>{{ pro.products.name }}</td>
                                    <td>{{ pro.qty }}</td>
                                    <td>{{ tt = ((pro.cost * pro.qty) * pro.tax + pro.cost * pro.qty )}}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Total: {{ tt }} ({{ totalItem }})</td>
                                </tr>
                            </tfoot>
                        </table>
            </div>
        </div>
    </div>
</div>
</template>
<script>
    export default {
            data(){
            return {
                product: [],
                loading:'',
                total:{}
                }
        },
         methods: {  
             loadData(){
              axios.get("/stocks./electronic/getstocks/").then(({data}) => (this.product = data));
            },
            
        },
        computed: {
    totalItem: function(){
      let sum = 0;
      this.product.forEach(function(product) {
         sum += (parseFloat(product.cost) * parseFloat(product.qty));
      });

     return sum;
    }
},
        mounted(){
              this.loadData();  
        }
    }
</script>