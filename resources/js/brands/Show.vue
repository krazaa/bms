<template>
<form method="POST" action="/cogs./CogStoreAcc" @submit.prevent="onSubmit">
    <div class="columns" v-if="!success">
        <div class="column is-10 is-offset-1">
            <div class="box">
                <b-field grouped group-multiline>
                <div class="control">
                    <h3 class="title is-4">Chart of Account Detail</h3>
                </div>
                </b-field>
                <div class="columns is-multiline">
                    
                    
                </div>

                </div>  
        </div>
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
                search:'',
                loading: false,
                cogFrom: {
                    typeid: '',
                    inbal: '',
                    acat_id: '',
                    debitcredit: '',
                    actype: '',
                    subtype: '0',
                    htype: '',
                    aname:'',
                    search:'',
                },
                cogsAcc:[]
                //csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                
            }
        },
        methods: {
            AcEdit(){
                axios.get('/products./autos/ShowSingle/' + this.id)
                    .then(response => {
                  this.cogsAcc = response.data;
                  });
            },
            AcCheck() {
                this.loading = true;
                    var searchv = this
                    axios.get('/cogs./AcCheck?code=' + this.cogFrom.search)
                    .then(function(response) {
                    Vue.set(searchv.$data, 'account', response.data)
                    searchv.loading = false;
                        })
                    //.catch(`error` => {"erro found"});
                    },
            AcCatLoad(){
                    axios.get("/cogs./AcCat").then(({data}) => (this.catsload = data));
                    axios.get("/cogs./AcTypes").then(({data}) => (this.actypeload = data));
                    axios.get("/cogs./GetMainAcc").then(({data}) => (this.macload = data));
                    
                    },
            GetSubHeads(){
                axios.get("/cogs./GetSubAcc?type=" +this.cogFrom.htype).then(({data}) => (this.subacload = data));
            },
            onSubmit(){
                axios.post('/cogs./CogStoreAcc', this.cogFrom)
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
