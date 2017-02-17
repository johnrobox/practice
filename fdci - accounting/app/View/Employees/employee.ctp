
<?php 

	echo $this->Html->css('main');
	echo $this->Html->css('employee');
	echo $this->Html->css('hot.full.min');
	echo $this->Html->css('bootstrap-timepicker.min');
	echo $this->Html->script('hot.full.min');
	echo $this->Html->script('employee');
	echo $this->Html->script('bootstrap-timepicker');
	echo $this->Html->script('bootstrap-timepicker.min');
	echo $this->Html->script('bootbox');

?>


<style>
.datepicker{
	z-index: 1060 !important;
}

#additional-info-container {
	margin: 10px 10px;
}
.bootstrap-timepicker-widget  {
	z-index: 9999;
}
#additional-info-container input {
	width: 400px;
	height: 30px;
}
#loading-BG {
	display: none;
	left: 0;
	top: 0;
	position: fixed;
	z-index: 9999;
	width: 100%;
	height: 100%;
	background: RGBA(0,0,0,0.5);
}
#loading-BG div {
	margin: 5% auto;
	width: 250px;
	background: #fff;
	border-radius: 10px;
}
.contract:hover {
	cursor: pointer;
}
#contract-selections ul {
	list-style-type: none;
	margin: 0;
	padding: 0;
	display: inline-block;
}
#contract-selections li {
	padding: 2px 5px;
}
#contract-selections li button {
	margin: 0px auto;
	font: 10px "Trebuchet MS",sans-serif;
}
#contract-selections {
	position: fixed;
	z-index: 99;
	top: 0;
	left: 0;
	height: 80px;
	background: #f9f9f9;
	border-radius: 2px;
	display: none;
}
</style>

<script>
var baseUrl = "<?php echo $this->webroot; ?>";
</script>

<div id="loading-BG">
	<div>
	<center>
		<?php 
			echo $this->Html->image('icon-loading.gif');
		?>
	</div>
	</center>
</div>
<div id="contract-selections">
	<ul>
	<?php 
		echo $this->Form->input('id', array('type'=>'hidden','id'=>'empID','value' => ''));
		echo "<li>";
		echo $this->Form->button('Add Contract',array(
																			'class' => 'btn btn-primary',
																			'data-toggle' => 'modal',
																			'data-target' => '#modalContract'
																		)
																	);
		echo "</li>";
		echo "<li>";
		echo $this->Form->button('View Contract',array(
																			'class' => 'btn btn-primary View-Contract',
																			'data-toggle' => 'modal',
																			'data-id-contract' => '',
																			'data-target' => '#View-Contract'
																		)
																	);
		echo "</li>";
		echo "<li>";
		echo $this->Form->button('View History',array(
												'class' => 'btn btn-primary',
												'data-toggle' => '',
												'data-target' => '',
												'onclick' => 'SelectHistory()'
												)
											);
		echo "</li>";
	?>
	</ul>
</div>

