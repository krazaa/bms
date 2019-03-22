<template>
<form method="POST" action="/settings./updatesetting/" @submit.prevent="onSubmit()">
    <div class="column is-10 is-offset-1">
        <div class="box">
            <h3 class="title is-4">Company Settings</h3>
        </div>
        <div class="box" v-for="config in setting">
            <div class="columns is-multiline">
                <div class="column is-4">
                    <div class="field">
                        <label class="label">Company Name:
                        </label>
                        <div class="control">
                            <input class="input" v-model="config.company" name="company" type="text" placeholder="e.g PTCL" autocomplete="off">
                            <span class="help is-danger">{{ allerrors.company }}</span>
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field">
                        <label class="label">Primary Contact:</label>
                        <div class="control">
                            <input class="input" v-model="config.contactone" name="contactone" type="text" placeholder="e.g Tair" autocomplete="off">
                            <span class="help is-danger">{{ allerrors.contactone }}</span>
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field">
                        <label class="label">Secondry Contact:</label>
                        <div class="control">
                            <input class="input" v-model="config.contacttwo" name="contacttwo" type="text" placeholder="e.g Zia" autocomplete="off">
                            <span class="help is-danger">{{ allerrors.contacttwo }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="column is-4">
                    <div class="field">
                        <label class="label">Fax:</label>
                        <div class="control">
                            <input class="input" v-model="config.fax" name="fax" type="number" placeholder="e.g 923211234567" autocomplete="off">
                            <span class="help is-danger">{{ allerrors.fax }}</span>
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field">
                        <label class="label">Email:</label>
                        <div class="control">
                            <input class="input" v-model="config.email" name="email" type="email" placeholder="e.g comanyname@gmail.com" autocomplete="off">
                            <span class="help is-danger">{{ allerrors.email }}</span>
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field">
                        <label class="label">Website:</label>
                        <div class="control">
                            <input class="input" v-model="config.website" name="website" type="number" placeholder="e.g www.company.com" autocomplete="off">
                            <span class="help is-danger">{{ allerrors.website }}</span>
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field">
                        <b-field label="NTN No.">
                        <b-input v-model="config.ntn" name="ntn" placeholder="NTN"></b-input>
                        </b-field>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="field">
                        <b-field label="STRN No.">
                        <b-input v-model="config.strn" name="strn" placeholder="STRN No"></b-input>
                        </b-field>
                    </div>
                </div>
                <div class="column is-6">
                    <div class="field">
                        <div class="control">
                            <b-field label="Address:">
                            <b-input type="textarea" v-model="config.address" name="address" placeholder="Address"></b-input>
                            </b-field>
                            <span class="help is-danger">{{ allerrors.address }}</span>
                        </div>
                    </div>
                </div>
                <div class="column is-6">
                    <figure class="image is-128x128">
                        <img :src="'/public/logo/'+config.logo" />
                    </figure>
                    <div class="field">
                        <div class="control">
                            <b-field class="file">
                            <b-upload v-model="config.file" name="logo">
                            <a class="button is-primary">
                                <b-icon icon="upload"></b-icon>
                                <span>Logo upload</span>
                            </a>
                            </b-upload>
                            <span class="file-name" v-if="config.file">
                                {{ file.name }}
                            </span>
                            </b-field>
                            <span class="help is-danger">{{ allerrors.logo }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="control is-flex is-pulled-right">
                <button class="button is-primary">Save Setting</button>
            </div>
        </div>
    </div>
    
</form>
</template>
<script>
    export default {
        data(){
            return {
                    setting: {},
                    company:'',
                    email:'',
                    logo:'',
                    address:'',
                    contactone:'',
                    contacttwo:'',
                    fax:'',
                    website:'',
                    ntn:'',
                    strn:'',
                    file: null,
                    loading: false,
                
                allerrors:'',
                //csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        methods:{
            onSubmit(){
                axios.post('/settings./updatesetting/', + this.company + this.email + this.logo + this.address + this.fax + this.website + this.ntn +this.strn +this.contactone +this.contacttwo)
                      .then(response => { this.success = true;
                      })
                    .catch((error) => {
                        this.allerros = error.response.data.errors;
                        this.success = false;
                   });
                }
        },
        mounted(){
            axios.get('/settings./getsetting/')
            .then((response)=> this.setting = response.data)
        //.catch((error) => this.allerrors = error.response.data.errors)
    },
}
</script>