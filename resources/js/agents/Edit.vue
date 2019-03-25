<template>
<div class="box">
    <div v-if="isLoading">
        <b-loading :active.sync="isLoading" :can-cancel="true"></b-loading>
    </div>
    <div v-if="!isLoading">
        <form @submit.prevent="updateSignal(agents.id)">
            <div class="columns" v-if="!success">
                <div class="column is-10 is-offset-1">
                    <div class="box">
                       <div class="columns is-multiline">
                    <div class="column is-4"><h3 class="title is-4">Update Agent</h3></div>
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
                                        <i class="mdi mdi-face-agent" aria-hidden="true"></i>
                                    </span>
                                    <router-link :to="{ name: 'agents' }"><span>Agents</span></router-link>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                        
                        <div class="columns is-multiline">
                            <div class="column is-3">
                                <div class="field">
                                    <label class="label">Company Name:
                                    </label>
                                    <div class="control">
                                        <input class="input" v-model="agents.company" name="company" type="text" placeholder="e.g PTCL" autocomplete="off">
                                        <span class="help is-danger">{{ allerros.company }}</span>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="column is-3">
                                <div class="field">
                                    <label class="label">Contact Person:</label>
                                    <div class="control">
                                        <input class="input" v-model="agents.person" name="person" type="text" placeholder="e.g Tair" autocomplete="off">
                                        <span class="help is-danger">{{ allerros.person }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-2">
                                <div class="field">
                                    <label class="label">CNIC:</label>
                                    <div class="control">
                                        <input class="input" v-model="agents.cnic" name="cnic" type="text" placeholder="e.g 13101-1122300-1" autocomplete="off">
                                        <span class="help is-danger">{{ allerros.cnic }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="column is-2">
                                <div class="field">
                                    <label class="label">Mobile:</label>
                                    <div class="control">
                                        <input class="input" v-model="agents.mobile" name="mobile" type="number" placeholder="e.g 923211234567" autocomplete="off">
                                        <span class="help is-danger">{{ allerros.mobile }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-2">
                                <div class="field">
                                    <label class="label">Telephone:</label>
                                    <div class="control">
                                        <input class="input" v-model="agents.tel" name="tel" type="number" placeholder="e.g 92992654321" autocomplete="off">
                                        <span class="help is-danger">{{ allerros.tel }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-2">
                                <div class="field">
                                    <label class="label">Email:</label>
                                    <div class="control">
                                        <input class="input" v-model="agents.email" name="email" type="email" placeholder="e.g agent@abc.com" autocomplete="off">
                                        <span class="help is-danger">{{ allerros.email }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-3">
                                <div class="field">
                                    <label class="label">Business Address:</label>
                                    <div class="control">
                                        <input class="input" v-model="agents.baddress" name="baddress" type="text" placeholder="e.g Business address" autocomplete="off">
                                        <span class="help is-danger">{{ allerros.baddress }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-3">
                                <div class="field">
                                    <label class="label">Home Address:</label>
                                    <div class="control">
                                        <input class="input" v-model="agents.haddress" name="haddress" type="text" placeholder="e.g Home address" autocomplete="off">
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
                <router-link class="button is-info is-pulled-right" :to="{ name: 'agents' }"><i class="fa fa-user-plus m-r-10"></i>Click to Back Agents</router-link>
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
                
                agents: {
                    company: '',
                    person: '',
                    cnic: '',
                    mobile: '',
                    tel: '',
                    email: '',
                    baddress:'',   
                    haddress: '',
                },
               
                
            }
        },
        methods: {
                updateSignal: function (id) {
                 axios.post('/agents./AgentUpdate/' + id, this.agents)
                .then(response => { this.success = true;
                 })
                    .catch((error) => {
                        this.allerros = error.response.data.errors;
                        this.success = false;
                   });
            },
            
             ShowSingle(){
            axios.get(`/agents./AgentEdit/${this.$route.params.id}`)
                .then((response)=> this.agents = this.temp = response.data)
                .catch((error) => this.errors = error.response.data.errors)
                        }    
                },
        mounted(){
            this.ShowSingle();  
        },    
}

</script>
