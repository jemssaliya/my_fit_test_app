<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="http://localzknow.sandbox8.elegant-media.com/storage/images/ic_logo_icon.png" width="30"
                         height="30" alt="">
                </a>
                <ul class="navbar-nav">
                    <!-- <router-link :to="{ name: 'welcome' }" class="nav-link">Home</router-link>
                    <router-link :to="{ name: 'page' }" class="nav-link" >Spa-Page</router-link>
                    <router-link :to="{ name: 'Client' }" class="nav-link" >client</router-link> -->
                    <div class="search-container">
                        <form action="#">
                            <input type="text" placeholder="Search.." name="search">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </ul>
                <div>
                    <!-- user name -->
                </div>
            </div>
        </nav>
        <main>
            <router-view></router-view>
        </main>
    </div>
</template>
<script>
    export default {}
</script>

<style scoped>
    .navbar .search-container {
        float: right;
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
</style>
