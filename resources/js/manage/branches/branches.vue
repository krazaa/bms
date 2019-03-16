<template>
<div class="columns is-multiline">
  <div class="column is-12">
    <div class="box">
      <!-- <router-view></router-view> -->
        <b-field grouped group-multiline>
         <div class="control">
                <h3 class="title is-4">Manage Branches</h3>   
            </div>
            <div class="control">
                <b-field>
                    <b-input v-model="search" placeholder="Keyword Seach" @input="SearchAutos"></b-input>
                </b-field>
            </div>
            <div class="control">
                <b-field>
                    <a href="/settings./branches/newbranch" class="button is-info">New Branch</a>
                </b-field>
            </div>
    </b-field>
    
      <table class="table is-fullwidth is-hoverable is-narrow is-desktop is-mobile" v-if="branches.length > 0">
        <div v-if="Studentloading" v-cloak align="center" class="loading-overlay is-active">
          <i class="fas fa-circle-notch fa-spin fa-5x"></i>
        </div>
        <thead>
          <tr>
            <th><abbr title="id">#</abbr></th>
            <th><abbr title="name">Branch</abbr></th>
            <th><abbr title="city">City</abbr></th>
            <th><abbr title="contact">Telephone</abbr></th>
            <th><abbr title="mobile">Mobile</abbr></th>
            <th><abbr title="action">Action</abbr></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(branche , index) in branches">
            <th>{{ index +1 }}</th>
            <td>{{ branche.name }}</td>
            <td>{{ branche.city }}</td>
            <td>{{ branche.contact }}</td>
            <td>{{ branche.mobile }}</td>
            <td>
                <a :href="`/settings./branches/ShowSingle/${branche.id}`" class="button is-success is-small"><span class="mdi mdi-eye-circle-outline"></span></a>
                <a :href="`/settings./branches/editbranch/${branche.id}`" class="button is-warning is-small"><span class="mdi mdi-pencil-box-outline"></span></a>
                <a :href="`/settings./branches/removebranch/${branche.id}`" class="button is-danger is-small"><span class="mdi mdi-trash-can"></span></a>
                <!-- <router-link :to="{ name: 'showelectronic' }">Hello World</router-link> -->
            </td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>
</div>
</template>

<script>
 
 export default {
 props: ['studentID'], 
        data() {
            return {
               branches: [],
               search: '',
               searchstudents: [],
               Studentloading: false,
                    }
            },
              methods: {
                SearchAutos() 
            {
            var searchstudents = this
            axios.get('/products./autos/SearchAutosProduct?search=' + this.search)
            .then(function(response) 
            {
            Vue.set(branches.$data, 'products', response.data).catch(error => {"erro found"});
            })

            },
            
          },
         mounted(){
          axios.get('/settings./branches/GetBranches')
          .then((response)=> this.branches = this.temp = response.data)
          .catch((error) => this.errors = error.response.data.errors)
    },

}
        
</script>