<template>
<div class="box">
    <div v-if="isLoading">
        <b-loading :active.sync="isLoading" :can-cancel="true"></b-loading>
    </div>
    <div v-if="!isLoading">
    <template>
    <section v-if="banksload.data.length > 0">
    <div class="columns is-multiline">
            <div class="column is-3"><h3 class="title is-4">Manage Banks</h3></div>
              <div class="column is-3">
                <h3 class="title is-4">
                <b-field>
            <b-input v-model="search" name="search" placeholder="Keyword Seach" @input="SearchGet"></b-input>
            </b-field>
          </h3>
          </div>
          <div class="column is-2">
              <router-link class="button is-primary d-inline-block is-pulled-right" :to="{ name: 'bankCreate' }"><i class="fa fa-user-plus m-r-10"></i> New Bank</router-link>
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


      
        <b-table
            :data="banksload.data"
            :loading="isLoading"
            :narrowed="isNarrowed"
            :default-sort-direction="defaultSortDirection"
             default-sort="banksload.company">
        <template slot-scope="props">
        <b-table-column field="id" label="ID" width="40" sortable>
        {{ props.row.id }}
        </b-table-column>
        <b-table-column field="bank" label="Bank Name" sortable>
        {{ props.row.bank }}
        </b-table-column>
        <b-table-column field="account" label="Account No" sortable>
        {{ props.row.account }}
        </b-table-column>
        <b-table-column field="iban" label="IBAN No" sortable>
        {{ props.row.iban }}
        </b-table-column>
        <b-table-column field="branchcode" label="Branch Code" sortable>
        {{ props.row.branchcode }}
        </b-table-column>
        <b-table-column field="city" label="City" sortable>
        {{ props.row.city }}
        </b-table-column>        
        <b-table-column field="isActive" label="Status" sortable>
            <b-switch v-model="props.row.isActive" name="isActive"
            :true-value="1" 
            :false-value="0"
            type="is-success"
            size="is-small" @input="BankED(props.row.id)">
            </b-switch>
        </b-table-column>
        <b-table-column label="Action" centered>
            <router-link class="button is-warning is-small" :to="{ name: 'bankEdit', params: {id: props.row.id }}"><span class="mdi mdi-pencil-box-outline"></span></router-link>
        <a @click="BankDelete(props.row.id)" class="button is-danger is-small"><span class="mdi mdi-trash-can"></span></a>
        </b-table-column>
        </template>
        </b-table>
    </section>
            <div class="control has-text-centered" v-show="!banksload.data.length">
        <h1 class="title is-2 is-warning">Record not found</h1>
        <hr>
        <router-link class="button is-primary " :to="{ name: 'bankCreate' }"><i class="fa fa-user-plus m-r-10"></i> Add your first Bank Account click here</router-link>
    </div>
    </template>
<hr>
        <pagination :limit="5" :show-disabled=false :data="banksload"  @pagination-change-page="getResults"></pagination>
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
                banksload: {},
                search:'',
                isActive:'',
                isNarrowed: true,
                isLoading: false,
                defaultSortDirection: 'asc',
                isAvailable: 0,
                searchvendor:[]
                
            }
        },
        mounted(){
        this.loadBanks();  
    },
        methods: { 
            BankED(id,){
              axios.get("/banks./BankED/" + id )
              // .then(response => { this.success = true;
              //         })
            //this.loadBanks();
            }, 
            loadBanks(){
              this.isLoading = true
              axios.get("banks./BanksListGet").then(({data}) => {
                  this.isLoading = false
                  this.banksload = data
            });
          },
            getResults(page = 1) {
                this.isLoading = true
                axios.get('/banks./BanksListGet?page=' + page)
                  .then(response => {
                    this.isLoading = false
                    this.banksload = response.data;
                });
            },
            SearchGet() {
            axios.get('/banks./BankSearch?search=' + this.search)
            .then(({data}) => (this.banksload = data));
            },
            BankDelete(id) {
            axios.get('/banks./BankDelete/' + id)
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
  

}

    
</script>
