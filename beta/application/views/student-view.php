<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Students
                        </div>
                        <div class="panel-body">
                            <?php if (is_array($results)) { ?>
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                    </tr>

                                <?php foreach($results as $row) { ?>
                                    <tr>
                                        <td><?php echo $row->firstname;?></td>
                                        <td><?php echo $row->lastname;?></td>
                                    </tr>
                                <?php } ?>

                                </table>
                                <?php echo $links; ?>
                            <?php } else { ?>
                            <h2>No record founds</h2>
                            <?php } ?>
                        </div>
                        <div class="panel-footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
