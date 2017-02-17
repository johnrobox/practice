<div class="container-fluid">
	<div class="row-fluid">
		<div class="sm-container main-content box-center">
	         <h3 class="modal-title" id="myModalLabel">Privilege</h3>
	         <input type="hidden" id="url" value="/">
	     	 <div class="privelege-content-form">
	     	 
	     	 		<?php 

	     	 		if(!empty($errors)){
	     	 			echo '<div class="bg-padd bg-danger">';
	     	 			foreach ($errors as $row){
	     	 				echo '<p class="alert alert-error">'.$row[0].'</p>';
	     	 					
	     	 			}
	     	 			echo '</div>';
	     	 		}
	     	 		
	     	 		echo $this->Form->create('Privilege', array('class' => 'form-horizontal', 'url' => '/admin/privileges/add'));
	     	 		
	     	 		echo $this->Form->input('roles_id',array(
									'div' => 'control-group',
									'type' => 'select',
									'class' => 'input-block-level',
									'label' => 'Role:',
	     	 						'required' => true,
									'name' => 'roles_id',
									'value' => $temp['roles_id'],
									'options' => $roles,
									'empty' => __('Select'),
							));
	     	 		?>
	     	 	<!-- 	<div class="row-fluid">
	     	 				<a href="#" class="add-input"><i class="fa fa-plus-square"></i> ADD</a>
	     	 		</div> -->
	     	 		<div class="path-container">
	     	 			<div class="input-group-data">
	     	 			<?php  			
	     	 			echo $this->Form->input('text',
	     	 					array('div' => array(
	     	 							'class' => 'control-group span6'
	     	 					),
	     	 							'name' => 'controller',
	     	 							'id' => 'txtController',
	     	 							'class' => 'input-block-level',
	     	 							'label' => 'Controller:',
	     	 							'value' => $temp['controller'],
										'required' => true,
	     	 							'placeholder' => ''
	     	 					)
	     	 			);
	     	 			
						echo $this->Form->input('text',
											array('div' => array(
													'class' => 'control-group span6'
											),
													'name' => 'action',
													'id' => 'txtAction',
													'class' => 'input-block-level',
													'label' => 'Action:',
													'value' => $temp['action'],
													'required' => true,
													'placeholder' => ''
											)
									);
						
	     	 			?>
	     	 			</div>
	     	 		</div>
	     	 		<?php 
	     	 		
					echo $this->Form->input('text',
									array('div' => array(
											'class' => 'control-group'
									),
											'name' => 'description',
											'id' => 'txtDescription',
											'class' => 'input-block-level',
											'label' => 'Description:',
											'value' => $temp['description'],
											'placeholder' => ''
									)
							);
						     	 		
					echo $this->Form->button('Submit', array('type' => 'submit','class' => 'btn btn-primary'));
	     	 		echo $this->Form->end();
	     	 		?>
	     	 </div>
		</div>
	</div>
</div>