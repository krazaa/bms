<template>
    <section>
        <form class="login-form" method="POST" action="/manage/updatesetting" enctype="multipart/form-data">
            <input type="hidden" name="_token" :value="csrf">
        <div class="box">
             <h3 class="title is-4">Company Settings</h3>
        </div>
        <div class="box" v-for="setting in setting">
            <input type="hidden" name="settingid" :value="setting.id">

            
                <div class="column">
                   <div class="field">
                      <div class="control">
                        <b-field label="Company Name">
                            <b-input v-model="setting.company" name="company" value="setting.company" placeholder="Company Name"></b-input>
                        </b-field>
                      </div>
                    </div> 
                </div>    
            <div class="column">
                <b-field label="Address">
                    <b-input type="textarea" v-model="setting.address" name="address" placeholder="Address"></b-input>
                </b-field>
            </div>    
            
            <div class="columns">
                <div class="column">
                    <b-field label="Primary Contact">
                    <b-input v-model="setting.contactone" name="contaceone" placeholder="Contact one"></b-input>
                </b-field>
                </div>
                <div class="column">
                    <b-field label="Secondry Contact">
                    <b-input v-model="setting.contacttwo" name="contacttwo" placeholder="Contact two"></b-input>
                </b-field>
                </div>
                <div class="column">
                    <b-field label="Fax">
                    <b-input v-model="setting.fax" name="fax" placeholder="Fax"></b-input>
                </b-field>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <b-field label="Email">
                        <b-input v-model="setting.email" name="email" placeholder="Email"></b-input>
                    </b-field>
                </div>
                <div class="column">
                    <b-field label="Website">
                        <b-input v-model="setting.website" name="website" placeholder="http://www.yourbms.com"></b-input>
                </b-field>
                </div>
            </div>
        <b-field grouped group-multiline>
            
            <div class="control">
                <b-field label="NTN No.">
                    <b-input v-model="setting.ntn" name="ntn" placeholder="NTN"></b-input>
                </b-field>
            </div>
            <div class="control">
                <b-field label="STRN No">
                    <b-input v-model="setting.strn" name="strn" placeholder="STRN No"></b-input>
                </b-field>
            </div>
        </b-field>
        <b-field label="Company Logo">
        <div class="control is-flex">
                  <figure class="image is-128x128">
            <img :src="`logo/${setting.logo}`" />
          </figure>
        </div>
        </b-field>
        <div class="control is-flex">
                <b-field class="file">
                    <b-upload v-model="file" name="logo">
                        <a class="button is-primary">
                            <b-icon icon="upload"></b-icon>
                            <span>Logo upload</span>
                        </a>
                    </b-upload>
                    <span class="file-name" v-if="file">
                        {{ file.name }}
                    </span>
                </b-field>
        </div>
        <div class="control is-flex is-pulled-right">
             <button class="button is-primary">Save Setting</button>
        </div>
           </div>
        </div>
    </form>

    </section>
</template>
<script>
    export default {
        data(){
            return {
                setting: [],
                file: null,
                loading: false,
                company:'',
                email:'',
                password:'',
                errors: [],
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        mounted(){
        axios.get('/settings./getsetting/')
        .then((response)=> this.setting = this.temp = response.data)
        .catch((error) => this.errors = error.response.data.errors)
    },
    }
</script>