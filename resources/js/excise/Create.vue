<template>
<form method="POST" action="/banks./BankStore" @submit.prevent="onSubmit">
    <div class="columns" v-if="!success">
        <div class="column is-10 is-offset-1">
            <div class="box">
                <b-field grouped group-multiline>
                <div class="control">
                    <h3 class="title is-4">Add New Excise and Taxation Office</h3>
                </div>
                </b-field>
                
                <div class="columns is-multiline">
                    <div class="column is-4">
                        <div class="field">
                            <label class="label">Excise and Taxation Office:</label>
                            <div class="control">
                                <input class="input" v-model="DataFrom.office" name="office" type="text" placeholder="e.g Office Name" autocomplete="off">
                                <span class="help is-danger">{{ allerros.office }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-4">
                        <div class="field">
                            <label class="label">Model :
                            </label>
                            <div class="control">
                                <input class="input" v-model="DataFrom.model" name="model" type="text" placeholder="e.g 345345-3" autocomplete="off">
                                <span class="help is-danger">{{ allerros.model }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-4">
                        <div class="field">
                            <div class="field">
                                <label class="label">Select Agent:</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="agent_id" v-model="DataFrom.agent_id" required>
                                            <option selected disabled>Select one</option>
                                            <option v-for="agent in agentsload" :value="agent.id">{{ agent.company }} {{ agent.person }} </option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="column is-4">
                        <div class="field">
                            <label class="label">Cost:</label>
                            <div class="control">
                                <input class="input" v-model="DataFrom.cost" name="Cost" type="number" placeholder="e.g 0545" autocomplete="off">
                                <span class="help is-danger">{{ allerros.Cost }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-4">
                        <div class="field">
                            <label class="label">Selling:</label>
                            <div class="control">
                                <input class="input" v-model="DataFrom.selling" name="selling" type="number" placeholder="e.g Rs,23423" autocomplete="off">
                                <span class="help is-danger">{{ allerros.selling }}</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="control is-flex is-pulled-right">
                    <button class="button is-primary">Add Office</button>
                </div>
            </div>
        </div>
    </div>
    <div class="notification is-success" v-if="success">
        <h2 class="title is-2"> Excise and Taxation Office successfully Stored! </h2>
        <br>
        <router-link class="button is-primary is-pulled-right" :to="{ name: 'excisentaxationCreate' }"><i class="fa fa-user-plus m-r-10"></i>Click to Back Excise and Taxation Office list</router-link>
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
                agentsload:'',
                DataFrom: {
                    office: '',
                    model: '',
                    agent_id: '',
                    cost: '',
                    selling: '',
                    
                }
                //csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                
            }
        },
        methods: {
            onSubmit(){
                axios.post('/excise./ExciseStore', this.DataFrom)
                      .then(response => { this.success = true;
                      })
                    .catch((error) => {
                        this.allerros = error.response.data.errors;
                        this.success = false;
                   });
                }
        },
         mounted(){

            axios.get("/excise./GetAgents").then(({data}) => (this.agentsload = data));
              
            }
}


</script>
