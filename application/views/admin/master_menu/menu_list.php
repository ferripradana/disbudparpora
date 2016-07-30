        <link href="<?php   echo base_url('assets/css/tree.css') ?>" rel="stylesheet">
        <script type="text/javascript" src="<?php   echo base_url('assets/js/tree.js') ?>"></script>
        <script type="text/javascript" src="<?php   echo base_url('assets/js/treeboot.js') ?>"></script>

        <h2 style="margin-top:0px">Menu List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php 
                    if($iscreate)
                    echo anchor(site_url('master_menu/create'),'Create', 'class="btn btn-primary"'); 
                ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
         <table class="table tree">
                <thead>
                    <tr>
                        <th>Menu</th>  
                        <th>Action</th>
                    </tr>
                </thead>
                
            </table>    
            <script type="text/javascript">
                var isupdate = <?php echo $isupdate; ?>;
                var isdelete = <?php echo $isdelete; ?>;
                $(document).ready(function() {
                      var jsonMenu = <?php echo $menu; ?>;
                      
                        
                        $('.tree').append( createTable(jsonMenu) );
                        $('.tree').treegrid();
                });
                 function createTable(jsonData){
                    var generated = '';
                    for(var i=0; i<jsonData.length; i++){
                        if(jsonData[i].menuParent == 0){
                            // parent menu
                            generated = generated + '<tr class="treegrid-'+jsonData[i].menuId+'"><td>'+jsonData[i].menuName+'</td><td>';
                                                        if (isupdate=="1") {
                                                            generated+= '<a href="./master_menu/update/'+jsonData[i].menuId+'"><i class="fa fa-pencil"></i></a>&nbsp;';
                                                        };
                                                        if (isdelete=="1") {
                                                            generated+= '<a href="./master_menu/delete/'+jsonData[i].menuId+'"><i class="fa fa-eraser"></i></a></td>';   
                                                        };
                                                        
                                                    generated+='</td></tr>';
                            // TODO recursive here
                            var recursiveResult = generateByRecursive(jsonData[i], generated);
                            generated = recursiveResult;
                        }
                    }
                    return generated;
                  }
                  
                  function generateByRecursive(jsonData, generated){
                    for(var i=0; i<jsonData.children.length; i++){
                        generated = generated + '<tr class="treegrid-'+jsonData.children[i].menuId+' treegrid-parent-'+jsonData.menuId+'"><td>'+jsonData.children[i].menuName+'</td><td>';
                                                         if (isupdate=="1") {
                                                            generated+='<a href="./master_menu/update/'+jsonData.children[i].menuId+'"><i class="fa fa-pencil"></i></a>&nbsp; ';
                                                        }
                                                        if (isdelete=="1") {
                                                         generated+='<a href="./master_menu/delete/'+jsonData.children[i].menuId+'"><i class="fa fa-eraser"></i></a>';
                                                        }
                                                        generated+='</td></tr>';
                        generated = generateByRecursive(jsonData.children[i], generated);
                    }
                    return generated;
                  }
            </script>

      
