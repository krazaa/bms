<template>
<div class="box">
    <template>
    <section>
        <b-field grouped group-multiline>
        <div class="control is-flex">
            <h3 class="title is-4">Manage Vedors</h3>
        </div>
        <div class="control is-flex">
            <b-field>
            <b-input v-model="searchvendor" name="search" placeholder="Keyword Seach" @input="VendorGet"></b-input>
            </b-field>
        </div>
        <div class="control is-flex">
            <b-select v-model="perPage" :disabled="!isPaginated">
            <option value="15">15 per page</option>
            <option value="30">30 per page</option>
            <option value="50">50 per page</option>
            <option value="100">100 per page</option>
            </b-select>
        </div>
        <div class="control is-flex">
            <router-link class="button is-primary is-pulled-right" :to="{ name: 'create' }"><i class="fa fa-user-plus m-r-10"></i> New Vendor</router-link>
        </div>
        </b-field>
        <p class="level-item">
            <span class="is-pulled-right" v-if="loading">
                <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i>
            </span>
        </p>
        <!-- {{ vendors }} -->
        <b-table
            :data="vendors.data"
            :loading="loading"
            :narrowed="isNarrowed"
            :default-sort-direction="defaultSortDirection"
             default-sort="vendors.name">
        <template slot-scope="props">
        <b-table-column field="vnum" label="Vendor ID" width="40" sortable>
        {{ props.row.vnum }}
        </b-table-column>
        <b-table-column field="company" label="Company" sortable>
        {{ props.row.company }}
        </b-table-column>
        <b-table-column field="person" label="Contact Person" sortable>
        {{ props.row.person }}
        </b-table-column>
        <b-table-column field="mobile" label="Mobile" sortable>
        {{ props.row.mobile }}
        </b-table-column>
        <b-table-column field="contact" label="Telephone" sortable>
        {{ props.row.contact }}
        </b-table-column>
        <b-table-column label="Action" centered>
        <a :href="`/manage/users/singleuser/${props.row.id}`" class="button is-success is-small"><span class="mdi mdi-eye"></span></a>
        <a :href="`/manage/users/edit/${props.row.id}`" class="button is-warning is-small"><span class="mdi mdi-pencil-box-outline"></span></a>
        <a :href="`/manage/users/edit/${props.row.id}`" class="button is-danger is-small"><span class="mdi mdi-trash-can"></span></a>
        </b-table-column>
        </template>
        </b-table>
    </section>
    </template>
<hr>

        <pagination :limit="5" :show-disabled=false :data="vendors"  @pagination-change-page="getResults"></pagination>

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
                vendors: [],
                searchvendor:'',
                isNarrowed: true,
                loading: false,
                isPaginated: true,
                isPaginationSimple: false,
                defaultSortDirection: 'asc',
                currentPage: 3,
                perPage: 40,
                isAvailable: 0,
                searchvendor:[]
                
            }
        },
        mounted(){
        // axios.get('/vendors./GetVendors')
        //     .then((response)=> this.vendors = this.temp = response.data)
        //     .catch((error) => this.errors = error.response.data.errors)
        this.loadVendor();  
    },
        methods: {  
             loadVendor(){
              this.loading = true
              axios.get("vendors./GetVendors").then(({data}) => (this.vendors = data));
              this.loading = false
            },
            getResults(page = 1) {
                axios.get('/vendors./GetVendors?page=' + page)
                  .then(response => {
                    this.vendors = response.data;
                });
            },

            VendorGet() {
            //var search = this
            axios.get('/vendors./VendorSearch?search=' + this.searchvendor)
            .then(({data}) => (this.vendors = data));
                //.then((data)=> {this.vendors = data })
        },
    }        
}

    
</script>
