<template>
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
                axios.get(`/products./autos/SearchAutosProduct?search=${name}`, )
                //axios.get(`/products./autos/SearchAutosProduct?search=${name}`)
                // this.$http.get(`https://api.themoviedb.org/3/search/movie?api_key=bb6f51bef07465653c3e553d6ab161a8&query=${name}`)
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
</script>
