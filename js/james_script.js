function onSearch(evt){
	var keyword = $('#keyword');

	if(keyword.val()==''){
		alert('Bạn chưa nhập thông tin tìm kiếm!');
		keyword.focus();
		return false;
	}else{
		$('#frm-search').submit();
	}

}
function doEnter(evt){
	var key;
	if(evt.keyCode == 13 || evt.which == 13){
		onSearch(evt);
	}else{
		return false;
	}
}
function submitMail(){
	if(isEmpty(document.getElementById('email_khachhang'), 'Nhập email của bạn')){
		document.getElementById('email_khachhang').focus();
		return false;
	}
	if(!check_email(document.nhanemail.email_khachhang.value)){
		alert('Email không hợp lệ');
		document.nhanemail.email_khachhang.focus();
		return false;
	}
	document.nhanemail.submit();
}
function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}
function goToByScroll(id) {
    $('html,body').animate({
        scrollTop: $("#" + id).offset().top - 60
    }, 'slow');
}
function validatePhone($phone) {
    var filter = /^[0-9-+]{10,11}$/;
    return filter.test($phone);
}
function addCart(id,sl,st){
  $.ajax({
    url: 'ajax/add_giohang.php',
    type: 'POST',
    data: {id: id, sl:sl},
    dataType: 'JSON',
    success: function(data){
        if(st==0){
            $('#cart-view').html(data.total);
            $('#cart-view1').html(data.total);
            $.confirm({
                boxWidth: '300px',
                useBootstrap: false,
                columnClass: 'small',
                type: 'orange',
                title: 'Thông báo đặt hàng',
                content: data.message,
                buttons: {
                close: function(){
                }
            }
          });
        }

        if(st==1){
            window.location.href = 'thanh-toan.html';
        }
    }
  })
}
function del(pid){
	if(confirm('Bạn muốn xóa sản phẩm này trong giỏ hàng?')){
		document.form1.pid.value=pid;
		document.form1.command.value='delete';
		document.form1.submit();
	}
}
function clear_cart(){
	if(confirm('Giỏ hàng sẽ rỗng nếu bạn tiếp tục?')){
		document.form1.command.value='clear';
		document.form1.submit();
	}
}
function update_cart(){
	document.form1.command.value='update';
	document.form1.submit();
}
$(document).ready(function() {
	$('#menu-mobile').mmenu();
	$('.bgts').click(function() {
	  $('html, body').animate({scrollTop:0},500);
	});

	$('#search .button-search').click(function(evt){
		onSearch(evt);
	});

	$('.left-product').on('click', 'li a', function(event) {
		$('.left-product li').removeClass('active');
		var obj = $(this);
		var id = parseInt(obj.data('id'));
		var idl = parseInt(obj.data('idl'));
		$(this).parent('li').addClass('active');
		$.ajax({
			url: 'ajax/load_sp.php',
			type: 'POST',
			data: {id: id},
			success: function(data){
				$('#show-product'+idl).html(data);
			}
		});
		
	});

	$('.click-search').click(function() {
		if($(this).hasClass('active')){
			$(this).find('i').addClass('fa fa-search').removeClass('pe-7s-close');
			$('.search').stop().animate({
				width: "0%"
			}, 1000);
			$(this).removeClass('active');
		}else{
			$('.search').stop().animate({
				width: "280px"
			}, 1000);
			$(this).find('i').removeClass('fa fa-search').addClass('pe-7s-close');
			$(this).addClass('active');
		}
	});


	$('body').append('<div id="top">&uarr;&uarr;</div>');
	$(window).scroll(function() {
	  if($(window).scrollTop() > 100) {
	      $('#top').addClass('top_ani');
	  } else {
	      $('#top').removeClass('top_ani');
	  }
	});

	$('#top').click(function() {
	  $('html, body').animate({scrollTop:0},500);
	});

	$('.slickTinTuc').slick({
		dots: false,
		infinite: true,
		speed: 600,
		vertical: false,
		slidesToShow: 4,
		slidesToScroll: 1,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 3000
	});

	$('.slickTTuc').slick({
		dots: false,
		infinite: true,
		speed: 600,
		vertical: false,
		slidesToShow: 3,
		slidesToScroll: 1,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 3000
	});
	
	$('.quangcao').slick({
		dots: false,
		infinite: true,
		speed: 300,
		vertical: true,
		slidesToShow: 2,
		slidesToScroll: 1,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 3000
	});

	$('.quangcao_mobile').slick({
		dots: false,
		infinite: true,
		speed: 300,
		vertical: false,
		slidesToShow: 3,
		slidesToScroll: 1,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 3000,
		responsive: [
		  {
		    breakpoint: 600,
		    settings: {
		      slidesToShow: 2,
		      slidesToScroll: 1
		    }
		  },
		  {
		    breakpoint: 480,
		    settings: {
		      slidesToShow: 2,
		      slidesToScroll: 1
		    }
		  },
		  {
		    breakpoint: 320,
		    settings: {
		      slidesToShow: 1,
		      slidesToScroll: 1
		    }
		  }
		]
	});

	$('.slickProduct').slick({
		dots: false,
		infinite: false,
		speed: 300,
		vertical: false,
		slidesToShow: 4,
		slidesToScroll: 1,
		arrows: true,
		autoplay: false,
		autoplaySpeed: 2000
	});

	$('.slickProduct_mobile').slick({
		dots: false,
		infinite: false,
		speed: 300,
		vertical: false,
		slidesToShow: 3,
		slidesToScroll: 1,
		arrows: true,
		autoplay: false,
		autoplaySpeed: 2000,
		responsive: [
		  {
		    breakpoint: 600,
		    settings: {
		      slidesToShow: 2,
		      slidesToScroll: 1
		    }
		  },
		  {
		    breakpoint: 480,
		    settings: {
		      slidesToShow: 1,
		      slidesToScroll: 1
		    }
		  },
		  {
		    breakpoint: 320,
		    settings: {
		      slidesToShow: 1,
		      slidesToScroll: 1
		    }
		  }
		]
	});

	$('.menu-m').click(function(event) {
		if(!$(this).hasClass('active')){
			$(this).parents('.spanmenu').find('ul').addClass('show');
			$(this).addClass('active');
		}else{
			$(this).parents('.spanmenu').find('ul').removeClass('show');
			$(this).removeClass('active');
		}
	});
	$('.slickDoiTac').slick({
		dots: false,
		infinite: true,
		speed: 300,
		vertical: false,
		slidesToShow: 6,
		slidesToScroll: 1,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 2000,
		responsive: [
		  {
		    breakpoint: 1024,
		    settings: {
		      slidesToShow: 3,
		      slidesToScroll: 1
		    }
		  },
		  {
		    breakpoint: 600,
		    settings: {
		      slidesToShow: 2,
		      slidesToScroll: 1
		    }
		  },
		  {
		    breakpoint: 480,
		    settings: {
		      slidesToShow: 1,
		      slidesToScroll: 1
		    }
		  }
		]
	});

	$('.slickDoiTac_mobile').slick({
		dots: false,
		infinite: true,
		speed: 300,
		vertical: false,
		slidesToShow: 4,
		slidesToScroll: 1,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 2000,
		responsive: [
		  {
		    breakpoint: 600,
		    settings: {
		      slidesToShow: 3,
		      slidesToScroll: 1
		    }
		  },
		  {
		    breakpoint: 480,
		    settings: {
		      slidesToShow: 2,
		      slidesToScroll: 1
		    }
		  }
		]
	});

	$('#video_load').load("ajax/video_load.php?id="+active_youtube);
    $('#list_video').change(function() {
      var id = $(this).val();
      $.ajax({
        url: 'ajax/video_load.php',
        type: 'POST',
        data: {id: id},
        success: function(msg){
           $('#video_load').html(msg);
        }
      })
    });
    $('.imgvideo').click(function() {
		 var id = $(this).data('id');
		 $.ajax({
			 url: 'ajax/video_load.php',
			 type: 'POST',
			 data: {id: id},
			 success: function(msg){
					$('#video_load').html(msg);
			 }
		 })
	 });
    $('.videoslider').slick({
		dots: false,
		infinite: true,
		speed: 400,
		vertical: false,
		slidesToShow: 3,
		slidesToScroll: 1,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 2000
	});
    $('#btn-submit-contact').click(function() {

		var error = true;
		var hoten = $('#hoten').val();
		var diachi = $('#diachi').val();
		var dienthoai = $('#dienthoai').val();
		var email = $('#email').val();
		var tieude = $('#tieude').val();
		var noidung = $('#noidung').val();
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
		if(active_address==1){ 
			if(diachi==''){
				error = true;
				$('#diachi').addClass('has-error');
				$('#diachi').next('p').html('Quý khách chưa nhập địa chỉ');
				return false;
			}else{
				error = false;
				$('#diachi').removeClass('has-error');
				$('#diachi').next('p').html('');
			}
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
		if(email==''){
			error = true;
			$('#email').addClass('has-error');
			$('#email').next('p').html('Quý khách chưa nhập email');
			return false;
		}else{
			if(!validateEmail(email)){
				error = true;
				$('#email').addClass('has-error');
				$('#email').next('p').html('Email không đúng định dạng');
				return false;
			}else{
				error = false;
				$('#email').removeClass('has-error');
				$('#email').next('p').html('');
			}
		}
		if(tieude==''){
			error = true;
			$('#tieude').addClass('has-error');
			$('#tieude').next('p').html('Quý khách chưa nhập tiêu đề');
			return false;
		}else{
			error = false;
			$('#tieude').removeClass('has-error');
			$('#tieude').next('p').html('');
		}

		if(noidung==''){
			error = true;
			$('#noidung').addClass('has-error');
			$('#noidung').next('p').html('Quý khách chưa nhập nội dung');
			return false;
		}else{
			error = false;
			$('#noidung').removeClass('has-error');
			$('#noidung').next('p').html('');
		}


		if(error == false){
			$('#frm_contact').submit();
		}else{
			return false;
		}
	});


	$('#btn-submit-order').click(function() {

		var error = true;
		var hoten1 = $('#hoten1').val();
		var dienthoai1 = $('#dienthoai1').val();
		var email1 = $('#email1').val();
		var noidung1 = $('#noidung1').val();
		if(hoten1==''){
			error = true;
			$('#hoten1').addClass('has-error');
			$('#hoten1').next('p').html('Quý khách chưa nhập họ tên');
			return false;
		}else{
			error = false;
			$('#hoten1').removeClass('has-error');
			$('#hoten1').next('p').html('');
		}

		if(dienthoai1==''){
			error = true;
			$('#dienthoai1').addClass('has-error');
			$('#dienthoai1').next('p').html('Quý khách chưa nhập điện thoại');
			return false;
		}else{
			if(!validatePhone(dienthoai1)){
				error = true;
				$('#dienthoai1').addClass('has-error');
				$('#dienthoai1').next('p').html('Điện thoại không đúng định dạng');
				return false;
			}else{
				error = false;
				$('#dienthoai1').removeClass('has-error');
				$('#dienthoai1').next('p').html('');
			}
		}
		if(email1==''){
			error = true;
			$('#email1').addClass('has-error');
			$('#email1').next('p').html('Quý khách chưa nhập email');
			return false;
		}else{
			if(!validateEmail(email1)){
				error = true;
				$('#email1').addClass('has-error');
				$('#email1').next('p').html('Email không đúng định dạng');
				return false;
			}else{
				error = false;
				$('#email1').removeClass('has-error');
				$('#email1').next('p').html('');
			}
		}

		if(noidung1==''){
			error = true;
			$('#noidung1').addClass('has-error');
			$('#noidung1').next('p').html('Quý khách chưa nhập nội dung');
			return false;
		}else{
			error = false;
			$('#noidung1').removeClass('has-error');
			$('#noidung1').next('p').html('');
		}


		if(error == false){
			$('#frm_order').submit();
		}else{
			return false;
		}
	});
	var nav = $('.chaytop');

	$(window).scroll(function () {
			if ($(this).scrollTop() > 50) {
				nav.addClass("menu-fixtop");
			} else {
				nav.removeClass("menu-fixtop");
			}
	});


	 $('.tabs-click').click(function() {
        var obj = $(this);
        var i = obj.index()+1;
        $('.tabs-click').removeClass('active');
        obj.addClass('active');
        var tab = '#tabs'+i;
        $('.tabs-content').hide();
        obj.parent('.tabs-detail').parent('.tab-box').find(tab).fadeIn(300);
    });

    $('.minus_giohang').click(function(){
      var number_giohang=$('.number_giohang').val();
      if(number_giohang>1){
        var number_change=parseInt(number_giohang)-1;
        $('.number_giohang').val(number_change);
      }
    });

    $('.plus_giohang').click(function(){
       var number_giohang=$('.number_giohang').val();
      if(number_giohang<101){
        var number_change=parseInt(number_giohang)+1;
        $('.number_giohang').val(number_change);
      }
    });


    $('#btn-tour-submit').click(function() {
		var error = true;
		var hoten = $('#hoten').val();
		var diachi = $('#diachi').val();
		var dienthoai = $('#dienthoai').val();
		var email = $('#email').val();
		var ghichu = $('#ghichu').val();
		var sokhach = $('#sokhach').val();
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
			$('#dienthoai').next('span').next('p').html('Quý khách chưa nhập điện thoại');
			return false;
		}else{
			if(!validatePhone(dienthoai)){
				error = true;
				$('#dienthoai').addClass('has-error');
				$('#dienthoai').next('span').next('p').html('Điện thoại không đúng định dạng');
				return false;
			}else{
				error = false;
				$('#dienthoai').removeClass('has-error');
				$('#dienthoai').next('span').next('p').html('');
			}
		}
		if(email==''){
			error = true;
			$('#email').addClass('has-error');
			$('#email').next('p').html('Quý khách chưa nhập email');
			return false;
		}else{
			if(!validateEmail(email)){
				error = true;
				$('#email').addClass('has-error');
				$('#email').next('p').html('Email không đúng định dạng');
				return false;
			}else{
				error = false;
				$('#email').removeClass('has-error');
				$('#email').next('p').html('');
			}
		}
		if(diachi==''){
			error = true;
			$('#diachi').addClass('has-error');
			$('#diachi').next('p').html('Quý khách chưa nhập địa chỉ');
			return false;
		}else{
			error = false;
			$('#diachi').removeClass('has-error');
			$('#diachi').next('p').html('');
		}
		if(sokhach==''){
			error = true;
			$('#sokhach').addClass('has-error');
			$('#sokhach').next('p').html('Quý khách chưa nhập số lượng khách');
			return false;
		}else{
			error = false;
			$('#sokhach').removeClass('has-error');
			$('#sokhach').next('p').html('');
		}
		if(error == false){
			$('#frm-tour').submit();
		}else{
			return false;
		}
	});

    $('.slickDetail').slick({
        dots: false,
        infinite: true,
        speed: 300,
        vertical: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        autoplay: false,
        autoplaySpeed: 2000,
		responsive: [
		  {
		    breakpoint: 992,
		    settings: {
		      slidesToShow: 3,
		      slidesToScroll: 1
		    }
		  }
		]
    });


    $('.update-sl').keyup(function() {
		var id = $(this).data('id');
		var sl = $(this).val();
		$.ajax({
			url: 'ajax/update_sl.php',
			type: 'POST',
			data: {id: id, sl: sl},
			dataType:'json',
			success: function(data){
				$('#cart-view').html(data.total);
				$('#cart-view1').html(data.total);
				$('#tonggia-x').html(data.totalorder);
				$('#thanhtien'+id).html(data.thanhtien);

			}
		});
		
	});


    $('#btn-order-submit').click(function() {

		var error = true;
		var id_nguoinhan = $('#use_one_address').val();
		var hoten = $('#hoten').val();
		var diachi = $('#diachi').val();
		var dienthoai = $('#dienthoai').val();
		var email = $('#email').val();
		var city = $('#city').val();
		var dist = $('#dist').val();
		var ghichu = $('#ghichu').val();
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
			$('#dienthoai').next('span').next('p').html('Quý khách chưa nhập điện thoại');
			return false;
		}else{
			if(!validatePhone(dienthoai)){
				error = true;
				$('#dienthoai').addClass('has-error');
				$('#dienthoai').next('span').next('p').html('Điện thoại không đúng định dạng');
				return false;
			}else{
				error = false;
				$('#dienthoai').removeClass('has-error');
				$('#dienthoai').next('span').next('p').html('');
			}
		}
		if(email==''){
			error = true;
			$('#email').addClass('has-error');
			$('#email').next('p').html('Quý khách chưa nhập email');
			return false;
		}else{
			if(!validateEmail(email)){
				error = true;
				$('#email').addClass('has-error');
				$('#email').next('p').html('Email không đúng định dạng');
				return false;
			}else{
				error = false;
				$('#email').removeClass('has-error');
				$('#email').next('p').html('');
			}
		}
		if(city==0){
			error = true;
			$('#city').addClass('has-error');
			$('#city').next('p').html('Quý khách chưa chọn thành phố');
			return false;
		}else{
			error = false;
			$('#city').removeClass('has-error');
			$('#city').next('p').html('');
		}
		if(dist==0){
			error = true;
			$('#dist').addClass('has-error');
			$('#dist').next('p').html('Quý khách chưa chọn quận huyện');
			return false;
		}else{
			error = false;
			$('#dist').removeClass('has-error');
			$('#dist').next('p').html('');
		}
		if(diachi==''){
			error = true;
			$('#diachi').addClass('has-error');
			$('#diachi').next('p').html('Quý khách chưa nhập địa chỉ');
			return false;
		}else{
			error = false;
			$('#diachi').removeClass('has-error');
			$('#diachi').next('p').html('');
		}
		
		if(id_nguoinhan==0){
			var hoten_nguoinhan = $('#hoten_nguoinhan').val();
			var diachi_nguoinhan = $('#diachi_nguoinhan').val();
			var dienthoai_nguoinhan = $('#dienthoai_nguoinhan').val();
			var email_nguoinhan = $('#email_nguoinhan').val();
			var city_nguoinhan = $('#city_nguoinhan').val();
			var dist_nguoinhan = $('#dist_nguoinhan').val();
			if(hoten_nguoinhan==''){
				error = true;
				$('#hoten_nguoinhan').addClass('has-error');
				$('#hoten_nguoinhan').next('p').html('Quý khách chưa nhập họ tên');
				return false;
			}else{
				error = false;
				$('#hoten_nguoinhan').removeClass('has-error');
				$('#hoten_nguoinhan').next('p').html('');
			}
			if(dienthoai_nguoinhan==''){
				error = true;
				$('#dienthoai_nguoinhan').addClass('has-error');
				$('#dienthoai_nguoinhan').next('span').next('p').html('Quý khách chưa nhập điện thoại');
				return false;
			}else{
				if(!validatePhone(dienthoai_nguoinhan)){
					error = true;
					$('#dienthoai_nguoinhan').addClass('has-error');
					$('#dienthoai_nguoinhan').next('span').next('p').html('Điện thoại không đúng định dạng');
					return false;
				}else{
					error = false;
					$('#dienthoai_nguoinhan').removeClass('has-error');
					$('#dienthoai_nguoinhan').next('span').next('p').html('');
				}
			}
			if(email_nguoinhan==''){
				error = true;
				$('#email_nguoinhan').addClass('has-error');
				$('#email_nguoinhan').next('p').html('Quý khách chưa nhập email');
				return false;
			}else{
				if(!validateEmail(email_nguoinhan)){
					error = true;
					$('#email_nguoinhan').addClass('has-error');
					$('#email_nguoinhan').next('p').html('Email không đúng định dạng');
					return false;
				}else{
					error = false;
					$('#email_nguoinhan').removeClass('has-error');
					$('#email_nguoinhan').next('p').html('');
				}
			}
			if(city_nguoinhan==0){
				error = true;
				$('#city_nguoinhan').addClass('has-error');
				$('#city_nguoinhan').next('p').html('Quý khách chưa chọn thành phố');
				return false;
			}else{
				error = false;
				$('#city_nguoinhan').removeClass('has-error');
				$('#city_nguoinhan').next('p').html('');
			}
			if(dist_nguoinhan==0){
				error = true;
				$('#dist_nguoinhan').addClass('has-error');
				$('#dist_nguoinhan').next('p').html('Quý khách chưa chọn quận huyện');
				return false;
			}else{
				error = false;
				$('#dist_nguoinhan').removeClass('has-error');
				$('#dist_nguoinhan').next('p').html('');
			}
			if(diachi_nguoinhan==''){
				error = true;
				$('#diachi_nguoinhan').addClass('has-error');
				$('#diachi_nguoinhan').next('p').html('Quý khách chưa nhập địa chỉ');
				return false;
			}else{
				error = false;
				$('#diachi_nguoinhan').removeClass('has-error');
				$('#diachi_nguoinhan').next('p').html('');
			}
		}

		if(error == false){
			$('#frm-order').submit();
		}else{
			return false;
		}
	});
	$('.checkout-radio-item').click(function() {
		var v = $(this).attr('value');
		$('.checkout-radio-item').removeClass('active');
		$('.checkout-radio-item').find('i').removeClass('fa-dot-circle-o').addClass('fa-circle-o');
		$(this).addClass('active');
		$(this).addClass('active').find('i').removeClass('fa-circle-o').addClass('fa-dot-circle-o');
		$('#use_one_address').val(v);

		if(v==0){
			$('.member-down').stop().slideDown();
		}else{
			$('.member-down').stop().slideUp();
		}
	});
	$('#city').change(function(event) {
		var id = $(this).val();
		$.ajax({
			url: 'ajax/load_quan.php',
			type: 'POST',
			data: {id: id,loai: '1'},
			success: function(data){
				$('#dist').html(data);
			}
		});
		
	});
	$('#city_nguoinhan').change(function(event) {
		var id = $(this).val();
		$.ajax({
			url: 'ajax/load_quan.php',
			type: 'POST',
			data: {id: id,loai: '2'},
			success: function(data){
				$('#dist_nguoinhan').html(data);
			}
		});
		
	});
});
