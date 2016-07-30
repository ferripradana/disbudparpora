
        <h2 style="margin-top:0px">Admin Detail</h2>
        
        <table class="table">
	    <tr><td>Username</td><td><?php echo $username; ?></td></tr>
	    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
	    <tr><td>Kecamatan</td><td><?php echo $kecamatan; ?></td></tr>
	    <tr><td>Role</td><td><?php echo $role; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('master_admin') ?>" class="btn btn-default">Cancel</button></td></tr>
	</table>
