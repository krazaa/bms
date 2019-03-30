<template>
    <div class="box">
        <input type="text" class="input" v-model="queryString" v-on:keyup="getResults()" placeholder="what are searching for?">
        <div class="content" v-if="users.length">
              <ul type="1">
                <li v-for="user in users">{{ user.name }}</li>
                
              </ul>
            </div>
    </div>
        
    
</template>

<script>
    export default{
        data(){
            return{
                users:[],
                queryString:'',
            }
        },
        methods:{
            getResults(){
                this.users = [];
                axios.get('/search',{params: {queryString: this.queryString}}).then(response =>{
                    //console.log(response.data);
                      response.data.forEach((user)=>{
                        this.users.push(user);
                      })  

                });
            }
        }
    }
    
</script>