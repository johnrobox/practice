<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url().'dashboard';?>">Seminar Dashboard</a> 
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right"> 
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo ucwords($this->session->userdata('username')); echo ' ( ' .ucwords($this->session->userdata('role')); echo ' )';   ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url()?>" target="_blank">Online Seminar Registration</a></li>
            <li role="separator" class="divider"></li>
            <?php $role = $this->session->userdata('role');
                if ($role == 'Admin' || $role == 'superAdmin'){
            ?> 
             <li><a href="<?php echo base_url().'manageUser';?>"><span class="glyphicon glyphicon-user"></span> Manage User</a></li> 
            <?php }else{
              echo '';
              }?>
            <li><a href="<?php echo base_url().'logout'; ?>"><span class="glyphicon glyphicon-off"></span> Logout</a> </li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>