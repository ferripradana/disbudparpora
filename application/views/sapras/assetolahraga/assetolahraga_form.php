        <link href="<?php echo base_url('assets/css/select/select2.min.css') ?>" rel="stylesheet">
        <script src="<?php echo base_url('assets/js/select/select2.full.js') ?>"></script>
        <h2 style="margin-top:0px">Asset Olahraga <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group">
                <label for="varchar">Nama <?php echo form_error('name') ?></label>
                <input type="text" class="form-control" name="name" id="name" placeholder="name" value="<?php echo $name; ?>" />
            </div>
        <div class="form-group">
                <label for="varchar">Kecamatan <?php echo form_error('name') ?></label>
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
                <label for="varchar">Tahun <?php echo form_error('tahun') ?></label>
                <input type="text" class="form-control" name="tahun" id="tahun" placeholder="tahun" value="<?php echo $tahun; ?>" />
            </div>
	    <div class="form-group">
                <label for="int">Kondisi <?php echo form_error('kondisi') ?></label>
                <select class="select2_single form-control" name="kondisi" id="kondisi" tabindex="-1">
                                 <option value="Baik" <?php echo ($kondisi=="Baik")? "selected":"" ?> >Baik</option>
                                 <option value="Sedang" <?php echo ($kondisi=="Sedang")? "selected":"" ?> >Sedang</option>
                                 <option value="Rusak" <?php echo ($kondisi=="Rusak")? "selected":"" ?> >Rusak</option> 
                </select>
            </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('assetolahraga') ?>" class="btn btn-default">Cancel</a>
	</form>
  <script type="text/javascript">
         $(document).ready(function(){
                 $(".select2_single").select2({
                            placeholder: "Select a state",
                            allowClear: true
                        });
            });

    </script>