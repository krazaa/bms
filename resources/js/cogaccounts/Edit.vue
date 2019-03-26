<template>
<form method="POST" @submit.prevent="updateSignal(cogFrom.id)">
    <div class="columns" v-if="!success">
        <div class="column is-10 is-offset-1">
            <div class="box">
                <div class="columns is-multiline">
                    <div class="column is-4"><h3 class="title is-4">Update COA</h3></div>
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
                                        <i class="mdi mdi-chart-timeline" aria-hidden="true"></i>
                                    </span>
                                    <router-link :to="{ name: 'cogs' }"><span>Chart of Accounts</span></router-link>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                
                 <div class="columns is-multiline">
                    <div class="column is-3">
                        <div class="field">
                            <div class="field">
                                <label class="label">Primary / Secondary:</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="typeid" v-model="cogFrom.typeid" @input="GetSubHeads()" required>
                                            <option selected disabled>Select one</option>
                                            <option value="0">Primary Account</option>
                                            <option v-for="mcl in macload" :value="mcl.id">{{ mcl.aname }} </option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column is-2" v-if="cogFrom.typeid > 0">
                        <div class="field">
                            <div class="field">
                                <label class="label">Sub Account:</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="subtype" v-model="cogFrom.subtype">
                                            <option selected disabled value="0">Select one</option>
                                            <option v-for="scl in subacload" :value="scl.id">{{ scl.aname }} </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Income/ Balance:</label>
                            <div class="control">
                                <div class="select">
                                    <select name="inbal" required v-model="cogFrom.inbal">
                                        <option selected disabled>Select one</option>
                                        <option value="1">Income Statement </option>
                                        <option value="2">Balance Sheet</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column is-3">
                        <div class="field">
                            <label class="label">Category:</label>
                            <div class="control">
                                <div class="select">
                                    <select name="acat_id" v-model="cogFrom.acat_id" required>
                                        <option selected disabled>Select one</option>
                                        <option v-for="acl in catsload" :value="acl.id">{{ acl.name }} </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column is-3">
                        <div class="field">
                            <label class="label">Debit / Credit:</label>
                            <div class="control">
                                <div class="select">
                                    <select name="debitcredit" v-model="cogFrom.debitcredit" required>
                                        <option selected disabled>Select one</option>
                                        <option value="1">Both</option>
                                        <option value="2">Debit</option>
                                        <option value="3">Credit</option>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column is-3">
                        <div class="field">
                            <label class="label">Type:</label>
                            <div class="control">
                                <div class="select">
                                    <select name="actype_id" v-model="cogFrom.actype" required>
                                        <option selected disabled>Select one</option>
                                        <option v-for="act in actypeload" :value="act.id">{{ act.name }} </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Class:</label>
                            <div class="control">
                                <div class="select">
                                    <select name="actype_id" v-model="cogFrom.actype" required>
                                        <option selected disabled>Select one</option>
                                        <option value="1">Variable</option>
                                        <option value="2">Fixed</option>
                                        <option value="3">Semi Variable</option>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Account Code:
                            </label>
                            <div class="control">
                                <input class="input" v-model="cogFrom.acode" name="acode" type="text" placeholder="e.g B18123456">
                                <span class="help is-danger">{{ allerros.acode }}</span>
                            </div>
                            
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Account Name:</label>
                            <div class="control">
                                <input class="input" v-model="cogFrom.aname" name="aname" type="text" placeholder="e.g Cash">
                                <span class="help is-danger">{{ allerros.aname }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="control is-flex is-pulled-right">
                    <button class="button is-primary">Update COA</button>
                </div>
            </div>
        </div>
    </div>
    <div class="notification is-success" v-if="success">
        <h2 class="title is-2"> COA submitted successfully! </h2>
        <br>
        <router-link class="button is-primary is-pulled-right" :to="{ name: 'cogs' }"><i class="fa fa-user-plus m-r-10"></i>Click to Back Chart of Accounts</router-link>
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
                catsload: [],
                actypeload: [],
                macload: [],
                status: '',
                subacload: '',
                loading: false,
                cogFrom: {
                    typeid: '',
                    acode: '',
                    inbal: '',
                    acat_id: '',
                    debitcredit: '',
                    actype: '',
                    subtype: '',
                    htype: '',
                    aname:'',
                    
                },
                cogsAccEdit:[],
                //csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                
            }
        },
        methods: {
            AcEdit(){
                axios.get('/cogs./AcEdit/' + this.id)
                    .then(response => {
                  this.cogFrom = response.data;
                  });
            },
        
            AcCatLoad(){
                    axios.get("/cogs./AcCat").then(({data}) => (this.catsload = data));
                    axios.get("/cogs./AcTypes").then(({data}) => (this.actypeload = data));
                    axios.get("/cogs./GetMainAcc").then(({data}) => (this.macload = data));
                    
                    },
            GetSubHeads(){
                axios.get("/cogs./GetSubAcc?type=" +this.cogFrom.htype).then(({data}) => (this.subacload = data));
            },
            updateSignal: function (id) {
                axios.post('/cogs./CoaUpdate/' + id, this.cogFrom)
                      .then(response => { this.success = true;
                      })
                    .catch((error) => {
                        this.allerros = error.response.data.errors;
                        this.success = false;
                   });
                 }

    },
    mounted(){
        this.AcCatLoad();  
        this.AcEdit();  
        }
}

</script>
