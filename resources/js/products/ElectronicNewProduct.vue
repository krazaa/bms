<template>
<form enctype="multipart/form-data" @submit.prevent="onSubmit">
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
                                        <i class="mdi mdi-arrow-left-bold-box" aria-hidden="true"></i>
                                    </span>
                                    <router-link :to="{ name: 'electronic' }"><span>Electronic Page</span></router-link>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="columns is-multiline">
                    
                    <div class="column is-4">
                           <b-field label="Category">
                            <b-select placeholder="Select a Category" v-model="FormData.category_id" name="category_id" @input="subCats" expanded required>
                                <option v-for="lc in Loadcategory" :value="lc.id">{{ lc.category }}</option>
                            </b-select>
                        </b-field>
                    </div>
                    <div class="column is-4" v-if="FormData.category_id > 0">
                          <b-field label="Sub Category">
                            <b-select placeholder="Select a Sub Category" v-model="FormData.subcategory_id" name="subcategory_id" expanded>
                                 <option v-for="subcat in subcats" :value="subcat.id">{{ subcat.category }}</option>
                            </b-select>
                        </b-field>
                    </div>
                </div>
                <div class="columns is-multiline">
                    <div class="column is-2">
                            <label class="label">Product Code:</label>
                        <div class="field">
                            <div class="control">
                                <input class="input" type="text" placeholder="e.g B18123456" v-model="FormData.code" @input="Checkcode">
                            </div>
                            <p class="help is-success" v-if="state == 'Available'">{{ FormData.code }} Available</p>
                            <p class="help is-danger" v-if="state == 'Not Available'"> Not Available</p>
                            <span class="help is-danger">{{ allerros.code }}</span>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Product Name:</label>
                            <div class="control">
                                <input class="input" v-model="FormData.name" name="name" type="text" placeholder="e.g Honda 125">
                                 <span class="help is-danger">{{ allerros.name }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Man Part no:</label>
                            <div class="control">
                                <input class="input" v-model="FormData.manpartno" name="manpartno" type="text" placeholder="e.g XX-0013">
                                 <span class="help is-danger">{{ allerros.manpartno }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Qty:</label>
                            <div class="control">
                                <input class="input" v-model="FormData.qty" name="qty" type="text" placeholder="e.g 1">
                            </div>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Max Qty:</label>
                            <div class="control">
                                <input class="input" v-model="FormData.maxqty" name="maxqty" type="text" placeholder="e.g 10">
                                 <span class="help is-danger">{{ allerros.maxqty }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Reorder Qty:</label>
                            <div class="control">
                                <input class="input" v-model="FormData.reorder" name="reorder" type="text" placeholder="e.g 15">
                                 <span class="help is-danger">{{ allerros.reorder }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Cash Discount:</label>
                            <div class="control">
                                <input class="input" v-model="FormData.cashdis" name="cashdis" type="text" placeholder="e.g 2000">
                                <span class="help is-danger">{{ allerros.cashdis }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Discount Allow:</label>
                            <div class="control">
                                <input class="input" v-model="FormData.discountallowed" name="discountallowed" type="text" placeholder="e.g 2000">
                                <span class="help is-danger">{{ allerros.discountallowed }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Cost Price:</label>
                            <div class="control">
                                <input class="input" v-model="FormData.cost" name="cost" type="text" placeholder="e.g 50,000">
                                <span class="help is-danger">{{ allerros.cost }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Whole Sale Price:</label>
                            <div class="control">
                                <input class="input" v-model="FormData.wsaleprice" name="wsaleprice" type="text" placeholder="e.g 45,000">
                                <span class="help is-danger">{{ allerros.wsaleprice }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Selling Price:</label>
                            <div class="control">
                                <input class="input" v-model="FormData.saleprice" name="saleprice" type="text" placeholder="e.g 55,000">
                                <span class="help is-danger">{{ allerros.saleprice }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Photo:</label>
                            <div class="control">
                                 <input @change="newProduct" id="photo" type="file" name="photo" class="input">
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
    </div>
    <div class="notification is-success" v-if="success">
        <h2 class="title is-2"> Record successfully Stored! </h2>
        <br>
        <router-link class="button is-info is-pulled-right" :to="{ name: 'electronic' }"><i class="fa fa-user-plus m-r-10"></i>Click to Back Electronic</router-link>
    </div>

</form>
</template>
<script>
    export default {
        data(){
            return {     
                success: false,          
                product: [],
                Loadcategory: [],
                username:'',
                submitted:false,
                loading:false,
                vendors: [],
                subcats: [],
                allerros: [],
                FormData: {
                    vendor_id:'',
                    category_id:'',
                    subcategory_id:'',
                    code:'',
                    name:'',
                    manpartno:'',
                    qty:'1',
                    maxqty:'',
                    reorder:'',
                    cost:'',
                    saleprice:'',
                    wsaleprice:'',
                    discountallowed:'0',
                    cashdis:'0',
                    photo:'',
                    file: null

                },
                state:'',
                photo:'',
               
            }
        },
        created () {
            // fetch the data when the view is created and the data is
            // already being observed
            this.getCatVan()
            this.cats()
          },
        watch: {
            '$route': 'getCatVan',
            '$route': 'cats'
        },
         methods: {
             newProduct(event) {
               let files = event.target.files;
               if (files.length) this.photo = files[0];
            },
            //updateAvatar: function (id) {
            onSubmit: function () {
                 
                 let data = new FormData();
                data.append('file', this.photo);
                data.append('vendor_id', this.FormData.vendor_id,);
                data.append('category_id', this.FormData.category_id,);
                data.append('subcategory_id', this.FormData.subcategory_id,);
                data.append('code', this.FormData.code,);
                data.append('name', this.FormData.name,);
                data.append('manpartno', this.FormData.manpartno,);
                data.append('qty', this.FormData.qty,);
                data.append('maxqty', this.FormData.maxqty,);
                data.append('reorder', this.FormData.reorder,);
                data.append('cost', this.FormData.cost,);
                data.append('saleprice', this.FormData.saleprice,);
                data.append('wsaleprice', this.FormData.wsaleprice,);
                data.append('discountallowed', this.FormData.discountallowed,);
                data.append('cashdis', this.FormData.cashdis,);
                axios.post('/products./electronic/ElecProductStore', data)
                //axios.post('/settings./UpdateSetting/1' +id, data)
                        .then(response => { this.success = true;
                         }) 
                         .catch((error) => { 
                            this.allerros = error.response.data.errors;
                        this.success = false;
                    });
              },
            
            cats(){
                axios.get("/categories./indexElec").then(({data}) => (this.Loadcategory = data));
            },
            subCats(){
                 axios.get('/categories./SubCatsElec/' + this.FormData.category_id)
                 .then((response)=> this.subcats = this.temp = response.data)
                 //.then(({data}) => (this.subcats = data));
                    
            },
            Checkcode() {
                var searchv = this
                axios.get('/products./electronic/SearchCode?code=' + this.FormData.code)
                    .then(function(response) {
                    Vue.set(searchv.$data, 'state', response.data)
                    })
                    //console.log(this.state)
                },
                getCatVan(){
                    axios.get("/vendors./GetVendorsElec").then(({data}) => (this.vendors = data));
                }
        },
         mounted(){
        this.cats();  
        },
        filters: {
        Upper(value) {
            return value.toUpperCase();
        }
    }

    }
</script>