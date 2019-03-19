<template>
<div class="columns is-multiline">
  <div class="column is-12">
    <div class="box">
      <!-- <router-view></router-view> -->
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
                  <router-link class="button is-info" :to="{ name: 'newproduct' }">New Product</router-link>
                    <!-- <a href="/products./autos/newproduct" class="button is-info">New Product</a> -->
                </b-field>
            </div>
    </b-field>
        <div v-if="loading" v-cloak align="center" class="loading-overlay is-active">
          <i class="mdi mdi-48px mdi-spin mdi-loading"></i>
        </div>
        <!-- <div class="loading" v-if="loading">
      Loading...
    </div> -->
       <table class="table is-fullwidth is-hoverable is-narrow is-desktop is-mobile" v-if="products.data.length > 0">

        <thead>
          <tr>
            <th><abbr title="code">Code</abbr></th>
            <th><abbr title="vendor">Vendor</abbr></th>
            <th><abbr title="name">Product</abbr></th>
            <th><abbr title="model">Model</abbr></th>
            <th><abbr title="shortname">Shortname</abbr></th>
            <th><abbr title="cost">Cost</abbr></th>
            <th><abbr title="action">Action</abbr></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(product , index) in products.data">
            <td>{{ product.code }}</td>
            <td>{{ product.company }}</td>
            <td>{{ product.name }}</td>
            <td>{{ product.model }}</td>
            <td>{{ product.shortname }}</td>
            <td>{{ product.cost }}</td>
            <td>
                <a :href="`/products./autos/AutoShow/${product.id}`" class="button is-success is-small"><span class="mdi mdi-eye-circle-outline"></span></a>
                <a :href="`/products./autos/ShowEditFrm/${product.id}`" class="button is-warning is-small"><span class="mdi mdi-pencil-box-outline"></span></a>
                <a :href="`/products./autos/ProductRemove/${product.id}`" class="button is-danger is-small"><span class="mdi mdi-trash-can"></span></a>
                <!-- <router-link :to="{ name: 'showelectronic' }">Hello World</router-link> -->
            </td>
          </tr>
        </tbody>
      </table>
      <pagination :limit="4" :data="products" @pagination-change-page="getResults"></pagination>
    </div>
  </div>
</div>
</template>

<script>
 
 export default {
 //props: ['studentID'], 
        data() {
            return {
               products: [],
               search: '',
               autosproducts: [],
               loading: false,
               
                    }
            },
            methods: {  
              SearchAutos(){
                    axios.get('/products./autos/SearchAutosProduct?search=' + this.search)
                      .then((data)=> {this.products = data })
                      },
              loadProducts(){
                  this.loading = true
                  axios.get("products./autos/GetAutosProducts").then(({data}) => (this.products = data));
                  this.loading = false
                      },
              getResults(page = 1) {
                axios.get('/products./autos/GetAutosProducts?page=' + page).then(response => {
                  this.products = response.data;
                  });
            }
            
          },
         mounted(){
          this.getResults();
    },

}
        
</script>