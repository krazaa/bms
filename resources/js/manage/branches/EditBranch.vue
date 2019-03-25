<template>
    <form class="form-horizontal" method="POST" @submit.prevent="updateSignal(branch.id)">
    <div class="columns" v-if="!success">
    <div class="columns is-multiline">
        <div class="column is-12">
            <div class="box">
                <div class="columns is-multiline">
                    <div class="column is-4"><h3 class="title is-4">Update Branch</h3></div>
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
                                        <i class="mdi mdi-source-branch" aria-hidden="true"></i>
                                    </span>
                                    <router-link :to="{ name: 'branches' }"><span>Branches</span></router-link>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
        
                  <div class="columns is-multiline">
                    <div class="column is-2">
                       <div class="field">
                        <label class="label">Code:</label>
                        <div class="control is-expanded">
                            <input class="input" name="code" v-model="branch.code" type="text" placeholder="1234">
                        </div>
                    </div> 
                    </div>
                    <div class="column is-2">
                    <div class="field">
                        <label class="label">Branch Name:</label>
                        <div class="control">
                            <input class="input" name="name" v-model="branch.name" type="text" placeholder="Branch Name">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                <div class="field">
                        <label class="label">Telephone:</label>
                        <div class="control">
                            <input class="input" name="contact" v-model="branch.contact" type="text" placeholder="0992-123456">
                        </div>
                    </div>
                </div>
                    <div class="column is-2">
                    <div class="field">
                        <label class="label">Mobile:</label>
                        <div class="control">
                            <input class="input" name="mobile" v-model="branch.mobile" type="text" placeholder="e.g 923219802672">
                        </div>
                    </div>
                    </div>
                    <div class="column is-2">
                    <div class="field">
                        <label class="label">Email:</label>
                        <div class="control">
                            <input class="input" name="email" v-model="branch.email" type="email" placeholder="example@pmb.com.pk">
                        </div>
                    </div>
                </div>
                <div class="column is-2">
                <div class="field">
                        <label class="label">City:</label>
                        <div class="control">
                            <input class="input" name="city" v-model="branch.city" type="text" placeholder="e.g Abbottabad">
                        </div>
                    </div>
                </div>
                    <div class="column is-3">
                    <div class="field">
                        <label class="label">Address:</label>
                        <div class="control">
                            <input class="input" name="address" v-model="branch.address" type="text" placeholder="Address">
                        </div>
                    </div>
                </div>
            </div>
                <div class="control is-flex is-pulled-right">
                    <button class="button is-primary">Update Branch</button>
                </div>
            </div>
        </div>
    </div>
    </div>
     <div class="notification is-success" v-if="success">
        <h2 class="title is-2"> Branch successfully Updated! </h2>
        <br>
        <router-link class="button is-primary is-pulled-right" :to="{ name: 'branches' }"><i class="fa fa-user-plus m-r-10"></i>Click to Back Branches</router-link>
</div>
</form>
</template>
<script>
    export default {
        props: ['id'], 
        data(){
            return {
                
                branch: {
                    name:'',
                    code:'',
                    address:'',
                    mobile:'',
                    email:'',
                    city:'',
                    },
                allerros: false,
                success: false,
                loading: false,
                //csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
               
            }
        },
        methods:{
             updateSignal: function (id) {
            axios.post('/settings./branches/branchupdate/' + id, this.branch)
                .then(response => { this.success = true;
                 })
                    .catch((error) => {
                        this.allerros = error.response.data.errors;
                        this.success = false;
                   });
        },
        ShowSingle(){
            axios.get(`/settings./branches/ShowSingle/${this.$route.params.id}`)
            .then((response)=> this.branch = this.temp = response.data)
            .catch((error) => this.errors = error.response.data.errors)
            }

            },
        mounted(){
            this.ShowSingle();            
        }
    }
</script>