<!-- Modal -->
<div class="modal hide fade" id="modalContract" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Contract</h4>
        <input type="hidden" id="url" value="<?php echo $this->webroot;?>">
        <div class="bg-padd bg-danger" style="display:none;">
      	</div>
      </div>
      <div class="modal-body">
      <?php
		echo $this->Form->create('Contractlog',array('type' => 'file', 'class' => 'form-horizontal'));
		echo $this->Form->input('id', array('type'=>'hidden','class'=>'empID','value' => ''));
		echo $this->Form->input('Description',
									array('div' => array(
											'class' => 'control-group'
									),
											'name' => 'description',
											'id' => 'txtDescription',
											'type' => 'textarea',
											'class' => 'input-block-level',
											'size' => 16,
											'label' => 'Description',
											'value' => '',
											'escape' => false,
											'placeholder' => ''
									)
							);
		echo $this->Form->input('text',
					array('div' => array(
							'class' => 'control-group'
					),
							'name' => 'date_start',
							'id' => 'dpStart',
							'class' => 'input-block-level',
							'size' => 16,
							'label' => 'Date Start',
							'value' => '',
							'placeholder' => ''
					)
			);
	
		echo $this->Form->input('number',
		    		array('div' => array(
		    				'class' => 'control-group'
		    		),
		    				'name' => 'date_end',
		    				'id' => 'dpEnd',
		    				'class' => 'input-block-level',
		    				'size' => 16,
		    				'label' => 'Date End',
		    				'value' => '',
		    				'placeholder' => ''
		    		)
		    );
	    echo $this->Form->input('numeric',
		    		array('div' => array(
		    				'class' => 'control-group'
		    		),
		    				'name' => 'salary',
		    				'id' => 'txtSalary',
		    				'class' => 'input-block-level',
		    				'size' => 16,
		    				'label' => 'Salary',
		    				'value' => '',
		    				'placeholder' => ''
		    		)
		    );
	   echo $this->Form->input('text',
		    		array('div' => array(
		    				'class' => 'control-group'
		    		),
		    				'name' => 'deminise',
		    				'id' => 'txtDeminise',
		    				'class' => 'input-block-level',
		    				'size' => 16,
		    				'label' => 'Deminise',
		    				'value' => '',
		    				'placeholder' => ''
		    		)
		    );
	   
	   echo $this->Form->input('text',
	   		array('div' => array(
	   				'class' => 'control-group'
	   		),
	   				'name' => 'term',
	   				'id' => 'txtTerm',
	   				'class' => 'input-block-level',
	   				'size' => 16,
	   				'label' => 'Term',
	   				'value' => '',
	   				'placeholder' => ''
	   		)
	   );

	   echo $this->Form->input('positions_id',
						array(
							'div' => 'control-group',
							'type'=>'select',
							'class' => 'input-block-level',
							'label' => 'Position',
						    'name' => 'positions_id',
							'id' => 'contract-position',
							'value' => '',
							'options' => $position,
							'empty' => __('Select'),
						)
			);
	   
	   
	   echo $this->Form->input('position_levels_id',
	   		array(
	   				'div' => 'control-group',
	   				'type'=>'select',
	   				'required' => false,
	   				'class' => 'input-block-level',
	   				'label' => 'Position level',
	   				'name' => 'position_levels_id',
	   				'id' => 'contract-position-level',
	   				'value' => '',
	   				'options' => $positionlevel,
	   				'empty' => __('Select'),
	   		)
	   );
	   
	/* 	$options = array('0'=>'Active','1'=>'Inactive');
		$attributes = array(
				'div' => 'control-group list-container',
				'type' => 'radio',
				'value' => 0,
				'class' => 'list-status', 
				'options' => $options, 
				'default' => 'Y'
		);
		echo $this->Form->input('Status',$attributes); */
	    echo $this->Form->file('document', array('id' => 'uploadDocument','required' => false,'accept' => "/*",'style' => 'display:none;'));
	    echo $this->Form->button('Browse File',
	    		array(
	    				'id' => 'BrowseFile',
	    				'class' => 'btn btn-default'
	    		)
	    );
	    echo $this->Form->button('Submit', array('type' => 'submit','class' => 'btn btn-primary btnContract'));
	    echo $this->Form->end();
		?>
		</div>    		 	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal hide fade" id="View-Contract" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detail</h4>
      </div>
      <div class="modal-body">
			<div class="form-horizontal">
			  <div class="control-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Employees ID:</label>
			    <div class="controls">
			      	<span id="employee-id"></span>
			    </div>
			  </div>
			  <div class="control-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
			    <div class="controls">
			      <span id="description"></span>
			    </div>
			  </div>
			  <div class="control-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Date Start</label>
			    <div class="controls">
			      <span id="date-start"></span>
			    </div>
			 </div>
			 <div class="control-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Date End</label>
			    <div class="controls">
			      <span id="date-end"></span>
			    </div>
			 </div>
			 <div class="control-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Document</label>
			    <div class="controls">
			      <span id="document"></span>
			    </div>
			 </div>
			  <div class="control-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Salary</label>
			    <div class="controls">
			      <span id="salary"></span>
			    </div>
			 </div>
			  <div class="control-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Deminise</label>
			    <div class="controls">
			      <span id="deminise"></span>
			    </div>
			 </div>
			  <div class="control-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Term</label>
			    <div class="controls">
			      <span id="term"></span>
			    </div>
			 </div>
			  <div class="control-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Position</label>
			    <div class="controls">
			      <span id="position"></span>
			    </div>
			 </div>
			  <div class="control-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Position level</label>
			    <div class="controls">
			      <span id="position-level"></span>
			    </div>
			 </div>
		</div>    		 	
      </div>
      <div class="modal-footer">
      	<a href="#" class="btn btn-primary btn-contact-edit">Edit</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true" style="display:none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h2 class="modal-title" id="myModalLabel"> More Information </h2>
        	<big style="color:red;" id="txt-errors"></big>
        </div>
      <div class="modal-body">
      	<form>
			    <div class="form-group" id="additional-info-container">
						<h4 id="lbl-employee"> </h4>
		        <?php
		        		echo $this->Form->Select('Drug Test',array(
		        																	'Passed' => 'Passed',
		        																	'Failed' => 'Failed'
		        																),array(
		        																'empty' => 'Drug Test',
	        																	'name' => 'drug_test',
	        																	'id' => 'drug_test',
	        																	'disabled' => 'disabled',
	        																	'div' => false
	        																	)
	        																);
		        		echo $this->Form->input('Tin No',array(
	        																	'name' => 'tin',
	        																	'id' => 'tin',
	        																	'disabled' => 'disabled',
	        																	'placeholder' => 'Enter Tin No',
	        																	'div' => false
	        																	)
	        																);
		        		echo $this->Form->input('Salary',array(
	        																	'name' => 'salary',
	        																	'id' => 'salary',
	        																	'disabled' => 'disabled',
	        																	'placeholder' => 'Enter Salary',
	        																	'div' => false
	        																	)
	        																);
		        		echo $this->Form->input('Medical No',array(
	        																	'name' => 'medical',
	        																	'id' => 'medical',
	        																	'disabled' => 'disabled',
	        																	'placeholder' => 'Enter Medical',
	        																	'div' => false
	        																	)
	        																);
		        		echo $this->Form->input('Pagibig No',array(
	        																	'name' => 'pagibig',
	        																	'id' => 'pagibig',
	        																	'disabled' => 'disabled',
	        																	'placeholder' => 'Enter Philhealth #',
	        																	'div' => false
	        																	)
	        																);
		        		echo $this->Form->input('Philhealth No',array(
	        																	'name' => 'philhealth',
	        																	'id' => 'philhealth',
	        																	'disabled' => 'disabled',
	        																	'placeholder' => 'Enter Philhealth #',
	        																	'div' => false
	        																	)
	        																);
		        		echo $this->Form->input('Sss No',array(
	        																	'name' => 'sss',
	        																	'id' => 'sss',
	        																	'disabled' => 'disabled',
	        																	'placeholder' => 'Enter SSS #',
	        																	'div' => false
	        																	)
	        																);
		        		echo $this->Form->input('Insurance id',array(
	        																	'name' => 'insurance_id',
	        																	'id' => 'insurance_id',
	        																	'disabled' => 'disabled',
	        																	'placeholder' => 'Enter Insurance ID',
	        																	'div' => false
	        																	)
	        																);
		        		echo $this->Form->input('Username',array(
	        																	'name' => 'username',
	        																	'id' => 'username',
	        																	'disabled' => 'disabled',
	        																	'placeholder' => 'Enter Username',
	        																	'div' => false
	        																	)
	        																);
		        		echo $this->Form->input('Password',array(
		        																'type' => 'password',
	        																	'name' => 'password',
	        																	'id' => 'password',
	        																	'disabled' => 'disabled',
	        																	'placeholder' => 'Enter Password',
	        																	'div' => false
	        																	)
	        																);
		        ?>
		        <span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span>
				  </div>
      </div>
      <div class="modal-footer">
			  <input type="button" value="Edit" class="btn btn-primary" id="btn-submit">
      </div>
    </div>
  </div>
