<template>
    <section>
        <div class="block">
            <b-switch v-model="openOnFocus">
                Open dropdown on focus
            </b-switch>
            <b-switch v-model="keepFirst">
                Keep-first <small>(will always have first option pre-selected)</small>
            </b-switch>
        </div>
        <p class="content"><b>Selected:</b> {{ selected }}</p>
        <b-field label="Find a name">
            <b-autocomplete
                v-model="name"
                placeholder="e.g. Anne"
                :keep-first="keepFirst"
                :open-on-focus="openOnFocus"
                :data="filteredDataObj"
                field="user.first_name"
                @select="option => selected = option">
            </b-autocomplete>
        </b-field>
    </section>
</template>

<script>
    //const data = require('@/data/sample.json')

    export default {
        data() {
            return {
                data:[],
                keepFirst: false,
                openOnFocus: false,
                name: '',
                selected: null
            }
        },
        mounted(){
              axios.get("vendors./GetVendors").then(({data}) => {
                  this.data = data
                });
        },
        computed: {
            filteredDataObj() {
                return this.data.filter((option) => {
                    return option
                        .toString()
                        .toLowerCase()
                        .indexOf(this.name.toLowerCase()) >= 0
                })
            }
        }
         
    }
</script>



<!-- <template>
    <section>
        <p class="content"><b>Selected:</b> {{ selected }}</p>
        <b-field label="Find a movie">
            <b-autocomplete
                :data="data"
                placeholder="e.g. Fight Club"
                field="title"
                :loading="isFetching"
                @typing="getAsyncData"
                @select="option => selected = option">

                <template slot-scope="props">
                    <div class="media">
                        
                        <div class="media-content">
                            {{ props.option.company }}
                            <br>
                            <small>
                                Released at {{ props.option.person }},
                                rated <b>{{ props.option.contact }}</b>
                            </small>
                        </div>
                    </div>
                </template>
            </b-autocomplete>
        </b-field>
    </section>
</template>

<script>
    import debounce from 'lodash/debounce'

    export default {
        data() {
            return {
                data: [],
                selected: null,
                isFetching: false
            }
        },
        methods: {
            // You have to install and import debounce to use it,
            // it's not mandatory though.
            getAsyncData: debounce(function (name) {
                if (!name.length) {
                    this.data = []
                    return
                }
                this.isFetching = true

                axios.get(`/vendors./VendorSearch?search=${name}`)
                    .then(({ data }) => {
                        this.data = []
                        data.results.forEach((item) => this.data.push(item))
                    })
                    .catch((error) => {
                        this.data = []
                        throw error
                    })
                    .finally(() => {
                        this.isFetching = false
                    })
            }, 500)
        }
    }
</script> -->