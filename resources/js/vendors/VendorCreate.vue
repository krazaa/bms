<template>
<form method="POST" @submit.prevent="onSubmit">
    <!-- <input type="hidden" name="_token" :value="csrf"> -->
    <div class="columns" v-if="!success">
        <div class="box">
            <div class="columns is-multiline">
                <div class="column is-4"><h3 class="title is-4">Add New Vendor</h3></div>
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
                    <div class="field">
                        <label class="label">Select Brand: </label>
                        <div class="control">
                            <div class="select">
                                <select name="brand_id" v-model="FromData.brand_id" required>
                                    <option selected disabled>Select one</option>
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
                            <input class="input" v-model="FromData.vnum" name="vnum" type="text" placeholder="e.g B18123456">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <label class="label">Company Name: </label>
                    <div class="field">
                        <div class="control">
                            <input class="input" v-model="FromData.company" name="company" type="text" placeholder="e.g Team Xperts"  @keyup="GetVendor" autocomplete="off">
                        </div>
                        <p class="help is-success list-inline" v-if="vendor == 'Available'"> {{ vendor }} is available.</p>
                        <p class="help is-danger" v-if="vendor == 'Not Available'"> {{ vendor }} Not Available.</p>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Contact Person: </label>
                        <div class="control">
                            <input class="input" v-model="FromData.person" name="person" type="text" placeholder="e.g Person name">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Telephone: </label>
                        <div class="control">
                            <input class="input" v-model="FromData.contact" name="contact" type="text" placeholder="e.g Telephone no">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Mobile:</label>
                        <div class="control">
                            <input class="input" v-model="FromData.mobile" name="mobile" type="text" placeholder="e.g 923219802672">
                        </div>
                    </div>
                </div>
                
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Another mobile:</label>
                        <div class="control">
                            <input class="input" v-model="FromData.bmobile" name="bmobile" type="text" placeholder="e.g 923219802672">
                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        <label class="label">Address:</label>
                        <div class="control">
                            <input class="input" v-model="FromData.address" name="address" type="text" placeholder="e.g your address">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">City:</label>
                        <div class="control">
                            <input class="input" v-model="FromData.city" name="city" type="text" placeholder="e.g your city">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Email:</label>
                        <div class="control">
                            <input class="input" v-model="FromData.email" name="email" type="text" placeholder="e.g vendor@gmail.com">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Website:</label>
                        <div class="control">
                            <input class="input" v-model="FromData.website" name="website" type="text" placeholder="e.g www.example.com">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">NTN No:</label>
                        <div class="control">
                            <input class="input" v-model="FromData.ntn" name="ntn" type="text" placeholder="445566">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Sales Tax No:</label>
                        <div class="control">
                            <input class="input" v-model="FromData.salestax" name="salestax" type="text" placeholder="1232">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="control is-flex is-pulled-right">
        <button class="button is-primary">Add Vendor</button>
    </div>
</div>
</div>
<div class="notification is-success" v-if="success">
<h2 class="title is-2"> Vendor successfully Stored! </h2>
<br>
<router-link class="button is-primary is-pulled-right" :to="{ name: 'vendors' }"><i class="fa fa-user-plus m-r-10"></i>Click to Back Vendor</router-link>
</div>
</div>
</form>
</template>
<script>
    export default {
        data(){
            return {
                vendor: '',
                search:'',
                brands:[],
                success: false,
                allerros:'',
                loading: false,
                FromData: {
                    brand_id: '',
                    vnum: '',
                    company: '',
                    person: '',
                    contact: '',
                    mobile: '',
                    bmobile: '',
                    address: '',
                    email:'',
                    city:'',
                    website:'',
                    ntn:'',
                    salestax:'',
                    
                }
                //csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                
            }
        },
        methods: {
            GetVendor() {
            //this.loading = true;
                var searchv = this
                axios.get('/vendors./SearchVendor?company=' + this.FromData.company)
                .then(function(response) {
                Vue.set(searchv.$data, 'vendor', response.data)
                //searchv.loading = false;
                }).catch(error => {"erro found"});
        },
         onSubmit(){
                axios.post('/vendors./VendorStore', this.FromData)
                      .then(response => { this.success = true;
                      })
                    .catch((error) => {
                        this.allerros = error.response.data.errors;
                        this.success = false;
                   });
                    this.loadVendor();
                },
         loadData(){
              axios.get("/brands./brands").then(({data}) => {
                  this.brands = data  });

            },
    },
       mounted(){
        this.loadData();  
        
    },

}

</script>
