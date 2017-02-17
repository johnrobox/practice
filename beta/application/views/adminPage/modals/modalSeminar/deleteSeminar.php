<?php foreach($query_seminar as $row) { ?>
<?php if($this->session->userdata('role') == 'superAdmin'){ ?>
        <div class="modal fade" id="deleteSeminar<?php echo $row->seminar_id;?>" tab-index="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"><b>Do you want to delete this?</b></div>
                    <div class="modal-body">
                        <h3 class="text-center"><?php echo $row->seminar_name?></h3>
                        <p>Created by: <?php echo $row->seminar_creator_username?></p>
                    </div>
                    <?php echo form_open(base_url().'deleteSeminar'); ?>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="<?php echo $row->seminar_id;?>"/>
                        <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-default" type="submit">Delete</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>               
    <?php }else{
            if($row->seminar_creator_username == $this->session->userdata('username')){?>
                <div class="modal fade" id="deleteSeminar<?php echo $row->seminar_id;?>" tab-index="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header"><b>Do you want to delete this?</b></div>
                            <div class="modal-body">
                                <h3 class="text-center"><?php echo $row->seminar_name?></h3>
                                <p>Created by: <?php echo $row->seminar_creator_username?></p>
                            </div>
                            <?php echo form_open(base_url().'deleteSeminar'); ?>
                            <div class="modal-footer">
                                <input type="hidden" name="id" value="<?php echo $row->seminar_id;?>"/>
                                <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-default" type="submit">Delete</button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
        <?php }
        }
    }//end of foreach ?>