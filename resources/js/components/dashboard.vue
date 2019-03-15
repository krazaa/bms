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
    <div class="columns is-multiline">
        <div class="column is-one-quarter">
            <a href="income">
                <div class="box has-ribbon-bottom is-small">
                    <span style="color: Mediumslateblue;">
                        <i class="mdi mdi-eye mdi-36px"></i>
                    </span>
                    <div class="ribbon is-medium is-primary">Products</div>
                </div>
            </a>
        </div>
        
        <div class="column is-one-quarter">
            <a href="students">
                <div class="box has-ribbon-bottom is-small">
                    <span style="color: Dodgerblue;">
                        <i class="fas fa-graduation-cap fa-3x"></i>
                    </span>
                    <div class="ribbon is-medium is-info">Students</div>
                </div>
            </a>
        </div>
        <div class="column is-one-quarter">
            <a href="reports">
                <div class="box has-ribbon-bottom is-small">
                    <span style="color: Mediumslateblue;">
                        <i class="fas fa-chart-bar fa-3x"></i>
                    </span>
                    <div class="ribbon is-medium is-light">Reports</div>
                </div>
            </a>
        </div>
        <div class="column is-one-quarter" id="discount">
            <a href="discounts">
                <div class="box has-ribbon-bottom is-small">
                    <span style="color: turquoise;">
                        <i class="fas fa-tag fa-3x"></i>
                    </span>
                    <div class="ribbon is-medium is-dark">Discount Requests {{ stuff }} </div>
                </div>
            </a>
        </div>
        <div class="column is-one-quarter">
            <a href="sms">
                <div class="box has-ribbon-bottom is-small">
                    <span style="color: Tomato;">
                        <i class="fas fa-sms fa-3x"></i>
                    </span>
                    <div class="ribbon is-medium is-black">SMS</div>
                </div>
            </a>
        </div>
        <div class="column is-one-quarter">
            <a href="manage/users">
                <div class="box has-ribbon-bottom is-small">
                    <i class="mdi mdi-account-group mdi-48px"></i>
                    <div class="ribbon is-medium is-link">Manage Users</div>
                </div>
            </a>
        </div>
        <div class="column is-one-quarter">
            <a href="manage/users">
                <div class="box has-ribbon-bottom is-small">
                    <i class="mdi mdi-settings mdi-48px"></i>
                    <div class="ribbon is-medium is-link">Settings</div>
                </div>
            </a>
        </div>
         
    </div>  
</div>

    </section>

</template>

<script>
    export default {
        data() {
           
            return {
                 
                stuff: [],
                 }
            },            
            methods: {
                updateStuff: function () {
                    axios.get('discountreq').then(response => this.stuff = response.data);
                    // axios.get('/discountreq').then((response) => {
                    //     //console.log(response.data.data);
                    //     this.stuff = response.data.stuff;
                    // }, (response) => {
                    //     console.log('ERROR');
                    //     console.log(response);
                    // });
                    // setTimeout(this.updateStuff, 5000);
                }
            },
            created: function() {

    this.updateStuff();
    this.stuff = setInterval(this.updateStuff, 15000)

},

        }
    
    
</script>