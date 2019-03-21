<template>
<div class="box">
    <template>
    <section>
        <b-field grouped group-multiline>
        <div class="control is-flex">
            <h3 class="title is-4">Manage Electronic Products</h3>
        </div>
        <div class="control is-flex">
            <b-field>
            <b-input v-model="search" name="search" placeholder="Keyword Seach" @input="ElectronicGet"></b-input>
            </b-field>
        </div>
        
        <div class="control is-flex">
            <router-link class="button is-primary is-pulled-right" :to="{ name: 'neweproduct' }"><i class="fa fa-user-plus m-r-10"></i> New Product</router-link>
        </div>
        </b-field>
        <p class="level-item">
            <span class="is-pulled-right" v-if="loading">
                <i class="mdi mdi-loading mdi-spin mdi-48px"></i>
            </span>
        </p> 
        <b-table
            :data="electronic.data"
            :loading="loading"
            :narrowed="isNarrowed"
            :default-sort-direction="defaultSortDirection"
             default-sort="electronic.name">
        <template slot-scope="props">
        <b-table-column field="vnum" label="Vendor ID" width="40" sortable>
        {{ props.row.vnum }}
        </b-table-column>
        <b-table-column field="category" label="Category" sortable>
        {{ props.row.category }}
        </b-table-column>
        <b-table-column field="code" label="Product Code" sortable>
        {{ props.row.code }}
        </b-table-column>
        <b-table-column field="name" label="Product Name" sortable>
        {{ props.row.name }}
        </b-table-column>
        <b-table-column field="comppartno" label="Part No" sortable>
        {{ props.row.comppartno }}
        </b-table-column>
        <b-table-column field="shortname" label="Short Name" sortable>
        {{ props.row.shortname }}
        </b-table-column>
        <b-table-column field="cost" label="Cost" sortable>
        {{ props.row.cost }}
        </b-table-column>
        
        <b-table-column label="Action" centered>
             <router-link class="button is-success is-small" :to="{ name: 'electronicshow', params: {id: props.row.id}}"><span class="mdi mdi-eye-circle-outline"></span></router-link>
             <router-link class="button is-warning is-small" :to="{ name: 'editeproduct', params: {id: props.row.id}}"><span class="mdi mdi-pencil-outline"></span></router-link>
        
        <a  class="button is-danger is-small"><span class="mdi mdi-trash-can"></span></a>
        </b-table-column>
        </template>
        </b-table>
    </section>
    </template>
<hr>

        <pagination :limit="5" :show-disabled=false :data="electronic"  @pagination-change-page="getResults"></pagination>

</div>
</template>

<script>
    export default {
        data(){
            return {
                electronic: {},
                search:'',
                isNarrowed: true,
                loading: false,
                defaultSortDirection: 'asc',
                isAvailable: 0,
            }
        },
        mounted(){
          this.loadElectronic();  
    },
        methods: {  
             loadElectronic(){
              this.loading = true
              axios.get("products./electronic/GetElectronic").then(({data}) => (this.electronic = data));
              this.loading = false
            },
            getResults(page = 1) {
                axios.get('/products./electronic/GetElectronic?page=' + page)
                  .then(response => {
                    this.electronic = response.data;
                });
            },

            ElectronicGet() {
              axios.get('/products./electronic/ElecSearch?search=' + this.search)
                .then(({data}) => (this.electronic = data));
                
        },
    }        
}
</script>
