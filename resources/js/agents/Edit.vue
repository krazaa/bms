<template>
<form method="POST" action="/agents./AgentUpdate/{AgentForm.id}" @submit.prevent="onSubmit(AgentFrom.id)">
    <div class="columns" v-if="!success">
        <div class="column is-10 is-offset-1">
            <div class="box">
                <b-field grouped group-multiline>
                <div class="control">
                    <h3 class="title is-4">Add Edit Agent</h3>
                </div>
                </b-field>
                
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
                            <label class="label">Contact Person 2:</label>
                            <div class="control">
                                <input class="input" v-model="AgentFrom.person2" name="person2" type="text" placeholder="e.g Zia" autocomplete="off">
                                <span class="help is-danger">{{ allerros.person2 }}</span>
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
                            <label class="label">Mobile:</label>
                            <div class="control">
                                <input class="input" v-model="AgentFrom.tel2" name="tel2" type="number" placeholder="e.g 92992654321" autocomplete="off">
                                <span class="help is-danger">{{ allerros.tel2 }}</span>
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
                    <div class="column is-12">
                        <div class="field">
                            <div class="control">
                               <b-field label="Address:">
                                <b-input type="textarea" v-model="AgentFrom.address" name="address" placeholder="Address"></b-input>
                                </b-field>
                                <span class="help is-danger">{{ allerros.address }}</span>
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
        props: ['id'], 
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
                    person2: '',
                    mobile: '',
                    tel: '',
                    tel2: '',
                    email: '',
                    address:'',   
                }
                
            }
        },
        methods: {
                AgentEdit(){
                axios.get('/agents./AgentEdit/' + this.id)
                    .then(response => {
                  this.AgentFrom = response.data;
                  });
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
            onSubmit(id){
                axios.post('/agents./AgentUpdate/', + id, + this.AgentFrom)
                      .then(response => { this.success = true;
                      })
                    .catch((error) => {
                        this.allerros = error.response.data.errors;
                        this.success = false;
                   });
                }
            },
        mounted(){
        this.AgentEdit();  
        
        },    
}

</script>
