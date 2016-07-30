        <link href="<?php echo base_url('assets/css/select/select2.min.css') ?>" rel="stylesheet">
        <script src="<?php echo base_url('assets/js/select/select2.full.js') ?>"></script>
        <h2 style="margin-top:0px">Sarana Olahraga <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group">
                <label for="varchar">name <?php echo form_error('name') ?></label>
                <input type="text" class="form-control" name="name" id="name" placeholder="name" value="<?php echo $name; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">alamat <?php echo form_error('alamat') ?></label>
                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="alamat" value="<?php echo $alamat; ?>" />
            </div>
	    <div class="form-group">
                <label for="int">kecamatan <?php echo form_error('kecamatan') ?></label>
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
                <label for="int">kondisi <?php echo form_error('kondisi') ?></label>
                <select class="select2_single form-control" name="kondisi" id="kondisi" tabindex="-1">
                                 <option value="1" <?php echo ($kondisi==1)? "selected":"" ?> >Baik</option>
                                 <option value="2" <?php echo ($kondisi==2)? "selected":"" ?> >Sedang</option>
                                 <option value="3" <?php echo ($kondisi==3)? "selected":"" ?> >Rusak</option> 
                </select>
            </div>
	    <div class="form-group">
                <label for="int">kategori <?php echo form_error('kategori') ?></label>
                <select class="select2_single form-control" name="kategori" id="kategori" tabindex="-1">
                                 <option value="1" <?php echo ($kategori==1)? "selected":"" ?> >Lapangan Olahraga</option>
                                 <option value="2" <?php echo ($kategori==2)? "selected":"" ?> >Gedung Olahraga</option> 
                </select>
            </div>
	    <div class="form-group">
                <label for="varchar">kepemilikan <?php echo form_error('kepemilikan') ?></label>
                <input type="text" class="form-control" name="kepemilikan" id="kepemilikan" placeholder="kepemilikan" value="<?php echo $kepemilikan; ?>" />
            </div>
	    <div class="form-group">
                <label for="int">kapasitas <?php echo form_error('kapasitas') ?></label>
                <input type="text" class="form-control" name="kapasitas" id="kapasitas" placeholder="kapasitas" value="<?php echo $kapasitas; ?>" />
            </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('saranaolahraga') ?>" class="btn btn-default">Cancel</a>
	</form>
    <script type="text/javascript">
         $(document).ready(function(){
                 $(".select2_single").select2({
                            placeholder: "Select a state",
                            allowClear: true
                        });
            });

    </script>