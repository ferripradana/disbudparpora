<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*------------UPLOAD-------*/

function getConfigUpload($file_name){
	// print_r($file); die();
	$config = array(
		'file_name'	=> date('Ymdhis').$file_name,
        'upload_path' => './upload/',
        'allowed_types' => 'gif|jpg|png',
        'max_size'  => '6000',
    );
	return $config; 
}
function getConfigThumb($path){
 	$config = array(
       	'source_image' => $path,
        'new_image' => './upload/thumbs',
        'maintain_ratio' => true,
        'width' => 120,
        'height' => 160
    );  	
    return $config;
}

/*------------END UPLOAD-------*/

function date_for_mysql($date){
    $date = explode("/", $date);
    return $date[2].'/'.$date[1].'/'.$date[0];
}

function date_for_form($date){
    $date = explode("-", $date);
    return $date[2].'/'.$date[1].'/'.$date[0];
}

function getStatus(){
    $status = array (0=>'Diajukan', '1'=>'Disetujui', '2'=> 'Ditolak');
    return $status;
}
function getStatusByValue($id){
    $status = array (0=>'Diajukan', '1'=>'Disetujui', '2'=> 'Ditolak');
    return $status[$id];
}


function date_formater($date){
    $bulan = array(
            '0' => '',
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
    );
    if ($date=='0000-00-00') {
        return '';
    }
    $date = explode("-", $date);
    return $date[2].' '.$bulan[(int)$date[1]].' '.$date[0];
}


function MonthTranslate($value){
    $bulan = array(
            '1' => 'januari',
            '2' => 'februari',
            '3' => 'maret',
            '4' => 'april',
            '5' => 'mei',
            '6' => 'juni',
            '7' => 'juli',
            '8' => 'agustus',
            '9' => 'september',
            '10' => 'oktober',
            '11' => 'november',
            '12' => 'desember'
    );
    // echo array_search($value, $bulan); die();
    return array_search($value, $bulan);
}

//recursive
  function get_menu($results,$parent_id){
        $menu = array();
            foreach ($results as $element) {
                if ($element['menuParent'] == $parent_id) {
                    $children = get_menu($results, $element['menuId']);
                    if ($children) { 
                       $element['children'] = $children;
                    }else{
                        $element['children'] = array();
                    }
                    $menu[] = $element;
                }
            }

        return $menu;
    }

    function getConfigPaging($base_url, $rows, $menu, $search = 0){
        $config['base_url'] = base_url() . $base_url;
        $config['total_rows'] = $rows;
        $config['per_page'] = 10;
        $config['uri_segment'] = ($search==1)?4:3;
        $config['suffix'] = '';
        $config['first_url'] = base_url() . $menu;
        return $config;
    }

    function getGender($value){
        switch ($value) {
            case 1:
                # code...
                return "Laki-laki";
                break;
             case 2:
                # code...
                return "Perempuan";
                break;    
            
            default:
                # code...
                break;
        }
    }
    function getKategori($value){
        switch ($value) {
            case 1:
                # code...
                return "Lapangan Olahraga";
                break;
             case 2:
                # code...
                return "Gedung Olahraga";
                break;    
            
            default:
                # code...
                break;
        }
    }
    function getKondisi($value){
        switch ($value) {
            case 1:
                # code...
                return "Baik";
                break;
            case 2:
                # code...
                return "Sedang";
                break;    
            case 3:
                # code...
                return "Rusak";
                break;
            default:
                # code...
                break;
        }
    }
    function get_mark($value){
        if ($value==1) {
            return '&#10004;';
        }else{
            return '';
        }
    }

   
