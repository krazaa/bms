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
                    <b-field label="PO Number:">
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
                <td><strong>Cargo P/U</strong></td>
                <td><strong>Cost:</strong></td>
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
                <td>{{ stockg = dload.qty * dload.cost | currency }}</td> 
                <td>{{ totalcargo = (dload.qty * dload.cost / totalSumm) * cargopo | currency }} 
                    <input type="hidden" v-model.number="dload.cargoStore = totalcargo" class="input">
                </td>
                <td width="120px">{{ cpu= (cargopo / dload.qty) | currency }}</td>
                <td>{{ costprice = (cpu + dload.cost) | currency }}</td>
                <td><input name="profit1" type="number" class="input" v-model.number="dload.profit"></td>
                <td width="120px"><input type="hidden" v-model.number="dload.salPrice = costprice + dload.profit" class="input">
                {{ costprice + dload.profit | currency }} </td> 
                <td><input type="hidden" v-model.number="dload.wolSale = costprice + dload.profit2" class="input">
                    <input name="profit12" type="number" class="input" v-model.number="dload.profit2"></td>
                <td>{{ costprice + dload.profit2 | currency }}</td>
                <input name="taxpage" type="hidden" class="input" v-model.number="dload.tax = paytax">
                <input name="taxpage" type="hidden" class="input" v-model.number="dload.cargopo = cargopo">
                <input name="taxpage" type="hidden" class="input" v-model.number="dload.cgt = Gtotal">
                
            </tr>
        </tbody>
        <tfoot>
            
             <tr>
               <td colspan="8"></td>
               <td><b>Income Tax:</b></td>
               <td><b>{{ paytax = (taxpay / 100) * totalSumm }} Rs.  </b></td>
               <td><input name="taxpage" type="text" class="input" v-model.number="taxpay">
                
               </td>
               <td></td>
            </tr>
            <tr>
                <td colspan="9"></td>
                <td ><b>Cargo Charges</b></td> 
                <td>
                <input name="cargo" type="number" class="input" v-model.number="cargopo">
            </td>
            </tr>
            <tr>
                <td colspan="9"></td>
                <td width="190px"><b>Total without Cargo:</b></td> 
                <td><b>{{ totalSumm }} Rs.</b></td>
            </tr>
            <tr>
                <td colspan="9"></td>
                <td><b>Total Payable</b></td> 
                <td><b>{{ Gtotal }} Rs.</b>
                    
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

        //PO final seting
            pocost:'',
            cargopo:'',
            wholesalepo:'',
            profit:'',
            profit2:'',
            cargoStore:'',
            salPrice:'',
            wolSale:'',
            tax:'',
            paytax:'',



                Dataload: {
                    dno:'',
                    branch_id:'',
                    stinv:'',
                    ddate:'',
                    rdate:'',
                    duedate:'',
                    qty:'',
                    cost:'',
                    paycargo:'',
                    cargopo:'',
                    cgt:'',

                   postwsp:'',
                   stockg:'',
                   totalcost:'',

                   

                    
                },
                profit:'',
                taxpay:'',
                
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
         methods: {
            
            onSubmit: function(){                
                var addRows = _.map(this.addRows, function(num){ return _.pick(num, 'qty','branch_id','podate','product_id','refno','vendor_id')})
                axios.post('/purchases./electronic/ReceivePOStore', this.Dataload, this.totalcost)
                
                .then(response => { this.success = true;
                      })
                    .catch((error) => {
                        this.allerros = error.response.data.errors;
                        this.success = false;
                   });
                }

            },
 
        computed: {
            CargoAll: function() {
            return this.Dataload.reduce(function(total, dload) {
            return total = parseInt(dload.qty) * parseInt(dload.cost);
          },0);
            },
           totalSumm: function(){
              return this.Dataload.reduce(function(total, dload){
                return total + (dload.qty * dload.cost); 
              },0);
            },

            Gtotal: function(){
                let total = 0;
                return total + (this.totalSumm) + (this.cargopo)
              },            
          
/////////////////////////////////////
                     
            },
            mounted(){
                //this.GetPOShow();

                axios.get("/purchases./electronic/GetPOshow/" + this.id)
                 .then(response => this.Dataload = response.data);
        
            },
    filters: {
      
    currency(amount) {
      const amt = Number(amount)
      return amt && amt.toLocaleString(undefined, {minimumIntegerDigits:2}) || '0'
        }
    }

    }
</script>