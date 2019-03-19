<template>
    <form method="POST" action="/vendors./VendorStore">
    <input type="hidden" name="_token" :value="csrf">
    <div class="box">
        <div class="control">
                    <h3 class="title is-4">Add New Category</h3>
                    <hr>
                </div>
        <div class="field is-grouped">

        <div class="field is-expanded">
            <label class="label">Category Name: 
            </label>
            <div class="control">
                <input class="input" name="category" type="text" placeholder="e.g TV, LED, Fax" v-model="search" @keyup="Checkname" autocomplete="off">
            </div>
            <p class="help is-success list-inline" v-if="category == 'Available'"> {{ search }} is available.</p>
            <p class="help is-danger" v-if="category == 'Not Available'"> {{ search }} {{ vendor }}</p>
        </div>
         

        
    </div>
  
    
    <div class="control is-flex is-pulled-right">
                    <button class="button is-primary">Add Vendor</button>
                </div>
</div>
</div>
</form>
</template>
<script>
    export default {
        data(){
            return {
                category: '',
                search:'',
                errors:'',
                loading: false,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                
            }
        },
        methods: {
            Checkname() 
            {
            this.loading = true;
                var searchv = this
                axios.get('/categories./SearchCat?name=' + this.search)
                .then(function(response) {
                Vue.set(searchv.$data, 'category', response.data)
                searchv.loading = false;
                }).catch(error => {"erro found"});
        },
    }
}

</script>
