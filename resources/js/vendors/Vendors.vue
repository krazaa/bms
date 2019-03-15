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
                    <b-input v-model="usersearch" placeholder="Keyword Seach" @input="SearchUsers"></b-input>
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
            <a href="/manage/users/create" class="button is-primary is-pulled-right">
                        <i class="fa fa-user-plus m-r-10"></i> New Vendor
                    </a>        
            </div>    
        </b-field>
        <p class="level-item"> 
            <span class="is-pulled-right" v-if="loading">
                <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i>
            </span>
        </p>
     
        <b-table
            :data="vendors"
            :narrowed="isNarrowed"
            :paginated="isPaginated"
            :per-page="perPage"
            :current-page.sync="currentPage"
            :pagination-simple="isPaginationSimple"
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
                vendors: '',
                usersearch:'',
                isNarrowed: true,
                errors:'',
                loading: false,
                isPaginated: true,
                isPaginationSimple: false,
                defaultSortDirection: 'asc',
                currentPage: 1,
                perPage: 15,
                isAvailable: 0,
                
            }
        },
        mounted(){
        axios.get('/vendors./GetVendors')
        .then((response)=> this.vendors = this.temp = response.data)
        .catch((error) => this.errors = error.response.data.errors)
    },
        methods: {
            SearchUsers() 
        {
            this.loading = true;
            var search = this
            axios.get('/manage/users/SearchUsers?search=' + this.usersearch)
            .then(function(response) 
            {
            Vue.set(users.$data, 'users', response.data)
            search.loading = false;
            })
            .catch(error => {"erro found"});
        },
        },
         computed: {
    filter: function() {
      var name_re = new RegExp(this.search_query.name, 'i')
      var data = []
      for (i in this.data) {
        if (this.data[i].name.match(name_re)
            && this.search_query.langs.includes(this.data[i].lang)) {
          data.push(this.data[i])
        }
      }
      return data
    }
}
        
}

    
</script>
