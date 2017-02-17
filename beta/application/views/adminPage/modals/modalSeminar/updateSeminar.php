<?php foreach($query_seminar as $row) { ?>
<?php if($this->session->userdata('role') == 'superAdmin'){ ?>
        <div class="modal fade" id="updateSeminar<?php echo $row->seminar_id;?>" tab-index="-1" role="dialog">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header text-center"><h3><small>Update</small><br><b><?php echo $row->seminar_name;?></b></h3></div>
			            <div class="modal-body">
			            	<?php echo form_open(base_url().'updateSeminar');?>
				                <div class="panel-body">                 
				                    <div class="form-group">
				                        <div class="input-group">
				                            <span class="input-group-addon"><span class="glyphicon glyphicon-file"></span></span>
				                            <input type="text" class="form-control" name="seminarName" id="seminarName" placeholder="Seminar Name" value="<?php echo $row->seminar_name; ?>" />
				                        </div>
				                    </div>
				                    <div class="form-group">
				                        <div class="input-group">
				                            <span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
				                            <input type="text" class="form-control" name="seminarLocation" id="seminarLocation" placeholder="Seminar Location" value="<?php echo $row->seminar_location; ?>"/>
				                        </div>
				                    </div>
				                    <div class="form-group">
				                        <div class="input-group">
				                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
				                            <input type="text" class="form-control" name="seminarTime" id="seminarTime" placeholder="Seminar Time" value="<?php echo $row->seminar_time; ?>"/>
				                        </div>
				                    </div>
				                    <div class="form-group" id="sandbox-container">
				                        <div class="input-daterange input-group" id="datepicker">
				                            <span class="input-group-addon">
				                                <span class="glyphicon glyphicon-calendar"></span>
				                            </span>
				                            <input type="text" class="form-control" name="seminarDate" placeholder="Seminar Date" value="<?php echo $row->seminar_date; ?>"/>
				                        </div>
				                    </div>
				                    <h3 class="text-center">Registration Schedule</h3> 
				                    <div class="row">
				                    	<div class="col-md-6" id="sandbox-container">
						                    <div class="form-group">
								                <div class="input-daterange input-group" id="datepicker">
								                    <span class="input-group-addon">Starts</span>
								                    <input type="text" class="form-control" name="starts" value="<?php echo $row->seminar_starts; ?>"/>
				                                    <span class="input-group-addon">
				                                        <span class="glyphicon glyphicon-calendar"></span>
				                                    </span>
								                </div>
								            </div>
				                    	</div>
				                    	<div class="col-md-6" id="sandbox-container">
						                    <div class="form-group">
								                <div class="input-daterange input-group" id="datepicker">
								                    <span class="input-group-addon">Ends</span>
								                    <input type="text" class="form-control" name="ends" value="<?php echo $row->seminar_ends; ?>"/>			                
				                                    <span class="input-group-addon">
				                                            <span class="glyphicon glyphicon-calendar"></span>
				                                    </span>
				                                </div>
								            </div>
				                    	</div>
				                    </div>
				                    <input type="hidden" name="id" value="<?php echo $row->seminar_id;?>">
				                    <div class="pull-right">
				                        <button class="btn btn-default" type="reset">Clear All</button>
				                        <button class="btn btn-primary" type="submit">Update</button>
				                    </div>
				                </div>
				            <?php echo form_close();?>	
			            </div>
			        </div>
			    </div>
			</div>                  
    <?php }else{
            if($row->seminar_creator_username == $this->session->userdata('username')){?>
                <div class="modal fade" id="updateSeminar<?php echo $row->seminar_id;?>" tab-index="-1" role="dialog">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header text-center"><h3><small>Update</small><br><b><?php echo $row->seminar_name;?></b></h3></div>
			            <div class="modal-body">
			            	<?php echo form_open(base_url().'updateSeminar');?>
				                <div class="panel-body">                 
				                    <div class="form-group">
				                        <div class="input-group">
				                            <span class="input-group-addon"><span class="glyphicon glyphicon-file"></span></span>
				                            <input type="text" class="form-control" name="seminarName" id="seminarName" placeholder="Seminar Name" value="<?php echo $row->seminar_name; ?>" />
				                        </div>
				                    </div>
				                    <div class="form-group">
				                        <div class="input-group">
				                            <span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
				                            <input type="text" class="form-control" name="seminarLocation" id="seminarLocation" placeholder="Seminar Location" value="<?php echo $row->seminar_location; ?>"/>
				                        </div>
				                    </div>
				                    <div class="form-group">
				                        <div class="input-group">
				                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
				                            <input type="text" class="form-control" name="seminarTime" id="seminarTime" placeholder="Seminar Time" value="<?php echo $row->seminar_time; ?>"/>
				                        </div>
				                    </div>
				                    <div class="form-group" id="sandbox-container">
				                        <div class="input-daterange input-group" id="datepicker">
				                            <span class="input-group-addon">
				                                <span class="glyphicon glyphicon-calendar"></span>
				                            </span>
				                            <input type="text" class="form-control" name="seminarDate" placeholder="Seminar Date" value="<?php echo $row->seminar_date; ?>"/>
				                        </div>
				                    </div>
				                    <h3 class="text-center">Registration Schedule</h3> 
				                    <div class="row">
				                    	<div class="col-md-6" id="sandbox-container">
						                    <div class="form-group">
								                <div class="input-daterange input-group" id="datepicker">
								                    <span class="input-group-addon">Starts</span>
								                    <input type="text" class="form-control" name="starts" value="<?php echo $row->seminar_starts; ?>"/>
				                                    <span class="input-group-addon">
				                                        <span class="glyphicon glyphicon-calendar"></span>
				                                    </span>
								                </div>
								            </div>
				                    	</div>
				                    	<div class="col-md-6" id="sandbox-container">
						                    <div class="form-group">
								                <div class="input-daterange input-group" id="datepicker">
								                    <span class="input-group-addon">Ends</span>
								                    <input type="text" class="form-control" name="ends" value="<?php echo $row->seminar_ends; ?>"/>			                
				                                    <span class="input-group-addon">
				                                            <span class="glyphicon glyphicon-calendar"></span>
				                                    </span>
				                                </div>
								            </div>
				                    	</div>
				                    </div>
				                    <input type="hidden" name="id" value="<?php echo $row->seminar_id;?>">
				                    <div class="pull-right">
				                        <button class="btn btn-default" type="reset">Clear All</button>
				                        <button class="btn btn-primary" type="submit">Update</button>
				                    </div>
				                </div>
				            <?php echo form_close();?>	
			            </div>
			        </div>
			    </div>
			</div>                
        <?php }
        }
 }//end of foreach ?>
			