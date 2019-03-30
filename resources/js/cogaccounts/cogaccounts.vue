<template>
<div class="box">
     <div v-if="isLoading">
        <b-loading :active.sync="isLoading" :can-cancel="true"></b-loading>
    </div>
    <div v-if="!isLoading">
    <template>
       <section v-if="cogsList.data.length > 0">
           <div class="columns is-multiline">
            <div class="column is-4"><h3 class="title is-4">Manage Chart of Accounts</h3></div>
          <div class="column is-3">
            <b-field>
            <b-input v-model="search" name="search" placeholder="Keyword Seach" @input="SearchGet"></b-input>
            </b-field>
          </div>
          <div class="column is-1">
              <router-link class="button is-primary d-inline-block is-pulled-right" :to="{ name: 'cogCreate' }"><i class="fa fa-user-plus m-r-10"></i> New COA</router-link>
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
        <div class="control is-flex">
            <h3 class="title is-4"></h3>
        </div>
        </b-field>
        <p class="level-item">
            <span class="is-pulled-right" v-if="loading">
                <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i>
            </span>
        </p>
        <b-table
            :data="cogsList.data"
            :loading="isLoading"
            :narrowed="isNarrowed"
            :default-sort-direction="defaultSortDirection"
             default-sort="cogsList.aname">
        <template slot-scope="props">
        <b-table-column field="id" label="ID" width="40" sortable>
        {{ props.row.id }}
        </b-table-column>
        <b-table-column field="acode" label="Code" sortable>
        {{ props.row.acode }}
        </b-table-column>
        <b-table-column field="aname" label="Account Name" sortable>
        {{ props.row.aname | uppercase}}
        </b-table-column>
        <b-table-column field="acat_id" label="Category" sortable>
        {{ props.row.cname}}
        </b-table-column>
        <b-table-column label="Sub Account Of">
           <i class="mdi mdi-subdirectory-arrow-right has-text-weight-semibold" v-if="props.row.subname != empty">{{ props.row.subname}} </i>
            <i class="mdi mdi-arrow-right has-text-weight-semibold" v-if="props.row.sub2name != empty">{{ props.row.sub2name}}</i> 
        </b-table-column>
        <b-table-column field="inbal" label="Income/ Balance" sortable>
        {{ props.row.inbal }}
        </b-table-column>
        <b-table-column field="debitcredit" label="Dr/Cr" sortable>
        {{ props.row.debitcredit }}
        </b-table-column>
        <b-table-column field="class" label="Class" sortable>
        {{ props.row.class}}
        </b-table-column>
        <b-table-column field="actype_id" label="Type" sortable>
        {{ props.row.tname}}
        </b-table-column>
        <b-table-column field="isActive" label="Status" sortable centered>
            <b-switch v-model="props.row.isActive"
            :true-value="1" 
            :false-value="0"
            size="is-small"
            type="is-success" @change="AccED(props.row.isActive)">
            </b-switch>
        </b-table-column>
        <b-table-column label="Action" centered>
            <!-- <router-link class="button is-info is-small" :to="{ name: 'cogShow', params: {id: props.row.id }}"><span class="mdi mdi-eye"></span></router-link> -->
            <router-link class="button is-warning is-small" :to="{ name: 'cogEdit', params: {id: props.row.id }}"><span class="mdi mdi-pencil-box-outline"></span></router-link>
        <a @click="CoaDelete(props.row.id)" class="button is-danger is-small"><span class="mdi mdi-trash-can"></span></a>
        </b-table-column>
        </template>
        </b-table>
    </section>
    <div class="control has-text-centered" v-show="!cogsList.data.length">
        <h1 class="title is-2 is-warning">Record not found</h1>
        <hr>
        <router-link class="button is-primary " :to="{ name: 'cogCreate' }"><i class="fa fa-user-plus m-r-10"></i> Add your first Chart of account click here</router-link>
    </div>
    </template>
<hr>
        <pagination :limit="5" :show-disabled=false :data="cogsList"  @pagination-change-page="getResults"></pagination>

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
                cogsList: {},
                search:'',
                isActive:'',
                isNarrowed: true,
                loading: false,
                defaultSortDirection: 'asc',
                isAvailable: 0,
                searchvendor:[],
                isLoading: false
                
            }
        },
        mounted(){
        this.loadCats();  
    },
        methods: { 
            AccED(){
              axios.get("/cogs./CogsList/" +this.row.isActive)
              //.then(({data}) => (this.cogsList = data));
            }, 
             loadCats(){
                this.isLoading = true
              axios.get('/cogs./CogsList').then(({data}) => {
                  this.isLoading = false
                  this.cogsList = data
            });

            },
            getResults(page = 1) {
                axios.get('/cogs./CogsList?page=' + page)
                  .then(response => {
                    this.cogsList = response.data;
                });
            },

            SearchGet() {
            axios.get('/categories./CatSearch?search=' + this.search)
            .then(({data}) => (this.cogsList = data));
        },
        CoaDelete(id) {
            axios.get('/cogs./CoaDelete/' + id)
            .then(response => { this.success = true;
                      })
            this.loadBanks();
            },
    },
        filters: {
            CreatedAT: function(value){
            return moment().format("DD-MM-YYYY");
        }
    },
    filters: {
        uppercase: function(v) {
      return v.toUpperCase();
    }
}

}

    
</script>
