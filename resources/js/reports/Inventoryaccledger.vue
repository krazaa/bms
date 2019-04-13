<template>
<div class="box">
     <div v-if="isLoading">
        <b-loading :active.sync="isLoading" :can-cancel="true"></b-loading>
    </div>
    <div v-if="!isLoading">
    <template>
       <section v-if="getdata.length > 0">
           <div class="columns is-multiline">
            <div class="column is-4"><h3 class="title is-4">INVENTORY ACCOUNT LEDGER</h3></div>
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
        <b-table-column field="name" label="PO Numbermber" sortable>
        PO-{{ props.row.ponumbers.poid }}
        </b-table-column>
        <b-table-column field="copmany" label="Vendor" sortable>
        {{ props.row.vendors.company }}
        </b-table-column>
        <b-table-column field="name" label="Product" sortable>
        {{ props.row.products.name }}
        </b-table-column>
        <b-table-column field="qty" label="Qty" sortable>
        {{ props.row.ponumbers.qty }}
        </b-table-column>
        <b-table-column field="dr" label="Debit" sortable>
        {{ props.row.dr }}
        </b-table-column>
        <b-table-column field="cr" label="Credit" sortable>
        {{ props.row.cr }}
        </b-table-column>
        <b-table-column field="name" label="Balance" sortable>
        {{ balance }}
        </b-table-column>
        </template>
        <template slot="footer">
                 <th class="is-hidden-mobile">
                    <div class="th-wrap is-numeric"></div>
                </th>
                <th class="is-hidden-mobile">
                    <div class="th-wrap "></div>
                </th>
                <th class="is-hidden-mobile">
                    <div class="th-wrap is-numeric"> </div>
                </th>
                <th class="is-hidden-mobile">
                    <div class="th-wrap"></div>
                </th>
                <th class="is-hidden-mobile">
                    <div class="th-wrap"></div>
                </th>
                <th class="is-hidden-mobile">
                    <div class="th-wrap">{{ dr }}</div>
                </th>
                <th class="is-hidden-mobile" >
                    <div class="th-wrap"> {{ cr }}</div>
                </th>
                <th class="is-hidden-mobile" >
                    <div class="th-wrap">{{ balance }}</div>
                </th>

                
            </template>
        
        </b-table>
    </section>
    <div class="control has-text-centered" v-show="!getdata.length">
        <h1 class="title is-2 is-warning">Record not found</h1>
        <hr>
        <router-link class="button is-primary " :to="{ name: 'cogCreate' }"><i class="fa fa-user-plus m-r-10"></i> Add your first Chart of account click here</router-link>
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
              axios.get('/reports./inventAccledger')
              .then(response => this.getdata = response.data);

            },
             

        
        
    },
     computed: {
      
      dr: function(){
        
        return this.getdata.reduce(function(total, row){

          return total + row.dr; 
        },0);
      },

      cr: function(){
        return this.getdata.reduce(function(total, row){
          return total + row.cr; 
        },0);
      },

     

      balance: function(){
        
        return this.getdata.reduce(function(total, row){

          return total + row.dr - row.cr; 
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
