<template>
    <section>
        <form  @submit.prevent="onSubmit">
        <div class="columns" v-if="!success">
            <div class="column is-12">
                <div class="box">
                     <div class="columns is-multiline">
                        <div class="column is-4"><h3 class="title is-4">Purchase Receive</h3></div>
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
                <div class="column is-3">
                    <b-field label="Delivery No:">
                        <b-input name="dno" ></b-input>
                    </b-field>
                    <span class="help is-danger"> </span>
                </div>
                    <div class="column is-3">
                        <b-field label="Sales Tax Invoice No:">
                        <b-input name="dno" ></b-input>
                    </b-field>
                         
                    </div>
                    <div class="column is-2">
                     <b-field label="Dispatch Date:">
                       <b-input name="dno" type="date"></b-input>
                    </b-field>
                </div>
                <div class="column is-2">
                     <b-field label="Receiving Date:">
                       <b-input name="dno" type="date"></b-input>
                    </b-field>
                </div>
                <div class="column is-2">
                     <b-field label="Due Date:">
                       <b-input name="dno" type="date"></b-input>
                    </b-field>
                </div>

                  
            </div>
                <div class="columns is-multiline">
                    <div class="column is-12">
        <table class="table">
        <thead>
            <tr>
                <td><strong>Product Code</strong></td>
                <td><strong>Product Name</strong></td>
                <td><strong>category</strong></td>
                <td><strong>Qty</strong></td>
                <td><strong>Cost</strong></td>
                <td><strong>Amount:</strong></td>
                <td><strong>Transportation Cost</strong></td>
                <td><strong>Transportation/Per</strong></td>
                <td><strong>Whole Sale:</strong></td>
                <td><strong>Sale Price:</strong></td>
                
            </tr>
        </thead>
        <tbody>
            <tr v-for="(dload, index)  in Dataload">
                <td>{{ dload.code }}</td>
                <td>{{ dload.name }}</td>
                <td>{{ dload.category }} {{ dload.subcat }}</td>
                <td><input type="hidden" v-model.number="dload.qty">{{ dload.qty }}</td>
                <td><input type="number" v-model.number="dload.cost" class="input"></td>
                <td>{{ tcost = dload.qty * dload.cost }}</td> 
                <td>{{ ct = tcost / total * cargo }}
                    <input type="hidden" v-model.number="ct" class="input">
                </td>
                <td>{{ ct / dload.qty }}</td>
                <td><b-input name="wsaleprice" v-model="dload.wsaleprice"></b-input></td>
                <td><b-input name="saleprice" v-model="dload.saleprice"></b-input></td>
                
                
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7">Total</td>
                <td><b>{{ total }}</b></td>
                <td><b>{{ wtotal }}</b></td>
                <td><b>{{ sptotal }}</b></td>
            </tr>
             <tr>
                <td colspan="6">Transportation</td> 
               <td><input name="cargo" type="text" class="input" v-model="cargo"></td>
            </tr>
        </tfoot>
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
        <router-link class="button is-info is-pulled-right" :to="{ name: 'poELists' }"><i></i>Click to Back POs</router-link>
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
        props: ['id'], 
        data(){
            return { 
                poe:[],
                Dataload: [],
                cargo:'0',
                amount:'',
                success: false,
                branches:[],
                vendors:'',
            
                allerros:[],
                products:[],

                data: [],
                isFetching: false,
                isFetching2: false,
 
            }
        },
        computed: {
            total() {
            return this.Dataload.reduce((total, dload) => {
            return total + dload.qty * dload.cost;
          }, 0).toFixed(2);
            },
            wtotal() {
            return this.Dataload.reduce((wtotal, dload) => {
            return wtotal + dload.wsaleprice;
          }, 0).toFixed(2);
            },
            sptotal() {
            return this.Dataload.reduce((sptotal, dload) => {
            return sptotal + dload.saleprice;
          }, 0).toFixed(2);
            },

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

         
            onSubmit: function(){                
                var addRows = _.map(this.addRows, function(num){ return _.pick(num, 'qty','branch_id','podate','product_id','refno','vendor_id')})
                axios.post('/purchases./electronic/StoreElecPO', addRows)
                
                .then(response => { this.success = true;
                      })
                    .catch((error) => {
                        this.allerros = error.response.data.errors;
                        this.success = false;
                   });
                },
              
            },
            mounted(){
            axios.get("/purchases./electronic/GetPOshow/" + this.id).then(({data}) => (this.Dataload = data))
            
    
    },
    filters: {
        Upper(value) {
            return value.toUpperCase();
        }
    }

    }
</script>