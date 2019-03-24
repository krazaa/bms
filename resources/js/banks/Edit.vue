<template>
<!-- <form method="POST" action="/agents./AgentUpdate/{AgentForm.id}" @submit.prevent="onSubmit"> -->
<form>
    <div class="columns" v-if="!success">
        <div class="column is-10 is-offset-1">
             <div class="box">
                 <div v-if="isLoading">
                    <b-loading :active.sync="isLoading" :can-cancel="true"></b-loading>
                </div>
                <div v-if="!isLoading">
                <div class="columns is-multiline">
                    <div class="column is-4"><h3 class="title is-4">Update Bank</h3></div>
                    <div class="column is-8">
                        <nav class="breadcrumb is-right" aria-label="breadcrumbs">
                            <ul>
                                <li>
                                    <span class="icon is-small">
                                        <i class="mdi mdi-home" aria-hidden="true"></i>
                                    </span>
                                    <router-link to="/dashboard"><span>Home</span></router-link>
                                </li>
                                <li>
                                    <span class="icon is-small">
                                        <i class="mdi mdi-bank" aria-hidden="true"></i>
                                    </span>
                                    <router-link :to="{ name: 'banks' }"><span>Banks</span></router-link>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="columns is-multiline">
                    <div class="column is-2">
                        <div class="field">
                            <b-field label="Branch Code:">
                            <b-input
                            v-model="DataFrom.branchcode"
                            name="branchcode"
                            minlength="3"
                            maxlength="6"
                            placeholder="Code">
                            </b-input>
                            </b-field>
                            <span class="help is-danger">{{ allerros.branchcode }}</span>
                            
                        </div>
                    </div>
                    <div class="column is-3">
                        <div class="field">
                            <label class="label">Bank Name:</label>
                            <div class="control">
                                <input class="input" v-model="DataFrom.bank" name="bank" type="text" placeholder="e.g National Bank of Pakistan" autocomplete="off">
                                <span class="help is-danger">{{ allerros.bank }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-4">
                        <div class="field">
                            <label class="label">Account No:
                            </label>
                            <div class="control">
                                <input class="input" v-model="DataFrom.account" name="account" type="text" placeholder="e.g 345345-3" @keyup="Availability()" autocomplete="off">
                                <span class="help is-danger">{{ allerros.account }}</span>
                            </div>
                            
                            <p class="help is-success list-inline" v-if="account == 'Available'">{{ DataFrom.account }} Available</p>
                            <p class="help is-danger" v-if="account == 'Not Available'"> Not Available</p>
                        </div>
                    </div>
                    <div class="column is-3">
                        <div class="field">
                            <label class="label">IBAN No:</label>
                            <div class="control">
                                <input class="input" v-model="DataFrom.iban" name="iban" type="text" placeholder="e.g NA-87888881" autocomplete="off">
                                <span class="help is-danger">{{ allerros.iban }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Telephone:</label>
                            <div class="control">
                                <input class="input" v-model="DataFrom.phone" name="phone" type="number" placeholder="e.g 92992654321" autocomplete="off">
                                <span class="help is-danger">{{ allerros.phone }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Mobile:</label>
                            <div class="control">
                                <input class="input" v-model="DataFrom.mobile" name="mobile" type="number" placeholder="e.g 923001234567" autocomplete="off">
                                <span class="help is-danger">{{ allerros.mobile }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">City:</label>
                            <div class="control">
                                <input class="input" v-model="DataFrom.city" name="city" type="text" placeholder="e.g City" autocomplete="off">
                                <span class="help is-danger">{{ allerros.city }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-3">
                        <div class="field">
                            <label class="label">Address:</label>
                            <div class="control">
                                <input class="input" v-model="DataFrom.address" name="address" type="text" placeholder="e.g Address" autocomplete="off">
                                <span class="help is-danger">{{ allerros.address }}</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="control is-flex is-pulled-right">
                    <button class="button is-primary" v-if="account == 'Available'">Update Bank</button>
                </div>
            </div>
        </div>
    </div>
    <div class="notification is-success" v-if="success">
        <h2 class="title is-2"> Bank successfully Stored! </h2>
        <br>
        <router-link class="button is-primary is-pulled-right" :to="{ name: 'banks' }"><i class="fa fa-user-plus m-r-10"></i>Click to Back Banks</router-link>
    </div>
</div>
</form>
</template>
<script>

    export default {
        props: ['id'], 
        data(){
            return {
                success : false,   
                allerros: [],
                account: '',
                status: '',
                isLoading: false,
                DataFrom: {
                    bank: '',
                    account: '',
                    iban: '',
                    branchcode: '',
                    phone: '',
                    address: '',
                    city: '',
                    mobile:'',
                }
                
            }
        },
        methods: {
                BankEdit(){
                    this.isLoading = true
                axios.get('/banks./BankEdit/' + this.id)
                    .then(response => {
                        this.isLoading = false
                  this.DataFrom = response.data;
                  });
            },
            Availability() {
                this.loading = true;
                    var searchv = this
                    axios.get('/banks./CheckAccount?account=' + this.DataFrom.account)
                    .then(function(response) {
                    Vue.set(searchv.$data, 'account', response.data)
                    searchv.loading = false;
                        })
                    //.catch(`error` => {"erro found"});
            },
            onSubmit(){
                axios.put('/banks./BankUpdate/', this.$route.params.DataFrom, this.DataFrom)
                      .then(response => { this.success = true;
                      })
                    .catch((error) => {
                        this.allerros = error.response.data.errors;
                        this.success = false;
                   });
                }
            },
        mounted(){
        this.BankEdit();  
        
        },    
}

</script>
