<template>
  <section>
<!-- <div class="box"> -->
     <div v-if="isLoading">
        <b-loading :active.sync="isLoading" :can-cancel="true"></b-loading>
    </div>
    <div v-if="!isLoading">
    <template>
    <section v-if="getDataload.data.length > 0">
        <div class="columns is-multiline">
            <div class="column is-3"><h3 class="title is-4">Manage Purchase Order</h3></div>
              <div class="column is-3">
                <h3 class="title is-4">
                <b-field>
            <b-input v-model="search" name="search" placeholder="Keyword Seach" @input="SearchAutos"></b-input>
            </b-field>
          </h3>
          </div>
          <div class="column is-2">
              <router-link class="button is-primary d-inline-block is-pulled-right" :to="{ name: 'poECreate' }"><i class="fa fa-user-plus m-r-10"></i> New Purchase Order</router-link>
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
            :data="getDataload.data"
            :loading="isLoading"
            :narrowed="isNarrowed"
            :default-sort-direction="defaultSortDirection"
             default-sort="getDataload.data.name">
        <template slot-scope="props">
        <b-table-column field="poid" label="PO ID" width="60" sortable>
        EPO-{{ props.row.poid }}
        </b-table-column>
        <b-table-column field="company" label="Vendor" sortable>
        {{ props.row.company }}
        </b-table-column>
        <b-table-column field="refno" label="Reference No" sortable>
        {{ props.row.refno }}
        </b-table-column>
        <b-table-column field="podate" label="Order Date" width="60" sortable>
        {{ props.row.podate | formatDate }}
        </b-table-column>
        
        <b-table-column field="branch" label="Branch" sortable>
        {{ props.row.branch }}
        </b-table-column>
        <!-- <b-table-column field="cost" label="Cost" width="80" sortable>
        {{ props.row.cost }}
        </b-table-column> -->

        <b-table-column field="isActive" label="Status" width="30" sortable right>
            <b-switch v-model="props.row.isActive" name="isActive"
            :true-value="1" 
            :false-value="0"
            size="is-small"
            type="is-success" @input="ChangeStatus(props.row.id)">
            </b-switch>
        </b-table-column>
        <b-table-column label="Action" width="140" centered>
             <!-- <router-link class="button is-success is-small" :to="{ name: 'AutosShow', params: {id: props.row.id}}"><span class="mdi mdi-eye-circle-outline"></span></router-link>
             <router-link class="button is-info is-small" :to="{ name: 'editproduct', params: {id: props.row.id}}"><span class="mdi mdi-pencil-box-outline"></span></router-link> -->
        
        <a @click="vDelete(props.row.id)" class="button is-danger is-small"><span class="mdi mdi-trash-can"></span></a>
        </b-table-column>
        </template>
        </b-table>
    </section>
     <div class="control has-text-centered" v-show="!getDataload.data.length">
        <h1 class="title is-2 is-warning">Record not found</h1>
        <hr>
        <router-link class="button is-primary " :to="{ name: 'newproduct' }"><i class="fa fa-user-plus m-r-10"></i> Add your first Vehicle click here</router-link>
    </div>
    </template>
<hr>
        <pagination :limit="5" :show-disabled=false :data="getDataload"  @pagination-change-page="getResults"></pagination>
</div>
<!-- </div> -->
</section>
</template>

<script>

 export default {
        data() {
            return {
                getDataload: {},
                search:'',
                isNarrowed: true,
                isLoading: false,
                perPage: 20,
                isPaginated: true,
                defaultSortDirection: 'asc',
               
                    }
            },
            methods: {  
                   ChangeStatus(id,){
              axios.get("/purchases./electronic/StatusChange/" + id )
            },
                
              SearchAutos(){
                    axios.get('/products./autos/SearchAutosProduct?search=' + this.search)
                      .then((data)=> {this.getDataload = data });
                      },
              loadData(){
                  this.isLoading = true
              axios.get("/purchases./electronic").then(({data}) => {
                  this.isLoading = false
                  this.getDataload = data });

                 },
              getResults(page = 1) {
                axios.get('/purchases./electronic?page=' + page).then(response => {
                  this.getDataload = response.data });
            },
            
            vDelete(id) {
            axios.get('/purchases./electronic/ProductRemove/' + id)
            .then(response => { this.success = true })
            this.loadData();
            },
            
            },
            mounted(){
            this.loadData();
    }

}
        
</script>