
        <h2 style="margin-top:0px">Master Menu <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	        <div class="form-group">
                <label for="varchar">Name <?php echo form_error('menuName') ?></label>
                <input type="text" class="form-control" name="menuName" id="menuName" placeholder="Menu Name" value="<?php echo $menuName; ?>" />
            </div>
            <div class="form-group">
                <label for="varchar">Link <?php echo form_error('menuLink') ?></label>
                <input type="text" class="form-control" name="menuLink" id="menuLink" placeholder="Menu Link" value="<?php echo $menuLink; ?>" />
            </div>
	        <div class="form-group">
                <label for="varchar">Parent <?php echo form_error('menuParent') ?></label>
                <?php echo form_dropdown('menuParent' , $option,$menuParent,' class="form-control" '); ?>
            </div>
	        <div class="form-group">
                <label for="varchar">Position <?php echo form_error('menuPosition') ?></label>
                <input type="text" class="form-control" name="menuPosition" id="menuPosition" placeholder="Position" value="<?php echo $menuPosition; ?>" />
            </div>
            	    <input type="hidden" name="menuId" value="<?php echo $menuId; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('master_menu') ?>" class="btn btn-default">Cancel</a>
	</form>
