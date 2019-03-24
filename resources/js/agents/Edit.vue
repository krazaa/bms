<template>
<div class="box">
    <div v-if="isLoading">
        <b-loading :active.sync="isLoading" :can-cancel="true"></b-loading>
    </div>
    <div v-if="!isLoading">
        <form @submit.prevent="updateItem(AgentFrom.id)">
            <div class="columns" v-if="!success">
                <div class="column is-10 is-offset-1">
                    <div class="box">
                        <b-field grouped group-multiline>
                        <div class="control">
                            <h3 class="title is-4">Add Edit Agent</h3>
                        </div>
                        </b-field>
                        <input class="input" v-model="AgentFrom.agentid" name="id" type="hidden">
                        <div class="columns is-multiline">
                            <div class="column is-4">
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
                            <div class="column is-4">
                                <div class="field">
                                    <label class="label">Contact Person:</label>
                                    <div class="control">
                                        <input class="input" v-model="AgentFrom.person" name="person" type="text" placeholder="e.g Tair" autocomplete="off">
                                        <span class="help is-danger">{{ allerros.person }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-4">
                                <div class="field">
                                    <label class="label">CNIC:</label>
                                    <div class="control">
                                        <input class="input" v-model="AgentFrom.cnic" name="cnic" type="text" placeholder="e.g 13101-1122300-1" autocomplete="off">
                                        <span class="help is-danger">{{ allerros.cnic }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="column is-4">
                                <div class="field">
                                    <label class="label">Mobile:</label>
                                    <div class="control">
                                        <input class="input" v-model="AgentFrom.mobile" name="mobile" type="number" placeholder="e.g 923211234567" autocomplete="off">
                                        <span class="help is-danger">{{ allerros.mobile }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-4">
                                <div class="field">
                                    <label class="label">Telephone:</label>
                                    <div class="control">
                                        <input class="input" v-model="AgentFrom.tel" name="tel" type="number" placeholder="e.g 92992654321" autocomplete="off">
                                        <span class="help is-danger">{{ allerros.tel }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-4">
                                <div class="field">
                                    <label class="label">Email:</label>
                                    <div class="control">
                                        <input class="input" v-model="AgentFrom.email" name="email" type="email" placeholder="e.g agent@abc.com" autocomplete="off">
                                        <span class="help is-danger">{{ allerros.email }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-6">
                                <div class="field">
                                    <label class="label">Business Address:</label>
                                    <div class="control">
                                        <input class="input" v-model="AgentFrom.baddress" name="baddress" type="text" placeholder="e.g Business address" autocomplete="off">
                                        <span class="help is-danger">{{ allerros.baddress }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-6">
                                <div class="field">
                                    <label class="label">Home Address:</label>
                                    <div class="control">
                                        <input class="input" v-model="AgentFrom.haddress" name="haddress" type="text" placeholder="e.g Home address" autocomplete="off">
                                        <span class="help is-danger">{{ allerros.haddress }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="control is-flex is-pulled-right">
                            <button class="button is-primary">Update Agent</button>
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
    </div>
</div>
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
                fillItem: this.record,
                AgentFrom: {
                    agentid: '',
                    company: '',
                    person: '',
                    cnic: '',
                    mobile: '',
                    tel: '',
                    email: '',
                    baddress:'',   
                    haddress: '',
                }
                
            }
        },
        methods: {
                AgentEdit(){
                axios.get('/agents./AgentEdit/' + this.id)
                    .then(response => {this.AgentFrom = response.data }) 
            },
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
                axios.post(`/agents./AgentUpdate/${this.$route.params.id}`, +this.AgentFrom)
                      .then(response => { this.success = true;
                      })
                    .catch((error) => {
                        this.allerros = error.response.data.errors;
                        this.success = false;
                   });
                },
                    updateItem: function(id){
                    // console.log('u')
                    //alert('clicked');
        
                    var input = this.AgentFrom;
                    console.log(this.AgentFrom);
                    return;
                    axios.patch('/agents./AgentUpdate' + id,{
                    params: input
                    }).then(function (response) {
                    alert('Item Updated Successfully.');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                }
                // updateForm: function(){
                //     var form = document.querySelector('form');
                //     var formdata = new FormData(form);
                //     axios.post(`/agents./AgentUpdate/${this.$route.params.id}`, +this.$route.params.id, formdata).then((response) =>{
                //         this.$router.push({path: '/', query: {alert: response.message}})
                //     },(response) => {
                //         console.log('error callback')
                //     }
                //     );
                // }
            },
        mounted(){
            this.AgentEdit();  
        },    
}

</script>
