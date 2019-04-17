<template>
<div class="box">
     <div v-if="isLoading">
        <b-loading :active.sync="isLoading" :can-cancel="true"></b-loading>
    </div>
    <div v-if="!isLoading">
    <template>
       <section v-if="getdata.length > 0">
           <div class="columns is-multiline">
            <div class="column is-4"><h3 class="title is-4">Goods Received Note List</h3></div>
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
        {{ props.index + 1 }}
        </b-table-column>
        <b-table-column field="type" label="Type" sortable>
            <p v-if="props.row.type == 1">Vehicles</p>
        <p v-if="props.row.type == 2">Electronics</p>
        </b-table-column>
        <b-table-column field="company" label="Vendor" sortable>
        {{ props.row.company }}
        </b-table-column>
        <b-table-column field="name" label="PO Number" sortable>POE-{{ props.row.poid}}
        </b-table-column>
        <b-table-column field="refno" label="Ref no" sortable>
        {{ props.row.refno}}
        </b-table-column>
        <b-table-column field="podate" label="Date" sortable>
        {{ props.row.podate | formatDate}}
        </b-table-column>
        <b-table-column label="Payment" sortable>
         <span class="is-success" v-if="props.row.isPaid === 0">Unpaid</span>
         <span class="is-warning" v-if="props.row.isPaid === 1">Paid</span>
        
        </b-table-column>
         <b-table-column label="Action" width="200">
          <a :href="`/grns./GetGrnpdf/` + props.row.poid" class="button is-dark is-small"><span class="mdi mdi-printer"></span></a>
          <!-- <a :href="`/grns./GrneExcel/` + props.row.poid" class="button is-warning is-small"><span class="mdi mdi-file-excel"></span></a> -->
             <router-link class="button is-success is-small" :to="{ name: 'grne', params: {id: props.row.poid}}"><span class="mdi mdi-eye-circle-outline"></span></router-link>
             <router-link class="button is-info is-small" to="/"><span class="mdi mdi-pencil-box-outline"></span></router-link>
        <a @click="vDelete(props.row.id)" class="button is-danger is-small"><span class="mdi mdi-trash-can"></span></a>
        </b-table-column>
        </template>
        </b-table>
    </section>
    <div class="control has-text-centered" v-show="!getdata.length">
        <h1 class="title is-2 is-warning">Record not found</h1>
        <hr>
        <router-link class="button is-primary " :to="{ name: 'grnsList' }"> Add your first GRN click here</router-link>
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
               axios.get("/grns.//GrnsList/")
              .then(response => this.getdata = response.data);

            },        
        
    },
     
}

    
</script>
