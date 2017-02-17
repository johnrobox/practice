<div class="container">
 	<div class="row">
		<div class="md-container main-content">
		<input type="hidden" id="url" value="<?php echo $this->webroot; ?>">
		<h3>Privilege List</h3>
			<div id="search-role-container" class="form-control">
			<?php 
				echo $this->Form->create('Privilege',array('id' => 'Privlegelist','type' => 'get','action' => 'privilege_list'));
				echo $this->Form->select('field',
						array(
								'roles' => 'Roles',
								'controller' => 'Controller',
								'action' => 'Action'
						),
						array(
								'name' => 'action',
								'empty' => 'Search By',
								'id' => 'cbo-category',
								'value' => $action,
								'class' => 'form-control'
						)
				);
				echo $this->Form->input('text',array(
								'div' => false,
								'name' => 'search',
								'id' => 'txtsearch',
								'value' => $search,
								'label' => false
	
							));
			   echo $this->Form->end();
			?>		
		</div>
		<table class="table">
              <thead>
                <tr>
                  <th>Roles:</th>
                  <th>Controller</th>
                  <th>Action</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>
                 	 <a href="<?php echo $this->webroot; ?>privileges/" class="btn pull-right" ><i class="icon-plus-sign"></i> ADD</a>
                  </th>
                </tr>
              </thead>
              <tbody>
              <?php
              	 foreach ($data as $row){
              ?>
                <tr class="role-id-<?php echo $row['Privilege']['id'];?>">
                  <td><?php echo $row['rl']['description'];?></td>
                  <td><?php echo $row['Privilege']['controller'];?></td>
                  <td><?php echo $row['Privilege']['action'];?></td>
                  <td><?php echo $row['Privilege']['description'];?></td>
                  <td><?php echo $row['Privilege']['status'];?></td>
                  <td>
                  	<a href="#" class="btn btn-danger btnDeleteRole" type="button" data-role-id="<?php echo $row['Privilege']['id'];?>">Delete</a>
                  	<a href="<?php echo $this->webroot; ?>privileges/edit/<?php echo $row['Privilege']['id']; ?>" class="btn btn-primary" data-role-id="<?php echo $row['Privilege']['id'];?>">Edit</a>
                  </td>
                </tr>
            <?php
            	}
            ?>    
              </tbody>
            </table>
            <div class="pagination role-paginates">
				<ul>
					<?php echo $this->Paginator->prev('« ', array('tag'=>'li'), null, array('class'=>'disabled'));?>
						
					<?php echo $this->Paginator->numbers(
							array(
									'modulus' => 4,
									'tag' => 'li',
									'separator' => '', 
									'currentClass' => 'active',
									'currentTag' => 'span'
								)
							);
					?>
					<?php echo $this->Paginator->next('»', array('tag'=>'li',), null, array('class'=>'disabled'));?>
				</ul>		
			</div>
	</div>	
</div>		