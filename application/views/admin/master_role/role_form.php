 <link href="<?php   echo base_url('assets/css/tree.css') ?>" rel="stylesheet">
 <script type="text/javascript" src="<?php   echo base_url('assets/js/tree.js') ?>"></script>
 <script type="text/javascript" src="<?php   echo base_url('assets/js/treeboot.js') ?>"></script>


<h2 style="margin-top:0px">Master Role <?php echo $button ?></h2>
<form action="<?php echo $action; ?>" method="post">
    <div class="form-group">
        <label for="varchar">Name <?php echo form_error('roleName') ?></label>
        <input type="text" class="form-control" name="roleName" id="roleName" placeholder="Role Name" value="<?php echo $roleName; ?>" />
    </div>
    <input type="hidden" name="roleId" value="<?php echo $roleId; ?>" />
    
   

			<table class="table tree">
                <thead>
                    <tr>
                        <th rowspan="2">Menu</th>  
                        <th>View</th>
                    	<th>Create</th>
                    	<th>Update</th>
                    	<th>Delete</th>
                    </tr> 
                </thead>
                
            </table>    
         <button type="submit" class="btn btn-primary"><?php echo $button ?></button>   
    	 <a href="<?php echo site_url('master_role') ?>" class="btn btn-default">Cancel</a>
	</form>        
		
            <script type="text/javascript">

                $(document).ready(function() {
                      var jsonMenu = <?php echo $menu; ?>
                        
                        $('.tree').append( createTable(jsonMenu) );
                        $('.tree').treegrid();
                });
                 function createTable(jsonData){
                    var generated = '';
                    for(var i=0; i<jsonData.length; i++){
                        if(jsonData[i].menuParent == 0){
                            // parent menu
                            var isview=(jsonData[i].isview == "1")? "checked":'' ;
                            var iscreate = (jsonData[i].iscreate == "1")? "checked":'';
                            var isupdate = (jsonData[i].isupdate == "1")? "checked":'';
                            var isdelete = (jsonData[i].isdelete == "1")? "checked":'';
                           


                            generated = generated + '<tr class="treegrid-'+jsonData[i].menuId+'"><td>'+jsonData[i].menuName+'</td>'+
                                                        '<td><input type="checkbox" name="ck['+jsonData[i].menuId+'][ckView]" '+ isview +'  value="1" /></td>'+
                                                        '<td><input type="checkbox" name="ck['+jsonData[i].menuId+'][ckCreate]" '+ iscreate +'  value="1" /></td>'+
                                                         '<td><input type="checkbox" name="ck['+jsonData[i].menuId+'][ckUpdate]" '+ isupdate +'  value="1" /></td>'+
                                                          '<td><input type="checkbox" name="ck['+jsonData[i].menuId+'][ckDelete]" '+ isdelete +'  value="1" /></td>'+
                                                    '</tr>';
                            // TODO recursive here
                            var recursiveResult = generateByRecursive(jsonData[i], generated);
                            generated = recursiveResult;
                        }
                    }
                    return generated;
                  }
                  
                  function generateByRecursive(jsonData, generated){
                    for(var i=0; i<jsonData.children.length; i++){
                    	var isview=(jsonData.children[i].isview == "1")? "checked":'' ;
                        var iscreate = (jsonData.children[i].iscreate == "1")? "checked":'';
                        var isupdate = (jsonData.children[i].isupdate == "1")? "checked":'';
                        var isdelete = (jsonData.children[i].isdelete == "1")? "checked":'';
                        generated = generated + '<tr class="treegrid-'+jsonData.children[i].menuId+' treegrid-parent-'+jsonData.menuId+'"><td>'+jsonData.children[i].menuName+'</td>'+
                                                        '<td><input type="checkbox" name="ck['+jsonData.children[i].menuId+'][ckView]" '+ isview +'  value="1" /></td>'+
                                                        '<td><input type="checkbox" name="ck['+jsonData.children[i].menuId+'][ckCreate]" '+ iscreate +' value="1" /></td>'+
                                                        '<td><input type="checkbox" name="ck['+jsonData.children[i].menuId+'][ckUpdate]" '+ isupdate +' value="1" /></td>'+
                                                        '<td><input type="checkbox" name="ck['+jsonData.children[i].menuId+'][ckDelete]" '+ isdelete +' value="1" /></td>'+
                                                        '</tr>';
                        generated = generateByRecursive(jsonData.children[i], generated);
                    }
                    return generated;
                  }
            </script>
