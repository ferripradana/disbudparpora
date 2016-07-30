        <h2 style="margin-top:0px">Tingkatan <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                <label for="varchar">Nama <?php echo form_error('tingkatanname') ?></label>
                <input type="text" class="form-control" name="tingkatanname" id="tingkatanname" placeholder="tingkatan" value="<?php echo $tingkatanname; ?>" />
            </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('master_tingkatan') ?>" class="btn btn-default">Cancel</a>
	</form>
