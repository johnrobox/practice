<?php foreach ($query_seminar_result->result_array() as $query_row){?>

  <div class="container">
      <div class="row">
          <div class="col-md-3" id="sidebar"><!--left col-->
                
            <ul class="list-group sticky" id="widget">
              <li class="list-group-item text-muted text-center">
              <img src="<?php  
                if($query_row['seminar_pic'] == ''){
                  echo base_url().'/images/default-image.jpg';}
                  else{
                  echo base_url().$query_row['seminar_pic'];}
                ?>" 
                class="img-responsive" width="300px" height="300px">
              <br><form action="<?php echo base_url().'upload-image'?>" method="POST" enctype="multipart/form-data"><input type="file" name="userfile"><input type="hidden" name="seminar_id" value="<?php echo $query_row['seminar_id'];?>"><button type="submit" class="btn btn-xs btn-block btn-primary">Upload</button></form></li>
              <li class="list-group-item text-right"><span class="pull-left brand-color-body"><small>Seminar Name: </small></span> <strong><?php echo $query_row['seminar_name'];?></strong></li>
              <li class="list-group-item text-right"><span class="pull-left brand-color-body"><small>Seminar Location: </small></span> <strong><?php echo $query_row['seminar_location'];?></strong></li>
              <li class="list-group-item text-right"><span class="pull-left brand-color-body"><small>Created by: </small></span> <strong><?php echo $query_row['seminar_creator_username'];?></strong></li>
              <li class="list-group-item text-right"><span class="pull-left brand-color-body"><small>Date Created: </small></span> <strong><?php echo date('F d, Y',strtotime($query_row['seminar_d_o_c']));?></strong></li>
              <li class="list-group-item text-right"><span class="pull-left brand-color-body"><small>Seminar Time: </small></span> <strong><?php echo $query_row['seminar_time'];?></strong></li>
              <li class="list-group-item text-right"><span class="pull-left brand-color-body"><small>Seminar Date: </small></span> <strong><?php echo  date('F d, Y',strtotime($query_row['seminar_date']));?></strong></li>
              <li class="list-group-item text-right"><span class="pull-left brand-color-body"><small>Registration Starts: </small></span> <strong><?php echo date('F d, Y',strtotime($query_row['seminar_starts']));?></strong></li>
              <li class="list-group-item text-right"><span class="pull-left brand-color-body"><small>Registration Ends: </small></span> <strong><?php echo date('F d, Y',strtotime($query_row['seminar_ends']))?></strong></li>
              <li class="list-group-item text-right"><span class="pull-left brand-color-body"><small>Status: </small></span> 
                <?php
                  if($this->session->userdata('role') == 'superAdmin'){
                    if($query_row['seminar_is_active'] == 0){ ?>
                      Not Active (<a href="#activateSeminar<?php echo $query_row['seminar_id'];?>" data-toggle="modal" title="Activate">Activate</a>)
                    <?php }else{?>
                      Active (<a href="#deactivateSeminar<?php echo $query_row['seminar_id'];?>" data-toggle="modal" title="Deactivate">Deactivate</a>)
                    <?php }
                  }else{
                    if($query_row['seminar_creator_username'] != $this->session->userdata('username')){
                      if($query_row['seminar_is_active'] == 0){
                        echo "Not Active (You can't activate this.)";
                       }else{
                        echo "Active (You can't deactivate this.)";
                       }
                    }else{
                        if($query_row['seminar_is_active'] == 0){?>
                          Not Active (<a href="#activateSeminar<?php echo $query_row['seminar_id'];?>" data-toggle="modal" title="Activate">Activate</a>)
                        <?php }else{?>
                          Active (<a href="#deactivateSeminar<?php echo $query_row['seminar_id'];?>" data-toggle="modal" title="Deactivate">Deactivate</a>)
                        <?php }
                       }
                    }
                ?>
              </li>
              <li class="list-group-item text-right">
                <?php
                  if($this->session->userdata('role') == 'superAdmin'){
                      echo form_open(base_url().'update-seminar');?>
                      <div style="margin: 0 auto;">
                      <a href="#updateSeminar<?php echo $query_row['seminar_id'];?>" class="btn btn-default" data-toggle="modal" title="Update">Update</a>
                      <a href="#deleteSeminar<?php echo $query_row['seminar_id'];?>" class="btn btn-default" data-toggle="modal" title="Delete">Delete</a>
                      </div>
              <?php }else{ 
                          if($query_row['seminar_creator_username'] != $this->session->userdata('username')){
                            echo '';
                          }else{
                            echo form_open(base_url().'update-seminar');?>
                            <div style="margin: 0 auto;">
                            <input type="hidden" name="id" value="<?php echo $query_row["seminar_id"];?>"/>
                            <?php echo '<button class="btn btn-default">Update</button>';
                            echo form_close();?>
                            <a href="#deleteSeminar<?php echo $query_row['seminar_id'];?>" class="btn btn-default" data-toggle="modal" title="Delete">Delete</a>
                            </div>
                       <?php }

                        }
                ?>
              </li>
            </ul> 
          </div><!--/col-3-->

          <div class="col-sm-9">
            <ul class="nav nav-tabs" id="myTab">
              <li class="active"><a href="" data-toggle="tab">Registered Users</a></li> 
               
                
            <div class="tab-content">
              <div class="tab-pane active">
                <hr> 
                <div class="table-responsive">
                  <table class="table table-hover"> 
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Address</th>
                            <th>Email Address</th>
                            <th>Contact Number</th>
                            <th>Found</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $ctr = 0;
                        foreach ($query_registrants as $row) {
                          if($row->lastname != ''){
                            $ctr += 1;
                          }
                        }
                        if($ctr>0){$ctrIn = 0;
                          foreach ($query_registrants as $row) {
                      ?> 
                                   <tr><td><?php echo $ctrIn += 1;?></td>
                                      <td><?php echo $row->firstname.' '.$row->middlename.' '.$row->lastname?></td>
                                      <td><?php echo $row->age;?></td>
                                      <td><?php echo $row->address;?></td>
                                      <td><?php echo $row->email;?></td>
                                      <td><?php echo $row->con_number;?></td>
                                      <td><?php echo $row->found;?></td>
                                   </tr>
                      <?php
                        }}else{
                          echo '<h3 class="text-center"><strong>There are no Registrants for this.</strong></h3>';
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
               <?php echo $links;?>
                
               </div><!--/tab-pane--> 
            </div><!--/tab-content-->
          </div><!--/col-9-->
      </div><!--/row-->
  </div>
<?php }?>