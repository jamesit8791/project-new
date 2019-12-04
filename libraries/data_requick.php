<?php
$arr_data = array(
    array("tbl"=>"product_list","field"=>"idl","source"=>"product","com"=>"san-pham","type"=>"san-pham"),
    array("tbl"=>"product_cat","field"=>"idl","source"=>"product","com"=>"san-pham","type"=>"san-pham"),
    array("tbl"=>"product","field"=>"id","source"=>"product","com"=>"san-pham","type"=>"san-pham"),
    array("tbl"=>"baiviet","field"=>"id","source"=>"news","com"=>"dich-vu","type"=>"dich-vu"),
    array("tbl"=>"baiviet","field"=>"id","source"=>"news","com"=>"tin-tuc","type"=>"tin-tuc"),
    array("tbl"=>"baiviet","field"=>"id","source"=>"news","com"=>"chinh-sach","type"=>"chinh-sach"),
    array("tbl"=>"info","field"=>"id","source"=>"baiviet","com"=>"gioi-thieu","type"=>"gioi-thieu"),
    array("tbl"=>"album","field"=>"id","source"=>"thuvienanh","com"=>"hinh-anh","type"=>"album")
);


if($com){
    foreach($arr_data as $k=>$v){
        if(isset($com) && $v['tbl']!='info' && $v['tbl']!='video'){
            $d->query("select id from #_".$v['tbl']." where tenkhongdau='".$com."' and type='".$v['type']."' and hienthi=1");
            if($d->num_rows()>=1){
                $row = $d->fetch_array();
                $_GET[$v['field']] = $row['id'];
                $com = $v['com'];
                break;
            }
        }
    }
}
?>