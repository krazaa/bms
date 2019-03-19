<template>
<div class="box">
        <b-field grouped group-multiline>
        <div class="control is-flex">
            <h3 class="title is-4">Product Information</h3>
        </div>
        </b-field>
        <p class="level-item">
            <span class="is-pulled-right" v-if="loading">
                <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i>
            </span>
        </p>
    <table class="table">
        <tbody>
            <tr>
                <td>{{ product.name }}</td>
            </tr>
        </tbody>
        
    </table>
<hr>

</div>
</template>
<script>
    export default {
        props: ['id'], 
        data(){
            return {
                product: []
                 
                }
        },
        mounted(){
            // axios.get('/products./autos/ShowSingle/' + this.id)
            // .then((response)=> this.product = this.temp = response.data)
            // .catch((error) => this.errors = error.response.data.errors)
            //console.log(this.productid)
              this.loadData();  
        },
         methods: {  
             loadData(){
              this.loading = true
              axios.get("/products./autos/ShowSingle/" + this.id).then(({data}) => (this.product = data));
              this.loading = false
            },
        }
    }
</script>