<template>
<div class="box">
     <div v-if="isLoading">
        <b-loading :active.sync="isLoading" :can-cancel="true"></b-loading>
    </div>
    <div v-if="!isLoading">
    <template>
       <section v-if="cogsList.length > 0">
           <div class="columns is-multiline">
            <div class="column is-4"><h3 class="title is-4">Account Balance Report</h3></div>
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
        <p class="level-item">
            <span class="is-pulled-right" v-if="loading">
                <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i>
            </span>
        </p>
        <b-table
            :data="cogsList"
            :loading="isLoading"
            :narrowed="isNarrowed"
            :default-sort-direction="defaultSortDirection"
             default-sort="cogsList.aname">
        <template slot-scope="props">
        <b-table-column field="id" label="ID" width="40" sortable>
        {{ props.row.id }}
        </b-table-column>
        <b-table-column field="acode" label="Code" sortable>
        {{ props.row.accounts.acode }}
        </b-table-column>
        <b-table-column field="aname" label="Account Name" sortable>
        {{ props.row.accounts.aname }}
        </b-table-column>
        <b-table-column field="debitcredit" label="Dr/Cr" sortable>
            <p v-if="props.row.accounts.debitcredit == 1">Both </p>
            <p v-if="props.row.accounts.debitcredit == 2">Debit </p>
            <p v-if="props.row.accounts.debitcredit == 3">Credit </p>
        
        </b-table-column>
        <b-table-column field="class" label="Class" sortable>
        {{ props.row.accounts.class}}
        </b-table-column>
        
        <b-table-column field="debit" label="Debit" sortable >
            {{  props.row.debit}}
        </b-table-column>
        <b-table-column field="credit" label="Credit" sortable >
            {{ props.row.credit}}
        </b-table-column>
        <b-table-column field="bal" label="Balance" sortable>
        {{ balance + props.row.debit}}  
        </b-table-column>
        </template>
        <template slot="footer">
                 <th class="is-hidden-mobile">
                    <div class="th-wrap is-numeric"></div>
                </th>
                
                <th class="is-hidden-mobile">
                    <div class="th-wrap is-numeric"></div>
                </th>
                <th class="is-hidden-mobile">
                    <div class="th-wrap is-numeric"> </div>
                </th>
                <th class="is-hidden-mobile">
                    <div class="th-wrap is-numeric"> </div>
                </th>
                <th class="is-hidden-mobile">
                    <div class="th-wrap is-numeric"> </div>
                </th>
                <th class="is-hidden-mobile">
                    <div class="th-wrap" > {{ debit }} </div>
                </th>
                <th class="is-hidden-mobile" >
                    <div class="th-wrap"> {{ credit }} </div>
                </th>
                <th class="is-hidden-mobile" >
                    <div class="th-wrap">  {{  balance  }}</div>
                </th>

                
            </template>
        
        </b-table>
    </section>
    <div class="control has-text-centered" v-show="!cogsList.length">
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
             loadCats(){
                //this.isLoading = true
              axios.get('/reports./CogABR')
              .then(response => this.cogsList = response.data);

              //.then(({data}) => { this.isLoading = false
                  //this.cogsList = data.data
            //});

            },
             

        
        
    },
     computed: {
      
      debit: function(){
        
        return this.cogsList.reduce(function(total, row){

          return total + row.debit; 
        },0);
      },

      credit: function(){
        
        return this.cogsList.reduce(function(total, row){

          return total + row.credit; 
        },0);
      },

      balance: function(){
        
        return this.cogsList.reduce(function(total, row){

          return total + row.debit - row.credit; 
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
