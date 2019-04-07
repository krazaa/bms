<template>

    <div class="columns">
        <div class="column is-12 ">
            <nav class="level bd-structure-item bd-is-structure-container" title="level">
                <div class="level-left bd-structure-item" title="level-left">
                    <div class="level-item">
                        <p class="subtitle is-5">
                            <strong>Purchase Order</strong>
                        </p>
                    </div>
                    <div class="level-item">{{ poe[0].company }}
                    </div>
                </div>

                <div class="level-right bd-structure-item" title="level-right">
                    <p class="level-item">
                        <a :href="`/purchases./electronic/GetPOshowPDF/${poe[0].poid}`" target="_blank" class="button is-light is-small"><i class="mdi mdi-printer has-text-weight-semibold"> Print</i>
                        </a> 
                    </p>
                        <p class="level-item">
                        <router-link class="button is-primary is-small" :to="{ name: 'poELists'}">
                        Back to POs
                        </router-link>
                    </p>
                </div>
            </nav>
            <div class="box">
                <div class="columns notification">
                          <div class="column is-one-third">Vendor Name:<strong> {{ poe[0].company }}</strong>
                            <br>Address: {{ poe[0].address }}
                            <br>Phone: {{ poe[0].contact }}
                            <br>Mobile: {{ poe[0].mobile }}
                           </div>
                           <div class="column is-one-third"></div>
                           <div class="column is-one-third">
                            PO ID: <strong>{{ poe[0].poid }}</strong>  
                            <br>Reference No: {{ poe[0].refno }}  
                            <br>Date: <strong>{{ poe[0].podate | formatDate }}</strong>
                         </div>
                          
                    </div>
                    
                    
                </div>
                
            <div class="box">
                <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                    <thead>
                        <th class="has-text-centered">#</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th class="has-text-centered">Qty</th>
                        <th>Branch</th>
                        
                    </thead>
                    <tbody>
                        <tr v-for="(po, key) in poe">
                            <td class="has-text-centered">{{ key+1 }}</td>
                            <td>{{ po.code }}</td>
                            <td>{{ po.name }}</td>
                            <td>{{ po.category }} <i class="mdi mdi-arrow-right has-text-weight-semibold" v-if="po.subcat != empty">{{ po.subcat }}</i></td>
                            <td class="has-text-centered">{{ po.qty }}</td>
                            <td>{{ po.branch }}</td>
                        </tr>
                    </tbody>
                </table>     
            </div>
            </div>
        </div>
    </div>

</template>
<script>
    export default {
        props: ['id'], 
            data(){
            return {
                poe: [],
                loading:''
                }
        },
         methods: {  
             loadData(){
              axios.get("/purchases./electronic/GetPOshow/" + this.id).then(({data}) => (this.poe = data));
            },
        },
        mounted(){
              this.loadData();  
        }
    }
</script>