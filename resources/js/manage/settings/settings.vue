<template>
<form method="POST"  @submit.prevent="updateSignal(settings.id)">
    <div class="columns" v-if="!success">
    <div class="column is-10 is-offset-1">
            <div v-if="isLoading">
        <b-loading :active.sync="isLoading" :can-cancel="true"></b-loading>
        </div>
        <div v-if="!isLoading">
            <h3 class="title is-4">Company Settings</h3>
        
        <div class="box">
            <div class="columns is-multiline">
                <div class="column is-4">
                    <div class="field">
                        <label class="label">Company Name:
                        </label>
                        <div class="control">
                            <input class="input" v-model="settings.company" name="company" type="text" placeholder="e.g PTCL" autocomplete="off" autofocus>
                            <span class="help is-danger">{{ allerros.company }}</span>
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Phone No:</label>
                        <div class="control">
                            <input class="input" v-model="settings.phone" name="phone" type="number" placeholder="0992123456" autocomplete="off">
                            <span class="help is-danger">{{ allerros.contactone }}</span>
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Mobile:</label>
                        <div class="control">
                            <input class="input" v-model="settings.phone" name="mobile" type="number" placeholder="e.g Zia" autocomplete="off">
                            <span class="help is-danger">{{ allerros.contacttwo }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Fax:</label>
                        <div class="control">
                            <input class="input" v-model="settings.fax" name="fax" type="number" placeholder="e.g 923211234567" autocomplete="off">
                            <span class="help is-danger">{{ allerros.fax }}</span>
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <label class="label">Email:</label>
                        <div class="control">
                            <input class="input" v-model="settings.email" name="email" type="email" placeholder="e.g comanyname@gmail.com" autocomplete="off">
                            <span class="help is-danger">{{ allerros.email }}</span>
                        </div>
                    </div>
                </div>
                <div class="column is-3">
                    <div class="field">
                        <label class="label">Website:</label>
                        <div class="control">
                            <input class="input" v-model="settings.website" name="website" type="text" placeholder="e.g www.company.com" autocomplete="off">
                            <span class="help is-danger">{{ allerros.website }}</span>
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <b-field label="NTN No.">
                        <b-input v-model="settings.ntn" name="ntn" placeholder="NTN"></b-input>
                        </b-field>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field">
                        <b-field label="STRN No.">
                        <b-input v-model="settings.strn" name="strn" placeholder="STRN No"></b-input>
                        </b-field>
                    </div>
                </div>
                <div class="column is-5">
                    <div class="field">
                        <div class="control">
                            <b-field label="Address:">
                            <b-input v-model="settings.address" name="address" placeholder="Address"></b-input>
                            </b-field>
                            <span class="help is-danger">{{ allerros.address }}</span>
                        </div>
                    </div>
                </div>
                <div class="column is-6">
                    <figure class="image is-128x128">
                        <img :src="'/public/logo/'+settings.logo" />
                    </figure>
                    <div class="field">
                        <div class="control">
                            <b-field class="file">
                            <b-upload v-model="settings.file" name="logo">
                            <a class="button is-primary">
                                <b-icon icon="upload"></b-icon>
                                <span>Logo upload</span>
                            </a>
                            </b-upload>
                            <span class="file-name" v-if="settings.file">
                                {{ settings.file.name }}
                            </span>
                            </b-field>
                            <span class="help is-danger">{{ allerros.logo }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="control is-flex is-pulled-right">
                <button class="button is-primary">Save Setting</button>
            </div>
        </div>
    </div>
    </div>
    </div>
         <div class="notification is-success" v-if="success">
        <h2 class="title is-2"> Company Setting successfully Updated! </h2>
        <br>
        <router-link class="button is-info is-pulled-right" :to="{ name: 'home' }"><i class="fa fa-user-plus m-r-10"></i>Click to Back Home</router-link>
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
                status: '',
                isLoading: false,
                
                settings: {
                    company: '',
                    //logo: '',
                    phone: '',
                    address: '',
                    mobile: '',
                    fax: '',
                    email:'',   
                    website: '',
                    ntn: '',
                    strn: '',
                    file: null
                },
                
               
                
            }
        },
        methods: {
                updateSignal: function (id) {
                 axios.post('/settings./updatesetting/' + id, this.settings)
                .then(response => { this.success = true;
                 })
                    .catch((error) => {
                        this.allerros = error.response.data.errors;
                        this.success = false;
                   });
            },
            
             ShowSingle(){
            axios.get(`/settings./getsetting/1`)
                .then((response)=> this.settings = this.temp = response.data)
                //.catch((error) => this.errors = error.response.data.errors)
                        }    
                },
        mounted(){
            this.ShowSingle();  
        },    
}

</script>