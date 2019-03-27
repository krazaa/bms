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
        <b-table-column field="type" label="Type" sortable>
            {{ props.row.type == '1' ? 'Vehicle' : 'Electronic' }}
        </b-table-column>
        <b-table-column field="catgory" label="Catgory">
        <b>{{ props.row.category }} </b>
                 <ul>        
                    <li v-for="sub in props.row.subcats">
                        <i class="mdi mdi-subdirectory-arrow-right"></i>
                    {{ sub.category }} 
                    <b-switch v-model="sub.isActive" name="isActive"
                        :true-value="1"
                        :false-value="0"
                        type="is-success" @input="StatusChange(sub.id)">
                    </b-switch>
                    <router-link class="button is-info is-small" :to="{ name: 'catedit', params: {id: props.row.id }}"><span class="mdi mdi-pencil-box-outline"></span></router-link>
        <a @click="DataSubDelete(props.row.id)" class="button is-danger is-small"><span class="mdi mdi-trash-can"></span></a>
                    </li>
                </ul> 
        </b-table-column>        
        <b-table-column label="Status">
            <b-switch v-model="props.row.isActive" name="isActive"
                :true-value="1"
                :false-value="0"
                type="is-success" @input="StatusChange(props.row.id)">
            </b-switch>
        </b-table-column>
        
        <b-table-column label="Action" centered>
        <router-link class="button is-info is-small" :to="{ name: 'catedit', params: {id: props.row.id }}"><span class="mdi mdi-pencil-box-outline"></span></router-link>
        <a @click="DataDelete(props.row.id)" class="button is-danger is-small"><span class="mdi mdi-trash-can"></span></a>
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
                categories: {},
                subcats: {},
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
        this.loadSubCats();

    },
       
        methods: {  
            StatusChange(id,){
              axios.get("/categories./ChangeStatus/" + id )
              // .then(response => { this.success = true;
              //         })
            }, 
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
            loadSubCats(){
              this.loading = true
              axios.get("/categories./SubCats").then(({data}) => (this.subcats = data));
              this.loading = false
            },

            SearchGet() {
            axios.get('/categories./CatSearch?search=' + this.search)
            .then(({data}) => (this.categories = data));
            },
            DataDelete(id) {
            axios.get('/categories./CatDelete/' + id)
            .then(response => { this.success = true;
                      })
            this.loadCats();
            },
            DataSubDelete(id) {
            axios.get('/categories./SubCatDelete/' + id)
            .then(response => { this.success = true;
                      })
            this.loadCats();
            },
    },
        filters: {
            CreatedAT: function(value){
            return moment().format("DD-MM-YYYY");
        }
    }        
}

    
</script>
