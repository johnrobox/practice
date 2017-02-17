<div class="container">
	<div class="row">
		<div class="col-md-8 wrapper">
			<h2 class="text-center"><strong>Update Seminar</strong></h2>
			 <hr>
			<?php echo form_open(base_url().'updateSeminar');
                foreach ($query_seminar_result->result_array() as $query_row){
            ?>
                <div class="panel-body">                 
                    <div class="form-group">
                            <span class="required text-center"><?php echo form_error('seminarName');?></span>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-file"></span></span>
                        <input type="text" class="form-control" name="seminarName" id="seminarName" placeholder="Seminar Name" value="<?php echo $query_row['seminar_name'];?>" />
                        </div>
                    </div>
                    <div class="form-group">
                            <span class="required text-center"><?php echo form_error('seminarLocation');?></span>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
                            <input type="text" class="form-control" name="seminarLocation" id="seminarLocation" placeholder="Seminar Location" value="<?php echo $query_row['seminar_location']; ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                            <span class="required text-center"><?php echo form_error('seminarTime');?></span>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                            <input type="text" class="form-control" name="seminarTime" id="seminarTime" placeholder="Seminar Time" value="<?php echo $query_row['seminar_time']; ?>"/>
                        </div>
                    </div>
                    <div class="form-group" id="sandbox-container">
                        <span class="required text-center"><?php echo form_error('seminarDate');?></span>
                        <div class="input-daterange input-group" id="datepicker">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            <input type="text" class="form-control" name="seminarDate" placeholder="Seminar Date" value="<?php echo $query_row['seminar_date']; ?>"/>
                        </div>
                    </div>
                    <h3 class="text-center">Registration Schedule</h3> 
                    <div class="row">
                    	<div class="col-md-6" id="sandbox-container">
		                    <div class="form-group">
                            	<span class="required text-center"><?php echo form_error('starts');?></span>
				                <div class="input-daterange input-group" id="datepicker">
				                    <span class="input-group-addon">
				                        Registration starts
				                    </span>
				                    <input type="text" class="form-control" name="starts" value="<?php echo $query_row['seminar_starts']; ?>"/>
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
				                    <span class="input-group-addon">
				                        Registration ends
				                    </span>
				                    <input type="text" class="form-control" name="ends" value="<?php echo $query_row['seminar_ends']; ?>"/>
				                    <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
				                </div>
				            </div>
                    	</div>
                    </div>
                        <input type="hidden" name="id" value="<?php echo $query_row['seminar_id'];?>"/>
                    <div class="pull-right">
                        <button class="btn btn-default" type="reset">Cancel</button>
                        <button class="btn btn-primary" type="submit">Done</button>
                    </div>
                </div>
            <?php }echo form_close();?>	
		</div>
        <div class="col-md-1"></div>
		<div class="col-md-3 wrapper list-seminar">
			<h3 class="text-center"><strong><span class="glyphicon glyphicon-th-list"></span> List</strong></h3><hr>              
                <?php foreach ($query_seminar as $row) {
                    echo '<h5><strong>'.$row->seminar_name.'</strong></h5>
                        <ul>';
                    if($row->seminar_is_active == 1){
                        echo '<li> Active </li>';
                    }else{
                        echo '<li> Not active </li>';
                    }
                    echo '
                            <li> by '.$row->seminar_creator_username.'</li>
                        </ul><br><hr>';
                }?>
            </table>
		</div>
	</div>
</div>