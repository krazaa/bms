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
                <router-link class="button is-warning" :to="{ name: 'userCreate'}">Create User</router-link>
            </div>
            <div class="control is-flex">
                 <router-link class="button is-info" :to="{ name: 'userRoles'}">Roles</router-link>
            </a>        
            </div>
            <div class="control is-flex">
            <router-link class="button is-success" :to="{ name: 'userPermissions'}">Permissions</router-link>    
            </div>

        </b-field>
                <p class="level-item"> <span class="is-pulled-right" v-if="isLoading">
                    <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i>
                    </span></p>
    
        <b-table
            :data="LoadUsers.data"
            :narrowed="isNarrowed"
            :default-sort-direction="defaultSortDirection"
            default-sort="LoadUsers.name">

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
                <b-table-column field="isActive" label="Status" sortable>
            <b-switch v-model="props.row.isActive" name="isActive"
            :true-value="1"
            :false-value="0"
            type="is-success" @input="StatusChange(props.row.id)">
            </b-switch>
            </b-table-column>
                <b-table-column field="date" label="Created" sortable centered>
                        {{ new Date(props.row.created_at).toLocaleDateString() }}
                </b-table-column>
                <b-table-column label="Action" centered>
                    <router-link class="button is-info is-small" :to="`/singleuser/${props.row.id}`"><span class="mdi mdi-eye"></span></router-link>
                    <!-- <a :href="`/manage/users/edit/${props.row.id}`" class="button is-warning is-small"><span class="mdi mdi-pencil-box-outline"></span></a>
                     -->
                     <a @click="UserDelete(props.row.id)" class="button is-danger is-small"><span class="mdi mdi-trash-can"></span></a>
                </b-table-column>   
                
            </template>
        </b-table>
        <pagination :limit="5" :show-disabled=false :data="LoadUsers"  @pagination-change-page="getResults"></pagination>
    </section>
</template>  

        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                LoadUsers: {},
                usersearch:'',
                isActive:'',
                isNarrowed: true,
                isLoading: false,
                defaultSortDirection: 'asc',
            }
        },
        mounted(){
            this.loadingData();
        },
        methods: {
            StatusChange(id,){
              axios.get("/manage./users/StautsChange/" + id )
                this.loadingData();
            },
             loadingData(){
              this.isLoading = true
              axios.get("/manage./users").then(({data}) => {
                this.isLoading = false;
                (this.LoadUsers = data)
                })
            }, 
              getResults(page = 1) {
                axios.get('/manage./users?page=' + page)
                  .then(response => {
                    this.LoadUsers = response.data;
                });
            },
            SearchUsers() 
            {
            axios.get('/manage./users/UserSearch?search=' + this.usersearch)
            .then(({data}) => (this.LoadUsers = data));
            },
            UserDelete(id) {
            axios.get('/manage./users/UserDelete/' + id)
            .then(response => { this.success = true;
                this.loadingData();
                      })
            
            },
        }
    }
</script>
