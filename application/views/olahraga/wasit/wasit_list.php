        <h2 style="margin-top:0px">Wasit List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php
                    if ($iscreate==1) 
                    echo anchor(site_url('wasit/create'),'Create', 'class="btn btn-primary"'); 
                ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <form action="<?php echo site_url('wasit/search'); ?>" class="form-inline" method="post">
                    <input name="keyword" class="form-control" value="<?php echo $keyword; ?>" />
                    <?php 
                    if ($keyword <> '')
                    {
                        ?>
                        <a href="<?php echo site_url('wasit'); ?>" class="btn btn-default">Reset</a>
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
            foreach ($wasit_data as $wasit)
            {
                ?>
                <tr>
			<td><?php echo ++$start ?></td>
            <td><img src="<?php echo !empty($wasit->foto)?base_url('upload/thumbs/'.$wasit->foto):base_url('upload/no_user.jpg') ?>" class="img-thumbnail" alt="Cinque Terre" ></td>
			<td><?php echo $wasit->nama ?></td>
			<td><?php echo $wasit->cabang ?></td>
			<td><?php echo $wasit->jenis ?></td>
			<td><?php echo $wasit->kecamatan ?></td>
            <td style="text-align:center"><?php   echo anchor(site_url('wasit/sertifikat/'.$wasit->id),'<i class="fa fa-certificate"></i>');  ?></td>
			<td style="text-align:center">
				<?php 
				echo anchor(site_url('wasit/read/'.$wasit->id),'<i class="fa fa-eye"></i>'); 
				echo '  ';
                if($isupdate){
				    echo anchor(site_url('wasit/update/'.$wasit->id),'<i class="fa fa-pencil"></i>'); 
				    echo '  ';
                }
                if($isdelete){ 
	       			echo anchor(site_url('wasit/delete/'.$wasit->id),'<i class="fa fa-eraser"></i>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
		<?php echo anchor(site_url('wasit/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </body>
</html>