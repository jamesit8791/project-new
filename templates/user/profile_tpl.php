<div class="content w-100 mt-10 clearfix">
   <div class="nav-account f-left">
   		<?php include_once _template."user/left_account.php"; ?>
   </div>
   <div class="right-account f-right">
   		<div class="title bx-border brt-none mg-0 pb-5 w-100">
		    <h4 class="mg-0 ds-inline-block p-relative">Thông tin tài khoản</h4>
		</div>
		<div class="content w-100 mt-10 clearfix">
			<form method="post" id="frm-info" name="frm-info" action="thong-tin-ca-nhan.html" enctype="multipart/form-data">
				<div class="box-account f-left w-100 bx-border pd-20 bg-white">
					<div class="left-count f-left">
						<?php if($message!=''){ ?>
						<div class="alert <?=($status==1) ? 'alert-error':'alert-success'?> row-count w-100 f-left mb-15">
							<?=$message?>
						</div>
						<?php } ?>
						<div class="row-count w-100 f-left mb-15">
							<label>Họ tên</label>
							<div class="row-in">
								<input type="text" name="data[hoten]" class="input-count" id="hoten" value="<?=$_SESSION['logging']['hoten']?>" placeholder="">
								<p class="error-text cl-red"></p>
							</div>
						</div>
						<div class="row-count w-100 f-left mb-15">
							<label>Email</label>
							<div class="row-in">
								<input disabled type="text" name="data[email]" class="input-count" id="email" value="<?=$_SESSION['logging']['email']?>" placeholder="">
							</div>
						</div>
						<div class="row-count w-100 f-left mb-15">
							<label>Điện thoại</label>
							<div class="row-in">
								<input type="text" name="data[dienthoai]" class="input-count" id="dienthoai" value="<?=$_SESSION['logging']['dienthoai']?>" placeholder="">
								<p class="error-text cl-red"></p>
							</div>
						</div>
						<?php if($_SESSION['logging']['ngaysinh']!=''){ 
							$ex_date = explode('/', $_SESSION['logging']['ngaysinh']);
						} ?>
						<div class="row-count w-100 f-left mb-15">
							<label>Ngày sinh</label>
							<div class="row-in">
								<select name="data[ngay]" class="input-count" id="thang">
									<option value="">Ngày</option>
									<?php for($i=1;$i<=31;$i++){ ?>
									<option value="<?=$i?>" <?=($ex_date[0]==$i) ? 'selected':''?>><?=$i?></option>
									<?php } ?>
								</select>
								<select name="data[thang]" class="input-count" id="ngay">
									<option value="">Tháng</option>
									<?php for($i=1;$i<=12;$i++){ ?>
									<option value="<?=$i?>" <?=($ex_date[1]==$i) ? 'selected':''?>><?=$i?></option>
									<?php } ?>
								</select>
								<select name="data[nam]" class="input-count f-right mr-0" id="nam">
									<option value="">Năm</option>
									<?php for($i=1970;$i<=(date('Y')-15);$i++){ ?>
									<option value="<?=$i?>" <?=($ex_date[2]==$i) ? 'selected':''?>><?=$i?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="row-count w-100 f-left mb-15">
							<label>&nbsp;</label>
							<input class="button bg-primary cl-white t-uppercase" type="button" id="btn-submit-update" value="Cập nhật"/>
						</div>
					</div>
					<div class="right-count f-right t-center">
						<div class="img-view">
							<img src="<?=_upload_avatar_l.$_SESSION['logging']['photo']?>" id="img-view" alt="Avatar">
						</div>
						<div class="file-upload">
						    <label for="upload" class="file-upload__label">Chọn file</label>
						    <input id="upload" class="file-upload__input" type="file" name="file">
						</div>
						<div class="mesage-upload">
							Dụng lượng file tối đa 1 MB <br/>Định dạng:.JPEG, .PNG
						</div>
					</div>
				</div>
			</form>
		</div>
   </div>
</div>
<script type="text/javascript">
	function validateEmail($email) {
	  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	  return emailReg.test( $email );
	}
	function validatePhone($phone) {
	    var filter = /^[0-9-+]{10,11}$/;
	    return filter.test($phone);
	}
	 function readURL(input,view) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $(view).attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    
	$(document).ready(function() {
		$("#upload").change(function(){
	        readURL(this,'#img-view');
	    });
		$('#btn-submit-update').click(function() {
			error = false;

			var hoten = $('#hoten').val();
			var dienthoai = $('#dienthoai').val();
			if(hoten==''){
				error = true;
				$('#hoten').addClass('has-error');
				$('#hoten').next('p').html('Quý khách chưa nhập họ tên');
				return false;
			}else{
				error = false;
				$('#hoten').removeClass('has-error');
				$('#hoten').next('p').html('');
			}

			if(dienthoai==''){
				error = true;
				$('#dienthoai').addClass('has-error');
				$('#dienthoai').next('p').html('Quý khách chưa nhập điện thoại');
				return false;
			}else{
				if(!validatePhone(dienthoai)){
					error = true;
					$('#dienthoai').addClass('has-error');
					$('#dienthoai').next('p').html('Điện thoại không đúng định dạng');
					return false;
				}else{
					error = false;
					$('#dienthoai').removeClass('has-error');
					$('#dienthoai').next('p').html('');
				}
			}

			if(error == false){
				$('#frm-info').submit();
			}else{
				return false;
			}
		});
	});
</script>