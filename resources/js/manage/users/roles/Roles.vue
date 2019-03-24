<template>
<div class="container">
          <div class="box">
    <div class="columns">
      <div class="column">
        <h3 class="title is-3">Manage Roles</h3>
      </div>
      <div class="column">
        <router-link class="button is-primary is-outlined is-pulled-right" :to="{ name: 'RoleCreate'}">Create New Role </router-link>
      </div>
    </div>
  </div>
  <nav class="panel column is-12" >
    <div class="box">
      <div class="columns is-multiline">
        <div class="column is-one-quarter" v-for="role,key in LoadData">
          <div class="box">
            <article class="media">
              <div class="media-content">
                <div class="content">
                  <h3 class="title">{{role.display_name}}</h3>
                  <h4 class="subtitle"><em>{{role.name}}</em></h4>
                  <p>
                    {{role.description}}
                  </p>
                </div>
                <div class="columns is-mobile">
                  <div class="column is-one-half">
                    <a :href="`/manage/roles/show/${role.id}`" class="button is-primary is-fullwidth">Show</a>
                  </div>
                  <div class="column is-one-half">
                    <router-link class="button is-info is-fullwidth" :to="{ name: 'RoleEdit', params: {id: role.id}}">Edit</router-link>
                    </div>
                  <div class="column is-one-half">
                    <button class="button is-danger is-fullwidth" aria-hidden="true" @click="del(key,role.id)">X</button>
                  </div>
                </div>
              </div>
            </article>
          </div>
        </div>
      </div>
    </div>
  </nav>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                LoadData: {},
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
              axios.get("/manage./roles").then(({data}) => {
                this.isLoading = false;
                (this.LoadData = data)
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
