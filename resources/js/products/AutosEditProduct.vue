<template>
    <form class="form-horizontal" method="POST" :action="`/products./autos/AutosUpdate/${product.id}`">

        <!-- <input type="hidden" name="_token" :value="csrf"> -->
    <div class="columns">
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
        
              <div class="field">
                     <div class="field">
                        <label class="label">Select Vendor:</label>
                        <div class="control">
                            <div class="select">
                                <select>
                                <option v-for="vendor in vendors.data" :value="product.vendor_id" :selected="product.vendor_id == vendor.id">{{ vendor.company }}</option>
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
                            <input class="input" type="text" v-model="product.code" disabled>
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field">
                        <label class="label">Product Name:</label>
                        <div class="control">
                            <input class="input" v-model="product.name" name="name" type="text" placeholder="e.g Honda 125">
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field">
                        <label class="label">Model:</label>
                        <div class="control">
                            <input class="input" v-model="product.model" type="text" placeholder="e.g XX-0013">
                        </div>
                    </div>
                </div>
            </div>

     <div class="columns is-multiline">
                        <div class="column is-4">
                    <div class="field">
                        <label class="label">Short Name:</label>
                        <div class="control">
                            <input class="input" v-model="product.shortname" name="shortname" type="text" placeholder="e.g Euro 125 CC">
                        </div>
                    </div>
                </div>
                   <div class="column is-4">
                    <div class="field">
                        <label class="label">Qty:</label>
                        <div class="control">
                            <input class="input" v-model="product.qty" name="qty" type="text" placeholder="e.g 1">
                        </div>
                    </div>
                </div>
                   <div class="column is-4">
                    <div class="field">
                        <label class="label">Max Qty:</label>
                        <div class="control">
                            <input class="input" v-model="product.maxqty" name="maxqty" type="text" placeholder="e.g 10">
                        </div>
                    </div>
                    </div>
                </div>

<div class="columns is-multiline">
                        <div class="column is-4">
                    <div class="field">
                        <label class="label">Reorder Qty:</label>
                        <div class="control">
                            <input class="input" v-model="product.reorder"name="reorder" type="text" placeholder="e.g 15">
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                     <div class="field">
                        <label class="label">Cash Discount:</label>
                        <div class="control">
                            <input class="input" v-model="product.cashdis" name="cashdis" type="text" placeholder="e.g 2000">
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field">
                        <label class="label">Discount Allowed:</label>
                        <div class="control">
                            <input class="input" v-model="product.discountallowed" name="discountallowed" type="text" placeholder="e.g 2000">
                        </div>
                    </div>
                    </div>
                </div>
<div class="columns is-multiline">
                        <div class="column is-4">
                    <div class="field">
                        <label class="label">Cost Price:</label>
                        <div class="control">
                            <input class="input" v-model="product.cost"name="cost" type="text" placeholder="e.g 50,000">
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field">
                        <label class="label">Whole Sale Price:</label>
                        <div class="control">
                            <input class="input" v-model="product.wsaleprice" name="wsaleprice" type="text" placeholder="e.g 45,000">
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field">
                        <label class="label">Selling Price:</label>
                        <div class="control">
                            <input class="input" v-model="product.saleprice" name="saleprice" type="text" placeholder="e.g 55,000">
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

</form>
</template>
<script>
    export default {
    props: ['id'], 
    data(){
    return {

    product: [],
    vendors: [],
    loading: false,
    csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

        }
    },
    mounted(){
        axios.get('/products./autos/ShowSingle/' + this.id)
        .then(response => {
                  this.product = response.data;
                  });
        //.then((response)=> this.product = this.temp = response.data)
        //.catch((error) => this.errors = error.response.data.errors)
        //console.log(this.productid)
        axios.get('/vendors./GetVendors/').then(response => {
                  this.vendors = response.data;
                  });
        //.then((response)=> this.vendors = this.temp = response.data)
        //.catch((error) => this.errors = error.response.data.errors)
        //console.log(this.vendors)
        },
}
</script>