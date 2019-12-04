<?php 
/*
<div class="widget">
    <div class="title"><h6>Chào mừng bạn đến với Administrator - HỆ THỐNG QUẢN TRỊ NỘI DUNG WEBSITE - Powered by <a href="http://www.nina.vn" target="_blank"><span style="color:#f00;">Thiết kế website NINA</span></a></h6><div class="clear"></div></div>
    <p>Nếu bạn có thắc mắc trong quá trình sử dụng, xin vui lòng gởi mail về địa chỉ <strong><a href="mailto:nina@nina.vn">nina@nina.vn</a></strong></p>
</div>
*/?>
<?php
    /* Set the default timezone */
    date_default_timezone_set("Asia/Ho_Chi_Minh");

    /* Set the date */
    if($_GET['datepicker']!=''){
        $date = strtotime($_GET['datepicker']);
    } else {
        $date = strtotime(date('y-m-d'));
    } 

    $day = date('d', $date);
    $month = date('m', $date);
    $year = date('Y', $date);
    $firstDay = mktime(0,0,0,$month, 1, $year);
    $title = strftime('%B', $firstDay);
    $dayOfWeek = date('D', $firstDay);
    $daysInMonth = cal_days_in_month(0, $month, $year);
    /* Get the name of the week days */
    $timestamp = strtotime('next Sunday');
    $weekDays = array();
    for ($i = 0; $i < 7; $i++) {
        $weekDays[] = strftime('%a', $timestamp);
        $timestamp = strtotime('+1 day', $timestamp);
    }
    $blank = date('w', strtotime("{$year}-{$month}-01"));

?>

<script type="text/javascript">
$(function () {
    $('#chart_visitor').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Thống kê truy cập tháng : <?php echo $month ?> - <?php echo $year ?> '
        },
        subtitle: {
            text: 'Devetloper by : <a href="http://nina.vn">Nina .LTD</a>'
        },
        xAxis: {
            categories: [
            <?php for($i = 1; $i <= $daysInMonth; $i++):?>
            '<?=$i?>',
            <?php endfor; ?>
            ]
        },
        yAxis: {
            title: {
                text: 'Tổng lượt truy cập'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'Số người truy cập',
            data: [
                <?php for($i = 1; $i <= $daysInMonth; $i++):
                     $k = $i+1;
                    $begin = strtotime($year.'-'.$month.'-'.$i);
                    $end = strtotime($year.'-'.$month.'-'.$k);

                    $query             =    "SELECT COUNT(*) AS todayrecord FROM counter WHERE tm>='$begin' and tm<'$end' "; 
                    $todayrc  = mysql_fetch_assoc($d->query($query)); 
                    $today_visitors     =    $todayrc['todayrecord']; 
                ?>
                <?=$today_visitors?>,
                <?php endfor; ?>

            ]
        }]
    });
    $( "#datepicker" ).datepicker({
      dateFormat: 'yy-mm-dd'
    });
});
</script>


<form name="supplier" id="validate" class="form" action="index.php" method="get" enctype="multipart/form-data">

   <div class="oneOne mtop10">
        <div class="widget mtop0">
           <div class="title">
                <h6>Chào mừng bạn đến với Administrator - HỆ THỐNG QUẢN TRỊ NỘI DUNG WEBSITE - Powered by <a href="http://www.nina.vn" target="_blank"><span style="color:#f00;">Thiết kế website NINA</span></a></h6>
                <p>Nếu bạn có thắc mắc trong quá trình sử dụng, xin vui lòng gởi mail về địa chỉ <strong><a href="mailto:nina@nina.vn">nina@nina.vn</a></strong></p>
            </div>
           
           <div class="formRow">
                <label>Thống kê theo tháng</label>
                <div class="formRight">
                    <input type="text" id="datepicker" name="datepicker" value="<?=$_GET['datepicker']?>" placeholder="yyyy-mm-dd" class="txt_ngay">
                    <input type="submit" class="blueB xemthongke btn_ngay" onclick="TreeFilterChanged2(); return false;" value="Xem thống kê" />
                </div>
           </div>
           <div id="chart_visitor" style="width: 100%; height: 400px; float: left;"></div>
          
        </div>
   </div>
</form>
<?php /*
<div class="widget">
    <div class="oneTwo">
        <div id="chart_browser" style="min-width: 310px; height: 400px; width: 100%; float: left;"></div>
    </div>
    <!-- 2 columns widgets -->
    <div class="oneTwo">            
        <div class="widget mtop0">
            <div class="title"><img src="./images/product-icon.png" alt="" class="titleIcon" /><h6>Sản phẩm mới</h6></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable taskWidget">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Tên sản phẩm</td>
                        <td>Ngày đăng</td>
                        <td width="60">Thao tác</td>
                    </tr>
                </thead>
                <tbody>
                 <?php for($i=0,$count=count($result_product);$i<$count;$i++) { ?>
                    <tr>
                        <td><?=$result_product[$i]['id']?></td>
                        <td style="text-align:left;">
                            <a href="index.php?com=product&act=edit&id_list=<?=$result_product[$i]['id_list']?>&id_cat=<?=$result_product[$i]['id_cat']?>&id_item=<?=$result_product[$i]['id_item']?>&id=<?=$result_product[$i]['id']?>" title="">
                                <?=$result_product[$i]['ten']?>
                            </a>
                        </td>
                        <td>
                            <span class="green f11">
                                <?=date('H:i:s d-m-Y',$result_product[$i]['ngaytao'])?>
                            </span>
                        </td>
                        <td class="actBtns">
                            <a href="index.php?com=product&act=edit&id_list=<?=$result_product[$i]['id_list']?>&id_cat=<?=$result_product[$i]['id_cat']?>&id_item=<?=$result_product[$i]['id_item']?>&id=<?=$result_product[$i]['id']?>" title="" class="smallButton tipS" original-title="Sửa sản phẩm">
                                <img src="./images/icons/dark/pencil.png" alt="">
                            </a>
                            <a href="" onclick="CheckDelete('index.php?com=product&act=delete&id=<?=$result_product[$i]['id']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa sản phẩm">
                                <img src="./images/icons/dark/close.png" alt="">
                            </a>  
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table> 
        </div>
        <div class="clear"></div>
    </div>
</div>
*/?>
<script src="js/highcharts/highcharts.js"></script>
<script src="js/highcharts/modules/exporting.js"></script>