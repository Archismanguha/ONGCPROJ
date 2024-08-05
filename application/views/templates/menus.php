<header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" style="background: #273E4A!important;">
    <a class="navbar-brand" href="https://ongcindia.com/web/eng/about-ongc/contact-us-1"><strong>ONGC Eastern Zone</strong></a>
    
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <?php if ($this->session->userdata('is_authenticated') == TRUE) {
          echo "<li class='nav-item active'>";
            echo "<a class='nav-link' href='".base_url()."users/viewDetails'>View Details <span class='sr-only'>(current)</span></a>";
          echo "</li>";
          echo "<li class='nav-item active'>";
            echo "<a class='nav-link' href='".base_url()."users/upload'>Upload <span class='sr-only'>(current)</span></a>";
          echo "</li>";
          echo "<li class='nav-item active' style='float:right;'>";
            echo "<a class='nav-link' href='".base_url()."users/logout'>Log Out <span class='sr-only'>(current)</span></a>";
          echo "</li>";
        }
        ?>
      </ul>
      <span class="nav-item dropdown">
        <?php if (!empty($userInfo)) {

        } else {
          
        } ?>
      </span>
    </div>
    <div class="navbar-collapse collapse order-3 dual-collapse2">
      <ul class="navbar-nav ml-auto">
        <?php if ($this->session->userdata('is_authenticated') == TRUE) {
          echo "<li class='nav-item active' style='float:right;color:white;'>";
            echo $this->session->userdata('firstname')." ".$this->session->userdata('lastname');
          echo "</li>";
        }
        ?>
      </ul>
  </div>
  </nav>
</header>