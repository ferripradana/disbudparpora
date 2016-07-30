        <h2 style="margin-top:0px">Jenis<?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                <label for="varchar">Nama <?php echo form_error('name') ?></label>
                <input type="text" class="form-control" name="jenisname" id="jenisname" placeholder="nama" value="<?php echo $jenisname; ?>" />
            </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('master_jenis') ?>" class="btn btn-default">Cancel</a>
	</form>
