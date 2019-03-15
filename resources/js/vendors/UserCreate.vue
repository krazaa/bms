<template>
<!-- <div class="container"> -->
    <section>
        <div class="box">
            <div class="columns">
                <div class="column">
                    <h3 class="title is-3">Create Users</h3>
                </div>
                <div class="column">
                    <a href="/manage/users/create" class="button is-primary is-outlined is-pulled-right">
                        <i class="fa fa-user-plus m-r-10"></i> Create New User
                    </a>
                    <p class="level-item"> <span class="is-pulled-right" v-if="loading">
                        <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i>
                    </span></p>
                </div>
            </div>
        </div>
        <form class="login-form" method="POST" action="/manage/users/store">
            <input type="hidden" name="_token" :value="csrf">
        <div class="box">
          <div class="columns">
            <div class="column is-6">
                <h3 class="title is-5">Branches</h3> 
                        <div class="block" v-for="branch in branches">
                            <b-checkbox v-model="brancheschecked" name="branchId[]" :native-value="branch.id">
                {{ branch.name }}</b-checkbox>
                </div>      
            </div>
            <div class="column is-6"><h3 class="title is-5">Roles</h3>
                <div class="block" v-for="role in roles">
                            <b-checkbox v-model="roleschecked" name="roleId[]" :native-value="role.id">
                {{ role.name }}</b-checkbox>
                </div>  
            </div>
          </div>
           <div class="box">
                <b-field label="Name">
                    <b-input v-model="name" name="name" placeholder="Full name"></b-input>
                </b-field>

                <b-field label="Email">
                    <b-input v-model="email" type="email" name="email" placeholder="Email Address" maxlength="30"></b-input>
            </b-field>

            <b-field>
                <b-input v-model="password" type="password" name="password" placeholder="Password" password-reveal>
            </b-input>
             </b-field>
             <button class="button is-primary">Register User</button>
           </div>
        </div>
    </form>
    </section>
<!--     </div> -->
</template>

<script>
    export default {
        data(){
            return {
                roles: [],
                branches: [],
                brancheschecked:[],
                roleschecked:[],
                loading: false,
                name:'',
                email:'',
                password:'',
                errors: [],
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        mounted(){
        axios.get('/manage/branches/')
        .then((response)=> this.branches = this.temp = response.data)
        .catch((error) => this.errors = error.response.data.errors)

        axios.get('/manage/roles/')
        .then((response)=> this.roles = this.temp = response.data)
        .catch((error) => this.errors = error.response.data.errors)
    
    },
    }
</script>
