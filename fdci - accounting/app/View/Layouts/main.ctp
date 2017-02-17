<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>

		<?php echo $this->fetch('title'); ?>
	</title>
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<?php

		echo $this->Html->meta('icon');
		echo $this->Html->css('twitter-bootstrap.min');
		echo $this->Html->css('datepicker');
		echo $this->Html->css('style.css');
		echo $this->Html->css('font-awesome.min.css');
		
		echo $this->Html->script('jquery-1.11.2.min');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

	?>
</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top nav-bar-mod">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="<?php echo $this->webroot;?>">FDC AS</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="">
                <a href="<?php echo $this->webroot;?>employees">Employee</a>
              </li>
              <li class="">
                <a href="<?php echo $this->webroot;?>profiles">Profiles</a>
              </li>
              <li class="">
                <a href="<?php echo $this->webroot;?>attendances">Attendance</a>
              </li>
            </ul>
            <ul class="nav pull-right">
              <li class="dropdown">
                  <a href="#" data-toggle="dropdown" class="dropdown-toggle"> 
                	<?php echo $this->Session->read('Auth.UserProfile.first_name')." ".
                						 $this->Session->read('Auth.UserProfile.middle_name')." ".
                						 $this->Session->read('Auth.UserProfile.last_name'); 
                	?>
                  <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                      <li><a href="#">View Profile</a></li>
                      <li><a href="<?php echo $this->webroot."users/logout"; ?>">Logout</a></li>
                  </ul>
              </li>
          </ul>
          </div>
        </div>
      </div>
    </div>
	<div id="container">
		<!-- 
		<div class="sidebar-nav">
		    <div class="well" style="width:300px; padding: 8px 0;">
				<ul class="nav nav-list"> 
				  <li class="nav-header">Admin Menu</li>        
				  <li><a href="index"><i class="icon-home"></i> Dashboard</a></li>
		          <li><a href="#"><i class="icon-envelope"></i> Messages <span class="badge badge-info">4</span></a></li>
		          <li><a href="#"><i class="icon-comment"></i> Comments <span class="badge badge-info">10</span></a></li>
				  <li class="active"><a href="#"><i class="icon-user"></i> Members</a></li>
		          <li class="divider"></li>
				  <li><a href="#"><i class="icon-comment"></i> Settings</a></li>
				  <li><a href="#"><i class="icon-share"></i> Logout</a></li>
				</ul>
			</div>
		</div>
		 -->
		<div id="content">
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
				
		</div>
	</div>
</body>
<?php
	echo $this->Html->script('bootstrap-datepicker');
	echo $this->Html->script('bootstrap.min');
	echo $this->Html->script('script');
?>
</html>
