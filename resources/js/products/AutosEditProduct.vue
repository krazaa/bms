<template>
    <form class="form-horizontal" method="POST" @submit.prevent="updateSignal(autos.id)">

    <div class="columns" v-if="!success">

        <div class="column is-10 is-offset-1">
            <div class="box">
        
           <div class="columns is-multiline">
                    <div class="column is-4"><h3 class="title is-4">Update Product</h3></div>
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
                
                     <div class="field">
                        <label class="label">Select Vendor:</label>
                        <div class="control">
                            <div class="select">
                                <select name="vendor_id" v-model="autos.vendor_id">
                                    <option v-for="vendor in vendors.data" :value="vendor.id">{{ vendor.company }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="column is-4">
                     <div class="field">
                        <label class="label">Select Category:</label>
                        <div class="control">
                            <div class="select">
                                <select name="category_id" v-model="autos.category_id" required>
                                    <option v-for="cat in getcats" :value="cat.id">{{ cat.category }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="columns is-multiline">
                    <div class="column is-2">
                    <div class="field">
                        <label class="label">Product Code: 
                        </label>
                        <div class="control">
                            <input class="input" type="text" v-model="autos.code" disabled>
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">autos Name:</label>
                        <div class="control">
                            <input class="input" v-model="autos.name" name="name" type="text" placeholder="e.g Honda 125">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Model:</label>
                        <div class="control">
                            <input class="input" v-model="autos.model" type="text" placeholder="e.g XX-0013">
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
                        <label class="label">Reorder Qty:</label>
                        <div class="control">
                            <input class="input" v-model="autos.reorder"name="reorder" type="text" placeholder="e.g 15">
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
                        <label class="label">Discount Allowed:</label>
                        <div class="control">
                            <input class="input" v-model="autos.discountallowed" name="discountallowed" type="text" placeholder="e.g 2000">
                        </div>
                    </div>
                    </div>
                
                        <div class="column is-2">
                    <div class="field">
                        <label class="label">Cost Price:</label>
                        <div class="control">
                            <input class="input" v-model="autos.cost"name="cost" type="text" placeholder="e.g 50,000">
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
                <button class="button is-primary">Update Vehicle</button>
            </div>
        </div>
    </div>
</div>
</div>
    <div class="notification is-success" v-if="success">
        <h2 class="title is-2"> Vehicle successfully Updated </h2>
        <br>
        <router-link class="button is-info is-pulled-right" :to="{ name: 'autos' }"><i class="fa fa-user-plus m-r-10"></i>Click to Back Vehicle</router-link>
    </div>
</form>
</template>
<script>
    export default {
    props: ['id'], 
    data(){
    return {

    vendors: [],
    getcats: [],
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
    loading: false,
    success: false,
    //csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

        }
    },
    methods: {
        getCats(){
                axios.get("/products./autos/CatsGet")
                .then(response => {
                this.getcats = response.data;
                }); 
        },
     updateSignal: function (id) {
                 axios.post('/products./autos/AutosUpdate/' + id, this.autos)
                .then(response => { this.success = true;
                 })
                    .catch((error) => {
                        this.allerros = error.response.data.errors;
                        this.success = false;
                   });
            }, 
            
             ShowSingle(){
            axios.get(`/products./autos/ShowSingle/${this.$route.params.id}`)
                .then((response)=> this.autos = this.temp = response.data)
                .catch((error) => this.errors = error.response.data.errors)
                        }    
                },
            
    mounted(){
        this.getCats();
        this.ShowSingle();
        
        axios.get('/vendors./GetVendors/').then(response => {
                  this.vendors = response.data;
                  });
        
        },
}
</script>