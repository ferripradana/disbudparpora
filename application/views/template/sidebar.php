<div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?php echo base_url('home')  ?>" class="site_title"><i class="fa fa-flag"></i> <span>Disbudparpora Klaten</span></a>
                    </div>
                    <div class="clearfix"></div>

                

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <!-- <h3>General</h3> -->
                            <ul class="nav side-menu" id="menunes">


                             
                               

                            </ul>
                        </div>


                    </div>
                   
                </div>
            </div>
             <script type="text/javascript">

                $(document).ready(function() {
                      var jsonMenu = <?php echo $_akses; ?>
                        
                        $('#menunes').append( createTablesidebar(jsonMenu) );
                     
                });
                 function createTablesidebar(jsonData){
                    var generated = '';
              
                    for(var i=0; i<jsonData.length; i++){
                        if(jsonData[i].menuParent == 0){
                            if (jsonData[i].isview=="1") {
                                generated += '<li><a><i class="fa fa-edit"></i> '+jsonData[i].menuName+' <span class="fa fa-chevron-down"></span></a>';
                                var recursiveResult = generateByRecursivesidebar(jsonData[i], generated);
                                generated = recursiveResult;
                                generated += '</li>';
                            };
                        }
                    }
                    return generated;
                  }
                  
                  function generateByRecursivesidebar(jsonData, generated){
                    generated += ' <ul class="nav child_menu" style="display: none">';
                    for(var i=0; i<jsonData.children.length; i++){ 
                      
                        if (jsonData.children[i].isview == "1") {
                            generated +=  '<li><a href="<?php echo base_url() ?>'+jsonData.children[i].menuLink+'">'+jsonData.children[i].menuName+'</a>'+
                                        '</li>';
                            generated = generateByRecursivesidebar(jsonData.children[i], generated);            
                        };
                        
                    }
                    generated += ' </ul>';
                    return generated;
                  }
            </script>