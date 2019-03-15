<template>
<div class="columns is-multiline">
  <div class="column is-12">
    <div class="box">
        <b-field grouped group-multiline>
         <div class="control">
                <h3 class="title is-4">Manage Products</h3>   
            </div>
             
            <div class="control">
                <b-field>
                    <a href="students/register" class="button is-info">New Product</a>
                </b-field>
            </div>
    </b-field>
    
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
        axios.get('/products/autos/ShowSingle/' + this.productid)
        .then((response)=> this.product = this.temp = response.data)
        //.catch((error) => this.errors = error.response.data.errors)
        console.log(this.productid)
    },
    }
</script>