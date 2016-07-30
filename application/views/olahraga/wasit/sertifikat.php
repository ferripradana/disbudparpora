
        <h2 style="margin-top:0px">Sertifikat Wasit : <?php echo $nama ?></h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4"> 
                <?php 
                    echo anchor(site_url('wasit'),'Back', 'class="btn btn-primary"'); 
                ?>
                <a href="#" onclick="tambah()" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg" >Tambah</a>
            </div>
           
        </div>

        <table class="table table-striped responsive-utilities jambo_table bulk_action" style="margin-bottom: 10px">
            <thead>
            <tr class="headings">
                <th>No</th>
        		<th>Nama</th>
                <th>Tingkat</th>
                <th>Tahun</th>
                <th>Action</th>
            </tr></thead><?php
            $start = 1;
            foreach ($sertifikat_wasit as $wasit)
            {
               ?>
                <tr>
                    <td><?php echo $start++; ?> </td>
                    <td><?php echo $wasit->sertifikatname ?></td>
                    <td><?php echo $wasit->tingkat ?></td>
                    <td><?php echo $wasit->tahun ?></td>
                    <td>
                        <a href="#"   onclick="editsertifikat(<?php echo $wasit->id ?>)" data-toggle="modal" data-target=".bs-example-modal-lg" ><i class="fa fa-pencil"></i></a>
                            &nbsp;
                        <?php
                            echo anchor(site_url('wasit/deletesertifikat/'.$id_wasit.'/'.$wasit->id),'<i class="fa fa-eraser"></i>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 

                       ?>
                    </td>
                </tr>
                    
               <?php
            }
            ?>
        </table>
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                     <form name="sertifikatwasitform" id="sertifikatwasitform">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Sertifikat Wasit Form</h4>
                        </div>
                        <div class="modal-body">
                              <input type="hidden"  name="id_sertifikat" id="id_sertifikat">  
                              <input type="hidden" name="id_wasit" id="id_wasit" value="<?php echo $id_wasit?>">
                               <div class="form-group">
                                        <label for="varchar">Nama </label>
                                        <input type="text" class="form-control" name="sertifikatname" id="sertifikatname" placeholder="Nama Sertifikat"  />
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
                                        <label for="varchar">Tahun </label>
                                        <input type="text" class="form-control" name="tahun" id="tahun" placeholder="Tahun Sertifikat"  />
                                </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" id="closeyo" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" id="savesertifikat" onclick="save_sertifikat()">Save changes</button>
                          <button type="button" class="btn btn-primary"  id="updatesertifikat" style="display:none" onclick="update_sertifikat()">Update changes</button>
                        </div>

                      </div>
                    </div>
                    </form>
                  </div>
<script type="text/javascript">
    var save_sertifikat;
    var editsertifikat;
    var tambah;
    var update_sertifikat;
    $(document).ready(function(e){
        var host = "<?php echo base_url(); ?>"
        console.log(host);
        tambah = function(){
            $("#savesertifikat").show();
            $("#updatesertifikat").hide();
            $("input[type=text], textarea").val("");
        }
        save_sertifikat = function(){
            $.ajax({
                url  : host+"wasit/sertifikatsave",
                    type : "POST",
                    dataType:"json" ,
                    data: $("#sertifikatwasitform").serialize() ,
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
        editsertifikat = function(id){
                $("#updatesertifikat").show();
                 $("#savesertifikat").hide();
                 $.ajax({
                    url  : host+"wasit/sertifikatbyid/"+id,
                    type : "get",
                    dataType:"json" ,
                    success:function(data){
                        if(data.data.sukses==1){
                            //class="product-count"
                            $("#id_wasit").val(data.data.form.id_wasit);
                            $("#sertifikatname").val(data.data.form.sertifikatname);
                            $("#tingkat").val(data.data.form.tingkat);
                            $("#tahun").val(data.data.form.tahun);
                            $("#id_sertifikat").val(data.data.form.id);
                             
                        }else{
                            alert(data.data.message);
                        }

                    } 
                });                
        } ,
        update_sertifikat = function(){
                // alert("das");
                $.ajax({
                    url  : host+"wasit/sertifikatupdate",
                    type : "POST",
                    dataType:"json" ,
                    data: $("#sertifikatwasitform").serialize() ,
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
    })
</script>


