<template>
<div class="box">
     <div v-if="isLoading">
        <b-loading :active.sync="isLoading" :can-cancel="true"></b-loading>
    </div>
    <div v-if="!isLoading">
    <template>
       <section v-if="getdata.length > 0">
           <div class="columns is-multiline">
            <div class="column is-4"><h3 class="title is-4">Inventory Valuation Summary</h3></div>
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
        <b-table-column field="name" label="Inventory" sortable>
        {{ props.row.name }}
        </b-table-column>
        <b-table-column field="qty" label="On Hand" sortable>
        {{ props.row.qty}}  
        </b-table-column>
        <b-table-column field="name" label="Avg Cost" sortable>
        {{ props.row.cost }}
        </b-table-column>
        <b-table-column field="name" label="Asset Value" sortable>
        {{ props.row.cost * props.row.qty }}
        </b-table-column>
        <b-table-column field="name" label="% of Total Asset" sortable>
            {{ props.row.cost * props.row.qty / av}} %
        </b-table-column>
        <b-table-column field="name" label="W.Sale Price" sortable>
        {{ props.row.wolSale }}
        </b-table-column>
        <b-table-column field="name" label="W. Sale Value" sortable>
            {{ props.row.wolSale * props.row.qty | currency}}
        </b-table-column>
        <b-table-column field="name" label="% of Tot W. Sale" sortable>
            {{ tws / props.row.wolSale  | currency}} %
        </b-table-column>
        <b-table-column field="name" label="Sales Price" sortable>
            {{ props.row.salPrice}}
        </b-table-column>
        <b-table-column field="name" label="Retail Value" sortable>
            {{ props.row.salPrice * props.row.qty | currency}}
        </b-table-column>
        <b-table-column field="name" label="% of Tot Retail" sortable>
            {{ tws / props.row.salPrice | currency}} %
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
                    <div class="th-wrap ">{{ totalqty }}</div>
                </th>
                <th class="is-hidden-mobile">
                    <div class="th-wrap is-numeric"> </div>
                </th>
                <th class="is-hidden-mobile">
                    <div class="th-wrap">{{ av }} </div>
                </th>
                <th class="is-hidden-mobile">
                    <div class="th-wrap"> {{ avt }} </div>
                </th>
                <th class="is-hidden-mobile" >
                    <div class="th-wrap"> </div>
                </th>
                <th class="is-hidden-mobile" >
                    <div class="th-wrap">{{ tws }}</div>
                </th>
                <th>
                        
                </th>
                <th>
                        
                </th>
                <th>
                     dd   
                </th>

                <th class="is-hidden-mobile" >
                    <div class="th-wrap">{{ tws }}</div>
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
              axios.get('/reports./ivs')
              .then(response => this.getdata = response.data);

            },
             

        
        
    },
     computed: {
      
      totalqty: function(){
        
        return this.getdata.reduce(function(total, row){
          return total + row.qty; 
        },0);
      },

      cost: function(){
        return this.getdata.reduce(function(total, row){
          return total + row.CostAmount; 
        },0);
      },

        tws: function(){
            return this.getdata.reduce(function(total, row){
            return total + row.wolSale * row.qty;
            },0);
      },

      av: function(){
            return this.getdata.reduce(function(total, row){
            return total + row.cost * row.qty;
            },0);
      },

      avt: function(){
            return this.getdata.reduce(function(total, row){
            return total + row.cost * row.qty / row.qty;
            },0);
      },


      asset: function(){
            return this.getdata.reduce(function(total, row){
            return total + totalcost / row.qty * 100; 
            },0);
      },

    
    }
    
}

    
</script>
