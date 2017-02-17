

                    <?php 
                    if($this->session->userdata('role') == 'superAdmin'){
                        if($row->seminar_is_active==1){ ?>
                                <a href="#deactivateSeminar<?php echo $row->seminar_id;?>" class="btn btn-default" data-toggle="modal" title="Deactivate"><i class="glyphicon glyphicon-remove"></i></a>
                        <?php }else{?>
                                <a href="#activateSeminar<?php echo $row->seminar_id;?>" class="btn btn-default" data-toggle="modal" title="Activate"><i class="glyphicon glyphicon-ok"></i></a>
                        <?php } ?>
                                <?php echo form_open(base_url().'update-seminar'); ?>
                                    <input type="hidden" name="id" value="<?php echo $row->seminar_id;?>"/>
                                    <button class="btn btn-default"><i class="glyphicon glyphicon-pencil"></i></button>
                                <?php echo form_close(); ?>
                                <a href="#deleteSeminar<?php echo $row->seminar_id;?>" class="btn btn-default" data-toggle="modal" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                    <?php }else{
                        if($row->seminar_creator_username != $this->session->userdata('username')){
                            echo 'No action is available';
                        }else{
                    ?>
                        <?php if($row->seminar_is_active==1){ ?>
                                <a href="#deactivateSeminar<?php echo $row->seminar_id;?>" class="btn btn-default" data-toggle="modal" title="Deactivate"><i class="glyphicon glyphicon-remove"></i></a>
                        <?php }else{?>
                                <a href="#activateSeminar<?php echo $row->seminar_id;?>" class="btn btn-default" data-toggle="modal" title="Activate"><i class="glyphicon glyphicon-ok"></i></a>
                        <?php } ?>
                                <?php echo form_open(base_url().'update-seminar'); ?>
                                    <input type="hidden" name="id" value="<?php echo $row->seminar_id;?>"/>
                                    <button class="btn btn-default"><i class="glyphicon glyphicon-pencil"></i></button>
                                <?php echo form_close(); ?>
                                <a href="#deleteSeminar<?php echo $row->seminar_id;?>" class="btn btn-default" data-toggle="modal" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                    <?php }}?>