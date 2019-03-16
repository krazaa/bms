<template>
    <form class="form-horizontal" method="POST" :action="`/products./autos/AutosUpdate/${product.id}`">
<div class="columns is-multiline">
        <input type="hidden" name="_token" :value="csrf">
    <div class="column is-12">
        <div class="box">
            <b-field grouped group-multiline>
            <div class="control">
                <h3 class="title is-4">Update Product</h3>
            </div>
            </b-field>
            <div class="field is-grouped">
                <div class="field">
                    <label class="label">Product Code:</label>
                    <div class="control">
                        <input class="input" type="text" name="code" :value="product.code" disabled>
                    </div>
                </div>
                <div class="field is-expanded">
                    <label class="label">Product Name:</label>
                    <div class="control is-expanded">
                        <input class="input" name="name" :value="product.name" type="text" placeholder="e.g Honda 125">
                    </div>
                </div>
                <div class="field is-expanded">
                    <label class="label">Model:</label>
                    <div class="control">
                        <input class="input" name="model" :value="product.model" type="text">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Short Name:</label>
                    <div class="control">
                        <input class="input" name="shortname" :value="product.shortname" type="text" placeholder="e.g Euro 125 CC">
                    </div>
                </div>
            </div>
            <div class="field is-grouped is-expanded">
                <div class="field is-expanded">
                    <label class="label">Select Vendor:</label>
                    <div class="control">
                        <div class="select">
                            <select>
                                <option v-for="vendor in vendors" :value="product.vendor_id" :selected="product.vendor_id == vendor.id">{{ vendor.company }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Qty:</label>
                    <div class="control">
                        <input class="input" name="qty" :value="product.qty" type="text">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Max Qty:</label>
                    <div class="control">
                        <input class="input" name="maxqty" :value="product.maxqty" type="text">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Reorder :</label>
                    <div class="control">
                        <input class="input" name="reorder" :value="product.reorder" type="text">
                    </div>
                </div>
            </div>
           <div class="field is-grouped">
                     <div class="field">
                        <label class="label">Cash Discount:</label>
                        <div class="control">
                            <input class="input" name="cashdis" :value="product.cashdis" type="text" placeholder="e.g 2000">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Discount Allowed:</label>
                        <div class="control">
                            <input class="input" name="discountallowed" :value="product.discountallowed" type="text" placeholder="e.g 2000">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Cost Price:</label>
                        <div class="control">
                            <input class="input" name="cost" :value="product.cost" type="text" placeholder="e.g 50,000">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Whole Sale Price:</label>
                        <div class="control">
                            <input class="input" name="wsaleprice" :value="product.wsaleprice" type="text" placeholder="e.g 45,000">
                        </div>
                    </div>
                </div>
                <div class="field is-grouped">
                    <div class="field">
                        <label class="label">Selling Price:</label>
                        <div class="control">
                            <input class="input" name="saleprice" :value="product.saleprice" type="text" placeholder="e.g 55,000">
                        </div>
                    </div>
                
            </div>
            <div class="control is-flex is-pulled-right">
                <button class="button is-primary">Update Product</button>
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
        axios.get('/products./autos/ShowSingle/' + this.productid)
        .then((response)=> this.product = this.temp = response.data)
        //.catch((error) => this.errors = error.response.data.errors)
        console.log(this.productid)
        axios.get('/vendors./GetVendors/')
        .then((response)=> this.vendors = this.temp = response.data)
        .catch((error) => this.errors = error.response.data.errors)
        //console.log(this.vendors)
        },
}
</script>