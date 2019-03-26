<template>
    <form method="POST" @submit.prevent="onSubmit">
    <!-- <input type="hidden" name="_token" :value="csrf"> -->
    <div class="box">
        <div class="control">
                    <h3 class="title is-4">Add New Category</h3>
                    <hr>
                </div>
        <div class="field is-grouped">
            <div class="field">
            <label class="label">Type:</label>
            <div class="control">
                <div class="block">
            <b-radio v-model="DataFrom.type"
                native-value="1"> 
                Vehicle
            </b-radio>
            <b-radio v-model="DataFrom.type"
                native-value="2">
                Electronic
            </b-radio>
        </div>
            </div>
        </div>
        <div class="field">
                <b-field label="Category Type">
            <b-select v-model="DataFrom.ctype" name="ctype">
                 <option selected disabled>Select name</option>
                <option
                    v-for="cat in categories.data"
                    :value="cat.id"
                    :key="cat.id">
                    {{ cat.category }}
                </option>
            </b-select>
        </b-field>
        </div>

        <div class="field">
            <label class="label">Category Name: 
            </label>
            <div class="control">
                <input class="input" name="category" type="text" placeholder="e.g TV, LED, Fax" v-model="DataFrom.category" @keyup="Checkname" autocomplete="off">
            </div>
            <p class="help is-success list-inline" v-if="category == 'Available'"> {{ DataFrom.category }} is available.</p>
            <p class="help is-danger" v-if="category == 'Not Available'"> {{ DataFrom.category }} {{ vendor }}</p>
        </div>
        
    </div>
    <div class="control is-flex is-pulled-right">
                    <button class="button is-primary">Add Category</button>
                </div>
</div>
</div>
</form>
</template>
<script>
    export default {
        data(){
            return {
                categories: [],
                loading: false,
                DataFrom: {
                    type: '1',
                    search:'',
                    ctype: '',
                    category: '',
                },
                category: '',
                //csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                
            }
        },
        methods: {
            Checkname() 
            {
            this.loading = true;
                var searchv = this
                axios.get('/categories./SearchCat?name=' + this.DataFrom.category)
                    .then(function(response) {
                Vue.set(searchv.$data, 'category', response.data)
                    searchv.loading = false;
                }) 
                    //.catch(error => {"erro found"});
        },
          onSubmit(){
                axios.post('/categories./CatStore', this.DataFrom)
                      .then(response => { this.success = true;
                      })
                    .catch((error) => {
                        this.allerros = error.response.data.errors;
                        this.success = false;
                   });
                }

    },
    created(){
         axios.get('/categories./GetCategories')
            .then(({data}) => (this.categories = data));
    },
}

</script>
