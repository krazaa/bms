<template>
<form method="POST" @submit.prevent="onSubmit">
    <!-- <input type="hidden" name="_token" :value="csrf"> -->
    <div class="columns" v-if="!success">
        <div class="column is-10 is-offset-1">
        <div class="box">
                  <div class="columns is-multiline">
                    <div class="column is-4"><h3 class="title is-4">Add New Category</h3></div>
                    <div class="column is-8">
                        <nav class="breadcrumb is-right" aria-label="breadcrumbs">
                            <ul>
                                <li>
                                    <span class="icon is-small">
                                        <i class="mdi mdi-home" aria-hidden="true"></i>
                                    </span>
                                    <router-link to="/dashboard"><span>Home</span></router-link>
                                </li>
                                <li>
                                    <span class="icon is-small">
                                        <i class="mdi mdi-car" aria-hidden="true"></i>
                                    </span>
                                    <router-link :to="{ name: 'manage' }"><span>Category Page</span></router-link>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            <div class="field is-grouped">
                <div class="field">
                    <label class="label">Type:</label>
                    <div class="control">
                        <div class="block">
                            <b-radio v-model="DataFrom.type"
                            native-value="1">
                            Vehicle
                            </b-radio>
                            <b-radio v-model="DataFrom.type"
                            native-value="2">
                            Electronic
                            </b-radio>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <b-field label="Category Type">
                    <b-select v-model="DataFrom.ctype" name="ctype" @input="loadSubCats">
                    <option value="0" selected disabled>Select name</option>
                    <option
                        v-for="cat in categories.data"
                        :value="cat.id"
                        :key="cat.id">
                        {{ cat.category }}
                    </option>
                    </b-select>
                    </b-field>
                </div>
                
                <div class="field">
                    <label class="label">Category Name:
                    </label>
                    <div class="control">
                        <input class="input" name="category" type="text" placeholder="e.g TV, LED, Fax" v-model="DataFrom.category" @keyup="Checkname" autocomplete="off">
                    </div>
                    <p class="help is-success list-inline" v-if="category == 'Available'"> {{ DataFrom.category }} is available.</p>
                    <p class="help is-danger" v-if="category == 'Not Available'"> {{ DataFrom.category }} {{ vendor }}</p>
                </div>
    </div>            
            <div class="control is-flex is-pulled-right">
                <button class="button is-primary">Add Category</button>
            </div>
            </div>
        </div>
    

</div>
<div class="notification is-success" v-if="success">
    <h2 class="title is-2"> Category successfully Stored! </h2>
    <br>
    <router-link class="button is-primary is-pulled-right" :to="{ name: 'manage' }"><i class="fa fa-user-plus m-r-10"></i>Click to Back Category</router-link>
</div>
</form>
</template>
<script>
    export default {
        data(){
            return {
                categories: [],
                subcategories: [],
                loading: false,
                DataFrom: {
                    type: '1',
                    search:'',
                    sub_id:'',
                    ctype: '',
                    category: '',
                },
                category: '',
                success: false,
                //csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                
            }
        },
        methods: {
            Checkname() 
            {
            this.loading = true;
                var searchv = this
                axios.get('/categories./SearchCat?name=' + this.DataFrom.category)
                    .then(function(response) {
                Vue.set(searchv.$data, 'category', response.data)
                    searchv.loading = false;
                }) 
                    //.catch(error => {"erro found"});
        },
            onSubmit(){
                axios.post('/categories./CatStore', this.DataFrom)
                      .then(response => { this.success = true;
                      })
                    .catch((error) => {
                        this.allerros = error.response.data.errors;
                        this.success = false;
                   });
                },
            loadrcats(){
            axios.get('/categories./indexCats')
            .then(({data}) => (this.categories = data));
            //setTimeout(this.loadcats, 5000);
            }

        },        
            mounted(){
            this.loadrcats();
        },
     watch: {
    // call again the method if the route changes
    '$route': 'loadrcats'
  }
    }


</script>
