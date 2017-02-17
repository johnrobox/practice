<div class="container wrapper">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class = "text-center">Manage User</h4>
        </div>
    <?php 
            echo $this->session->flashdata('delete-alert-message'); 
            echo $this->session->flashdata('activate-alert-message'); 
            echo $this->session->flashdata('deactivate-alert-message'); 
    ?>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Username</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Role</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Created</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            
            <?php foreach($query_user as $row) { ?>
            <tr class="text-center">
                <td><?php echo $row->firstname.' '.$row->middlename.' '.$row->lastname; ?></td>
                <td><?php echo $row->username;?></td>
                <td><?php echo $row->user_email;?></td>
                <td>
                    <?php if(($row->role=='Admin')||($row->role=='superAdmin')){
                        echo 'Administrator';
                    }else{
                        echo 'Regular';
                    } ?>
                </td>
                <td>
                    <?php if($row->is_active==1){
                            echo 'Active';
                        }else{
                            echo 'Not Active';
                            }?>
                </td>
                <td>
                    <?php 
                        $created = strtotime($row->d_o_c);
                        echo date('F jS Y', $created )
                    ?>
                </td>
                <td>
                    <?php 
                        if($row->role == 'superAdmin'){
                            echo 'No action is available';
                        }else{
                    ?>
                        <?php if($row->is_active==1){?>
                        <a href="#deactivateUser<?php echo $row->id;?>" class="btn btn-default" data-toggle="modal"><i class="glyphicon glyphicon-remove"></i></a>
                        <?php }else{?>
                        <a href="#activateUser<?php echo $row->id;?>" class="btn btn-default" data-toggle="modal"><i class="glyphicon glyphicon-ok"></i></a>
                        <?php } ?>
                        <a href="#deleteUser<?php echo $row->id;?>" class="btn btn-default" data-toggle="modal"><i class="glyphicon glyphicon-trash"></i></a>
                    <?php }?>
                </td>
            </tr>
            <?php }?>
        </table>
        <div class="panel-footer"></div>
    </div>
</div>
