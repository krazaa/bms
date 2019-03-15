<template>
<div class="container">
        
        <div class="box">
           <template>
    <section>
            
            <b-field grouped group-multiline>
            <div class="control is-flex">
                <h3 class="title is-4">Manage Users </h3>            
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
            <a href="/manage/users/create" class="button is-primary is-outlined is-pulled-right">
                        <i class="fa fa-user-plus m-r-10"></i> Create New User
                    </a>        
            </div>    
        </b-field>
        <p class="level-item"> <span class="is-pulled-right" v-if="loading">
                        <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i>
                    </span></p>
    
        <b-table
            :data="users"
            :narrowed="isNarrowed"
            :paginated="isPaginated"
            :per-page="perPage"
            :current-page.sync="currentPage"
            :pagination-simple="isPaginationSimple"
            :default-sort-direction="defaultSortDirection"
            default-sort="user.name">

            <template slot-scope="props">
                <b-table-column field="id" label="ID" width="40" sortable numeric>
                    {{ props.row.id }}
                </b-table-column>

                <b-table-column field="name" label="Name" sortable>
                    {{ props.row.name }}
                </b-table-column>
                <b-table-column field="email" label="Email" sortable>
                    {{ props.row.email }}
                </b-table-column>

                <b-table-column field="date" label="Created" sortable centered>
                        {{ new Date(props.row.created_at).toLocaleDateString() }}
                </b-table-column>
                    
                <b-table-column label="Action" centered>
                    <router-link class="button is-info is-small" :to="`/singleuser/${props.row.id}`"><span class="mdi mdi-eye"></span></router-link>
                    <a :href="`/manage/users/singleuser/${props.row.id}`" class="button is-success is-small"><span class="mdi mdi-eye"></span></a>
                    <a :href="`/manage/users/edit/${props.row.id}`" class="button is-warning is-small"><span class="mdi mdi-pencil-box-outline"></span></a>
                    <a :href="`/manage/users/edit/${props.row.id}`" class="button is-danger is-small"><span class="mdi mdi-trash-can"></span></a>
                </b-table-column>   
                
            </template>
        </b-table>
    </section>
</template>  

        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                users: '',
                usersearch:'',
                isNarrowed: true,
                errors:'',
                loading: false,
                isPaginated: true,
                isPaginationSimple: false,
                defaultSortDirection: 'asc',
                currentPage: 1,
                perPage: 15
            }
        },
        mounted(){
        axios.get('/manage/getusers')
        .then((response)=> this.users = this.temp = response.data)
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
        }
    }
</script>
