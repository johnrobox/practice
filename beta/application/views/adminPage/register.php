<div class="login-wrapper">   
    <img src="<?php echo base_url().'images/header.png';?>" class="img-responsive login-logo"/>
    <hr>
     <h2 class="text-center"><strong>Create an Account</strong></h2>
        <div class="row">
            <?php echo form_open(base_url().'register');?>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="input-group col-md-12">
                            <label for="firstname">First Name</label><span class="required"><?php echo form_error('firstname');?></span>
                            <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo set_value('firstname'); ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group col-md-12">
                            <label for="middlename">Middle Name</label><span class="required"><?php echo form_error('middlename');?></span>
                            <input type="text" class="form-control" name="middlename" id="middlename" value="<?php echo set_value('middlename'); ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group col-md-12">
                            <label for="lastname">Last Name</label><span class="required"><?php echo form_error('lastname');?></span>
                            <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo set_value('lastname'); ?>" />
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="input-group col-md-12">
                            <label for="username">Username</label><span class="required"><?php echo form_error('Username');?></span>
                            <input type="text" class="form-control" name="Username" id="username" value="<?php echo set_value('Username'); ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group col-md-12">
                            <label for="email">Email Address</label><span class="required"><?php echo form_error('EmailAdd');?></span>
                            <input type="text" class="form-control" name="EmailAdd" id="email" value="<?php echo set_value('EmailAdd');?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group col-md-12">
                            <label for="password">Password</label><span class="required"><?php echo form_error('Password');?></span>
                            <input type="password" class="form-control" name="Password" id="password" value="<?php echo set_value('Password');?>" />
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="input-group col-md-12">
                            <label for="cpassword">Confirm Password</label><span class="required"><?php echo form_error('CPassword');?></span>
                            <input type="password" class="form-control" name="CPassword" id="cpassword" value="<?php echo set_value('CPassword');?>" />
                        </div>
                    </div> 
               
    <hr>
                    <div class="pull-right">
                        <button class="btn btn-default " type="reset">Clear All</button>
                        <button class="btn btn-primary " type="submit">Register</button>
                    </div>
                    <a href="<?php echo base_url().'admin';?>">Already have an account?</a>
                </div>
            </div>
            <?php echo form_close();?>
                <div class="text-center">
                   <small>All rights reserved. Jellyfish Education Consultancy</small>
                </div>
</div>