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
                    <b-input v-model="search" placeholder="Keyword Seach" @input="SearchAutos"></b-input>
                </b-field>
            </div>
            <div class="control">
                <b-field>
                    <a href="/products./autos/newproduct" class="button is-info">New Product</a>
                </b-field>
            </div>
    </b-field>
    
      <table class="table is-fullwidth is-hoverable is-narrow is-desktop is-mobile" v-if="products.length > 0">
        <div v-if="Studentloading" v-cloak align="center" class="loading-overlay is-active">
          <i class="fas fa-circle-notch fa-spin fa-5x"></i>
        </div>
        <thead>
          <tr>
            <th><abbr title="id">#</abbr></th>
            <th><abbr title="code">Code</abbr></th>
            <th><abbr title="vendor">Vendor</abbr></th>
            <th><abbr title="products">Product</abbr></th>
            <th><abbr title="shortname">shortname</abbr></th>
            <th><abbr title="color">color</abbr></th>
            <th><abbr title="chassis">chassis</abbr></th>
            <th><abbr title="engine">engine</abbr></th>
            <th><abbr title="cost">cost</abbr></th>
            <th><abbr title="action">Action</abbr></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(product , index) in products">
            <th>{{ index +1 }}</th>
            <td>{{ product.code }}</td>
            <td>{{ product.vendorinfo.company }}</td>
            <td>{{ product.name }}</td>
            <td>{{ product.shortname }}</td>
            <td>{{ product.color }}</td>
            <td>{{ product.chassis }}</td>
            <td>{{ product.engine }}</td>
            <td>{{ product.cost }}</td>
            <td>
                <a :href="`/products./autos/ShowSingle/${product.id}`" class="button is-success is-small"><span class="mdi mdi-eye-circle-outline"></span></a>
                <a :href="`/products./autos/ShowEdit/${product.id}`" class="button is-warning is-small"><span class="mdi mdi-pencil-box-outline"></span></a>
                <a :href="`/products./autos/ProductRemove/${product.id}`" class="button is-danger is-small"><span class="mdi mdi-trash-can"></span></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</template>

<script>
 
 export default {
 props: ['studentID'], 
        data() {
            return {
               products: [],
               search: '',
               searchstudents: [],
               Studentloading: false,
                    }
            },
              methods: {
                SearchAutos() 
            {
            var searchstudents = this
            axios.get('/products./autos/SearchAutosProduct?search=' + this.search)
            .then(function(response) 
            {
            Vue.set(searchstudents.$data, 'products', response.data).catch(error => {"erro found"});
            })

            },
            
          },
         mounted(){
        axios.get('/products./autos/GetAutosProducts')
        .then((response)=> this.products = this.temp = response.data)
        .catch((error) => this.errors = error.response.data.errors)
    },

}
        
</script>