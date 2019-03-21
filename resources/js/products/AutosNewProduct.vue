<template>
    <!-- <form method="POST" action="/products./autos/AutoProductStore"> -->
    <form  v-on:submit.prevent="StoreProduct()">
<!--     <input type="hidden" name="_token" :value="csrf"> -->
    <div class="columns">
        <div class="column is-10 is-offset-1">
            <div class="box">
                <b-field grouped group-multiline>
                    <div class="control">
                        <h3 class="title is-4">Add New Product</h3>
                    </div>
                </b-field>
                <div class="field">
                     <div class="field">
                        <label class="label">Select Vendor:</label>
                        <div class="control">
                            <div class="select">
                                <select name="vendor_id" v-model="Addvendor.vendor">
                                    <option selected disabled>Select Vendor</option>
                                    <option v-for="vendor in vendors.data" :value="vendor.id">{{ vendor.company }}</option>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="columns is-multiline">
                        <div class="column is-4">
                    <div class="field">
                        <label class="label">Product Code: 
                        </label>
                        <div class="control">
                            <input class="input" type="text" placeholder="e.g B18123456" v-model="Addvendor.code" @input="Checkcode">
                            {{ state }}
                        </div>
                        
                        <p class="help is-success list-inline" v-if="state == '0'">{{ state }} Available</p>
                        <p class="help is-danger" v-if="state == '1'"> Not Available</p>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field">
                        <label class="label">Product Name:</label>
                        <div class="control">
                            <input class="input" v-model="Addvendor.name" name="name" type="text" placeholder="e.g Honda 125">
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field">
                        <label class="label">Model:</label>
                        <div class="control">
                            <input class="input" name="model" type="text" placeholder="e.g XX-0013">
                        </div>
                    </div>
                </div>
            </div>
                
                <div class="columns is-multiline">
                        <div class="column is-4">
                    <div class="field">
                        <label class="label">Short Name:</label>
                        <div class="control">
                            <input class="input" name="shortname" type="text" placeholder="e.g Euro 125 CC">
                        </div>
                    </div>
                </div>
                   <div class="column is-4">
                    <div class="field">
                        <label class="label">Qty:</label>
                        <div class="control">
                            <input class="input" name="qty" type="text" placeholder="e.g 1">
                        </div>
                    </div>
                </div>
                   <div class="column is-4">
                    <div class="field">
                        <label class="label">Max Qty:</label>
                        <div class="control">
                            <input class="input" name="maxqty" type="text" placeholder="e.g 10">
                        </div>
                    </div>
                    </div>
                </div>
                <div class="columns is-multiline">
                        <div class="column is-4">
                    <div class="field">
                        <label class="label">Reorder Qty:</label>
                        <div class="control">
                            <input class="input" name="reorder" type="text" placeholder="e.g 15">
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                     <div class="field">
                        <label class="label">Cash Discount:</label>
                        <div class="control">
                            <input class="input" name="cashdis" type="text" placeholder="e.g 2000">
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field">
                        <label class="label">Discount Allowed:</label>
                        <div class="control">
                            <input class="input" name="discountallowed" type="text" placeholder="e.g 2000">
                        </div>
                    </div>
                    </div>
                </div>
                <div class="columns is-multiline">
                        <div class="column is-4">
                    <div class="field">
                        <label class="label">Cost Price:</label>
                        <div class="control">
                            <input class="input" name="cost" type="text" placeholder="e.g 50,000">
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field">
                        <label class="label">Whole Sale Price:</label>
                        <div class="control">
                            <input class="input" name="wsaleprice" type="text" placeholder="e.g 45,000">
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field">
                        <label class="label">Selling Price:</label>
                        <div class="control">
                            <input class="input" name="saleprice" type="text" placeholder="e.g 55,000">
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

<!-- <div class="box" v-if="submitted"> -->
    <!-- <div class="control" v-if="submitted">
        <p class="title is-1">Product Successfully Addred!</p>
    </div> -->
<!-- </div> -->

</form>
</template>
<script>
    export default {
        data(){
            return {               
                product: [],
                username:'',
                submitted:false,
                vendors: [],
                Addvendor: {
                    vendor:'',
                    code:'',
                    name:''
                },
                state:'',
                
                loading: false,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
               
            }
        },
         methods: {
            Checkcode() {
                axios.get('/products./autos/SearchCode?code=' + this.Addvendor.code)
                    .then((response)=> this.state = this.temp = response.data)
                    console.log(this.state)
                },
            StoreProduct(){
                axios.post('/products./autos/AutoProductStore', this.Addvendor)
                .then(function(){
                //console.log(data);
                    //this.submitted = true;
                }).catch(function(error){
                    console.log(error);

                })
                  //   .then(function (data) {
                  //   console.log(data);
                  // });
                  
            
        }
    },
        mounted(){
        
            axios.get("/vendors./GetVendors").then(({data}) => (this.vendors = data));
    
    },
    }
</script>