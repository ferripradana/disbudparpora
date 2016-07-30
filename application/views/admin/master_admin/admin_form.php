        <link href="<?php echo base_url('assets/css/select/select2.min.css') ?>" rel="stylesheet">
        <script src="<?php echo base_url('assets/js/select/select2.full.js') ?>"></script>
        <h2 style="margin-top:0px">Admin <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	        <div class="form-group">
                <label for="varchar">Username <?php echo form_error('username') ?></label>
                <input type="text" class="form-control" name="username" id="username" placeholder="username" value="<?php echo $username; ?>" />
            </div>
            <div class="form-group">
                <label for="int">Kecamatan <?php echo form_error('kecamatan') ?></label>
                <select class="select2_single form-control" name="kecamatan" id="kecamatan" tabindex="-1">
                      <?php 
                        foreach ($kecamatan_option as $key => $value) {
                            if ($kecamatan==$key) {
                        ?>
                                 <option value="<?php echo $key ?>" selected><?php echo $value; ?></option>
                        <?php                              
                            }else{
                          ?>
                                 <option value="<?php echo $key ?>"><?php echo $value; ?></option>
                            <?php         
                            }
                      ?>  

                      <?php
                        }
                       ?>  
                </select>
            </div>
	        <div class="form-group">
                <label for="varchar">Email <?php echo form_error('email') ?></label>
                <input type="email" class="form-control" name="email" id="email" placeholder="email" value="<?php echo $email; ?>" />
            </div>
            <div class="form-group">
                <label for="varchar">Role <?php echo form_error('role') ?></label>
                <?php echo form_dropdown('role' , $option,$role,' class="form-control" '); ?>
            </div>
	        <div class="form-group">
                <label for="varchar">Password <?php echo form_error('password') ?></label>
                <input type="password" class="form-control" name="password" id="password" placeholder="password" value="<?php echo $password; ?>" />
            </div>
            <div class="form-group">
                <label for="varchar">Password Confirmation <?php echo form_error('passconf') ?></label>
                <input type="password" class="form-control" name="passconf" id="passconf" placeholder="password confirmation" value="<?php echo $password; ?>" />
            </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('master_admin') ?>" class="btn btn-default">Cancel</a>
	</form>
    <script type="text/javascript">
         $(document).ready(function(){
                 $(".select2_single").select2({
                            placeholder: "Select a state",
                            allowClear: true
                        });     
            });
    </script>