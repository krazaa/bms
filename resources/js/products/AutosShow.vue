<template>
<div class="box">
    <div class="columns">
        <div class="column is-6 is-offset-3">
        <b-field grouped group-multiline>
        <div class="control is-flex">
            <h3 class="title is-4">Product Information</h3>
        </div>
        </b-field>
        <p class="level-item">
            <span class="is-pulled-right" v-if="loading">
                <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i>
            </span>
        </p>
        <div class="box">
            <div class="columns is-multiline">
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">Product Code: </label>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">{{ product.name }} </label>
                    </div>
                </div>
            </div>

            <div class="columns is-multiline">
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">Product Code: </label>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">{{ product.code }} </label>
                    </div>
                </div>
            </div>

            <div class="columns is-multiline">
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">Preffered Vendor:</label>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">{{ product.vendor_id }} </label>
                    </div>
                </div>
            </div>

            <div class="columns is-multiline">
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">Model:</label>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">{{ product.model }} </label>
                    </div>
                </div>
            </div>

            <div class="columns is-multiline">
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">Short Name:</label>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">{{ product.shortname }} </label>
                    </div>
                </div>
             </div>
                
                            <div class="columns is-multiline">
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">Re - Oder Quantity::</label>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">{{ product.reorder }} </label>
                    </div>
                </div>
             </div>

                         <div class="columns is-multiline">
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">Maximum Quantity:</label>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">{{ product.maxqty }} </label>
                    </div>
                </div>
             </div>

                         <div class="columns is-multiline">
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">Cost Price:</label>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">{{ product.cost }} </label>
                    </div>
                </div>
             </div>

                 <div class="columns is-multiline">
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">Cash Discount:</label>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">{{ product.cost }} </label>
                    </div>
                </div>
             </div>

              <div class="columns is-multiline">
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">Whole Sale Price:</label>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">{{ product.wsaleprice }} </label>
                    </div>
                </div>
             </div>

             <div class="columns is-multiline">
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">Discount Allowed:</label>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">{{ product.discountallowed }} </label>
                    </div>
                </div>
             </div>

             <div class="columns is-multiline">
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">Sale Price:</label>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field is-horizontal">
                        <label class="label">{{ product.saleprice }} </label>
                    </div>
                </div>
             </div>



        </div>
    </div>
</div>

       
        
        
        <hr>
        
    </div>
</div>
</template>
<script>
    export default {
        props: ['id'], 
        data(){
            return {
                product: []
                 
                }
        },
        mounted(){

              this.loadData();  
        },
         methods: {  
             loadData(){
              this.loading = true
              axios.get("/products./autos/ShowSingle/" + this.id).then(({data}) => (this.product = data));
              this.loading = false
            },
        }
    }
</script>