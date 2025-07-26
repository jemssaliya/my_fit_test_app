<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <a class="navbar-brand" href="/clients">
                <img src="/images/logo@2x.png" height="35" alt="">
            </a>
            <div class="container">
                <a class="navbar-brand" href="/clients"></a>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="" href="/">
                                Home
                            </a>
                        </li>
                        <li>
                            <a class="" href="/clients">
                                Clients
                            </a>
                        </li>
                    </ul>
                </div>
                <div type="" class="dropdown-toggle username-text" data-toggle="dropdown">
                    <!-- user name -->
                    {{ username }}
                    <ul class="dropdown-menu" style="left:auto; right:auto;">
                        <li style="text-align:center;"><a class="log-out-copy" href="/user/profile">My Profile</a></li>
                        <hr class="navbar-devider">
                        <li style="text-align:center;"><a class="log-out-copy" href="#">Manage Subscription</a></li>
                        <hr class="navbar-devider">
                        <li style="text-align:center;"><a class="log-out-copy" href="/logout">Log out</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    export default Vue.extend({
        name: 'navbar',
        props: [
            'username'
        ],
        methods: {
            logout() {
                window.location.href = this.$config.BASE_URL + '/logout';
            },
            myprofile() {
                window.location.href = this.$config.BASE_URL + '/user/profile';
            }
        }
    })
</script>

<style scoped>
    .navbar .search-container {
        float: right;
    }

    .navbar-devider {
        border-color: #e8d7d7;
    }

    .navbar input[type=text] {
        padding: 6px;
        margin-top: 8px;
        font-size: 17px;
        border: none;
        background-color: #e9eef3;
    }

    .navbar .search-container button {
        float: right;
        padding: 6px 10px;
        margin-top: 8px;
        margin-right: 16px;
        background: #ddd;
        font-size: 17px;
        border: none;
        cursor: pointer;
    }

    .navbar .search-container button:hover {
        background: #ccc;
    }

    .username-text {
        height: 18px;
        color: #000;
        font-family: Montserrat !important;
        font-size: 16px;
        font-weight: bold;
        letter-spacing: 0.29px;
        line-height: 18px;
        text-align: right;
    }

    .log-out-copy {
        height: 20px;
        width: 60px;
        color: #000;
        font-family: Montserrat !important;
        font-size: 13px;
        letter-spacing: 0.40px;
        line-height: 16px;
        text-align: center;
        font-weight: normal !important;
    }

    .navbar {
        margin-bottom: 1px !important;
    }
</style>
