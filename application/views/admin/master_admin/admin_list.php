
        <h2 style="margin-top:0px">Admin List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php 
                    if ($iscreate==1)
                    echo anchor(site_url('master_admin/create'),'Create', 'class="btn btn-primary"'); 
                ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <form action="<?php echo site_url('master_admin/search'); ?>" class="form-inline" method="post">
                    <input name="keyword" class="form-control" value="<?php echo $keyword; ?>" />
                    <?php 
                    if ($keyword <> '')
                    {
                        ?>
                        <a href="<?php echo site_url('master_admin'); ?>" class="btn btn-default">Reset</a>
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
                    <th>Username</th>
		            <th>Email</th>
                    <th>Kecamatan</th>
                    <th>Role</th>
		            <th style="text-align:center">Action</th>
            </tr>
            </thead>
            <?php
            foreach ($master_users_data as $master_users)
            {
                ?>
                <tr>
			<td><?php echo ++$start ?></td>
			<td><?php echo $master_users->username ?></td>
			<td><?php echo $master_users->email ?></td>
            <td><?php echo $master_users->kecamatan ?></td>
            <td><?php echo $master_users->role?></td>
			
			<td style="text-align:center">
				<?php 
				echo anchor(site_url('master_admin/read/'.$master_users->id),'<i class="fa fa-eye"></i>'); 
				echo ' '; 
                if($isupdate){
				    echo anchor(site_url('master_admin/update/'.$master_users->id),'<i class="fa fa-pencil"></i>'); 
                    echo ' '; 
				}
                if($isdelete){
                     echo anchor(site_url('master_admin/delete/'.$master_users->id),'<i class="fa fa-eraser"></i>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');     
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
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
