<div class="container wrapper">
  <div class="panel panel-default">
        <div class="panel-heading">        
              <div class="btn-group">
                 <a href="#createSeminar" class="btn btn-default" data-toggle="modal" title="createSeminar"><strong>+</strong> Create Seminar</a>
              </div>
        </div>
    <?php
            echo $this->session->flashdata('insertSeminar-alert-message'); 
            echo $this->session->flashdata('activateSeminar-alert-message');
            echo $this->session->flashdata('deactivateSeminar-alert-message');
            echo $this->session->flashdata('deleteSeminar-alert-message');
            echo $this->session->flashdata('updateSeminar-alert-message'); ?>
    
            
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">Seminar Name</th>
                    <th class="text-center">Date & Created By</th>
                    <th class="text-center">Location</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
    <?php
             foreach($query_seminar as $row) { 
                $status = '';
                if($row->seminar_is_active == 1){
                    $status = '<span class="glyphicon glyphicon-ok-circle success"></span>';
                }else{
                    $status = '<span class="glyphicon glyphicon-remove-circle required"></span>';
                }
    ?>
            <tr>
                <td class="text-center"><?php echo $status.' '.$row->seminar_name?></td>
                <td class="text-center"><?php echo $row->seminar_creator_username.' (<small>'.date('F d, Y',strtotime($row->seminar_d_o_c)).'</small>)';?></td>
                <td><?php echo $row->seminar_location?></td>
                <?php $seminar_name = str_replace(' ','-',strtolower($row->seminar_name));?>
                <td class="text-center"><a href="<?php echo base_url() ?><?php echo $seminar_name?>/<?=$row->seminar_location_url?>"  role="button" data-toggle="modal" class="btn btn-default btn-sm" title="Edit">View full details</a></td>
            </tr>
            <?php }?>
        </table>
    </div>
</div>