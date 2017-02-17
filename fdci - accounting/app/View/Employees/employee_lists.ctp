
<?php 
	echo $this->Html->css('employee');
	echo $this->Html->css('hot.full.min');
	echo $this->Html->css('bootstrap-timepicker.min');
	echo $this->Html->script('hot.full.min');
	echo $this->Html->script('employee');
	echo $this->Html->css('employee-edit-profile');
	echo $this->Html->script('bootstrap-timepicker');
	echo $this->Html->script('bootstrap-timepicker.min');
	echo $this->Html->script('bootbox');
?>

<script>
var baseUrl = "<?php echo $this->webroot; ?>";
</script>

<div class="container-fluid">
	<div class="row-fluid">
		<div id="employee-container" class="main-content">
			<div id="search-container" class="form-control">
			<h3> Employees </h3>
				<?php 
				echo $this->Form->select('field',
																		    array(
																		    	'employee-id' => 'Employee ID',
																		    	'name' => 'Name',
																		    	'nick-name' => 'Nick Name',
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
																		    		2 => 'Active',
																		    		1 => 'Inactive',
																		    		0 => 'Deleted'
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
				echo " ";
				echo $this->Form->button('Search',array(
																		'class' => 'btn btn-inverse',
																		'id' => 'btn-search'
																		)
																	);
				?>
			</div>
			<div id="guides-container">
				<legend> Guides </legend>
					<ul>
						<li> <span> How to add new row </span> </li>
						<li> <span> How to edit a row </span> </li>
						<li> <span> How to Select Shift </span> </li>
						<li> <span> How to add contract </span> </li>
					</ul>
			</div>
			<div class="add-cont">
				<a href="#" data-toggle="modal" data-target='#addNewProfile'><i class="fa fa-plus-square"></i> ADD NEW PROFILE</a>
			</div>	
			<div id="table-employees"></div>
		</div>
	</div>
</div>
<div id="contract-selections">
	<ul>
	<?php 
		echo $this->Form->input('id', array('type'=>'hidden','id'=>'empID','value' => ''));
		echo "<li>";
		echo $this->Form->button('Add Contract',array(
																			'class' => 'btn btn-primary btn-Addcontract',
																			'data-toggle' => 'modal',
																			'data-target' => '#modalContract',
																			'onclick' => ''
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
		echo $this->Html->link('View History','',array(
												'class' => 'btn btn-primary',
												'data-toggle' => '',
												'data-target' => '',
												'id' => 'btn-view-contract-log',
												'target' => 'blank',
												'style' => 'font-size:10px;height:15px;'
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
		echo $this->Form->create('Contractlog',array('type' => 'file', 'class' => 'form-horizontal', 'id' => 'ContractlogIndexForm'));
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
											'required' => true,
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
							'required' => true,
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
							'required' => true,
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
							'required' => true,
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
							'required' => true,
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
					'required' => true,
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
							'required' => true,
							'options' => $position,
							'empty' => __('Select'),
						)
			);
	   
	   
	   echo $this->Form->input('position_levels_id',
	   		array(
	   				'div' => 'control-group',
	   				'type'=>'select',
	   				'required' => true,
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
	   	   
		?>
		</div>    		 	
      </div>
      <div class="modal-footer">
      	<?php 
      	
      	echo $this->Form->file('document', array('id' => 'uploadDocument','required' => false,'accept' => "application/pdf",'style' => 'display:none;'));
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
      		<h5 class="notice alert alert-info" style="display:none; "> No contract available </h5>
      		<div class="contract-detail-modal" id="form-contract">
	      		<div class="detail-title alert alert-info">
	      			<div class="row-fluid">
		      			<div class="span6">
			      			<h5><i class="icon-user"></i> Employee ID:</h5>
			      			<span id="employee-id"></span>
		      			</div>
		      			<div class="span6">
			      			<h5><i class="icon-calendar"></i> Date:</h5>
			      			<span id="date-start"></span> to
			      			<span id="date-end"></span>
		      			</div>
	      			</div>
	      		</div>
	      		
	      		<div class="detail-content alert alert-info">
	      			<div class="row-fluid">
	      				<div class="span6">
			      			<h5><i class="icon-info-sign"></i> Job Description:</h5>
			      			<span id="position-level"></span>	 
			      			<span id="position"></span>     			
		      			</div>
		      			<div class="span3">
			      			<h5><i class="fa fa-usd"></i> Salary:</h5>
			      			<span id="salary"></span>  			
		      			</div>
		      			<div class="span3">
			      			<h5><i class="fa fa-money"></i> Deminise:</h5>
			      			<span id="deminise"></span>			
		      			</div>
			      		<div class="row-fluid">
			      			<div class="span12">
				      			<h5><i class="icon-info-sign"></i> Description:</h5>
				      			<span id="description"></span>
			      			</div>
		      			</div>
	      			</div>
	      		</div>
	      		
	      		<div class="detail-footer alert alert-info">
	      			<div class="row-fluid">
		      			<div class="span6">
				      			<h5><i class="icon-info-sign"></i> Term:</h5>
				      			<span id="term"></span>
			      		</div>
			      		<div class="span6">
			      			<h5><i class="fa fa-folder-open"></i> Contract Pdf:</h5>
			      			 <div class="controls">
				     		 	<a href="#" id="link-doc"><span id="document"></span></a>
				    		</div>
			      		</div>
		      		</div>
	      		</div>  		
      		</div>
		</div>    		 	
      </div>
      <div class="modal-footer">
      	<a href="#" class="btn btn-primary btn-contact-edit" target="blank">Edit</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modalAccounts" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true" style="display:none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h2 class="modal-title" id="myModalLabel"> ACCOUNTS </h2>
				<big style="color:red;" id="txt-errors"></big>
       </div>
      <div class="modal-body">
			    <div class="form-group" id="additional-info-container">
						<h4 id="lbl-employee"> </h4>
		        <?php
		        		echo "Drug Test<br>";
		        		echo $this->Form->Select('Drug Test',array(
		        																	'Passed' => 'Passed',
		        																	'Failed' => 'Failed'
		        																),array(
		        																'empty' => 'Drug Test',
	        																	'name' => 'drug_test',
	        																	'id' => 'drug_test',
	        																	'disabled' => 'disabled'
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


<div class="modal fade" id="modalViewProfile" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true" style="display:none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <?php echo $this->form->create('post',array(
																		'id' => 'ProfileRegister',
																		'class' => 'form-horizontal'  																		
																		)
																	);
    ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h2 class="modal-title" id="myModalLabel"> PROFILE </h2>
				<big style="color:red;" id="txt-errors"></big>
       </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
			  <?php echo $this->form->submit('Update',array(
			  																'class' => 'btn btn-primary',
			  																'onclick' => 'updateProfile()'
			  															)
			  														);
			  ?>
      </div>
    </div>
    <?php echo $this->form->end;?>
  </div>
</div>


<div class="modal fade" id="addNewProfile" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true" style="display:none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h2 class="modal-title" id="myModalLabel">Add New Profile</h2>
         <div class="bg-padd bg-danger" style="display:none;">
      	</div>
       </div>
       <?php 
       		echo $this->Form->create('Profile',array('type' => 'file', 'class' => 'form-horizontal', 'id'=>'ProfileRegister'));
       ?>
      <div class="modal-body">
      	<div class="img-cont">
			<div class="img-prev">
				<?php echo $this->Html->image('emptyprofile.jpg', array('alt' => 'CakePHP', 'id' => 'img_preview', 'class' => 'img-responsive')); ?>
			</div>
		</div>
		<?php 
				echo $this->Form->file('picture', array('id' => 'uploadFile','required' => false,'accept' => "image/*",'style' => 'display:none;'));
				echo $this->Form->button('Browse Photo', 
											array(
												'id' => 'BrowsePhoto',
												'class' => 'btn btn-success control-group'
											)
						);
				echo $this->Form->input('text',
									array('div' => array(
											'class' => 'control-group'
										),
										 'name' => 'first_name',
										 'id' => 'txtName',
										 'class' => 'input-block-level',
										 'size' => 16,
										 'label' => 'First name',
										 'after' => '',
										 'value' => '',
										 'placeholder' => ''
									)
								);
				echo $this->Form->input('text',
											array('div' => array(
													'class' => 'control-group'
											),
													'name' => 'last_name',
													'id' => 'txtLastName',
													'class' => 'input-block-level',
													'size' => 16,
													'label' => 'Last Name',
													'value' => '',
													'placeholder' => ''
											)
									);
				echo $this->Form->input('text',
												array('div' => array(
														'class' => 'control-group'
												),
														'name' => 'middle_name',
														'id' => 'txtMiddleName',
														'class' => 'input-block-level',
														'size' => 16,
														'label' => 'Middel Name',
														'value' => '',
														'placeholder' => ''
												)
										);
				echo $this->Form->input('text',
						array('div' => array(
								'class' => 'control-group'
						),
								'name' => 'nick_name',
								'id' => 'txtnick_name',
								'class' => 'input-block-level',
								'size' => 16,
								'label' => 'Nickname',
								'value' => '',
								'placeholder' => ''
						)
				);
				echo $this->Form->input('date',
										array('div' => array(
												'class' => 'control-group input-group date',
												'id' => '',
												'data-date' =>'12-02-2012',
												'data-date-format'=>'yyyy-mm-dd',
											),
												'name' => 'birthdate',
												'id' => 'dp3',
												'class' => 'input-block-level ',
												'size' => 16,
												'label' => 'Birth date',
												'value' => '',
												'after' => ' <div class="input-group-addon"> <span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span></div>',
												'placeholder' => ''
										)
								);
				echo $this->Form->input('number',
				    		array('div' => array(
				    				'class' => 'control-group'
				    		),
				    				'name' => 'contact',
				    				'id' => 'txtContact',
				    				'class' => 'input-block-level',
				    				'size' => 16,
				    				'label' => 'Contact',
				    				'value' => '',
				    				'placeholder' => ''
				    		)
				    );
				echo $this->Form->input('email',
				    		array('div' => array(
				    				'class' => 'control-group'
				    		),
				    				'name' => 'facebook',
				    				'id' => 'txtFacebook',
				    				'class' => 'input-block-level',
				    				'size' => 16,
				    				'label' => 'Facebook',
				    				'value' => '',
				    				'placeholder' => ''
				    		)
				    );
				echo $this->Form->input('email',
				    		array('div' => array(
				    				'class' => 'control-group'
				    		),
				    				'name' => 'email',
				    				'id' => 'txtEmail',
				    				'class' => 'input-block-level',
				    				'size' => 16,
				    				'label' => 'Email',
				    				'value' => '',
				    				'placeholder' => ''
				    		)
				    );
				echo $this->Form->input('gender',
									array(
										'div' => 'control-group',
										'type'=>'select',
										'class' => 'input-block-level',
										'label' => 'Gender',
									    'name' => 'gender',
										'value' => '',
										'options' => array(
												'M' => 'MALE',
												'F' => 'FEMALE',
										),
										'empty' => __('Select'),
									)
						);
			    echo $this->Form->input('Address',
				    		array('div' => array(
				    				'class' => 'control-group'
				    		),
				    				'name' => 'address',
				    				'id' => 'txtAddress',
				    				'class' => 'input-block-level',
				    				'size' => 16,
				    				'type' => 'textarea',
				    				'label' => 'Address',
				    				'value' => '',
				    				'placeholder' => ''
				    		)
				    );
			   echo $this->Form->input('text',
				    		array('div' => array(
				    				'class' => 'control-group'
				    		),
				    				'name' => 'contact_person',
				    				'id' => 'txtContact',
				    				'class' => 'input-block-level',
				    				'size' => 16,
				    				'label' => 'Contact Person',
				    				'value' => '',
				    				'placeholder' => ''
				    		)
				    );
				echo $this->Form->input('number',
				    		array('div' => array(
				    				'class' => 'control-group list-container'
				    		),
				    				'name' => 'contact_person_no',
				    				'id' => 'txtContactNo',
				    				'class' => 'input-block-level',
				    				'size' => 16,
				    				'label' => 'Contact Person Number',
				    				'value' => '',
				    				'placeholder' => ''
				    		)
				    );
		?>
      </div>
      <div class="modal-footer">
			  <?php 
				  echo $this->Form->file('signature', array('id' => 'uploadSignature','required' => false,'accept' => "image/*",'style' => 'display:none;'));
				  echo $this->Form->button('Browse Signature',
				  		array(
				  				'id' => 'BrowseSignature',
				  				'class' => 'btn btn-default'
				  		)
				  );
				  echo $this->Form->button('Submit', array('type' => 'submit','class' => 'btn btn-primary', 'id' => 'btnAddProfile'));
			  ?>
      </div>
      <?php 
     	 echo $this->Form->end();
      ?>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal hide fade" id="modalShift" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	    <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <legend class="modal-title" id="myModalLabel"> Employee Shift Master </legend>
	       </div>
			</div> 		 	
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

	<div class="input-group-addon"> 
	<span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span>
	</div>
<div class="layout-transparent" style="display:none;">	
	<div class="loading-gif">
		<img src="<?php echo $this->webroot;?>img/icon-loading.gif" class="img-responsive"/>
	</div>
</div>	
