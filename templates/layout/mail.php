<div class="container">
	<div class="box-mail">
		<div class="i bg ds-flex flex-wrap flex-between">
			<p>
				<img src="images/icon-mail.png" alt="Đăng ký nhận ưu đãi">
			</p>
			<p>
				<span>Đăng ký nhận ưu đãi</span>
				<span>Đăng ký nhận tin khuyến mãi ngay hôm nay để nhận được ưu đãi tốt nhất</span>
			</p>
		</div>
		<div class="i">
			<form  name="nhanemail" id="nhanemail" method="post" action="">
		        <input type="text" class="text-mail " required name="email_khachhang" id="email_khachhang" placeholder="Nhập email cỉa bạn để nhận tin khuyến mãi..."/>
		        <input type="hidden" name="ok-mail" id="ok-mail" />
		        <button type="submit" class="btn-mail">Đăng ký</button>
		    </form>
		</div>
		<div class="i ds-flex flex-wrap flex-between flex-align-center">
			<?php for($i=0;$i<count($mangxahoi_mail);$i++){   ?>
	        <a href="<?=$mangxahoi_mail[$i]['link']?>" title="<?=$mangxahoi_mail[$i]['ten']?>">
	          <img src="<?=_upload_hinhanh_l.$mangxahoi_mail[$i]['photo']?>" alt="<?=$mangxahoi_mail[$i]['ten']?>" width="40">
	        </a>
	        <?php } ?>
		</div>
	</div>
</div>

<?php
	
	if(isset($_POST['ok-mail']))
	{
		
		$email_khachhang=$_POST['email_khachhang'];
		
		$d->reset();
		$sql_mail="SELECT email FROM table_newsletter WHERE email='".$email_khachhang."'";
		$d->query($sql_mail);
		$mail2=$d->result_array();

		if(count($mail2)>0)
		{
			$s="Gửi thất bại";
			echo '<script language="javascript"> alert("'.$s.'") </script>';
		}
		else
		{


			$email_khachhang = trim(strip_tags($email_khachhang));
			$email_khachhang = mysql_real_escape_string($email_khachhang);

			if($_SESSION['dem-moc']<3){
				$sql = "INSERT INTO  table_newsletter (email) VALUES ('$email_khachhang')";	
				if($d->query($sql)== true)
				{
					$s="Gửi thành công";
					$_SESSION['dem-moc'] = $_SESSION['dem-moc'] + 1;
					echo '<script language="javascript"> alert("'.$s.'") </script>';
				}
			}else{
				echo '<script language="javascript"> alert("Bạn không thể gửi liên lục") </script>';
			}
			
		}
		
	}
?>