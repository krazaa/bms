<template>
<div class="columns is-multiline">
  <div class="column is-12">
    <div class="box">
        <div v-if="isLoading">
        <b-loading :active.sync="isLoading" :can-cancel="true"></b-loading>
    </div>
    <div v-if="!isLoading">
        <b-field grouped group-multiline>
         <div class="control">
                <h3 class="title is-4">Manage Branches</h3>   
            </div>
            
            <div class="control">
                <b-field>
                    <router-link :to="{ name: 'newbranch'}" class="button is-info">New Branch</router-link>
                </b-field>
            </div>
    </b-field>
    
      <table class="table is-fullwidth is-hoverable is-narrow is-desktop is-mobile" v-if="branches.length > 0">
        
        <thead>
          <tr>
            <th><abbr title="id">#</abbr></th>
            <th><abbr title="code">Code</abbr></th>
            <th><abbr title="name">Branch</abbr></th>
            <th><abbr title="city">City</abbr></th>
            <th><abbr title="contact">Telephone</abbr></th>
            <th><abbr title="mobile">Mobile</abbr></th>
            <th><abbr title="mobile">Status</abbr></th>
            <th><abbr title="action">Action</abbr></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(branche , index) in branches">
            <th>{{ index +1 }}</th>
            <td>{{ branche.code }}</td>
            <td>{{ branche.name }}</td>
            <td>{{ branche.city }}</td>
            <td>{{ branche.contact }}</td>
            <td>{{ branche.mobile }}</td>
            <td>
            <b-switch v-model="branche.isActive" name="isActive"
            :true-value="1"
            :false-value="0"
            type="is-success" @input="StatusChange(branche.id)">
            </b-switch>
            </td>
            <td>
                <router-link class="button is-warning is-small" :to="{ name: 'editbranch', params: {id: branche.id}}"><span class="mdi mdi-pencil-box-outline"></span></router-link>
                <a :href="`/settings./branches/removebranch/${branche.id}`" class="button is-danger is-small"><span class="mdi mdi-trash-can"></span></a>
                <!-- <router-link :to="{ name: 'showelectronic' }">Hello World</router-link> -->
            </td>
          </tr>
        </tbody>
      </table>

      </div>
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
               isLoading: false,
                    }
            },
            methods:{
              StatusChange(id,){
              axios.get("/settings./branches/ChangeStatus/" + id )
              // .then(response => { this.success = true;
              //         })
            //this.loadBranchers();
            }, 
              loadBranchers(){
              this.isLoading = true
              axios.get('/settings./branches/GetBranches').then(({data}) => {
                  this.isLoading = false
                  this.branches = data
            });
            }
          },
         mounted(){
            this.loadBranchers();
          // .then((response)=> this.branches = this.temp = response.data)
          // .catch((error) => this.errors = error.response.data.errors)
    },

}
        
</script>