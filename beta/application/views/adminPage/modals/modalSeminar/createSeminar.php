<div class="modal fade" id="createSeminar" tab-index="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h3><b>Create new Seminar</b></h3></div>
            <div class="modal-body">
            	<?php echo form_open(base_url().'create-seminar');?>
	                <div class="panel-body">                 
	                    <div class="form-group">
	                            <span class="required text-center"><?php echo form_error('seminarName');?></span>
	                        <div class="input-group">
	                            <span class="input-group-addon"><span class="glyphicon glyphicon-file"></span></span>
	                            <input type="text" class="form-control" name="seminarName" id="seminarName" placeholder="Seminar Name" value="<?php echo set_value('seminarName'); ?>" />
	                        </div>
	                    </div>
	                    <div class="form-group">
	                            <span class="required text-center"><?php echo form_error('seminarLocation');?></span>
	                        <div class="input-group">
	                            <span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
	                            <input type="text" class="form-control" name="seminarLocation" id="seminarLocation" placeholder="Seminar Location" value="<?php echo set_value('seminarLocation'); ?>"/>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                            <span class="required text-center"><?php echo form_error('seminarTime');?></span>
	                        <div class="input-group">
	                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
	                            <input type="text" class="form-control" name="seminarTime" id="seminarTime" placeholder="Seminar Time" value="<?php echo set_value('seminarTime'); ?>"/>
	                        </div>
	                    </div>
	                    <div class="form-group" id="sandbox-container">
	                        <span class="required text-center"><?php echo form_error('seminarDate');?></span>
	                        <div class="input-daterange input-group" id="datepicker">
	                            <span class="input-group-addon">
	                                <span class="glyphicon glyphicon-calendar"></span>
	                            </span>
	                            <input type="text" class="form-control" name="seminarDate" placeholder="Seminar Date" value="<?php echo set_value('seminarDate'); ?>"/>
	                        </div>
	                    </div>
	                    <h3 class="text-center">Registration Schedule</h3> 
	                    <div class="row">
	                    	<div class="col-md-6" id="sandbox-container">
			                    <div class="form-group">
	                            	<span class="required text-center"><?php echo form_error('starts');?></span>
					                <div class="input-daterange input-group" id="datepicker">
					                    <span class="input-group-addon">Starts</span>
					                    <input type="text" class="form-control" name="starts" value="<?php echo set_value('starts'); ?>"/>
	                                    <span class="input-group-addon">
	                                        <span class="glyphicon glyphicon-calendar"></span>
	                                    </span>
					                </div>
					            </div>
	                    	</div>
	                    	<div class="col-md-6" id="sandbox-container">
			                    <div class="form-group">
	                            	<span class="required text-center"><?php echo form_error('ends');?></span>
					                <div class="input-daterange input-group" id="datepicker">
					                    <span class="input-group-addon">Ends</span>
					                    <input type="text" class="form-control" name="ends" value="<?php echo set_value('ends'); ?>"/>			                
	                                    <span class="input-group-addon">
	                                            <span class="glyphicon glyphicon-calendar"></span>
	                                    </span>
	                                </div>
					            </div>
	                    	</div>
	                    </div>
	                    <div class="pull-right">
	                        <button class="btn btn-default" type="reset">Clear All</button>
	                        <button class="btn btn-primary" type="submit">Create</button>
	                    </div>
	                </div>
	            <?php echo form_close();?>	
            </div>
        </div>
    </div>
</div>   