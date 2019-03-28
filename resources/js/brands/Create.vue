<template>
<form method="POST"  @submit.prevent="onSubmit">
    <div class="columns" v-if="!success">
        <div class="column is-10 is-offset-1">
            <div class="box">
                <div class="columns is-multiline">
                    <div class="column is-4"><h3 class="title is-4">Add New Brand</h3></div>
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
                                    <router-link :to="{ name: 'brands' }"><span>Brands</span></router-link>
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
                            <b-radio v-model="DataFrom.type" native-value="1">
                            Vehicle
                            </b-radio>
                            <b-radio v-model="DataFrom.type" native-value="2">
                            Electronic
                            </b-radio>
                                </div>
                             </div>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Brand Name:</label>
                            <div class="control">
                                <input class="input" v-model="DataFrom.brand" name="brand" type="text" placeholder="e.g Honda" autocomplete="off">
                                <span class="help is-danger">{{ allerros.mobile }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="control is-flex is-pulled-right">
                    <button class="button is-primary">Add Brand</button>
                </div>
            </div>
        </div>
    </div>
    <div class="notification is-success" v-if="success">
        <h2 class="title is-2"> Brand successfully Stored! </h2>
        <br>
        <router-link class="button is-info is-pulled-right" :to="{ name: 'brands' }"><i class="fa fa-user-plus m-r-10"></i>Click to Back Brands list</router-link>
    </div>
</form>
</template>
<script>

    export default {
        props: ['data'], 
        data(){
            return {
                success : false,   
                allerros: [],
                status: '',
                loading: false,
                DataFrom: {
                    type: '1',
                    brand: '',
                    
                    
                }
                //csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                
            }
        },
        methods: {
            onSubmit(){
                axios.post('/brands./BrandStore', this.DataFrom)
                      .then(response => { this.success = true;
                      })
                    .catch((error) => {
                        this.allerros = error.response.data.errors;
                        this.success = false;
                   });
                }
        },
    
}

</script>
