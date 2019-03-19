<template>
<div class="columns is-multiline">
  <div class="column is-12">
    <div class="box">
        <b-field grouped group-multiline>
         <div class="control">
                <h3 class="title is-4">Manage Products</h3>   
            </div>
        </b-field>
    </div>
  </div>
</div>
</template>
<script>
    export default {
        props: ['id'], 
        data(){
            return {
                product: [],
                loading: false
               
            }
        },
        mounted(){
        axios.get('/products/autos/ShowSingle/' + this.id)
        .then((response)=> this.product = this.temp = response.data)
        //.catch((error) => this.errors = error.response.data.errors)
        console.log(this.id)
    },
    }
</script>