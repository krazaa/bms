<template>
    <section>
<div class="box">
    <div class="box">
        <div class="title is-1 has-text-centered">Pak Motors BMS</div>
    </div>
        <div class="columns is-multilines">
            <div class="column is-5">
                <figure class="image is-256x256">
                    <img :src="'/public/logo/bmslogo.png'">
                </figure>
            </div>
            <div class="column is-7">
                <div class="columns">
                </div>
                <div class="colums is-8">
                     <form class="login-form" method="POST" action="login">
                        <input type="hidden" name="_token" :value="csrf">
                    <div class="box">
                        <h1 class="title is-3">Staff Login</h1>
                        <b-field label="Username">
                            <b-input placeholder="example@pmb.com.pk"
                                type="email"
                                icon="email"
                                name="email"
                                 required>
                            </b-input>
                        </b-field>
                        <b-field label="Password">
                            <b-input 
                                type="password"
                                icon="textbox-password"
                                name="password"
                                required>
                            </b-input>
                        </b-field>
                        <button class="button is-dark is-active is-pulled-right">Staff Login</button>
                    </div>
                </form>
                </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</template>
<script>
export default {
    data() {
        return {
            members:'1',
            loading: false,
             csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),  
        }
    }
}
</script>