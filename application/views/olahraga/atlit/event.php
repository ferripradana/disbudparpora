
        <h2 style="margin-top:0px">Event Atlit : <?php echo  $nama ?></h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4"> 
                <?php 
                    echo anchor(site_url('atlit'),'Back', 'class="btn btn-primary"'); 
                ?>
                <a href="#"  onclick="tambah()" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg" >Tambah</a>
            </div>
           
        </div>

        <table class="table table-striped responsive-utilities jambo_table bulk_action" style="margin-bottom: 10px">
            <thead>
            <tr class="headings">
                <th>No</th>
        		<th>Nama</th>
                <th>Tingkat</th>
                <th>Tahun</th>
                <th>Medali</th>
                <th>Peringkat</th>
                <th>Action</th>
            </tr></thead><?php
            $start = 1;
            foreach ($atlit_event as $atlit)
            {
               ?>
                <tr>
                    <td><?php echo $start++; ?> </td>
                    <td><?php echo $atlit->name ?></td>
                    <td><?php echo $atlit->tingkat ?></td>
                    <td><?php echo $atlit->tahun ?></td>
                    <td><?php echo $atlit->medali ?></td>
                    <td><?php echo $atlit->peringkat ?></td>
                    <td>
                        <a href="#"   onclick="editevent(<?php echo $atlit->id ?>)" data-toggle="modal" data-target=".bs-example-modal-lg" ><i class="fa fa-pencil"></i></a>
                            &nbsp;
                        <?php
                            echo anchor(site_url('atlit/deleteevent/'.$id_atlit.'/'.$atlit->id),'<i class="fa fa-eraser"></i>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 

                       ?>
                    </td>
                </tr>
                    
               <?php
            }
            ?>
        </table>
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <form name="eventatlitform" id="eventatlitform">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Event Atlit Form</h4>
                        </div>
                        <div class="modal-body">
                              <input type="hidden"  name="id_event" id="id_event">  
                              <input type="hidden" name="id_atlit" id="id_atlit" value="<?php echo $id_atlit ?>">
                               <div class="form-group">
                                        <label for="varchar">Nama </label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Nama Event"  />
                                </div>
                                <div class="form-group">
                                        <label for="varchar">Tingkat </label>
                                        <select class="select2_single form-control" name="tingkat" id="tingkat" tabindex="-1">
                                            <option value="Daerah / Kab Kota">Daerah / Kab Kota</option>
                                            <option value="Provinsi">Provinsi</option>
                                            <option value="Nasional">Nasional</option> 
                                            <option value="Internasional">Internasional</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                        <label for="varchar">Tahun</label>
                                        <input type="text" class="form-control" name="tahun" id="tahun" placeholder="Tahun"  />
                                </div>
                                <div class="form-group">
                                        <label for="varchar">Medali </label>
                                        <select class="select2_single form-control" name="medali" id="medali" tabindex="-1">
                                            <option value="Emas">Emas</option>
                                            <option value="Perak">Perak</option>
                                            <option value="Perungu">Perungu</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                        <label for="varchar">Peringkat </label>
                                        <input type="text" class="form-control" name="peringkat" id="peringkat" placeholder="peringkat"  />
                                </div>
                          
                        </div>
                        <div class="modal-footer">
                          <button type="button" id="closeyo" class="btn btn-default"  data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" id="saveevent" onclick="save_event()">Save changes</button>
                           <button type="button" class="btn btn-primary"  id="updateevent" style="display:none" onclick="update_event()">Update changes</button>
                        </div>

                      </div>
                    </div>
                    </form>
                  </div>
<script type="text/javascript">
    var save_event;
    var editevent;
    var tambah;
    var update_event;
    $(document).ready(function(e){
             var host = "<?php echo base_url(); ?>";
             console.log(host);
             tambah = function(){
                 $("#saveevent").show();
                  $("#updateevent").hide();
                  $("input[type=text], textarea").val("");
             }
             save_event = function(){
                // alert("das");
                $.ajax({
                    url  : host+"atlit/eventsave",
                    type : "POST",
                    dataType:"json" ,
                    data: $("#eventatlitform").serialize() ,
                    success:function(data){
                        if(data.data.sukses==1){
                            //class="product-count"
                             
                            alert("berhasil disimpan");
                             $("input[type=text], textarea").val("");
                            $("#closeyo").click();
                            location.reload();
                        }else{
                            alert(data.data.message);
                        }

                    } 
                });

             },
             editevent = function(id){
                $("#updateevent").show();
                 $("#saveevent").hide();
                 $.ajax({
                    url  : host+"atlit/eventbyid/"+id,
                    type : "get",
                    dataType:"json" ,
                    success:function(data){
                        if(data.data.sukses==1){
                            //class="product-count"
                            $("#id_atlit").val(data.data.form.id_atlit);
                            $("#name").val(data.data.form.name);
                            $("#tingkat").val(data.data.form.tingkat);
                            $("#tahun").val(data.data.form.tahun);
                            $("#medali").val(data.data.form.medali);
                            $("#peringkat").val(data.data.form.peringkat);
                            $("#id_event").val(data.data.form.id);
                             
                        }else{
                            alert(data.data.message);
                        }

                    } 
                });                
             } ,
             update_event = function(){
                // alert("das");
                $.ajax({
                    url  : host+"atlit/eventupdate",
                    type : "POST",
                    dataType:"json" ,
                    data: $("#eventatlitform").serialize() ,
                    success:function(data){
                        if(data.data.sukses==1){
                            //class="product-count"
                             
                            alert("berhasil disimpan");
                             $("input[type=text], textarea").val("");
                            $("#closeyo").click();
                            location.reload();
                        }else{
                            alert(data.data.message);
                        }

                    } 
                });

             }
    });


</script>

