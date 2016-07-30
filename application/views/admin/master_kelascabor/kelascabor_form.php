        <link href="<?php echo base_url('assets/css/select/select2.min.css') ?>" rel="stylesheet">
        <script src="<?php echo base_url('assets/js/select/select2.full.js') ?>"></script>
        <h2 style="margin-top:0px">Kelascabor <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group">
                <label for="int">Cabang <?php echo form_error('cabang') ?></label>
                <select class="select2_single form-control" name="cabang" id="cabang" tabindex="-1">
                      <?php 
                        foreach ($cabang_option as $key => $value) {
                            if ($cabang==$key) { 
                        ?>
                                 <option value="<?php echo $key ?>" selected><?php echo $value; ?></option>
                        <?php                              
                            }else{
                          ?>
                                 <option value="<?php echo $key ?>"><?php echo $value; ?></option>
                            <?php         
                            }
                        }
                       ?>  
                </select>            
                </div>
	    <div class="form-group">
                <label for="int">Tingkatan <?php echo form_error('tingkatan') ?></label>
                <select class="select2_single form-control" name="tingkatan" id="tingkatan" tabindex="-1">
                      <?php 
                        foreach ($tingkatan_option as $key => $value) {
                            if ($tingkatan==$key) { 
                        ?>
                                 <option value="<?php echo $key ?>" selected><?php echo $value; ?></option>
                        <?php                              
                            }else{
                          ?>
                                 <option value="<?php echo $key ?>"><?php echo $value; ?></option>
                            <?php         
                            }
                        }
                       ?>  
                </select>        
            </div>
	    <div class="form-group">
                <label for="varchar">Nama <?php echo form_error('nama') ?></label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="nama" value="<?php echo $nama; ?>" />
            </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('master_kelascabor') ?>" class="btn btn-default">Cancel</a>
	</form>
<script type="text/javascript">
         $(document).ready(function(){
                 $(".select2_single").select2({
                            placeholder: "Select a state",
                            allowClear: true
                        });
                
            });

    </script>