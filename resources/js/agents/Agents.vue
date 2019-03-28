<template>
<div class="box">
    <div v-if="isLoading">
        <b-loading :active.sync="isLoading" :can-cancel="true"></b-loading>
    </div>
    <div v-if="!isLoading">
        <template>
        <section v-if="agentsload.data.length > 0">
            <b-field grouped group-multiline>
            <div class="control is-flex">
                <h3 class="title is-4">Manage Agents</h3>
            </div>
            <div class="control is-flex">
                <b-field>
                <b-input v-model="search" name="search" placeholder="Keyword Seach" @input="SearchGet"></b-input>
                </b-field>
            </div>
            <div class="control is-flex">
                <router-link class="button is-primary is-pulled-right" :to="{ name: 'agentCreate' }"><i class="fa fa-user-plus m-r-10"></i> New Agent</router-link>
            </div>
            </b-field>
            
            <b-table
            :data="agentsload.data"
            :loading="isLoading"
            :narrowed="isNarrowed"
            :default-sort-direction="defaultSortDirection"
            default-sort="agentsload.data.company">
            <template slot-scope="props">
            <b-table-column field="id" label="ID" width="40" sortable>
            {{ props.row.id }}
            </b-table-column>
            <b-table-column field="company" label="Company Name" sortable>
            {{ props.row.company }}
            </b-table-column>
            <b-table-column field="person" label="Contact Person" sortable>
            {{ props.row.person }}
            </b-table-column>
            <b-table-column field="cnic" label="CNIC" sortable>
            {{ props.row.cnic }}
            </b-table-column>
            <b-table-column field="mobile" label="Mobile" sortable>
            {{ props.row.mobile }}
            </b-table-column>
            <b-table-column field="tel" label="Telephone" sortable>
            {{ props.row.tel}}
            </b-table-column>
            <b-table-column field="isActive" label="Status" sortable>
            <b-switch v-model="props.row.isActive" name="isActive"
            :true-value="1"
            :false-value="0"
            type="is-success" @input="AgentED(props.row.id)">
            </b-switch>
            </b-table-column>
            <b-table-column label="Action" centered>
        <!--     <router-link class="button is-success is-small" :to="{ name: 'agentShow', params: {id: props.row.id }}"><span class="mdi mdi-eye"></span></router-link> -->
            <router-link class="button is-warning is-small" :to="{ name: 'agentEdit', params: {id: props.row.id }}"><span class="mdi mdi-pencil-box-outline"></span></router-link>
            <a @click="AgentDelete(props.row.id)" class="button is-danger is-small"><span class="mdi mdi-trash-can"></span></a>
            </b-table-column>
            </template>
            </b-table>
        </section>
         <div class="control has-text-centered" v-show="!agentsload.data.length">
        <h1 class="title is-2 is-warning">Record not found</h1>
        <hr>
        <router-link class="button is-primary " :to="{ name: 'agentCreate' }"><i class="fa fa-user-plus m-r-10"></i> Add your first Agent click here</router-link>
    </div>
        </template>
        <hr>
    <pagination :limit="5" :show-disabled=false :data="agentsload"  @pagination-change-page="getResults"></pagination>
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
                agentsload: {},
                search:'',
                isActive:'',
                isNarrowed: true,
                success: false,
                isLoading: false,
                defaultSortDirection: 'asc',
                isAvailable: 0,
                searchvendor:[]
                
            }
        },
        mounted(){
        this.loadAgents();  
    },
        methods: { 
            AgentED(id,){
              axios.get("/agents./AgentED/" + id )
              // .then(response => { this.success = true;
              //         })
            //this.loadAgents();
            }, 
             loadAgents(){
                 this.isLoading = true
              axios.get("agents./AgentsListGet").then(({data}) => {
                  this.isLoading = false
                  this.agentsload = data  });

            },
            getResults(page = 1) {
                axios.get('/agents./AgentsListGet?page=' + page)
                  .then(response => {
                    this.agentsload = response.data;
                });
            },
            SearchGet() {
            axios.get('/agents./CheckAvailable?search=' + this.search)
            .then(({data}) => (this.agentsload = data));
            },
            AgentDelete(id) {
            axios.get('/agents./AgentDelete/' + id)
            .then(response => { this.success = true;
                      })
            this.loadAgents();
            },
    },
        filters: {
            CreatedAT: function(value){
            return moment().format("DD-MM-YYYY");
        }
    },

}

    
</script>
