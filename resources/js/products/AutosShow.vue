<template>
<div class="columns is-multiline">
  <div class="column is-12">
    <div class="box">
         <div class="control">
            <h3 class="title is-4">
                {{ product.code }} {{ product.company }} {{ product.name }} {{ product.model }}
            </h3>   
             <div class="control">
                asdf
             </div>
        </div>
    </div>
  </div>
</div>
</template>
<script>
    export default {
        props: ['productid'], 
        data(){
            return {
                product: [],
                loading: false     
                }
        },
        mounted(){
            axios.get('/products./autos/ShowSingle/' + this.productid)
            .then((response)=> this.product = this.temp = response.data)
            .catch((error) => this.errors = error.response.data.errors)
            //console.log(this.productid)
        },
    }
</script>