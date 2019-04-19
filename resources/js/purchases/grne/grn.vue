<template>
<div class="box">
     <div v-if="isLoading">
        <b-loading :active.sync="isLoading" :can-cancel="true"></b-loading>
    </div>
    <div v-if="!isLoading">
    <template>
       <section v-if="getdata.length > 0">
           <div class="columns is-multiline">
            <div class="column is-4"> 
                <h3 class="title is-4">Goods Received Note.</h3></div>
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

        <div class="columns is-multiline">
            <div class="column is-6">
                Vendor Name: <b>{{ getdata[0].company }}</b><br> 
                Phone: <b>{{ getdata[0].contact }}</b><br>
                Address: <b>{{ getdata[0].address }}</b><br>
                Transporter Name: <b>{{ getdata[0].transporter }}</b><br>
                Transportation<b> {{ TotalCargo | currency}}</b><br>
            </div>
            <div class="column is-3">
                P. Order No: <b> POE-{{ getdata[0].poid }}</b><br>
                Delivery No: <b>{{ getdata[0].dno }}</b><br>
                Sales Tax Inv: <b>{{ getdata[0].stinv }}</b><br>
                PO Status: <b>Received</b><br>
                Payable - Vendor <b>{{ totalcost + getdata[0].tax | currency}}</b>
            </div>
            <div class="column is-3">
                Order Date: <b>{{ getdata[0].podate | formatDate}} </b><br>
                Dispatch Date: <b>{{ getdata[0].ddate | formatDate}}</b><br>
                Receiving Date: <b>{{ getdata[0].rdate | formatDate}}</b><br>
                Due Date: <b>{{ getdata[0].duedate | formatDate}}</b><br>
                Income Tax: <b>{{ getdata[0].tax | currency}}</b>
            </div>    
        </div>
        
        <b-table
            :data="getdata" 
            :key="index"
            :loading="isLoading"
            :narrowed="isNarrowed"
            :default-sort-direction="defaultSortDirection"
             default-sort="getdata.name">
        <template slot-scope="props">
        <b-table-column field="id" label="ID" width="40" sortable>
        {{ props.index + 1 }}
        </b-table-column>
        <b-table-column field="name" label="Code" sortable>
        {{ props.row.code }}
        </b-table-column>
        <b-table-column field="qty" label="Product Name." sortable>
        {{ props.row.name}}  
        </b-table-column>
        <b-table-column field="name" label="MPN" sortable>
        {{ props.row.manpartno }}
        </b-table-column>
        <b-table-column field="name" label="Category" sortable>
        {{ props.row.category }}
        </b-table-column>
        <b-table-column field="name" label="Sub Category" sortable>
            {{ props.row.subcat }}
        </b-table-column>
        <b-table-column field="qty" label="Qty" sortable>
            {{ props.row.qty}} 
        </b-table-column>
        <b-table-column field="name" label="Cost" sortable numeric>
            {{ props.row.cost}} 
        </b-table-column>
        <b-table-column field="tcost" label="T. Cost" sortable numeric>
            {{ props.row.cost * props.row.qty}} 
        </b-table-column>
        <b-table-column field="cargo" label="Cargo" sortable numeric>
            {{  props.row.cargopu * props.row.qty | currency}}
        </b-table-column>
        <b-table-column field="cpu" label="P/U" sortable numeric>
            {{ props.row.cargopu | currency}}
        </b-table-column>
        <b-table-column field="name" label="Ad Cost" sortable numeric>
        {{ props.row.cost + props.row.cargopu | currency}}
        </b-table-column>
        <b-table-column field="name" label="Ad T Cost" sortable numeric>
        {{ props.row.cost * props.row.qty + props.row.cargopu | currency}} 
        </b-table-column>
        </template>
        <template slot="footer">
            
                 <th>
                    <div class="th-wrap is-numeric"></div>
                </th>
                
                <th>
                    <div class="th-wrap is-numeric"></div>
                </th>
                <th>
                    <div class="th-wrap "></div>
                </th>
                <th>
                    <div class="th-wrap is-numeric"> </div>
                </th>
                <th>
                    <div class="th-wrap"> </div>
                </th>
                <th >
                    <div class="th-wrap"></div>
                </th>
                <th>
                    <div class="th-wrap" numeric> {{ totalqty }}</div>
                </th>
                <th>
                    <div class="th-wrap" > </div>
                </th>
                <th>
                    <div class="th-wrap is-numeric"> {{ totalcost | currency}}</div>
                </th>
                <th>
                    <div class="th-wrap is-numeric">{{ TotalCargo | currency}}</div></th>
                <th></th>
                <th></th>
                <th numeric><p class="has-text-right">{{ atc | currency }}</p></th>
            
            </template>
        </b-table>
         <div class="columns is-multiline">
            <div class="column is-3">
                Accounts<br>
                Inventory <br>
                Income Tax <br>
                Payable - Vendor <br>
                Payable - Services <br>
            </div>
            <div class="column is-3">
                <div class="columns is-multiline">
                    <div class="column is-6">Debit
                        <br><b>{{ TotalCargo + totalcost | currency}}</b>
                        <br><b>{{ getdata[0].tax }}</b>
                        <br><b></b>
                        <br><b></b>
                        <br><b>{{ getdata[0].tax + TotalCargo + totalcost | currency }}</b>
                        
                    </div>
                    <div class="column is-6">Credit
                        <br><b></b>
                        <br>
                        <br><b>{{ totalcost + getdata[0].tax }}</b>
                        <br><b>{{ TotalCargo | currency}}</b>
                        <br><b>{{ TotalCargo + totalcost + getdata[0].tax | currency}}</b>
                    </div>

                </div>
            </div>

        </div>
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
    export default {
        props: ['id'], 
        data(){
            return {
                getdata: {},
                company: {},
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
        this.FetchCompany();  
    },
        methods: { 
             FetchData(){
               axios.get("/grns./GetGrn/" + this.id)
              .then(response => this.getdata = response.data);
            },        

            FetchCompany(){
               axios.get("/settings./GetSetting/1")
              .then(response => this.company = response.data);
            },        
        
    },
     computed: {
      
      totalqty: function(){
        
        return this.getdata.reduce(function(total, row){

          return total + row.qty; 
        },0);
      },

      TotalCargo: function(){
        return this.getdata.reduce(function(total, row){
          return total + row.cargopu * row.qty; 
        },0);
      },

      

        totalcost: function(){
            return this.getdata.reduce(function(total, row){
            return total + row.qty * row.cost; 
            },0);
      },

      atc: function(){
            return this.getdata.reduce(function(total, row){
            return total + (row.cost + row.cargopu) * row.qty; 
            },0);
      },

      balance: function(){
        
        return this.getdata.reduce(function(total, row){

          return total + row.debit - row.credit; 
        },0);
      }
    },
   filters: {
      
    currNum (amount) {
      const amt = Number(amount)
      return amt && amt.toLocaleString(undefined, {minimumIntegerDigits:1}) || '0'
        },
        
    }
}

    
</script>
