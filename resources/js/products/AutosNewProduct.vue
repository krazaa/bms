<template>
<div class="columns is-multiline">
  <div class="column is-12">
    <div class="box">
        <b-field grouped group-multiline>
         <div class="control">
                <h3 class="title is-4">Add New Product</h3>   
            </div>
    </b-field>
<div class="field is-grouped">
    <div class="field">
        <label class="label">Product Code:</label>
            <div class="control">
                <input class="input" type="text" placeholder="e.g B18123456">
            </div>
    </div>

    <div class="field is-expanded">
        <label class="label">Product Name:</label>
            <div class="control is-expanded">
                <input class="input" type="text" placeholder="e.g Honda 125">
            </div>
    </div>
    <div class="field">
        <label class="label">Short Name:</label>
            <div class="control">
                <input class="input" type="text" placeholder="e.g Euro 125 CC">
            </div>
    </div>
    </div>
    <div class="field is-grouped">
    <div class="field">
        <label class="label">Select Vendor:</label>
            <div class="control">
                <div class="select">
    <select>
      <option>Select Option</option>
      
    </select>
  </div>
            </div>
    </div>
     <div class="field">
        <label class="label">Color:</label>
            <div class="control">
                <input class="input" type="text" placeholder="e.g Red">
            </div>
    </div>
    <div class="field">
        <label class="label">Engine:</label>
            <div class="control">
                <input class="input" type="text" placeholder="e.g 2672">
            </div>
    </div>
    <div class="field">
        <label class="label">Chassis:</label>
            <div class="control">
                <input class="input" type="text" placeholder="e.g EX-123-A">
            </div>
    </div>
    </div>
    <div class="field is-grouped">
    <div class="field">
        <label class="label">Cost Price:</label>
            <div class="control">
                <input class="input" type="text" placeholder="e.g 50,000">
            </div>
            
    </div>
    <div class="field">
        <label class="label">Selling Price:</label>
            <div class="control">
                <input class="input" type="text" placeholder="e.g 55,000">
            </div>
    </div>
    
    </div>
    <div class="control is-flex is-pulled-right">
             <button class="button is-primary">Add Product</button>
        </div>
    </div>
  </div>
</div>
</template>

<script>
    export default {
        props: ['productid'], 
        data(){
            return {
                
                product: [],
                loading: false
               
            }
        },
        mounted(){
        axios.get('/products/autos/ShowSingle/' + this.productid)
        .then((response)=> this.product = this.temp = response.data)
        //.catch((error) => this.errors = error.response.data.errors)
        console.log(this.productid)
    },
    }
</script>