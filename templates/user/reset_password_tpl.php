<div class="content w-100 mt-10 clearfix">
   <div class="nav-account f-left">
   		<?php include_once _template."user/left_account.php"; ?>
   </div>
   <div class="right-account f-right">
   		<div class="title bx-border brt-none mg-0 pb-5 w-100">
		    <h4 class="mg-0 ds-inline-block p-relative">Đổi mật khẩu</h4>
		</div>
		<div class="content w-100 mt-10 clearfix">
			<form method="post" id="frm-repass" name="frm-repass" action="doi-mat-khau.html" enctype="multipart/form-data">
				<div class="box-account f-left w-100 bx-border pd-20 bg-white">
					<div class="left-count f-left">
						<?php if($message!=''){ ?>
						<div class="alert <?=($status==1) ? 'alert-error':'alert-success'?> row-count w-100 f-left mb-15">
							<?=$message?>
						</div>
						<?php } ?>
						<div class="row-count w-100 f-left mb-15">
							<label>Mật khẩu cũ</label>
							<div class="row-in">
								<input type="password" name="data[password-old]" class="input-count" id="password-old" value="" placeholder="">
								<p class="error-text cl-red"></p>
							</div>
						</div>
						<div class="row-count w-100 f-left mb-15">
							<label>Mật khẩu mới</label>
							<div class="row-in">
								<input type="password" name="data[password]" class="input-count" id="password" value="" placeholder="">
								<p class="error-text cl-red"></p>
							</div>
						</div>
						<div class="row-count w-100 f-left mb-15">
							<label>Xác nhận mật khẩu</label>
							<div class="row-in">
								<input type="password" name="data[password-confirm]" class="input-count" id="password-confirm" value="" placeholder="">
								<p class="error-text cl-red"></p>
							</div>
						</div>
						<div class="row-count w-100 f-left">
							<label>&nbsp;</label>
							<input class="button bg-primary cl-white t-uppercase" type="button" id="btn-submit-repass" value="Thay đổi"/>
						</div>
					</div>
					<div class="right-count f-right t-center">
						
					</div>
				</div>
			</form>
		</div>
   </div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#btn-submit-repass').click(function() {
			error = false;
			var password_old = $('#password-old').val();
			var password = $('#password').val();
			var password_confirm = $('#password-confirm').val();
			if(password_old==''){
				error = true;
				$('#password-old').addClass('has-error');
				$('#password-old').next('p').html('Quý khách chưa nhập mật khẩu');
				return false;
			}else{
				error = false;
				$('#password-old').removeClass('has-error');
				$('#password-old').next('p').html('');
			}

			if(password==''){
				error = true;
				$('#password').addClass('has-error');
				$('#password').next('p').html('Quý khách chưa nhập mật khẩu');
				return false;
			}else{
				error = false;
				$('#password').removeClass('has-error');
				$('#password').next('p').html('');
			}
			if(password_confirm==''){
				error = true;
				$('#password-confirm').addClass('has-error');
				$('#password-confirm').next('p').html('Quý khách chưa nhập mật khẩu xác nhận');
				return false;
			}else{
				error = false;
				$('#password-confirm').removeClass('has-error');
				$('#password-confirm').next('p').html('');
			}

			if(password_confirm!=password){
				error = true;
				$('#password-confirm').addClass('has-error');
				$('#password-confirm').next('p').html('Mật khẩu và Mật khẩu xác nhận không giống nhau');
				return false;
			}else{
				error = false;
				$('#password-confirm').removeClass('has-error');
				$('#password-confirm').next('p').html('');
			}

			if(error == false){
				$('#frm-repass').submit();
			}else{
				return false;
			}
		});
	});
</script>