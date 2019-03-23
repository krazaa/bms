<template>
<div class="box">
    <div v-if="loading">
            
        </div>

        <div v-if="!loading">
            <!-- here is your application code -->
        </div>
    <template>
    <section v-if="exciseload.data.length > 0">

        <b-field grouped group-multiline>
        <div class="control is-flex">
            <h3 class="title is-4">Manage Excise and Taxation Office</h3>
        </div>
        <div class="control is-flex">
            <b-field>
            <b-input v-model="search" name="search" placeholder="Keyword Seach" @input="SearchGet"></b-input>
            </b-field>
        </div>
        <div class="control is-flex">
            <router-link class="button is-primary is-pulled-right" :to="{ name: 'excisentaxationCreate' }"><i class="fa fa-user-plus m-r-10"></i> New Office</router-link>
        </div>
        </b-field>
        <p class="level-item">
            <span class="is-pulled-right" v-if="loading">
                <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i>
            </span>
        </p>
        <b-table
            :data="exciseload.data"
            :loading="loading"
            :narrowed="isNarrowed"
            :default-sort-direction="defaultSortDirection"
             default-sort="exciseload.office">
        <template slot-scope="props">
        <b-table-column field="id" label="ID" width="40" sortable>
        {{ props.row.id }}
        </b-table-column>
        <b-table-column field="office" label="Office" sortable>
        {{ props.row.office }}
        </b-table-column>
        <b-table-column field="agent" label="Agent" sortable>
        {{ props.row.company }} {{ props.row.person }}
        </b-table-column>
        <b-table-column field="model" label="Model" sortable>
        {{ props.row.model }}
        </b-table-column>
        <b-table-column field="cost" label="Cost" sortable>
        {{ props.row.cost}}
        </b-table-column>
        <b-table-column field="selling" label="Selling" sortable>
        {{ props.row.selling}}
        </b-table-column>        
        <b-table-column label="Action" centered>
            <router-link class="button is-success is-small" :to="{ name: 'bankShow', params: {id: props.row.id }}"><span class="mdi mdi-eye"></span></router-link>
            <router-link class="button is-warning is-small" :to="{ name: 'excisentaxationEdit', params: {id: props.row.id }}"><span class="mdi mdi-pencil-box-outline"></span></router-link>
        <a @click="ExciseDelete(props.row.id)" class="button is-danger is-small"><span class="mdi mdi-trash-can"></span></a>
        </b-table-column>
        </template>
        </b-table>
    </section>
            <div class="control has-text-centered" v-show="!exciseload.data.length">
        <h1 class="title is-2 is-warning">Record not found</h1>
        <hr>
        <router-link class="button is-primary " :to="{ name: 'excisentaxationCreate' }"><i class="fa fa-user-plus m-r-10"></i> Add first Excise and Taxation Office click here</router-link>
    </div>
    </template>
<hr>
        <pagination :limit="5" :show-disabled=false :data="exciseload"  @pagination-change-page="getResults"></pagination>
        
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
                exciseload: {},
                search:'',
                isActive:'',
                isNarrowed: true,
                loading: false,
                defaultSortDirection: 'asc',
                isAvailable: 0,
                searchvendor:[]
                
            }
        },
        mounted(){
        this.loadExcise();  
    },
        methods: { 
            ExciseED(id,){
              axios.get("/excise./ExciseED/" + id )
              // .then(response => { this.success = true;
              //         })
            this.loadBanks();
            }, 
             loadExcise(){
              this.loading = true
              axios.get("/excise./ExciseListGet").then(({data}) => (this.exciseload = data)
                )
              this.loading = false
            },
            getResults(page = 1) {
                axios.get('/excise./ExciseListGet?page=' + page)
                  .then(response => {
                    this.exciseload = response.data;
                });
            },
            SearchGet() {
            axios.get('/excise./ExciseSearch?search=' + this.search)
            .then(({data}) => (this.exciseload = data));
            },
            ExciseDelete(id) {
            axios.get('/excise./ExciseDelete/' + id)
            .then(response => { this.success = true;
                      })
            this.loadExcise();
            },
    },
        filters: {
            CreatedAT: function(value){
            return moment().format("DD-MM-YYYY");
        }
    },

}

    
</script>
