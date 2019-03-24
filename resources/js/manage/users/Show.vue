<template>
<div class="container">
        <div class="box">
            <div class="columns">
                <div class="column">
                    <h3 class="title is-3">Manage Users</h3>
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
        <div class="box">
           Name: {{ user.name }}<br>
           Email: {{ user.email }} <br>
           Created: {{ user.created_at }}<br>
           Role: <ul>
               <li v-for="role in user.roles">
                   {{ role.name }}
               </li>
           </ul> 
           
        </div>
    </div>
</template>

<script>
    export default {
        props: ['userid'], 
        data(){
            return {
                
                user: [],
                loading: false
               
            }
        },
        mounted(){
        axios.get('/manage/users/singleuser/' + this.userid)
        .then((response)=> this.user = this.temp = response.data)
        //.catch((error) => this.errors = error.response.data.errors)
        console.log(this.userid)
    },
    }
</script>
