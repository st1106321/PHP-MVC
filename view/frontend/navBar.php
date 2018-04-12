<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">App</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="./">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?action=listByFav">Favorites</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li> -->
    </ul>

    <form action="index.php?action=searchItem" class="form-inline my-2 my-lg-0">
      <input hidden type="text" name="action" value="searchItem"/>
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchFor"/>
      <button class="btn btn-outline-success my-2 my-sm-0 mr-sm-1" type="submit">Search</button>
    </form>
    <a class="btn btn-outline-dark" href="index.php?action=userLogout">Logout</a>
  </div>
</nav>