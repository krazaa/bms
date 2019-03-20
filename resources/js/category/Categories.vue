<template>
<div class="box">
    <template>
    <section>
        <b-field grouped group-multiline>
        <div class="control is-flex">
            <h3 class="title is-4">Manage Categories</h3>
        </div>
        <div class="control is-flex">
            <b-field>
            <b-input v-model="search" name="search" placeholder="Keyword Seach" @input="SearchGet"></b-input>
            </b-field>
        </div>
        <div class="control is-flex">
            <router-link class="button is-primary is-pulled-right" :to="{ name: 'catcreate' }"><i class="fa fa-user-plus m-r-10"></i> New Category</router-link>
        </div>
        </b-field>
        <p class="level-item">
            <span class="is-pulled-right" v-if="loading">
                <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i>
            </span>
        </p>
        <b-table
            :data="categories.data"
            :loading="loading"
            :narrowed="isNarrowed"
            :default-sort-direction="defaultSortDirection"
             default-sort="categories.name">
        <template slot-scope="props">
        <b-table-column field="id" label="ID" width="40" sortable>
        {{ props.row.id }}
        </b-table-column>
        <b-table-column field="catgory" label="Catgory" sortable>
        {{ props.row.category }}
        </b-table-column>
        <b-table-column field="created_at" label="Created" sortable>
        {{ props.row.created_at | CreatedAT}}
        </b-table-column>
        
        
        <b-table-column label="Action" centered>
        <a :href="`/manage/users/singleuser/${props.row.id}`" class="button is-success is-small"><span class="mdi mdi-eye"></span></a>
        <a :href="`/manage/users/edit/${props.row.id}`" class="button is-warning is-small"><span class="mdi mdi-pencil-box-outline"></span></a>
        <a :href="`/manage/users/edit/${props.row.id}`" class="button is-danger is-small"><span class="mdi mdi-trash-can"></span></a>
        </b-table-column>
        </template>
        </b-table>
    </section>
    </template>
<hr>
        <pagination :limit="5" :show-disabled=false :data="categories"  @pagination-change-page="getResults"></pagination>

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
                categories: [],
                search:'',
                isNarrowed: true,
                loading: false,
                defaultSortDirection: 'asc',
                isAvailable: 0,
                searchvendor:[]
                
            }
        },
        mounted(){
        this.loadCats();  
    },
        methods: {  
             loadCats(){
              this.loading = true
              axios.get("/categories./GetCategories").then(({data}) => (this.categories = data));
              this.loading = false
            },
            getResults(page = 1) {
                axios.get('/categories./GetCategories?page=' + page)
                  .then(response => {
                    this.categories = response.data;
                });
            },

            SearchGet() {
            axios.get('/categories./CatSearch?search=' + this.search)
            .then(({data}) => (this.categories = data));
        },
    },
        filters: {
            CreatedAT: function(value){
            return moment().format("DD-MM-YYYY");
        }
    }        
}

    
</script>
