
        <h2 style="margin-top:0px">Atlit List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4"> 
                <?php 
                    if ($iscreate==1)
                    echo anchor(site_url('atlit/create'),'Create', 'class="btn btn-primary"'); 
                ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <form action="<?php echo site_url('atlit/search'); ?>" class="form-inline" method="post">
                    <input name="keyword" class="form-control" value="<?php echo $keyword; ?>" />
                    <?php 
                    if ($keyword <> '')
                    {
                        ?>
                        <a href="<?php echo site_url('atlit'); ?>" class="btn btn-default">Reset</a>
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
                <th>Spesialisasi</th>
                <th>Kecamatan</th>
                <th>Jenis</th>
        		<th>Potensial</th>
        		<th>Status</th>
                <th style="text-align:center">Event</th>
        		<th style="text-align:center">Action</th>
            </tr></thead><?php
            foreach ($atlit_data as $atlit)
            {
                ?>
                <tr>
			<td><?php echo ++$start ?></td>
            <td> <img src="<?php echo !empty($atlit->foto)?base_url('upload/thumbs/'.$atlit->foto):base_url('upload/no_user.jpg') ?>" class="img-thumbnail" alt="Cinque Terre" ></td>
            <td><?php echo $atlit->nama ?></td>
			<td><?php echo $atlit->cabang?></td>
			<td><?php echo $atlit->spesialis ?></td>
            <td><?php echo $atlit->kecamatan ?></td>
            <td><?php echo $atlit->jenis ?></td>
			<td><?php echo get_mark($atlit->potensial) ?></td>
			<td><?php echo get_mark($atlit->status) ?></td>
            <td style="text-align:center"><?php   echo anchor(site_url('atlit/event/'.$atlit->id),'<i class="fa fa-trophy"></i>');  ?></td>
			<td style="text-align:center">
				<?php 
				echo anchor(site_url('atlit/read/'.$atlit->id),'<i class="fa fa-eye"></i>'); 
				echo '  ';
                if($isupdate){ 
				    echo anchor(site_url('atlit/update/'.$atlit->id),'<i class="fa fa-pencil"></i>'); 
				    echo '  ';
                } 
				if($isdelete){
                    echo anchor(site_url('atlit/delete/'.$atlit->id),'<i class="fa fa-eraser"></i>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
		<?php echo anchor(site_url('atlit/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
 