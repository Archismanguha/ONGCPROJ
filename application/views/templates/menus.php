<header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" style="background: #273E4A!important;">
    <a class="navbar-brand" href="https://ongcindia.com/web/eng/about-ongc/contact-us-1"><strong>ONGC Eastern Zone</strong></a>
    
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          
        </li>
      </ul>
      <span class="nav-item dropdown">
        <?php if (!empty($userInfo)) {
          print '<a style="color:#fff;" class="nav-link" href="' . base_url() . 'users/logout" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
        </a>';
        } else {
          
        } ?>
      </span>
    </div>
  </nav>
</header>