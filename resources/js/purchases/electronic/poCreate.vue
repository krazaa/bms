<template>
    <section>
        <form  @submit.prevent="onSubmit">
        <!-- <div class="columns" v-if="!success"> -->
            <div class="column is-10 is-offset-1">
                <div class="box">
                     <div class="columns is-multiline">
                        <div class="column is-4"><h3 class="title is-4">New Purchase Order</h3></div>
                            <div class="column is-8">
                                <nav class="breadcrumb is-right" aria-label="breadcrumbs">
                                    <ul>
                                        <li>
                                            <span class="icon is-small"><i class="mdi mdi-home" aria-hidden="true"></i></span>
                                            <router-link to="/dashboard"><span>Home</span></router-link>
                                        </li>
                                        <li>
                                            <span class="icon is-small"><i class="mdi mdi-car" aria-hidden="true"></i></span>
                                            <router-link :to="{ name: 'poELists' }"><span>Purchase Order Page</span></router-link>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                    </div>
 
            <div class="columns">
                <div class="column is-4">
                    <b-field label="Vendor">
                        <b-autocomplete v-model="vendors"
                            :data="data"
                            placeholder="Type Vendor name"
                            field="company"
                            :loading="isFetching"
                            @typing="getAsyncData1"
                            @select="option => addRows.vendor_id = option.id">
                            <template slot-scope="props">
                                <div class="media">
                                    <div class="media-content">
                                        {{ props.option.company }}
                                        <br>
                                        <small>
                                            Person {{ props.option.person }},
                                            Mobile <b>{{ props.option.mobile }}</b>
                                        </small>
                                    </div>
                                </div>
                            </template>
                        </b-autocomplete>
                    </b-field>
                    <span class="help is-danger"> </span>
                </div>
                    <div class="column is-3">
                         <b-field label="Reference No:">
                            <b-input v-model="addRows.refno" name="refno" expanded></b-input>
                         </b-field>
                         <span class="help is-danger"> </span>
                    </div>
                    <div class="column is-4">
                     <b-field label="Date:">
                        <input class="input" v-model="addRows.podate" type="date" placeholder="Text input" expanded>
                         
                    </b-field>
                         <span class="help is-danger"> </span>
                </div>    
            </div>
                <div class="columns is-multiline">
                    <div class="column is-12">
                      <table class="table">
        <thead>
            <tr>
                <td><strong>Product Name</strong></td>
                <td><strong>Qty</strong></td>
                <td><strong>Branch</strong></td>
                <td><strong>Action</strong></td>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(addRow, index) in addRows">
                <td>
            <b-field>
            <b-autocomplete v-model="addRow.items"
                :data="products"
                placeholder="Type Product name"
                field="name"
                :loading="isFetching2"
                @typing="getAsyncData"
                @select="option => addRows.product_id = option.id" expanded>
                <template slot-scope="props">
                    <div class="media">
                        <div class="media-left">
                            <img width="32" :src="`/public/electronic/${props.option.photo}`">
                        </div>
                        <div class="media-content">
                            {{ props.option.name }}
                            <br>
                            <small>
                                Code: <b>{{ props.option.code }}</b>
                                
                            </small>
                        </div>
                    </div>
                </template>
            </b-autocomplete>
        </b-field>
        <span class="help is-danger"> </span>
                </td>
                <td>
                     <b-field>
                            <b-input v-model="addRow.qty" expanded name="qty[]" type="number"></b-input>
                         </b-field>
                         <span class="help is-danger"> </span>
                </td>
                <td>
                    <b-field>
                            <b-select  name="branch_id[]" v-model="addRow.branch_id" expanded>
                                <option v-for="br in branches" :value="br.id">{{ br.name }}</option>
                            </b-select>
                        </b-field>
                         <span class="help is-danger"> </span>
                </td>
                <td>
                    <b-field>
                    <button class="button is-button is-danger" @click="deleteRow(index)">X</button>
                </b-field>
                </td>
            </tr>
        </tbody>
    </table>
            </div>
                </div>
            
             <div class="control is-flex is-pulled-right">
                    <button  class="button is-primary">Add Product</button>
            </div>
            <a class="button is-info" @click="addRow">+ Add row</a>
            </div>
        </div>
    </div>

    <!-- <div class="notification is-success" v-if="success">
        <h2 class="title is-2"> Record successfully Stored! </h2>
        <br>
        <router-link class="button is-info is-pulled-right" :to="{ name: 'poELists' }"><i class="fa fa-user-plus m-r-10"></i>Click to Back Electronic</router-link>
    </div> -->

</form>
</section>
</template>
<script>
import debounce from 'lodash/debounce'   
import Datepicker from 'vue-bulma-datepicker'
export default {
     components: {
        Datepicker
        },
        data(){
            return { 
                Dataload:[],
              
             addRows: [{
                    product_id: '',
                    qty: '',
                    branch_id: '',
                    items:'',
                    vendor_id:'',
                    refno:'',
                    podate:'',
                }],              
                
                success: false,
                branches:[],
                 vendors:'',
                 items:'',
                 
                //vendor_id:'',
                //branch_id:'',
                //product_id:'',
                //refno:'',
                
                allerros:[],

                products:[],
                data: [],
                isFetching: false,
                isFetching2: false,
 
            }
        },
         methods: {
            //vendors Search
            getAsyncData1: debounce(function (name) {
                if (!name.length) {
                    this.data = []
                    return
                }
                this.isFetching = true
                 axios.get(`/vendors./VendorSearch?search=${this.vendors}`)
                    .then(({ data }) => {
                        this.data = []
                        data.data.forEach((item) => this.data.push(item))
                    })
                    .catch((error) => {
                        this.data = []
                        throw error
                    })
                    .finally(() => {
                        this.isFetching = false
                    })
            }, 500),
            //products Search
            getAsyncData: debounce(function (name) {
                if (!name.length) {
                    this.data = []
                    return
                }
                this.isFetching2 = true
                

                 axios.get(`/purchases./electronic/GetElecProducts?search=${name}`)
                    .then(({ data }) => {
                        this.data = []
                        data.data.forEach((item) => this.products.push(item))
                    })
                    .catch((error) => {
                        this.data = []
                        throw error
                    })
                    .finally(() => {
                        this.isFetching2 = false
                    })
            }, 500),
        
            addRow() {
              this.addRows.push({
                product_id: '',
                qty: '',
                branch_id: ''
                });
          },
           deleteRow(index) {
              this.addRows.splice(index,1)
            },
         
            onSubmit: function(){

                let data = new FormData();
                data.append('vendor_id',this.addRows.vendor_id);
                data.append('refno', this.addRows.refno);
                data.append('podate', this.addRows.podate);
                data.append('product_id', this.addRows.product_id);
                data.append('qty', this.addRows.qty);
                data.append('branch_id', this.addRows.branch_id);

                axios.post('/purchases./electronic/StoreElecPO', data)
                .then(response =>{
                }).then(response => { this.success = true;
                      })
                    .catch((error) => {
                        this.allerros = error.response.data.errors;
                        this.success = false;
                   });
                },
              
            },
            mounted(){
            axios.get("/purchases./electronic/GetBranches").then(({data}) => (this.branches = data));
            // axios.get("/vendors./GetVendorsAuto").then(({data}) => (this.vendors = data));
            //axios.get("/categories./indexAutos").then(({data}) => (this.getcats = data));
    
    },
    filters: {
        Upper(value) {
            return value.toUpperCase();
        }
    }

    }
</script>