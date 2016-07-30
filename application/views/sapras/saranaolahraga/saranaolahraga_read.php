        <h2 style="margin-top:0px">Sarana Olahraga Read</h2>
        <table class="table">
	    <tr><td>name</td><td><?php echo $name; ?></td></tr>
	    <tr><td>alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>kecamatan</td><td><?php echo $kecamatan; ?></td></tr>
	    <tr><td>kondisi</td><td><?php echo getKondisi($kondisi); ?></td></tr>
	    <tr><td>kategori</td><td><?php echo getKategori($kategori); ?></td></tr>
	    <tr><td>kepemilikan</td><td><?php echo $kepemilikan; ?></td></tr>
	    <tr><td>kapasitas</td><td><?php echo $kapasitas; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('saranaolahraga') ?>" class="btn btn-default">Cancel</button></td></tr>