<template>
    <section>
        <form  @submit.prevent="onSubmit">
        <div class="columns" v-if="!success">
            <div class="column is-8 is-offset-2">
            

                    <p class="content"><b>Selected:</b> {{ selected }}</p>
        <b-field label="Find or add a Fruit">
            <b-autocomplete
                v-model="product"
                ref="autocomplete"
                :data="filteredDataArray"
                placeholder="e.g. Dog"
                @select="option => selected = option">
                <template slot="header">
                    <a @click="showAddFruit">
                        <span> Add new... </span>
                    </a> 
                </template>
                <template slot="empty">No results for {{product}} </template>
            </b-autocomplete>




        </b-field>
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

                <div class="column is-5">
                    <b-field label="Vendor">
                        <b-autocomplete v-model="vendors" required
                            :data="data"
                            placeholder="Type Vendor name"
                            field="company"
                            :loading="isFetching"
                            @typing="getAsyncData1"
                            @select="option => addRows[0].vendor_id = option.id">
                            <template slot-scope="props">
                                <div class="media">
                                    <div class="media-content">
                                        {{ props.option.company }}
                                        <br>
                                        <small>
                                            Person {{ props.option.person }},<br>
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
                            <b-input v-model="addRows[0].refno" name="refno" expanded required></b-input>
                         </b-field>
                         <span class="help is-danger"> </span>
                    </div>
                    <div class="column is-3">
                     <b-field label="Order Date:">
                        <input class="input" v-model="addRows[0].podate" type="date" placeholder="Text input" expanded required>
                         
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
                <td><strong></strong></td>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(addRow, index) in addRows">
            <td width="360px">
            <b-field>
            <b-autocomplete v-model="addRow.items" required
                :data="products"
                placeholder="Type Product name"
                field="name"
                :loading="isFetching2"
                @typing="getAsyncData"
                @select="option => addRow.product_id = option.id">
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
                <td width="220px">
                     <b-field>
                            <b-input v-model="addRow.qty" expanded name="qty[]" type="number" required></b-input></b-field>
                    <span class="help is-danger"> </span>
                </td>
                <td width="220px">
                    <b-field is-right>
                    <button class="button is-button is-danger is-pulled-right" @click="deleteRow(index)">X</button>
                </b-field>
                </td>
            </tr>
        </tbody>
        <button class="button is-info" @click.prevent="addRow">+ Add row</button>
            
    </table>
            </div>
                </div>
            
             <div class="control is-flex is-pulled-right">
                    <button  class="button is-primary">Add Product</button>
            </div>
            
            </div>
        </div>
    </div>

    <div class="notification is-success" v-if="success">
        <h2 class="title is-2"> Record successfully Stored! </h2>
        <br>
        <router-link class="button is-info is-pulled-right" :to="{ name: 'poELists' }"><i class="fa fa-user-plus m-r-10"></i>Click to Back POs</router-link>
    </div>

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
                 data4: [],
                 name: '',
                selected: null
 
            }
        },
               computed: {
            filteredDataArray() {
                return this.data4.filter((option) => {
                    return option.name
                        .toString()
                        .toLowerCase()
                        .indexOf(this.name.toLowerCase()) >= 0
                })
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
                        data.forEach((item) => this.products.push(item))
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
                var addRows = _.map(this.addRows, function(num){ return _.pick(num, 'qty','branch_id','podate','product_id','refno','vendor_id')})
                axios.post('/purchases./electronic/StoreElecPO', addRows)
                //.then(response =>{ 
                //})
                .then(response => { this.success = true;
                      })
                   //  .catch((error) => {
                   //      this.allerros = error.response.data.errors;
                   //      this.success = false;
                   // });
                },
                 showAddFruit() {
                this.$dialog.prompt({
                    message: `Fruit`,
                    inputAttrs: {
                        placeholder: 'e.g. Watermelon',
                        maxlength: 20,
                        value: this.name
                    },
                    confirmText: 'Add',
                    onConfirm: (value) => {
                        this.data4.push(value)
                        this.$refs.autocomplete.setSelected(value)
                    }
                })
            }
              
            },

     
            mounted(){
            axios.get("/purchases./electronic/GetBranches").then(({data}) => (this.branches = data));
            axios.get("/purchases./electronic/ElecProductsList").then(response => this.data4 = response.data);
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