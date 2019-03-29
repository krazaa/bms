<template>
<div class="box">
     <div v-if="isLoading">
        <b-loading :active.sync="isLoading" :can-cancel="true"></b-loading>
    </div>
    <div v-if="!isLoading">
    <template>
    <section v-if="products.data.length > 0">
        <div class="columns is-multiline">
            <div class="column is-3"><h3 class="title is-4">Manage Vehicles</h3></div>
              <div class="column is-3">
                <h3 class="title is-4">
                <b-field>
            <b-input v-model="search" name="search" placeholder="Keyword Seach" @input="SearchAutos"></b-input>
            </b-field>
          </h3>
          </div>
          <div class="column is-2">
              <router-link class="button is-primary d-inline-block is-pulled-right" :to="{ name: 'newproduct' }"><i class="fa fa-user-plus m-r-10"></i> New Vehicle</router-link>
          </div>
                    <div class="column is-4">
                        <nav class="breadcrumb is-right" aria-label="breadcrumbs">
                            <ul>
                                <li>
                                    <span class="icon is-small">
                                        <i class="mdi mdi-home" aria-hidden="true"></i>
                                    </span>
                                    <router-link to="/dashboard"><span>Home</span></router-link>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

        <b-field grouped group-multiline>
      
 

        </b-field>
        
        <b-table
            :data="products.data"
            :loading="isLoading"
        
            :narrowed="isNarrowed"
            :default-sort-direction="defaultSortDirection"
             default-sort="products.name">
        <template slot-scope="props">
        <b-table-column field="id" label="ID" width="60" sortable>
        {{ props.row.id }}
        </b-table-column>
        <b-table-column field="code" label="Product No" width="60" sortable>
        {{ props.row.code }}
        </b-table-column>
        <b-table-column field="name" label="Product" sortable>
        {{ props.row.name }}
        </b-table-column>
        <b-table-column field="model" label="Model" sortable>
        {{ props.row.model }}
        </b-table-column>
        <b-table-column field="vendor" label="Vendor" sortable>
        {{ props.row.company }}
        </b-table-column>
        <b-table-column field="category" label="Category" sortable>
        {{ props.row.category }}
        </b-table-column>
        <b-table-column field="cost" label="Cost" sortable>
        {{ props.row.cost }}
        </b-table-column>
        <b-table-column field="isActive" label="Status" sortable>
            
            <b-switch v-model="props.row.isActive" name="isActive"
            :true-value="1" 
            :false-value="0"
            type="is-success" @input="ChangeStatus(props.row.id)">
            </b-switch>
        </b-table-column>
        <b-table-column label="Action" centered>
             <!-- <router-link class="button is-success is-small" :to="{ name: 'AutosShow', params: {id: props.row.id}}"><span class="mdi mdi-eye-circle-outline"></span></router-link> -->
             <router-link class="button is-info is-small" :to="{ name: 'editproduct', params: {id: props.row.id}}"><span class="mdi mdi-pencil-box-outline"></span></router-link>
        
        <a @click="vDelete(props.row.id)" class="button is-danger is-small"><span class="mdi mdi-trash-can"></span></a>
        </b-table-column>
        </template>
        </b-table>
    </section>
     <div class="control has-text-centered" v-show="!products.data.length">
        <h1 class="title is-2 is-warning">Record not found</h1>
        <hr>
        <router-link class="button is-primary " :to="{ name: 'newproduct' }"><i class="fa fa-user-plus m-r-10"></i> Add your first Vehicle click here</router-link>
    </div>
    </template>
<hr>
        <pagination :limit="5" :show-disabled=false :data="products"  @pagination-change-page="getResults"></pagination>
</div>
</div>
</template>

<script>
 
 export default {
 //props: ['studentID'], 
        data() {
            return {
                products: {},
                search:'',
                isNarrowed: true,
                isLoading: false,
                perPage: 20,
                isPaginated: true,
                defaultSortDirection: 'asc',
               
                    }
            },
            methods: {  
                   ChangeStatus(id,){
              axios.get("/products./autos/ChangeStatus/" + id )
              // .then(response => { this.success = true;
              //         })
            //this.loadBanks();
            },
                
              SearchAutos(){
                    axios.get('/products./autos/SearchAutosProduct?search=' + this.search)
                      .then((data)=> {this.products = data })
                      },
              loadProducts(){
                    this.isLoading = true
              axios.get("products./autos/GetAutosProducts").then(({data}) => {
                  this.isLoading = false
                  this.products = data
            });

                      },
              getResults(page = 1) {
                axios.get('/products./autos/GetAutosProducts?page=' + page).then(response => {
                  this.products = response.data;
                  });
            },
            vDelete(id) {
            axios.get('/products./autos/ProductRemove/' + id)
            .then(response => { this.success = true;
                      })
            this.loadProducts();
            },
            
          },
         mounted(){
          this.loadProducts();
    },

}
        
</script>