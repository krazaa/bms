
<template>
<section>
        <p class="content"><b>Selected:</b> {{ vendor_id }}</p>
        <b-field label="Find a movie">
            <b-autocomplete v-model="person"
               :data="data"
                placeholder="e.g. Fight Club"
                field="company"
                
                :loading="isFetching"
                @input="getAsyncData"
            @select="option => vendor_id = option.id">

<template slot-scope="props">
    <div class="media">
        
        <div class="media-content">
            {{ props.option.company }}
            <br>
            <small>
                Contact Person: {{ props.option.person }}
                
            </small>
        </div>
    </div>
</template>
            </b-autocomplete>
        </b-field>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                data: [],
person: '',
vendor_id: null,
isFetching: false
            }
        },
        methods: {
            // You have to install and import _.debounce to use it,
            // it's not mandatory though.
            getAsyncData: _.debounce(function () {
            this.data = []
            this.isFetching = true
                axios.get(`/vendors./VendorSearch?search=${this.person}`)
            .then(({ data }) => {
            data.data.forEach((item) => this.data.push(item))
            this.isFetching = false
            })
            .catch((error) => {
            this.isFetching = false
        throw error
    })
            }, 500)
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
                            {{ props.option.name }}
                            <br>
                            <small>
                                Released at {{ props.option.model }},
                                rated <b>{{ props.option.code }}</b>
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
                axios.get(`/products./autos/SearchAutosProduct?search=${name}` )
                
                    .then(({ data }) => {
                        this.data = []
                        data.data.forEach((item) => this.data.push(item))
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
</script>
 -->