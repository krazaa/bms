<template>
<div class="box">
    <div v-if="isLoading">
        <b-loading :active.sync="isLoading" :can-cancel="true"></b-loading>
    </div>
    <div v-if="!isLoading">
    <template>
    <section>
         <div class="columns is-multiline">
            <div class="column is-3"><h3 class="title is-4">Manage Electronic</h3></div>
              <div class="column is-3">
                <h3 class="title is-4">
                <b-field>
            <b-input v-model="search" name="search" placeholder="Keyword Seach" @input="ElectronicGet"></b-input>
            </b-field>
          </h3>
          </div>
          <div class="column is-2">
              <router-link class="button is-primary d-inline-block is-pulled-right" :to="{ name: 'neweproduct' }"><i class="mdi mdi-plus-box"></i> New Product</router-link>
          </div>
                    <div class="column is-4">
                        <nav class="breadcrumb is-right" aria-label="breadcrumbs">
                            <ul>
                                <li>
                                    <span class="icon is-small">
                                        <i class="mdi mdi-home" aria-hidden="true"></i>
                                    </span>
                                    <router-link to="/dashboard"><span>Home</span></router-link>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
        <b-table
            :data="electronic.data"
            :loading="isLoading"
            :narrowed="isNarrowed"
            :default-sort-direction="defaultSortDirection"
             default-sort="electronic.name">
        <template slot-scope="props">
        <b-table-column field="id" label="ID" width="40" sortable>
        {{ props.row.id }}
        </b-table-column>
        <b-table-column field="photo" label="Photo">
            <figure class="image is-16x16" v-if="props.row.photo">
                <a href="#"><img :src="`/electronic/${props.row.photo}`" @click='isOpen = !isOpen'></a>
                <figure class="image is-96x96" v-if="isOpen">
                     <img :src="`/electronic/${props.row.photo}`">
                </figure>
            </figure>
        </b-table-column>
        <b-table-column field="code" label="Code" sortable>
        {{ props.row.code }}
        </b-table-column>
        <b-table-column field="name" label="Product Name" sortable>
        {{ props.row.name }}
        </b-table-column>
        <b-table-column field="category" label="Category" sortable>
        {{ props.row.category }} <i class="mdi mdi-arrow-right" v-if="props.row.subcategory"></i>{{ props.row.subcategory }}
        </b-table-column>
        <b-table-column field="manpartno" label="Man Part No" sortable>
        {{ props.row.manpartno }}
        </b-table-column>
        <b-table-column field="cost" label="Cost" sortable>
        {{ props.row.cost }}
        </b-table-column>
           <b-table-column field="isActive" label="Status" sortable>
            <b-switch v-model="props.row.isActive" name="isActive"
            :true-value="1" 
            :false-value="0"
            size="is-small"
            type="is-success">
            </b-switch>
        </b-table-column>
        
        <b-table-column label="Action" centered>
             <router-link class="button is-success is-small" :to="{ name: 'electronicshow', params: {id: props.row.id}}"><span class="mdi mdi-eye-circle-outline"></span></router-link>
             <router-link class="button is-warning is-small" :to="{ name: 'editeproduct', params: {id: props.row.id}}"><span class="mdi mdi-pencil-outline"></span></router-link>
        
        <a  class="button is-danger is-small"><span class="mdi mdi-trash-can"></span></a>
        </b-table-column>
        </template>
        </b-table>
    </section>
    </template>
<hr>

        <pagination :limit="5" :show-disabled=false :data="electronic"  @pagination-change-page="getResults"></pagination>
</div>
</div>
</template>

<script>
    export default {
        data(){
            return {
                electronic: {},
                search:'',
                isNarrowed: true,
                isLoading: false,
                defaultSortDirection: 'asc',
                isAvailable: 0,
                isOpen: false
            }
        },
        mounted(){
          this.loadElectronic();  
    },
        methods: {  
             loadElectronic(){
                this.isLoading = true
              axios.get("products./electronic/GetElectronic").then(({data}) => {
                  this.isLoading = false
                  this.electronic = data   });  
            },
            
            getResults(page = 1) {
                axios.get('/products./electronic/GetElectronic?page=' + page)
                  .then(response => {
                    this.electronic = response.data;
                });
            },

            ElectronicGet() {
              axios.get('/products./electronic/ElecSearch?search=' + this.search)
                .then(({data}) => (this.electronic = data));
                
            },
             toggle: function(){
            this.isOpen = !this.isOpen
        },
    }        
}
</script>
