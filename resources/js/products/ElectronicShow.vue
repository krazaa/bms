<template>
<div class="box">
    <div class="columns">
        <div class="column is-8 is-offset-2">
            <nav class="level bd-structure-item bd-is-structure-container" title="level">
                <div class="level-left bd-structure-item" title="level-left">
                    <div class="level-item">
                        <p class="subtitle is-5">
                            <strong>Product Information</strong>
                        </p>
                    </div>
                    <div class="level-item">
                    </div>
                </div>
                <div class="level-right bd-structure-item" title="level-right">
                    <p class="level-item">
                        <router-link class="button is-primary is-small" :to="{ name: 'electronic'}">
                        Back to Products
                        </router-link>
                    </p>
                </div>
            </nav>
            <div class="box">
                <div class="columns is-multiline">
                    <div class="column is-4">
                        <div class="field is-horizontal">
                            <label class="label">Product Name: </label>
                        </div>
                    </div>
                    <div class="column is-8">
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
                    <div class="column is-8">
                        <div class="field is-horizontal">
                            <label class="label">{{ product.company }} </label>
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
                            <label class="label"> </label>
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
</div>
</template>
<script>
    export default {
        props: ['id'], 
        data(){
            return {
                product: [],
                loading: false
               
            }
        },
        mounted(){
        axios.get('/products./electronic/ShowSingle/' + this.id)
        .then((response)=> this.product = this.temp = response.data)
        //.catch((error) => this.errors = error.response.data.errors)
        console.log(this.id)
    },
    }
</script>