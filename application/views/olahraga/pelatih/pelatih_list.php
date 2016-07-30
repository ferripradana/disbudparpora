        <h2 style="margin-top:0px">Pelatih List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php 
                    if ($iscreate==1)
                    echo anchor(site_url('pelatih/create'),'Create', 'class="btn btn-primary"'); 
                ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <form action="<?php echo site_url('pelatih/search'); ?>" class="form-inline" method="post">
                    <input name="keyword" class="form-control" value="<?php echo $keyword; ?>" />
                    <?php 
                    if ($keyword <> '')
                    {
                        ?>
                        <a href="<?php echo site_url('pelatih'); ?>" class="btn btn-default">Reset</a>
                        <?php
                    }
                    ?>
                    <input type="submit" value="Search" class="btn btn-primary" />
                </form>
            </div>
        </div>
        <table class="table table-striped responsive-utilities jambo_table bulk_action" style="margin-bottom: 10px">
            <thead>
            <tr class="headings">
                <th>No</th>
		<th>Foto</th>
        <th>Nama</th>
		<th>Cabang</th>
		<th>Jenis</th>
		<th>Kecamatan</th>
        <th style="text-align:center">Sertifikat</th>
		<th style="text-align:center">Action</th>
            </tr></thead><?php
            foreach ($pelatih_data as $pelatih)
            {
                ?>
                <tr>
			<td><?php echo ++$start ?></td>
			<td><img src="<?php echo !empty($pelatih->foto)?base_url('upload/thumbs/'.$pelatih->foto):base_url('upload/no_user.jpg') ?>" class="img-thumbnail" alt="Cinque Terre" ></td>
			<td><?php echo $pelatih->nama ?></td>
			<td><?php echo $pelatih->cabang ?></td>
			<td><?php echo $pelatih->jenis ?></td>
			<td><?php echo $pelatih->kecamatan ?></td>
            <td style="text-align:center"><?php   echo anchor(site_url('pelatih/sertifikat/'.$pelatih->id),'<i class="fa fa-certificate"></i>');  ?></td>
			<td style="text-align:center">
				<?php 
				echo anchor(site_url('pelatih/read/'.$pelatih->id),'<i class="fa fa-eye"></i>'); 
				echo '  '; 
                if($isupdate){
				echo anchor(site_url('pelatih/update/'.$pelatih->id),'<i class="fa fa-pencil"></i>'); 
				echo '  ';
                }
                if($isdelete){ 
				echo anchor(site_url('pelatih/delete/'.$pelatih->id),'<i class="fa fa-eraser"></i>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				}
                ?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('pelatih/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>