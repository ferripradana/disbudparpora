
        <h2 style="margin-top:0px">Wasit Read</h2>
        <table class="table">
	    <tr><td>Cabang</td><td><?php echo $cabang; ?></td></tr>
	    <tr><td>Jenis</td><td><?php echo $jenis; ?></td></tr>
	    <tr><td>Kecamatan</td><td><?php echo $kecamatan; ?></td></tr>
	    <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
	    <tr><td>Tempat Lahir</td><td><?php echo $tmp_lahir; ?></td></tr>
	    <tr><td>Tanggal Lahir</td><td><?php echo $tgl_lahir; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>Kelamin</td><td><?php echo getGender($kelamin); ?></td></tr>
	    <tr><td>Telepon</td><td><?php echo $telepon; ?></td></tr>
	    <tr><td>Foto</td>
	    	<td> <?php 
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
            </td>
        </tr>
	    <tr><td></td><td><a href="<?php echo site_url('wasit') ?>" class="btn btn-default">Cancel</button></td></tr>
	</table>
