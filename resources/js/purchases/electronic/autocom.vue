<template>
    <section>
        <p class="content"><b>Selected:</b> {{ selected }}</p>
        <b-field label="Find or add a Fruit">
            <b-autocomplete
                v-model="code"
                ref="autocomplete"
                :data="filteredDataArray"
                placeholder="e.g. Dog"
                field="product_name"
                @select="option => selected = option.id">
                
                <template slot="empty">No results for {{code}}</template>
            </b-autocomplete>
        </b-field>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                data4: [],
                code: '',
                selected: null
            }
        },
        computed: {
            filteredDataArray() {
                return this.data4.filter((option) => {
                    return option.product_name
                        .toString()
                        .toLowerCase()
                        .indexOf(this.code.toLowerCase()) >= 0
                })
            }
        },

         mounted(){
            axios.get("/purchases./electronic/ElecProductsList").then(response => this.data4 = response.data);
        },
    }
</script>
