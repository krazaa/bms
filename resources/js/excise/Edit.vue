<template>
<form @submit.prevent="updateSignal(excise.id)">
    <div class="columns" v-if="!success">
        <div class="column is-10 is-offset-1">
            <div class="box">
                <b-field grouped group-multiline>
                <div class="control">
                    <h3 class="title is-4">Update Excise and Taxation Office</h3>
                </div>
                </b-field>
                
                <div class="columns is-multiline">
                    <div class="column is-3">
                        <div class="field">
                            <label class="label">Excise and Taxation Office:</label>
                            <div class="control">
                                <input class="input" v-model="excise.office" name="office" type="text" placeholder="e.g Office Name" autocomplete="off">
                                <span class="help is-danger">{{ allerros.office }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Model:
                            </label>
                            <div class="control">
                                <input class="input" v-model="excise.model" name="model" type="text" placeholder="e.g 345345-3" autocomplete="off">
                                <span class="help is-danger">{{ allerros.model }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-3">
                        <div class="field">
                            <div class="field">
                                <label class="label">Select Agent:</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="agent_id" v-model="excise.agent_id" required>
                                            <option selected disabled>Select one</option>
                                            <option v-for="agent in agentsload" :value="agent.id">{{ agent.company }} {{ agent.person }} </option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Cost:</label>
                            <div class="control">
                                <input class="input" v-model="excise.cost" name="Cost" type="number" placeholder="e.g 0545" autocomplete="off">
                                <span class="help is-danger">{{ allerros.Cost }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Selling:</label>
                            <div class="control">
                                <input class="input" v-model="excise.selling" name="selling" type="number" placeholder="e.g Rs,23423" autocomplete="off">
                                <span class="help is-danger">{{ allerros.selling }}</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="control is-flex is-pulled-right">
                    <button class="button is-primary">Update Office</button>
                </div>
            </div>
        </div>
    </div>
    <div class="notification is-success" v-if="success">
        <h2 class="title is-2"> Excise and Taxation Office successfully Stored! </h2>
        <br>
        <router-link class="button is-info is-pulled-right" :to="{ name: 'excisentaxation' }"><i class="fa fa-user-plus m-r-10"></i>Click to Back Excise and Taxation Office list</router-link>
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
                agentsload: '',
                isLoading: false,
                
                excise: {
                    office: '',
                    model: '',
                    agent_id: '',
                    cost: '',
                    selling: '',
                },
               
                
            }
        },
        methods: {
                updateSignal: function (id) {
                 axios.post('/excise./ExciseUpdate/' + id, this.excise)
                .then(response => { this.success = true;
                 })
                    .catch((error) => {
                        this.allerros = error.response.data.errors;
                        this.success = false;
                   });
            },
            
             ShowSingle(){
            axios.get(`/excise./ExciseEdit/${this.$route.params.id}`)
                .then((response)=> this.excise = this.temp = response.data)
                //.catch((error) => this.errors = error.response.data.errors)
                        }    
                },
    
        mounted(){
            this.ShowSingle();  
            axios.get("/excise./GetAgents").then(({data}) => (this.agentsload = data));  
            
        },    
}

</script>
