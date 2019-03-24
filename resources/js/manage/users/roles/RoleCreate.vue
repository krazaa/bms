<template>
<!-- <div class="container"> -->
    <section>
        <div class="box">
            <div class="columns">
                <div class="column">
                    <h3 class="title is-3">Create New Role</h3>
                </div>
                <div class="column">
                   
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
            
            <div class="column is-4">
                <div class="box">
                <h3 class="title is-5">Role Details</h3>
                    <div class="block" v-for="role in roles">
                        <b-checkbox v-model="roleschecked" name="roleId[]" :native-value="role.id">
                        {{ role.name }}</b-checkbox>
                    </div>  
                <b-field label="Name (Human Readable)">
                    <b-input v-model="display_name" name="display_name" placeholder="Human Readable"></b-input>
                </b-field>

                <b-field label="Slug (Can not be changed)">
                    <b-input v-model="name" type="text" name="name" placeholder="Slug" maxlength="30"></b-input>
                </b-field>

                <b-field label="Description">
                    <b-input v-model="description" type="text" name="description" placeholder="Description" maxlength="30"></b-input>
                </b-field>
             <button class="button is-primary">Register User</button>
            </div>
            </div>
            <div class="column is-4">
                <div class="box">
                <h3 class="title is-5">Role Details</h3>
            </div>

          </div>
           
                
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
                display_name:'',
                description:'',
                errors: [],

                //csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        mounted(){
    
        axios.get('/manage/roles/')
        .then((response)=> this.roles = this.temp = response.data)
        .catch((error) => this.errors = error.response.data.errors)
    
    },
    }
</script>
