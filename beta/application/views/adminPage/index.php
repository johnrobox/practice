<div class="login-wrapper">    
          <h2 class="text-center"><strong>LOGIN</strong></h2>
            <?php echo form_open(base_url().'admin');?>
                <div class="panel-body">
                    <?php if($this->session->userdata('error_logged_in')!=''){?>
                        <div class="text-center alert alert-danger">
                         <?php 
                         echo $this->session->userdata('error_logged_in');
                         $data  =   array('error_logged_in'=>'');
                         $this->session->unset_userdata($data);
                         $this->session->sess_destroy();
                         ?>   
                        </div> 
                    <?php }?>
                    <div class="form-group">
                            <span class="required text-center"><?php echo form_error('username');?></span>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" />
                        </div>
                    </div>
                    <div class="form-group">
                            <span class="required text-center"><?php echo form_error('password');?></span>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
                        </div>
                    </div> 
    <hr>
                    <div class="pull-right">
                        <button class="btn btn-default " type="reset">Clear All</button>
                        <button class="btn btn-primary " type="submit">Login</button>
                    </div>
                    <a href="<?php echo base_url().'register';?>">Don't have an account?</a>
                </div>
            <?php echo form_close();?>
</div>