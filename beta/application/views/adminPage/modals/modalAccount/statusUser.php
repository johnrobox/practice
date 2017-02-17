<?php foreach($query_user as $row) { ?>
<?php if($this->session->userdata('role') == 'superAdmin'){ ?>
    <?php if($row->is_active == 1) {?>
        <div class="modal fade" id="deactivateUser<?php echo $row->id;?>" tab-index="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"><b>Do you want to deactivate this user?</b></div>
                    <div class="modal-body">
                        <h3 class="text-center"><?php echo ucwords($row->firstname).' '. ucwords($row->middlename).' '. ucwords($row->lastname).' ( '. ucwords($row->username).' ) ';?></h3>
                    </div>
                    <?php echo form_open(base_url().'deactivateUser'); ?>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="<?php echo $row->id;?>"/>
                        <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-default" type="submit">Deactivate</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>                                    
    <?php }else {?>
        <div class="modal fade" id="activateUser<?php echo $row->id;?>" tab-index="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"><b>Do you want to activate this user?</b></div>
                    <div class="modal-body">
                        <h3 class="text-center"><?php echo ucwords($row->firstname).' '. ucwords($row->middlename).' '. ucwords($row->lastname).' ( '. ucwords($row->username).' ) ';?></h3>
                    </div>
                    <?php echo form_open(base_url().'activateUser'); ?>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="<?php echo $row->id;?>"/>
                        <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-default" type="submit">Activate</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    <?php }
        }
    }//end of foreach ?>