<template>
<div class="box">
    <div v-if="isLoading">
        <b-loading :active.sync="isLoading" :can-cancel="true"></b-loading>
    </div>
    <div v-if="!isLoading">
    <template>
    <section v-if="vendors.data.length > 0">
    <div class="columns is-multiline">
            <div class="column is-3"><h3 class="title is-4">Manage Vendors</h3></div>
              <div class="column is-3">
                <h3 class="title is-4">
                <b-field>
            <b-input v-model="searchvendor" name="search" placeholder="Keyword Seach" @input="VendorGet"></b-input>
            </b-field>
          </h3>
          </div>
          <div class="column is-2">
              <router-link class="button is-primary d-inline-block is-pulled-right" :to="{ name: 'create' }"><i class="fa fa-user-plus m-r-10"></i> New Vendor</router-link>
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
            :data="vendors.data"
            :loading="isLoading"
            :narrowed="isNarrowed"
            :default-sort-direction="defaultSortDirection"
             :default-sort="vendors.data.company">
        <template slot-scope="props">
        <b-table-column field="id" label="ID" width="40" sortable numeric>
        {{ props.row.id }}
        </b-table-column>
        <b-table-column field="brands.bran" label="Make"  sortable>
        {{ props.row.type }}
        </b-table-column>
        <b-table-column field="brands.bran" label="Brand"  sortable>
        {{ props.row.brands.brand }}
        </b-table-column>
        <b-table-column field="code" label="Code" sortable>
        {{ props.row.vnum }}
        </b-table-column>
        <b-table-column field="company" label="Vendor Name" sortable>
        {{ props.row.company }}
        </b-table-column>
        <b-table-column field="person" label="Contact Person" sortable>
        {{ props.row.person }}
        </b-table-column>
        <b-table-column field="mobile" label="Mobile" sortable>
        {{ props.row.mobile }}
        </b-table-column>
        <b-table-column field="ntn" label="NTN" sortable>
        {{ props.row.ntn }}
        </b-table-column>
        <b-table-column field="strn" label="STRN" sortable>
        {{ props.row.salestax }}
        </b-table-column>
        <b-table-column field="isActive" label="Status">
            <b-switch v-model="props.row.isActive" name="isActive"
            :true-value="1"
            :false-value="0"
            type="is-success" @input="VendorED(props.row.id)">
            </b-switch>
            </b-table-column>
        <b-table-column label="Action" centered>
        <router-link class="button is-info is-small" :to="{ name: 'vendorEdit', params: {id: props.row.id }}"><span class="mdi mdi-pencil-box-outline"></span></router-link>
            <a @click="onDelete(props.row.id)" class="button is-danger is-small"><span class="mdi mdi-trash-can"></span></a>
        </b-table-column>
        </template>
        </b-table>
    </section>
       <div class="control has-text-centered" v-show="!vendors.data.length">
        <h1 class="title is-2 is-warning">Record not found</h1>
        <hr>
        <router-link class="button is-primary " :to="{ name: 'create' }"><i class="fa fa-user-plus m-r-10"></i> Add your first Vendor click here</router-link>
    </div>
    </template>
<hr>

        <pagination :limit="5" :show-disabled=false :data="vendors"  @pagination-change-page="getResults"></pagination>
</div>
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
    export default {
        data(){
            return {
                vendors: {},
                searchvendor:'',
                isNarrowed: true,
                isLoading: false,
                defaultSortDirection: 'asc',
                isAvailable: 0,
                interval: null,
                searchvendor:[]
            }
        },
        mounted(){
            this.loadVendor();
            // this.interval = setInterval(function () {
            // this.loadVendor();
            // }.bind(this), 10000);
    },
        methods: { 
            VendorED(id,){
              axios.get("/vendors./VendorED/" + id )
            },  
             loadVendor(){
              this.isLoading = true
              axios.get("vendors./GetVendors").then(({data}) => {
                  this.isLoading = false
                  this.vendors = data
                });
            },
            getResults(page = 1) {
                this.isLoading = true
                axios.get('/vendors./GetVendors?page=' + page)
                  .then(response => {
                    this.isLoading = false
                    this.vendors = response.data;
                });
            },
             onDelete(id) {
            axios.get('/vendors./VendorDelete/' + id)
            //
            
            .then(response => { this.success = true })

            //
            this.loadVendor();
            },

            VendorGet() {
            axios.get('/vendors./VendorSearch?search=' + this.searchvendor)
                .then(({data}) => {
                    (this.vendors = data)
            });
            
        },
    }        
}

    
</script>
