<template>
<form method="POST" action="/cogs./CogStoreAcc" @submit.prevent="onSubmit">
    <div class="columns" v-if="!success">
        <div class="column is-10 is-offset-1">
            <div class="box">
                <b-field grouped group-multiline>
                <div class="control">
                    <h3 class="title is-4">Add New Agent</h3>
                </div>
                </b-field>
                
                <div class="columns is-multiline">
                    <div class="column is-3">
                        <div class="field">
                            <label class="label">Company Name:
                            </label>
                            <div class="control">
                                <input class="input" v-model="AgentFrom.company" name="company" type="text" placeholder="e.g PTCL" @keyup="Availability()" autocomplete="off">
                                <span class="help is-danger">{{ allerros.company }}</span>
                            </div>
                            
                            <p class="help is-success list-inline" v-if="account == 'Available'">{{ AgentFrom.company }} Available</p>
                            <p class="help is-danger" v-if="account == 'Not Available'"> Not Available</p>
                        </div>
                    </div>
                    <div class="column is-3">
                        <div class="field">
                            <label class="label">Contact Person:</label>
                            <div class="control">
                                <input class="input" v-model="AgentFrom.person" name="person" type="text" placeholder="e.g Tair" autocomplete="off">
                                <span class="help is-danger">{{ allerros.person }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">CNIC:</label>
                            <div class="control">
                                <input class="input" v-model="AgentFrom.cnic" name="cnic" type="text" placeholder="e.g 13101-8788888-1" autocomplete="off">
                                <span class="help is-danger">{{ allerros.cnic }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Mobile:</label>
                            <div class="control">
                                <input class="input" v-model="AgentFrom.mobile" name="mobile" type="number" placeholder="e.g 923211234567" autocomplete="off">
                                <span class="help is-danger">{{ allerros.mobile }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Telephone:</label>
                            <div class="control">
                                <input class="input" v-model="AgentFrom.tel" name="tel" type="number" placeholder="e.g 92992654321" autocomplete="off">
                                <span class="help is-danger">{{ allerros.tel }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="column is-3">
                        <div class="field">
                            <label class="label">Email:</label>
                            <div class="control">
                                <input class="input" v-model="AgentFrom.email" name="email" type="email" placeholder="e.g agent@abc.com" autocomplete="off">
                                <span class="help is-danger">{{ allerros.email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-3">
                        <div class="field">
                            <label class="label">Business Address:</label>
                            <div class="control">
                                <input class="input" v-model="AgentFrom.baddress" name="baddress" type="text" placeholder="e.g Business address" autocomplete="off">
                                <span class="help is-danger">{{ allerros.baddress }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-3">
                        <div class="field">
                            <label class="label">Home Address:</label>
                            <div class="control">
                                <input class="input" v-model="AgentFrom.haddress" name="haddress" type="text" placeholder="e.g Home address" autocomplete="off">
                                <span class="help is-danger">{{ allerros.haddress }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-3">
                        <div class="field">
                            <label class="label">City:</label>
                            <div class="control">
                                <input class="input" v-model="AgentFrom.city" name="city" type="text" placeholder="e.g City" autocomplete="off">
                                <span class="help is-danger">{{ allerros.city }}</span>
                            </div>
                        </div>
                    </div>
                
                </div>
                <div class="control is-flex is-pulled-right">
                    <button class="button is-primary" v-if="account == 'Available'">Add Product</button>
                </div>
            </div>
        </div>
    </div>
    <div class="notification is-success" v-if="success">
        <h2 class="title is-2"> Agent successfully Stored! </h2>
        <br>
        <router-link class="button is-primary is-pulled-right" :to="{ name: 'agents' }"><i class="fa fa-user-plus m-r-10"></i>Click to Back Agents</router-link>
    </div>
</form>
</template>
<script>

    export default {
        props: ['data'], 
        data(){
            return {
                success : false,   
                allerros: [],
                account: '',
                status: '',
                loading: false,
                AgentFrom: {
                    company: '',
                    person: '',
                    cnic: '',
                    mobile: '',
                    tel: '',
                    haddress: '',
                    city: '',
                    email: '',
                    baddress:'',
                    
                }
                //csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                
            }
        },
        methods: {
            Availability() {
                this.loading = true;
                    var searchv = this
                    axios.get('/agents./CheckCompany?company=' + this.AgentFrom.company)
                    .then(function(response) {
                    Vue.set(searchv.$data, 'account', response.data)
                    searchv.loading = false;
                        })
                    //.catch(`error` => {"erro found"});
            },
            onSubmit(){
                axios.post('/agents./AgentStore', this.AgentFrom)
                      .then(response => { this.success = true;
                      })
                    .catch((error) => {
                        this.allerros = error.response.data.errors;
                        this.success = false;
                   });
                     this.loadAgents();
                }
        },
    
}

</script>
