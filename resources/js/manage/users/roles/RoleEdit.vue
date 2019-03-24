<template>
<!-- <div class="container"> -->
    <section>
        <div class="box">
            <div class="columns">
                <div class="column">
                    <h3 class="title is-3">Edit {{ roles.display_name }}</h3>
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
                     
                <b-field label="Name (Human Readable)">
                    <b-input v-model="roles.display_name" name="display_name" placeholder="Human Readable"></b-input>
                </b-field>

                <b-field label="Slug (Can not be changed)">
                    <b-input v-model="roles.name" type="text" name="name" placeholder="Slug" maxlength="30"></b-input>
                </b-field>

                <b-field label="Description">
                    <b-input v-model="roles.description" type="text" name="description" placeholder="Description" maxlength="30"></b-input>
                </b-field>
             <button class="button is-primary">Save Changes to Role</button>
            </div>
            </div>
            <div class="column is-8">
                <div class="box" >
                <h3 class="title is-5">Permissions</h3>
                <div class="block" v-for="permission in loadData">
                    <div class="columns">
                        <div class="column is-6">
                        <b-checkbox v-model="permissions" name="id[]"
                            :native-value="permission.id == 1 ? 'checked' : ''">
                        {{ permission.display_name }} ({{ permission.name }})</b-checkbox>
                     </div>   
                    </div> 
                </div>
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
        props:['id'],
        data(){
            return {
                roles: [],
                loadData: [],
                permissions: [],
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
        methods: {
              EditData(){
            axios.get('/manage./roles/RoleEdit/'+ this.id)
        .then((response)=> this.roles = this.temp = response.data)
        .catch((error) => this.errors = error.response.data.errors)
        }
        },
        mounted(){
            this.EditData();
        axios.get('/manage./permissions/')
        .then((response)=> this.loadData = this.temp = response.data)
        .catch((error) => this.errors = error.response.data.errors)
        },
    }
</script>
