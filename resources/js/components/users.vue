<template>
    <section>
        <div class="columns">
            <div class="column">
                <h3 class="title is-3">Welcom to Dashboard</h3>
            </div>
            <div class="column">
                <a href="#" class="button is-white is-pulled-right"> </a>
            </div>
        </div>
<div class="box">
    <form @submit.prevent="updateAvatar" action="#" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label name="task-title">Incarca poza:</label>
          <input @change="newAvatar" id="avatar" type="file" name="avatar">
          <input  id="rolename" type="text" name="rolename">
        </div>
        <button type="submit" class="btn btn-primary general-task-btn">upload</button>
      </form>
</div>

    </section>

</template>

<script>
export default{
    props: ['userid'],
    data(){
        return{
            avatar: {
            },
            //rolename:'',
        }
    },
    methods: {
    newAvatar(event) {
       let files = event.target.files;
       if (files.length) this.avatar = files[0];
    },
    updateAvatar: function () {
        let data = new FormData();
        data.append('file', this.avatar);
        data.append('rolenameq', this.rolename,);
        axios.post('/manage./users/updateAvatar', data)
                .then(res => {
                    console.log(res);
                 }) 
                 .catch(error => console.log(error));
        // window.location.href = "/profile";
      }
    }
}
    
    
</script>