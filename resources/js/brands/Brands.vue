<template>
<div class="box">
    <div v-if="isLoading">
        <b-loading :active.sync="isLoading" :can-cancel="true"></b-loading>
    </div>
    <div v-if="!isLoading">
    <template>
    <section v-if="brandsload.data.length > 0">

        <b-field grouped group-multiline>
        <div class="control is-flex">
            <h3 class="title is-4">Manage Brands</h3>
        </div>
        <div class="control is-flex">
            <b-field>
            <b-input v-model="search" name="search" placeholder="Keyword Seach" @input="SearchGet"></b-input>
            </b-field>
        </div>
        <div class="control is-flex">
            <router-link class="button is-primary is-pulled-right" :to="{ name: 'brandCreate' }"><i class="fa fa-user-plus m-r-10"></i> New Brand</router-link>
        </div>
        </b-field>
      
        <b-table
            :data="brandsload.data"
            :loading="isLoading"
            :narrowed="isNarrowed"
            :default-sort-direction="defaultSortDirection"
             default-sort="brandsload.data.brand">
        <template slot-scope="props">
        <b-table-column field="id" label="ID" width="40" sortable>
        {{ props.row.id }}
        </b-table-column>
        <b-table-column field="type" label="Type" width="200" sortable>
        {{ props.row.type }}
        </b-table-column>
        <b-table-column field="brand" label="Brand Name" sortable>
        {{ props.row.brand }}
        </b-table-column>
        <b-table-column field="isActive" label="Status" width="40" sortable>
            <b-switch v-model="props.row.isActive" name="isActive"
            :true-value="1" 
            :false-value="0"
            type="is-success" @input="BrandED(props.row.id)">
            </b-switch>
        </b-table-column>
        <b-table-column label="Action" width="100" centered>
            <router-link class="button is-warning is-small" :to="{ name: 'brandEdit', params: {id: props.row.id }}"><span class="mdi mdi-pencil-box-outline"></span></router-link>
        <a @click="BrandDelete(props.row.id)" class="button is-danger is-small"><span class="mdi mdi-trash-can"></span></a>
        </b-table-column>
        </template>
        </b-table>
    </section>
            <div class="control has-text-centered" v-show="!brandsload.data.length">
        <h1 class="title is-2 is-warning">Record not found</h1>
        <hr>
        <router-link class="button is-primary " :to="{ name: 'brandCreate' }"><i class="fa fa-user-plus m-r-10"></i> Add your first Brand click here</router-link>
    </div>
    </template>
<hr>
        <pagination :limit="5" :show-disabled=false :data="brandsload"  @pagination-change-page="getResults"></pagination>
        </div>
</div>


</template>
<style >
.available{
  color: green;
}
.notavailable{
  color: red;
}
</style>
<script>
import moment from 'moment';
//import VueMomentLib from "vue-moment-lib";
    export default {
        data(){
            return {
                brandsload: {},
                search:'',
                isActive:'',
                isNarrowed: true,
                isLoading: false,
                defaultSortDirection: 'asc',
                isAvailable: 0,
                searchvendor:[]
                
            }
        },
        mounted(){
        this.loadBrands();  
    },
        methods: { 
            BrandED(id,){
              axios.get("/brands./BrandED/" + id )
            }, 
            loadBrands(){
              this.isLoading = true
              axios.get("brands./BrandsListGet").then(({data}) => {
                  this.isLoading = false
                  this.brandsload = data
            });
          },
            getResults(page = 1) {
                this.isLoading = true
                axios.get('/brands./BrandsListGet?page=' + page)
                  .then(response => {
                    this.isLoading = false
                    this.brandsload = response.data;
                });
            },
            SearchGet() {
            axios.get('/brands./BrandSearch?search=' + this.search)
            .then(({data}) => (this.brandsload = data));
            },
            BrandDelete(id) {
            axios.get('/brands./BrandDelete/' + id)
            .then(response => { this.success = true;
                      })
            this.loadBrands();
            },
    },
        filters: {
            CreatedAT: function(value){
            return moment().format("DD-MM-YYYY");
        }
    },
  

}

    
</script>
