<template>
    <section>
  <div id="list-add-delete" class="columns">
    
    <section id="new-item-form" class="column">
        <div class="field">
            
        </div>
        <b-field horizontal label="id" :type="isIDlabelDanger" :message="IDLabelMessage">
            <b-input v-model="newId"></b-input>
        </b-field>
        <b-field horizontal label="label" :type="isItemLabelDanger" :message="ItemLabelMessage">
            <b-input v-model="newItem"></b-input>
        </b-field>
       
    </section>
  </div>
</section>  
</template>

<script>
    export default {
        data() {
            return {
                
                
                
            }
        },
        computed: {
    isIDlabelDanger() {
        if (this.newId === "") return "is-danger";
        let hasItem = this.hasItemById(this.newId);
        if (hasItem) {
            return "is-danger";
        } else {
            return "is-success";
        }
    },
    IDLabelMessage() {
        if (this.newId === "") return "Please enter an ID";
        let hasItem = this.hasItemById(this.newId);
        if (hasItem) {
            return "Please enter a unique ID";
        } else {
            return "";
        }
    },
    isItemLabelDanger() {
        if (this.newItem !== "") {
            return "is-success";
        } else {
            return "is-danger";
        }
    },
    ItemLabelMessage() {
        if (this.newItem !== "") {
            return "";
        } else {
            return "Please enter an Item";
        }
    },
    formIsInDanger() {
      if (this.isIDlabelDanger === "is-danger"
       || this.isItemLabelDanger === "is-danger") {
        return true;
      } else {
        return false;
      }
    },
    isNewItemFormDisabled() {
      if (this.formIsInDanger) return true;
      else return false;
    }
},

        methods: {

        }
    }
            
            
        
        
        
</script>
