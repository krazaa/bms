<template>
    <form method="POST" action="/products./autos/AutoProductStore">
    <input type="hidden" name="_token" :value="csrf">
    <div class="columns is-multiline">
        <div class="column is-12">
            <div class="box">
                <b-field grouped group-multiline>
                <div class="control">
                    <h3 class="title is-4">Add New Product</h3>
                </div>
                </b-field>
                <div class="field is-grouped">
                    <div class="field">
                        <label class="label">Product Code:</label>
                        <div class="control">
                            <input class="input" name="code" type="text" placeholder="e.g B18123456">
                        </div>
                    </div>
                    <div class="field is-expanded">
                        <label class="label">Product Name:</label>
                        <div class="control is-expanded">
                            <input class="input" name="name" type="text" placeholder="e.g Honda 125">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Short Name:</label>
                        <div class="control">
                            <input class="input" name="shortname" type="text" placeholder="e.g Euro 125 CC">
                        </div>
                    </div>
                </div>
                <div class="field is-grouped">
                    <div class="field">
                        <label class="label">Select Vendor:</label>
                        <div class="control">
                            <div class="select">
                                <select name="vendor_id">
                                    <option v-for="vendor in vendors" :value="vendor.id">{{ vendor.company }}</option>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Color:</label>
                        <div class="control">
                            <input class="input" name="color" type="text" placeholder="e.g Red">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Engine:</label>
                        <div class="control">
                            <input class="input" name="engine" type="text" placeholder="e.g 2672">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Chassis:</label>
                        <div class="control">
                            <input class="input" name="chassis" type="text" placeholder="e.g EX-123-A">
                        </div>
                    </div>
                </div>
                <div class="field is-grouped">
                    <div class="field">
                        <label class="label">Cost Price:</label>
                        <div class="control">
                            <input class="input" name="cost" type="text" placeholder="e.g 50,000">
                        </div>
                        
                    </div>
                    <div class="field">
                        <label class="label">Selling Price:</label>
                        <div class="control">
                            <input class="input" name="saleprice" type="text" placeholder="e.g 55,000">
                        </div>
                    </div>
                    
                </div>
                <div class="control is-flex is-pulled-right">
                    <button class="button is-primary">Add Product</button>
                </div>
            </div>
        </div>
    </div>
</form>
</template>
<script>
    export default {
        props: ['productid'], 
        data(){
            return {
                
                product: [],
                vendors: [],
                loading: false,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
               
            }
        },
        mounted(){
        axios.get('/products/autos/ShowSingle/' + this.productid)
        .then((response)=> this.product = this.temp = response.data)
        //.catch((error) => this.errors = error.response.data.errors)
        console.log(this.productid)
        axios.get('/vendors./GetVendors/')
        .then((response)=> this.vendors = this.temp = response.data)
        .catch((error) => this.errors = error.response.data.errors)
    },
    }
</script>