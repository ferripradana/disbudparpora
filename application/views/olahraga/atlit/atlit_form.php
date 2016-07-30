        <link href="<?php echo base_url('assets/css/select/select2.min.css') ?>" rel="stylesheet">
        <script src="<?php echo base_url('assets/js/select/select2.full.js') ?>"></script>
        <h2 style="margin-top:0px">Atlit <?php echo $button ?></h2>
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
                      ?>  

                      <?php
                        }
                       ?>  
                </select>
            </div>
	    <div class="form-group">
                <label for="int">Jenis <?php echo form_error('jenis') ?></label>
                <select class="select2_single form-control" name="jenis" id="jenis" tabindex="-1">
                      <?php 
                        foreach ($jenis_option as $key => $value) {
                            if ($jenis==$key) {
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
                <label for="varchar">Nama <?php echo form_error('nama') ?></label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="nama" value="<?php echo $nama; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">Tempat Lahir <?php echo form_error('tmp_lahir') ?></label>
                <input type="text" class="form-control" name="tmp_lahir" id="tmp_lahir" placeholder="tmp_lahir" value="<?php echo  $tmp_lahir; ?>" />
            </div>
	    <div class="form-group">
                <label for="date">Tanggal Lahir <?php echo form_error('tgl_lahir') ?></label>
                <input type="text" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="tgl_lahir" value="<?php echo ($tgl_lahir!='00/00/0000')?$tgl_lahir:'' ; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">Alamat <?php echo form_error('alamat') ?></label>
                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="alamat" value="<?php echo $alamat; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">Telepon <?php echo form_error('telepon') ?></label>
                <input type="text" class="form-control" name="telepon" id="telepon" placeholder="telepon" value="<?php echo $telepon; ?>" />
            </div>
	    <div class="form-group">
                <label for="int">Kelamin <?php echo form_error('kelamin') ?></label>
                 <select class="select2_single form-control" name="kelamin" id="kelamin" tabindex="-1">
                                 <option value="1" <?php echo ($kelamin==1)? "selected":"" ?> >Laki - Laki</option>
                                 <option value="2" <?php echo ($kelamin==2)? "selected":"" ?>  >Perempuan</option> 
                </select>
            </div>
	    <div class="form-group">
                <label for="int">Tinggi (Cm)<?php echo form_error('tinggi') ?></label>
                <input type="text" class="form-control" name="tinggi" id="tinggi" placeholder="tinggi" value="<?php echo $tinggi; ?>" />
            </div>
	    <div class="form-group">
                <label for="int">Berat (Kg)<?php echo form_error('berat') ?></label>
                <input type="text" class="form-control" name="berat" id="berat" placeholder="berat" value="<?php echo $berat; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">Spesialisasi <?php echo form_error('spesialis') ?></label>
                <input type="text" class="form-control" name="spesialis" id="spesialis" placeholder="spesialis" value="<?php echo $spesialis; ?>" />
            </div>
	    <div class="form-group">
               
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="1" name="potensial" id="potensial" <?php echo ($potensial==1)?"checked":"" ?> /> Potensial (Centang untuk ya)
                    </label>
                </div>
            </div>
	    <div class="form-group">
                 <div class="checkbox">
                    <label>
                          <input type="checkbox" value="1" name="status" id="status" <?php echo ($status==1)?"checked":"" ?> /> Status Aktif (Centang untuk aktif)
                    </label>
                </div>    
                 
            </div>
	    <div class="form-group">
                <label for="date">Tanggal Status (Isi jika status aktif di centang)<?php echo form_error('tgl_status') ?></label>
                <input type="text" class="form-control" name="tgl_status" id="tgl_status" placeholder="tgl_status" value="<?php echo  ($tgl_status!='00/00/0000')?$tgl_status:'' ; ?>" />
        </div>
	     <div class="form-group">
                <label for="varchar">Foto <?php echo form_error('foto') ?></label>
                <input type="file"  name="foto" id="foto" />            
            </div>
         <div>
                
                <?php 
                    if (isset($foto) && $foto!='' && $foto!='0') {
                        ?>
                        <img src="<?php echo base_url('upload/thumbs/'.$foto) ?>" class="img-thumbnail" alt="Cinque Terre" />
                        <?php
                    }else{
                        ?>
                        <img src="<?php echo base_url('upload/no_user.jpg') ?>" class="img-thumbnail" alt="Cinque Terre" />
                        <?php
                    }
                 ?>
        </div>
        <br>   
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('atlit') ?>" class="btn btn-default">Cancel</a>
	</form>
    <script type="text/javascript">
         $(document).ready(function(){
                 $(".select2_single").select2({
                            placeholder: "Select a state",
                            allowClear: true
                        });
                     $('#tgl_lahir').daterangepicker({
                                singleDatePicker: true,
                                showDropdowns: true,
                                calender_style: "picker_5",
                              
                                 format: 'DD/MM/YYYY',
                            }, function (start, end, label) {
                                 console.log(start.toISOString(), end.toISOString(), label);
                            });
                        $('#tgl_status').daterangepicker({
                                singleDatePicker: true,
                                showDropdowns: true,
                                calender_style: "picker_5",
                              
                                 format: 'DD/MM/YYYY',
                            }, function (start, end, label) {
                                 console.log(start.toISOString(), end.toISOString(), label);
                            });
                
            });


    </script>