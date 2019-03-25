<template>
<div class="box">
     <div v-if="isLoading">
        <b-loading :active.sync="isLoading" :can-cancel="true"></b-loading>
    </div>
    <div v-if="!isLoading">
    <template>
    <section>
        <b-field grouped group-multiline>
        <div class="control is-flex">
            <h3 class="title is-4">Manage Vehicles</h3>
        </div>
        <div class="control is-flex">
            <b-field>
            <b-input v-model="search" name="search" placeholder="Keyword Seach" @input="SearchAutos"></b-input>
            </b-field>
        </div>
        
        
        <div class="control is-flex">
            <router-link class="button is-primary is-pulled-right" :to="{ name: 'newproduct' }"><i class="fa fa-user-plus m-r-10"></i> New Vehicle</router-link>
        </div>
        </b-field>
        
        <b-table
            :data="products.data"
            :loading="isLoading"
        
            :narrowed="isNarrowed"
            :default-sort-direction="defaultSortDirection"
             default-sort="products.name">
        <template slot-scope="props">
        <b-table-column field="vnum" label="VehicleID" width="60" sortable>
        VAC-{{ props.row.vnum }}
        </b-table-column>
        <b-table-column field="vendor" label="Vendor" sortable>
        {{ props.row.company }}
        </b-table-column>
        <b-table-column field="name" label="Product Name" sortable>
        {{ props.row.name }}
        </b-table-column>
        <b-table-column field="model" label="Model" sortable>
        {{ props.row.model }}
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
        
        <a :href="`/manage/users/edit/${props.row.id}`" class="button is-danger is-small"><span class="mdi mdi-trash-can"></span></a>
        </b-table-column>
        </template>
        </b-table>
    </section>
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
            }
            
          },
         mounted(){
          this.loadProducts();
    },

}
        
</script>