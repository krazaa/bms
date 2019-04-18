<template>
<div class="box">
     <div v-if="isLoading">
        <b-loading :active.sync="isLoading" :can-cancel="true"></b-loading>
    </div>
    <div v-if="!isLoading">
    <template>
       <section v-if="getdata.length > 0">
           <div class="columns is-multiline">
            <div class="column is-4"><h3 class="title is-4">Account Payable Ledger</h3></div>
                    <div class="column is-8">
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
        
        <b-table
            :data="getdata"
            :loading="isLoading"
            :narrowed="isNarrowed"
            :default-sort-direction="defaultSortDirection"
             default-sort="getdata.aname">
        <template slot-scope="props">
        <b-table-column field="id" label="ID" width="40" sortable>
        {{ props.row.id }}
        </b-table-column>
        <b-table-column field="copmany" label="Vendor" sortable>
        {{ props.row.vendors.company }}
        </b-table-column>
        <b-table-column field="credit" label="Balance" sortable>
        {{ props.row.credit }}
        </b-table-column>
        </template>
        <template slot="footer">
                 <th class="is-hidden-mobile"></th>
                <th></th>
                <th><div class="th-wrap">{{ balance }}</div></th>
            </template>
        
        </b-table>
    </section>
    <div class="control has-text-centered" v-show="!getdata.length">
        <h1 class="title is-2 is-warning">Record not found</h1>
        <hr>
        <router-link class="button is-primary " :to="{ name: 'dashboard' }"><i class="fa fa-user-plus m-r-10"></i> Back to Dashboard</router-link>
    </div>
    </template>
<hr>

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
                getdata: {},
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
        this.FetchData();  
    },
        methods: { 
             FetchData(){
                //this.isLoading = true
              axios.get('/ledgers./vbs')
              .then(response => this.getdata = response.data);

            },
    },
     computed: {
    

      cr: function(){
        return this.getdata.reduce(function(total, row){
          return total + row.credit; 
        },0);
      },

     

      balance: function(){
        
        return this.getdata.reduce(function(total, row){

          return total + row.credit ; 
        },0);
      }
    },
    filters: {
            CreatedAT: function(value){
            return moment().format("DD-MM-YYYY");
            }
        },
}

    
</script>
