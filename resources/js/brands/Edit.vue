<template>
<form @submit.prevent="updateSignal(brands.id)">
    <div class="columns" v-if="!success">
        <div class="column is-10 is-offset-1">
             <div class="box">
                 <div v-if="isLoading">
                    <b-loading :active.sync="isLoading" :can-cancel="true"></b-loading>
                </div>
                <div v-if="!isLoading">
                <div class="columns is-multiline">
                    <div class="column is-4"><h3 class="title is-4">Update Brand</h3></div>
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
                                        <i class="mdi mdi-bank" aria-hidden="true"></i>
                                    </span>
                                    <router-link :to="{ name: 'brands' }"><span>Brand</span></router-link>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="columns is-multiline">
                  
                    <div class="column is-3">
                        <div class="field">
                            <label class="label">Type:</label>
                            <div class="control">
                                <div class="block">
                            <b-radio v-model="brands.type" native-value="1">
                            Vehicle
                            </b-radio>
                            <b-radio v-model="brands.type" native-value="2">
                            Electronic
                            </b-radio>
                                </div>
                             </div>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Brand Name:
                            </label>
                            <div class="control">
                                <input class="input" v-model="brands.brand" name="brand" type="text" placeholder="e.g Honda" autocomplete="off">
                                <span class="help is-danger">{{ allerros.brand }}</span>
                            </div>
                            
                        </div>
                    </div>            
                    </div>
                </div>
                <div class="control is-flex is-pulled-right">
                    <button class="button is-primary">Update Brand</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="notification is-success" v-if="success">
        <h2 class="title is-2"> Brand successfully Stored! </h2>
        <br>
        <router-link class="button is-primary is-pulled-right" :to="{ name: 'brands' }"><i class="fa fa-user-plus m-r-10"></i>Click to Back Brands</router-link>
</div>
</form>
</template>
<script>

    export default {
        props: ['id'], 
        data(){
            return {
                success : false,   
                allerros: [],
                isLoading: false,
                
                brands: {
                    type: '',
                    brand: '',
                },
               
                
            }
        },
        methods: {
                updateSignal: function (id) {
                 axios.post('/brands./brandUpdate/' + id, this.brands)
                .then(response => { this.success = true;
                 })
                    .catch((error) => {
                        this.allerros = error.response.data.errors;
                        this.success = false;
                   });
            },
            
             ShowSingle(){
            axios.get(`/brands./BrandEdit/${this.$route.params.id}`)
                .then((response)=> this.brands = this.temp = response.data)
                .catch((error) => this.errors = error.response.data.errors)
                        }    
                },
        mounted(){
            this.ShowSingle();  
        },    
}

</script>
