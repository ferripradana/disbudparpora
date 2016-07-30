        <h2 style="margin-top:0px">Kecamatan <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                <label for="varchar">Nama <?php echo form_error('kecamatanname') ?></label>
                <input type="text" class="form-control" name="kecamatanname" id="kecamatanname" placeholder="kecamatan" value="<?php echo $kecamatanname; ?>" />
            </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('master_kecamatan') ?>" class="btn btn-default">Cancel</a>
	</form>
