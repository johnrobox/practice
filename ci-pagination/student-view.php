<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                House Area List
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                    </tr>
                <?php foreach($results as $row) { ?>
                    <tr class="tr<?php echo $row->ATypeID;?>">
                        <td><?php echo $row->firstname;?></td>
                        <td><?php echo $row->lastname;?></td>
                    </tr>
                <?php } ?>
                </table>
                <?php echo $links; ?>
            </div>
            <div class="panel-footer">
                
            </div>
        </div>
    </div>
</div>