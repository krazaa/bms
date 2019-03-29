<template>
<form method="POST" @submit.prevent="updateSignal(vendors.id)">
    <!-- <input type="hidden" name="_token" :value="csrf"> -->
    <div class="columns" v-if="!success">
        <div class="box">
            <div class="columns is-multiline">
                <div class="column is-4"><h3 class="title is-4">Edit Vendor</h3></div>
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
                                    <i class="mdi mdi-keyboard-backspace" aria-hidden="true"></i>
                                </span>
                                <router-link :to="{ name: 'vendors' }"><span>Vendors</span></router-link>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="columns is-multiline">
                <div class="column is-2">
                    <label class="label">Type:</label>
                    <div class="control">
                        <div class="block">
                            <b-radio v-model="vendors.type" native-value="1">
                            Vehicle
                            </b-radio>
                            <b-radio v-model="vendors.type" native-value="2">
                            Electronic
                            </b-radio>
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Select Brand: </label>
                        <div class="control">
                            <div class="select">
                                <select name="brand_id" v-model="vendors.brand_id" required>
                                    <option v-for="brand in brands" :value="brand.id">{{ brand.brand }} </option>  
                                        </select>
                                    </div>
                                </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Code: </label>
                        <div class="control">
                            <input class="input" v-model="vendors.vnum" name="vnum" type="text" placeholder="e.g B18123456">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <label class="label">Company Name: </label>
                    <div class="field">
                        <div class="control">
                            <input class="input" v-model="vendors.company" name="company" type="text" placeholder="e.g Team Xperts"  autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Contact Person: </label>
                        <div class="control">
                            <input class="input" v-model="vendors.person" name="person" type="text" placeholder="e.g Person name">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Telephone: </label>
                        <div class="control">
                            <input class="input" v-model="vendors.contact" name="contact" type="text" placeholder="e.g Telephone no">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Mobile:</label>
                        <div class="control">
                            <input class="input" v-model="vendors.mobile" name="mobile" type="text" placeholder="e.g 923219802672">
                        </div>
                    </div>
                </div>
                
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Another mobile:</label>
                        <div class="control">
                            <input class="input" v-model="vendors.bmobile" name="bmobile" type="text" placeholder="e.g 923219802672">
                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        <label class="label">Address:</label>
                        <div class="control">
                            <input class="input" v-model="vendors.address" name="address" type="text" placeholder="e.g your address">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">City:</label>
                        <div class="control">
                            <input class="input" v-model="vendors.city" name="city" type="text" placeholder=" your city">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Email:</label>
                        <div class="control">
                            <input class="input" v-model="vendors.email" name="email" type="text" placeholder="e.g vendor@gmail.com">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Website:</label>
                        <div class="control">
                            <input class="input" v-model="vendors.website" name="website" type="text" placeholder="e.g www.example.com">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">NTN No:</label>
                        <div class="control">
                            <input class="input" v-model="vendors.ntn" name="ntn" type="text" placeholder="e.g NTN 445566">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Sales Tax No:</label>
                        <div class="control">
                            <input class="input" v-model="vendors.salestax" name="salestax" type="text" placeholder="e.g ST-33-44545">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="control is-flex is-pulled-right">
        <button class="button is-primary">Update Vendor</button>
    </div>
</div>
</div>
</div>
<div class="notification is-success" v-if="success">
<h2 class="title is-2"> Vendor successfully Stored! </h2>
<br>
<router-link class="button is-info is-pulled-right" :to="{ name: 'vendors' }"><i class="fa fa-user-plus m-r-10"></i>Click to Back Vendor</router-link>
</div>
</form>
</template>
<script>
    export default {
        props: ['id'], 
        data(){
            return { 
                brands:[],               
                vendors: {
                    vnum:'',
                    brand_id:'',
                    type: '',
                    company:'',
                    person:'',
                    contact:'',
                    mobile:'',
                    bmobile:'',
                    address:'',
                    email:'',
                    city:'',
                    website:'',
                    ntn:'',
                    salestax:'',
                    },
                allerros: false,
                success: false,
                loading: false,
               
            }
        },
        methods:{
             updateSignal: function (id) {
            axios.post('/vendors./VendorhUpdate/' + id, this.vendors)
                .then(response => { this.success = true;
                 })
                    .catch((error) => {
                        this.allerros = error.response.data.errors;
                        this.success = false;
                   });
        },
        ShowSingle(){
            axios.get(`/vendors./editVendor/${this.$route.params.id}`)
            .then((response)=> this.vendors = this.temp = response.data)
            .catch((error) => this.errors = error.response.data.errors)
            },
        loadData(){
              axios.get("/brands./brands").then(({data}) => {
                  this.brands = data  });
            }
        },
            
        mounted(){
            this.ShowSingle();            
            this.loadData();            
        },
    }
</script>
