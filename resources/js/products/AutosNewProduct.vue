<template>
    <form  @submit.prevent="onSubmit()">
        <div class="columns" v-if="!success">
    <div class="columns">
        <div class="column is-10 is-offset-1">
            <div class="box">
                 <div class="columns is-multiline">
                    <div class="column is-4"><h3 class="title is-4">Add New Product</h3></div>
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
                                    <router-link :to="{ name: 'autos' }"><span>Vehicles Page</span></router-link>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="columns is-multiline">

                <div class="column is-4">
                     <b-field label="Category">
                            <b-select placeholder="Select a Category" name="category_id" v-model="autos.category_id" expanded>
                                <option v-for="cat in getcats" :value="cat.id">{{ cat.category }}</option>
                            </b-select>
                        </b-field>
                    </div>
                </div>

                    <div class="columns is-multiline">
                        <div class="column is-2">
                    <div class="field">
                        <label class="label">Product Code: 
                        </label>
                        <div class="control">
                            <input class="input" type="text" placeholder="e.g B18123456" v-model="autos.code" @input="Checkcode">
                            {{ state }} 
                            <span class="help is-danger">{{ allerros.code }}</span>
                        </div>
                        
                        <p class="help is-success list-inline" v-if="state == '0'">{{ state }} Available</p>
                        <p class="help is-danger" v-if="state == '1'"> Not Available</p>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Product Name:</label>
                        <div class="control">
                            <input class="input" v-model="autos.name" name="name" type="text" placeholder="e.g Honda 125">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Model:</label>
                        <div class="control">
                            <input class="input" v-model="autos.model" name="model" type="text" placeholder="e.g XX-0013">
                        </div>
                    </div>
                </div>
 
                
                        <div class="column is-2">
                    <div class="field">
                        <label class="label">Reorder Qty:</label>
                        <div class="control">
                            <input class="input" v-model="autos.reorder" name="reorder" type="text" placeholder="e.g 15">
                        </div>
                    </div>
                </div>
                 <div class="column is-2">
                    <div class="field">
                        <label class="label">Max Qty:</label>
                        <div class="control">
                            <input class="input" v-model="autos.maxqty" name="maxqty" type="text" placeholder="e.g 10">
                        </div>
                    </div>
                    </div>
                
                <div class="column is-2">
                     <div class="field">
                        <label class="label">Cash Discount:</label>
                        <div class="control">
                            <input class="input" v-model="autos.cashdis" name="cashdis" type="text" placeholder="e.g 2000">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Discount Allow:</label>
                        <div class="control">
                            <input class="input" v-model="autos.dautosiscountallowed" name="discountallowed" type="text" placeholder="e.g 2000">
                            
                        </div>
                    </div>
                    </div>

               
                        <div class="column is-2">
                    <div class="field">
                        <label class="label">Cost Price:</label>
                        <div class="control">
                            <input class="input" v-model="autos.cost" name="cost" type="text" placeholder="e.g 50,000">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Whole Sale Price:</label>
                        <div class="control">
                            <input class="input" v-model="autos.wsaleprice" name="wsaleprice" type="text" placeholder="e.g 45,000">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Selling Price:</label>
                        <div class="control">
                            <input class="input" v-model="autos.saleprice" name="saleprice" type="text" placeholder="e.g 55,000">
                        </div>
                    </div>
                </div>
                    
                </div>
                <div class="control is-flex is-pulled-right">
                    <button  class="button is-primary">Add Product</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="notification is-success" v-if="success">
        <h2 class="title is-2"> Record successfully Stored! </h2>
        <br>
        <router-link class="button is-info is-pulled-right" :to="{ name: 'autos' }"><i class="fa fa-user-plus m-r-10"></i>Click to Back Vehicles</router-link>
    </div>

</form>
</template>
<script>

    export default {
        data(){
            return {               
                
                success: false,
                getcats:[],
                vendors: [],
                autos: {
                    vendor:'',
                    vendor_id:'',
                    category_id:'',
                    code:'',
                    name:'',
                    cashdis:'',
                    discountallowed:'',
                    cost:'',
                    saleprice:'',
                    wsaleprice:'',
                    qty:'',
                    reorder:'',
                    maxqty:'',
                    
                },
                state:'',
                allerros:[],
                 
                loading: false,
               
            }
        },
         methods: {
            Checkcode() {
                axios.get('/products./autos/SearchCode?code=' + this.autos.code)
                    .then((response)=> this.state = this.temp = response.data)
                    console.log(this.state)
                },
        onSubmit(){
                axios.post('/products./autos/AutoProductStore', this.autos)
                      .then(response => { this.success = true;
                      })
                    .catch((error) => {
                        this.allerros = error.response.data.errors;
                        this.success = false;
                   });
                }    
        },
        mounted(){
    
            axios.get("/categories./indexAutos").then(({data}) => (this.getcats = data));
    
    },
    filters: {
        Upper(value) {
            return value.toUpperCase();
        }
    }

    }
</script>