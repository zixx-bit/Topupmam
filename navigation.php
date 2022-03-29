<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">TopUPmama</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link" href="users.php">My Account</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="users.php">Users</a>
        </li>

        <li>
          <a href="#" class="nav-link" >Hello <?=$user_data['first'];?> :)
          <span class="caret"></span>
        </a>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="logout.php">Log Out</a>
        </li>
      </ul>

    </div>
  </div>
</nav>
