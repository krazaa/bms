<template>
<!-- <form method="POST" action="/agents./AgentUpdate/{AgentForm.id}" @submit.prevent="onSubmit"> -->
<form>
    <div class="columns" v-if="!success">
        <div class="column is-10 is-offset-1">
            <div class="box">
                <b-field grouped group-multiline>
                <div class="control">
                    <h3 class="title is-4">Add Edit Bank</h3>
                </div>
                </b-field>
                    <input class="input" v-model="DataFrom.agentid" name="id" type="hidden">            
                <div class="columns is-multiline">
                    <div class="column is-4">
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
                                <input class="input" v-model="DataFrom.account" name="account" type="text" placeholder="e.g 830158" @keyup="Availability()" autocomplete="off">
                                <span class="help is-danger">{{ allerros.account }}</span>
                            </div>
                            
                            <p class="help is-success list-inline" v-if="account == 'Available'">{{ DataFrom.account }} Available</p>
                            <p class="help is-danger" v-if="account == 'Not Available'"> Not Available</p>
                        </div>
                    </div>
                    <div class="column is-4">
                        <div class="field">
                            <label class="label">IBAN No:</label>
                            <div class="control">
                                <input class="input" v-model="DataFrom.iban" name="iban" type="text" placeholder="e.g KZ750902L8R3Y6P5PP0N" autocomplete="off">
                                <span class="help is-danger">{{ allerros.iban }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="column is-4">
                        <div class="field">
                            <label class="label">Branch Code:</label>
                            <div class="control">
                                <input class="input" v-model="DataFrom.branchcode" name="branchcode" type="text" placeholder="e.g DQMPFCI4" autocomplete="off">
                                <span class="help is-danger">{{ allerros.branchcode }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-4">
                        <div class="field">
                            <label class="label">Telephone:</label>
                            <div class="control">
                                <input class="input" v-model="DataFrom.phone" name="phone" type="text" placeholder="e.g 92992654321" autocomplete="off">
                                <span class="help is-danger">{{ allerros.phone }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-4">
                        <div class="field">
                            <label class="label">Mobile:</label>
                            <div class="control">
                                <input class="input" v-model="DataFrom.mobile" name="mobile" type="text" placeholder="e.g 92992654000" autocomplete="off">
                                <span class="help is-danger">{{ allerros.mobile }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-6">
                        <div class="field">
                            <label class="label">City:</label>
                            <div class="control">
                                <input class="input" v-model="DataFrom.city" name="city" type="text" placeholder="e.g City" autocomplete="off">
                                <span class="help is-danger">{{ allerros.city }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-6">
                        <div class="field">
                            <label class="label">Address:</label>
                            <div class="control">
                                <input class="input" v-model="DataFrom.address" name="address" type="text" placeholder="e.g Bank address" autocomplete="off">
                                <span class="help is-danger">{{ allerros.address }}</span>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="control is-flex is-pulled-right">
                    <button class="button is-primary" @click="onSubmit">Update Bank</button>
                </div>
            </div>
        </div>
    </div>
    <div class="notification is-success" v-if="success">
        <h2 class="title is-2"> Bank successfully Stored! </h2>
        <br>
        <router-link class="button is-primary is-pulled-right" :to="{ name: 'banks' }"><i class="fa fa-user-plus m-r-10"></i>Click to Back Banks</router-link>
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
                loading: false,
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
                axios.get('/banks./BankEdit/' + this.id)
                    .then(response => {
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
