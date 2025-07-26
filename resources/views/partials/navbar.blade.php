<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="logo@2x.png" width="30" height="30" alt="">
        </a>
        <ul class="navbar-nav">
            <div class="search-container">
                <form action="#">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit" style="height: 39px;"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </ul>
        <div>
            <!-- user name -->
        </div>
    </div>
</nav>

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
