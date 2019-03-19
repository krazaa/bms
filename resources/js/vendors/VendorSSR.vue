<template>
    <b-table 
    :data="vendors.data" 
    :columns="columns"
    :hoverable="isHoverable"
    :narrowed="isNarrowed"
    :paginated="isPaginated"
    ></b-table>

</template>

<script>
    export default {
        data() {
            return {
                vendors: [],
                isNarrowed: false,
                isPaginated: true,
                isHoverable: false,    
                columns: [
                    {
                        field: 'id',
                        label: 'ID',
                        width: '40',
                        numeric: true
                    },
                    {
                        field: 'vnum',
                        label: 'Vendors',
                    },
                    {
                        field: 'company',
                        label: 'Company',
                    },
                    {
                        field: 'person',
                        label: 'person',
                        centered: true
                    },
                    {
                        field: 'gender',
                        label: 'Gender',
                    }
                ]
            }
        },
         methods: {
         loadProducts(){
              this.loading = true
              axios.get("/vendors./GetVendors").then(({data}) => (this.vendors = data));
              this.loading = false
            }
        },
         mounted(){
          // axios.get('/products./autos/GetAutosProducts')
          // .then((response)=> this.products = this.temp = data)
          // .catch((error) => this.errors = error.response.data.errors)
          this.loadProducts();
    },
    }
</script>
