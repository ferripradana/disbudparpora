<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Cabor Read</h2>
        <table class="table">
	    <tr><td>name</td><td><?php echo $caborname; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('master_cabor') ?>" class="btn btn-default">Cancel</button></td></tr>
	</table>
    </body>
</html>