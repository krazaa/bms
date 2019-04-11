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
                <div class="column is-2">
                    <b-field label="Purchase Order Number:">
                        <b-input name="poid" v-model="Dataload[0].poid" readonly></b-input>
                    </b-field>
                    <span class="help is-danger"> </span>
                </div>
                    <div class="column is-2">
                        <b-field label="Delivery No:">
                        <b-input name="dno" v-model="Dataload[0].dno"></b-input>
                    </b-field>
                         
                    </div>
                    <div class="column is-2">
                        <b-field label="Sales Tax Invoice No:">
                        <b-input name="stinv" v-model="Dataload[0].stinv"></b-input>
                    </b-field>
                         
                    </div>
                    <div class="column is-2">
                     <b-field label="Dispatch Date:">
                       <b-input name="ddate" type="date" v-model="Dataload[0].ddate"></b-input>
                    </b-field>
                </div>
                <div class="column is-2">
                     <b-field label="Receiving Date:">
                       <b-input name="rdate" type="date" v-model="Dataload[0].rdate"></b-input>
                    </b-field>
                </div>
                <div class="column is-2">
                     <b-field label="Due Date:">
                       <b-input name="duedate" type="date" v-model="Dataload[0].duedate"></b-input>
                    </b-field>
                </div>

                  
            </div>
                <div class="columns is-multiline">
                    <div class="column is-12">
        <table class="table">
        <thead>
            <tr>
                <td><strong>Code</strong></td>
                <td><strong>Qty</strong></td>
                <td><strong>Cost</strong></td>
                <td><strong>Amount:</strong></td>
                <td><strong>Cargo</strong></td>
                <td><strong>Cargo Per Unit</strong></td>
                <td><strong>Cost Price:</strong></td>
                <td><strong>Profit:</strong></td>
                <td><strong>Whole Sale:</strong></td>
                <td><strong>Profit:</strong></td>
                <td><strong>Sale Price:</strong></td>
                
            </tr>
        </thead>
        <tbody>
            <tr v-for="(dload, index)  in Dataload">
                <td width="150px">{{ dload.code }}</td>
                <td><input type="hidden" v-model.number="dload.qty">{{ dload.qty }}</td>
                <td width="120px"><input type="number" v-model.number="dload.cost" class="input"></td>
                <td>{{ tcost = dload.qty * dload.cost | currency}}</td> 
                <td>{{ totalcargo = tcost / total * cargo | currency}} 
                    <input type="hidden" v-model.number="totalcargo" class="input">
                </td>
                <td>{{ cargocost = totalcargo / dload.qty | currency }}</td>
                    <td>
                        <input type="text" v-model.number="totalcost=dload.cost + cargocost " class="input" readonly> 
                    </td>
                    <td>
                        <b-input type="number" v-model="hsp = dload.wsprice"> </b-input>
                    </td>
                    <td>
                        <input type="hidden" v-model="dload.wolSale = totalWholeSale">
                        <b-input type="number" name="wsaleprice" v-model="totalWholeSale" readonly></b-input>
                    </td>
                    
                    <td>
                        <b-input type="number" v-model="wspp = dload.sprice"> </b-input>
                    </td> 
                    <td>
                        <input type="hidden" v-model="dload.salPrice = totalSalePrice">
                        <b-input type="number" name="saleprice" v-model="totalSalePrice" readonly></b-input>

                        <input name="CostAmount" type="hidden" class="input" v-model="dload.CostAmount = totalcost">
                        <input name="itax" type="hidden" class="input" v-model="dload.tax = incomtax">
                        <input name="payable" type="hidden" class="input" v-model="dload.totalPayable = payable">
                        <input name="cargo" type="hidden" class="input" v-model="dload.cargoamount = cargo">
                        <input name="cargo" type="hidden" class="input" v-model="dload.branch_id">
                        <input name="payableamount" type="hidden" class="input" v-model="dload.tpayable =payable">
                    </td>
                
                
            </tr>
        </tbody>
        <tfoot>
            
             <tr>
               <td colspan="8"></td>
               <td><b>Income Tax:</b></td>
               <td><b>{{ incomtax }} Rs.</b></td>
               <td><input name="taxpage" type="number" class="input" v-model="taxpage"></td>
               <td></td>
            </tr>
            <tr>
                <td colspan="9"></td>
                <td ><b>Cargo Charges</b></td> 
                <td><input name="cargo" type="number" class="input" v-model="cargoamount = cargo"></td>
            </tr>
            <tr>
                <td colspan="9"></td>
                <td width="190px"><b>Total without Cargo:</b></td> 
                <td><b>{{ total }} Rs.</b></td>
            </tr>
            <tr>
                <td colspan="9"></td>
                <td><b>Total Payable</b></td> 
                <td><b>{{ payable }} Rs.</b>
                    
                </td>
            </tr>
        </tfoot>
    </table>
            </div>
                </div>
            
             <div class="control is-flex is-pulled-right">
                    <button  class="button is-primary" >Reveive Product</button>
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
                Dataload: {
                    dno:'',
                    branch_id:'',
                    stinv:'',
                    ddate:'',
                    rdate:'',
                    duedate:'',
                    wsp:'',
                    psprice:'',
                    wsprice:'',
                    tax:'',
                    wolSale:'',
                    salPrice:'',
                    cargoamount:'',
                    CostAmount:'',
                    totalPayable:'',
                    tpayable:''
                    
                },
                cargo:'0',
                amount:'',
                totalcost:'',
                cargoamount:'',
                itax:'',
                taxpage:'%',
                wsprice:'',
                sprice:'',
                payableamount:'',
                success: false,
                branches:[],
                vendors:'',
                wspricetotal:'0',
                
            
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
            return total + parseInt(dload.qty) * parseInt(dload.cost);
          }, 0).toFixed(0);
            },
            

            incomtax: function() {
            let total = 0;    
                return  total += ((this.taxpage / 100) * this.total).toFixed(0)
            },

            payable: function() {
                let total = 0;    
                return  total +=  parseFloat(this.total) + parseFloat(this.cargo);            
            },
            // totalSalePrice: function() {
                
            //     return parseFloat(this.wspp) + parseFloat(this.totalcost);            
            // },
        
             totalWholeSale() {
                let total = 0;    
                return  total +=  parseInt(this.hsp) + parseInt(this.totalcost);
              },

      
            totalSalePrice: function() {
             let total = 0;    
             return  total += parseInt(this.wspp) + parseInt(this.totalcost);
             },


        },

         methods: {
            //vendors Search
            // getAsyncData1: debounce(function (name) {
            //     if (!name.length) {
            //         this.data = []
            //         return
            //     }
            //     this.isFetching = true
            //      axios.get(`/vendors./VendorSearch?search=${this.vendors}`)
            //         .then(({ data }) => {
            //             this.data = []
            //             data.data.forEach((item) => this.data.push(item))
            //         })
            //         .catch((error) => {
            //             this.data = []
            //             throw error
            //         })
            //         .finally(() => {
            //             this.isFetching = false
            //         })
            // }, 500),
            //products Search

         
            onSubmit: function(){                
                var addRows = _.map(this.addRows, function(num){ return _.pick(num, 'qty','branch_id','podate','product_id','refno','vendor_id')})
                axios.post('/purchases./electronic/ReceivePOStore', this.Dataload, this.totalcost)
                
                .then(response => { this.success = true;
                      })
                    .catch((error) => {
                        this.allerros = error.response.data.errors;
                        this.success = false;
                   });
                },
                
                GetPOShow: function(){
                //var showpo = this
                 axios.get("/purchases./electronic/GetPOshow/" + this.id)
                 .then(response => this.Dataload = response.data);
                 //.then(({data}) => (this.Dataload = data))
               //   .then(function(response) {
               //      Vue.set(showpo.$data, 'Dataload', response.data)
                    
               // })
             }
                              
            },
            mounted(){
                this.GetPOShow();
        
            },
    filters: {
        Upper(value) {
            return value.toUpperCase();
        },
        currency(amount) {
      const amt = Number(amount)
      return amt && amt.toLocaleString(undefined, {minimumIntegerDigits:2}) || '0'
    }
    }

    }
</script>