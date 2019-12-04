<?php 
	include_once "ajax_lib.php";
	if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false)){
		header('Content-Type: text/html; charset=utf-8');
		die("Bạn Không có quyền vào đây !");
	}else{
		if (isset($_POST["level"])) {
			$level = htmlspecialchars($_POST["level"]);
			$id= htmlspecialchars($_POST["id"]);
			$type = htmlspecialchars($_POST["type"]);
			switch ($level) {
				case '0':{
					$sql="select * from table_product_cat where id_list=".$id." and type='".$type."'  order by stt ";
					$stmt=mysql_query($sql);
					$str='
						<option value="">Chọn danh mục cấp 2</option>			
						';
					while ($row=@mysql_fetch_array($stmt)) 
					{
						if($row["id"]==(int)@$id_select)
							$selected="selected";
						else 
							$selected="";

						$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';			
					}
					echo  $str;
					break;
				}
				case '1':{
					$sql="select * from table_product_item where id_cat=".$id." and  type='".$type."' order by stt";
					$stmt=mysql_query($sql);
					$str='
						<option value="">Chọn danh mục cấp 3</option>			
						';
					while ($row=@mysql_fetch_array($stmt)) 
					{
						if($row["id"]==(int)@htmlspecialchars($_REQUEST["id_cat"]))
							$selected="selected";
						else 
							$selected="";
						$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';			
					}
					echo $str;
					break;
				}
				case '2':{
					echo $sql="select * from table_product_sub where id_item=".$id." and  type='".$type."' order by stt";
					$stmt=mysql_query($sql);
					$str='
						<option value="">Chọn danh mục cấp 4</option>			
						';
					while ($row=@mysql_fetch_array($stmt)) 
					{
						if($row["id"]==(int)@htmlspecialchars($_REQUEST["id_cat"]))
							$selected="selected";
						else 
							$selected="";
						$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';			
					}
					echo $str;
					break;
				}
				default:
					echo 'error ajax';
					break;
			}
			
		}
	}
	
?>