</div>

<div id="employee-container">
	<div id="search-container" class="form-control">
	<h3> Employees </h3>
		<?php 
		echo $this->Form->select('field',
																    array(
																    	'employee_id' => 'Employee ID',
																    	'name' => 'Name',
																    	'position' => 'Position',
																    	'status' => 'Status'
																    ),
																    array(
																    	'empty' => 'Search By',
																    	'id' => 'cbo-category',
																    	'class' => 'form-control'
																    	)
																    );
		echo $this->Form->select('field',
																    array(
																    		2 => 'Inactive',
																    		1 => 'Active'
																    ),
																    array(
																    	'empty' => 'Status',
																    	'id' => 'cbo-status',
																    	'class' => 'form-control'
																    	)
																    );
		echo $this->Form->select('',null,array(
																	'empty' => 'Position',
																	'id' => 'cbo-position',
																  'class' => 'cbo-position'
																)
															);
		echo " ";
		echo $this->Form->select('',null,array(
																	'id' => 'cbo-position-level',
																  'class' => 'cbo-position'
																)
															);
		echo $this->Form->input('',array(
																	'id' => "txt-search",
																	'class' => 'txt-search',
																	'placeholder' => 'Search',
																	'class' => 'form-control',
																	'div' => false,
																	'label' => false
																)
															);
		?>		
	</div>
	<div id="table-employees"></div>
</div>


  <div class="row text-center" style="display:none;">
    <a href="#" class="btn btn-lg btn-primary" id="btn-select" data-toggle="modal" data-target="#largeModal">Click to open Modal</a>
	</div>

	<div class="input-group-addon"> 
	<span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span>
	</div>