<template>
    <form class="form-horizontal" method="POST" :action="`/settings./branches/branchupdate/${branch.id}`">
    <input type="hidden" name="_token" :value="csrf">
    <div class="columns is-multiline">
        <div class="column is-12">
            <div class="box">
                <b-field grouped group-multiline>
                <div class="control">
                    <h3 class="title is-4">Edit Branch</h3>
                </div>
                </b-field>
                <div class="field is-grouped">
                    <div class="field">
                        <label class="label">Branch Name:</label>
                        <div class="control">
                            <input class="input" name="name" :value="branch.name" type="text" placeholder="Branch Name">
                        </div>
                    </div>
                    <div class="field is-expanded">
                        <label class="label">Address:</label>
                        <div class="control is-expanded">
                            <input class="input" :value="branch.address" name="address" type="text" placeholder="Address">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Email:</label>
                        <div class="control">
                            <input class="input" :value="branch.email" name="email" type="text" placeholder="example@pmb.com.pk">
                        </div>
                    </div>
                </div>
                <div class="field is-grouped">
                    <div class="field">
                        <label class="label">Telephone:</label>
                        <div class="control">
                            <input class="input" :value="branch.contact" name="contact" type="text" placeholder="0992-123456">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Mobile:</label>
                        <div class="control">
                            <input class="input" :value="branch.mobile" name="mobile" type="text" placeholder="e.g 923219802672">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">City:</label>
                        <div class="control">
                            <input class="input" :value="branch.city" name="city" type="text" placeholder="e.g Abbottabad">
                        </div>
                    </div>
                    
                </div>
                <div class="control is-flex is-pulled-right">
                    <button class="button is-primary">Update Branch</button>
                </div>
            </div>
        </div>
    </div>
</form>
</template>
<script>
    export default {
        props: ['branchid'],  
        data(){
            return {
                
                branch: [],
                vendors: [],
                loading: false,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
               
            }
        },
        mounted(){
        axios.get('/settings./branches/ShowSingle/' + this.branchid)
        .then((response)=> this.branch = this.temp = response.data)
        //.catch((error) => this.errors = error.response.data.errors)
        console.log(this.productid)
        axios.get('/vendors./GetVendors/')
        .then((response)=> this.vendors = this.temp = response.data)
        .catch((error) => this.errors = error.response.data.errors)
    },
    }
</script>