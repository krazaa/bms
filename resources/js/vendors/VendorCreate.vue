<template>
    <form method="POST" action="/vendors./VendorStore">
    <input type="hidden" name="_token" :value="csrf">
    <div class="box">
        <div class="control">
                    <h3 class="title is-4">Add New Vendor</h3>
                    <hr>
                </div>
        <div class="field is-grouped">
            <div class="field is-expanded">
            <label class="label">Vendor Code: 
            </label>
            <div class="control">
                <input class="input" name="vnum" type="text" placeholder="e.g B18123456">
            </div>
        </div>

        <div class="field is-expanded">
            <label class="label">Company Name: 
            </label>
            <div class="control">
                <input class="input" name="company" type="text" placeholder="e.g Team Xperts" v-model="search" @keyup="GetVendor" autocomplete="off">
            </div>
            <p class="help is-success list-inline" v-if="vendor == 'Available'"> {{ search }} is available.</p>
            <p class="help is-danger" v-if="vendor == 'Not Available'"> {{ search }} {{ vendor }}</p>
        </div>
        <div class="field is-expanded">
            <label class="label">Contact Person: 
            </label>
            <div class="control">
                <input class="input" name="person" type="text" placeholder="e.g Person name">
            </div>
        </div>

        <div class="field is-expanded">
            <label class="label">Telephone: </label>
            <div class="control">
                <input class="input" name="contact" type="text" placeholder="e.g Telephone no">
            </div>
        </div>
    </div>
    <div class="field is-grouped">
        <div class="field is-expanded">
            <label class="label">Mobile:</label>
            <div class="control">
                <input class="input" name="mobile" type="text" placeholder="e.g 923219802672">
            </div>
        </div>
        <div class="field is-expanded">
            <label class="label">Another mobile:</label>
            <div class="control">
                <input class="input" name="bmobile" type="text" placeholder="e.g 923219802672">
            </div>
        </div>
        <div class="field is-expanded">
            <label class="label">Address:</label>
            <div class="control">
                <input class="input" name="address" type="text" placeholder="e.g your address">
            </div>
        </div>
        <div class="field is-expanded">
            <label class="label">Email:</label>
            <div class="control">
                <input class="input" name="email" type="text" placeholder="e.g vendor@gmail.com">
            </div>
        </div>
    </div>
    <div class="field is-grouped">
        <div class="field is-expanded">
            <label class="label">Website:</label>
            <div class="control">
                <input class="input" name="website" type="text" placeholder="e.g www.example.com">
            </div>
        </div>
        <div class="field is-expanded">
            <label class="label">NTN No:</label>
            <div class="control">
                <input class="input" name="ntn" type="text" placeholder="e.g NTN 445566">
            </div>
        </div>
        <div class="field is-expanded">
            <label class="label">Sales Tax No:</label>
            <div class="control">
                <input class="input" name="salestax" type="text" placeholder="e.g ST-33-4454533-345">
            </div>
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
                vendor: '',
                search:'',
                errors:'',
                loading: false,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                
            }
        },
        methods: {
            GetVendor() 
            {
            this.loading = true;
                var searchv = this
                axios.get('/vendors./SearchVendor?company=' + this.search)
                .then(function(response) {
                Vue.set(searchv.$data, 'vendor', response.data)
                searchv.loading = false;
                }).catch(error => {"erro found"});
        },
    }
}

</script>
