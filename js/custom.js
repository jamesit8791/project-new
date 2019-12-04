"use strict";
var JAMES = {};
var $window = $(window),
    $document = $(document),
    $body = $('body'),
    $video = $('#video-index'),
    $slide_product = $('#slide-product'),
    $gallery = $('#gallery'),
    $detail_product = $('#detail-product'),
    $nav = $('.menu-fixed'),
    $contact = $("#frm-contact"),
    $lienhe = $("#frm-lienhe"),
    $nav_mobile = $('#menu-mobile');

$.fn.exists = function() {
    return this.length > 0;
};






JAMES.preloader = function() {
  $('.page-preloader-cover').addClass('hidden');
  $('.page-preloader-cover').remove();

  /*if(index=='yes'){
    loadCSS(plugin_path + 'ajax_paging/ajax.css');
    loadData(1,'#load-construction',0,'noibat');

    var id_list = $('#id-list-product').val();
    var res_list = id_list.split(",");

    $.each( res_list, function( i, val ) {
      var load = '#load-product'+val;
      loadDataProduct(1, load , val ,'noibat');
    });
  }*/
};

JAMES.clickPartner = function() {
  $('.clickPartner').click(function(event) {
    $('html, body').animate({scrollTop: $('#partner').offset().top },1000)
  });
};

JAMES.backToTop = function(){
	$body.append('<div id="back-to-top" style=""><a class="top arrow"><i class="fa fa-angle-up"></i> <span>TOP</span></a></div>');
	$window.scroll(function() {
		if($window.scrollTop() > 100) {
			$('#back-to-top .top').addClass('animate_top');
		} else {
		  	$('#back-to-top .top').removeClass('animate_top');
		}
	});
	$('#back-to-top .top').click(function() {
	  $('html, body').animate({scrollTop:0},500);
	});
}
JAMES.menuFixedTop = function(){
	$(window).scroll(function () {
		if ($(this).scrollTop() > $('.header-bottom-page').height()) {
			$nav.addClass("fixed");
      $('.header-bottom-page').addClass('ab-search');
		} else {
			$nav.removeClass("fixed");
      $('.header-bottom-page').removeClass('ab-search');
		}
	});
}
JAMES.menuMobile = function() {
  if($('.menu-mobile').exists()){
    loadCSS(plugin_path + 'plugins/mmenu/src/css/jquery.mmenu.all.css');
    loadScript(plugin_path + 'plugins/mmenu/src/js/jquery.mmenu.min.all.js', function() {
      $('#menu-mobile').mmenu();
    });
  }
}
JAMES.searchPosition = function() {
  if($('#search-click').exists()){
    $('#search-click').click(function() {
      if($(this).hasClass('active')){
        $(this).find('i').addClass('fa-search').removeClass('fa-times');
        $('.search').animate({
          width: "0%",
          opacity: "0"
        }, 1000);
        $(this).removeClass('active');
      }else{
        $('.search').animate({
          width: "200px",
          opacity: "1"
        }, 1000);
        $(this).find('i').removeClass('fa-search').addClass('fa-times');
        $(this).addClass('active');
      }
    });
  }
}
JAMES.loadIndex = function() {
  $('body').on('click', '.click-construction', function(event) {
    event.preventDefault();
    var _o = $(this);
    $('.click-construction').removeClass('active');
    _o.addClass('active');
    var _i = parseInt(_o.attr('rel'));
    if(_i==0){
      loadData(1,'#load-construction',0,'noibat');
    }else{
      loadData(1,'#load-construction',_i,'noibat');
    }
  });

  $('body').on('click', '.click-menu', function(event) {
    event.preventDefault();
    var _o = $(this);
    $('.click-menu').find('i').removeClass('fa-angle-up').addClass('fa-angle-down');
    _o.find('i').removeClass('fa-angle-down').addClass('fa-angle-up');
    $('ul.two').stop().slideUp(400);
    _o.parent('li').find('ul').stop().slideToggle(400);
  });
  
  $('body').on('click', '.xemthem-page', function(event) {
    event.preventDefault();
    var _o = $(this);
    var da = {
      idlist: _o.attr('data-idlist'),
      total: _o.attr('data-total'),
      showed: _o.attr('data-showed'),
      subtotal: _o.attr('data-subtotal')
    }
    $.ajax({
      type: "POST",
      url: "ajax/ajax_product.php",
      data: da,
      success: function(msg){
        var _sho = parseInt(_o.attr('data-showed'))+4;
        var _tot = parseInt(_o.attr('data-total')) - _sho;
        $('#slide-product' + _o.attr('data-idlist')).append(msg);
        _o.attr('data-showed',_sho);
        if(_tot>0){
          _o.html('<span>Xem thêm ' + _tot + ' sản phẩm khuyến mãi</span>');
        }else{
          _o.html('');
        }
      }
  });
  });

}
function loadData(page,id_tab,id_danhmuc,id_loaiview){
  $.ajax({
      type: "POST",
      url: "ajax_paging/ajax_paging.php",
      data: {page:page,id_danhmuc:id_danhmuc,id_loaiview:id_loaiview},
      success: function(msg)
      {
        $(id_tab).html(msg);
        $(id_tab+" .pagination li.active").click(function(){
          var pager = $(this).attr("p");
          loadData(pager,id_tab,id_danhmuc,id_loaiview);
        });
      }
  });
}
function loadDataProduct(page,id_tab,id_danhmuc,id_loaiview){
  $.ajax({
      type: "POST",
      url: "ajax_paging/ajax_paging_product.php",
      data: {page:page,id_danhmuc:id_danhmuc,id_loaiview:id_loaiview},
      success: function(msg)
      {
        $(id_tab).html(msg);
        $(id_tab+" .pagination li.active").click(function(){
          var pager = $(this).attr("p");
          loadDataProduct(pager,id_tab,id_danhmuc,id_loaiview);
        });
      }
  });
}
JAMES.contactForm = function() {
  if($contact.exists()){
    loadScript(plugin_path + 'js/jquery.validate.min.js', function() {
      $contact.validate({
        rules: {
          hoten: "required",
          dienthoai: {
            required: true,
            number: true,
            minlength: 10
          },
          diachi: "required",
          email: {
            required: true,
            email: true
          },
          tieude: "required",
          noidung: "required"
        },

        messages: {
          hoten: "Họ tên không được rỗng",
          dienthoai: {
            required: "Số điện thoại không được rỗng",
            number: "Số điện thoại không hợp lệ",
            minlength: "Số điện thoại không hợp lệ [>= 10 số]"
          },
          diachi: "Địa chỉ không được rỗng",
          email: {
            required: "Email không được rỗng",
            email: "Email không hợp lệ"
          },
          tieude: "Tiêu đề không được rỗng",
          noidung: "Nội dung không được rỗng"
        },
        submitHandler: function(form) {
          form.submit();
        }
      });
    });
  }
  if($lienhe.exists()){
    loadScript(plugin_path + 'js/jquery.validate.min.js', function() {
      $lienhe.validate({
        rules: {
          hoten: "required",
          dienthoai: {
            required: true,
            number: true,
            minlength: 10
          },
          email: {
            required: true,
            email: true
          },
          noidung: "required"
        },

        messages: {
          hoten: "Họ tên không được rỗng",
          dienthoai: {
            required: "Số điện thoại không được rỗng",
            number: "Số điện thoại không hợp lệ",
            minlength: "Số điện thoại không hợp lệ [>= 10 số]"
          },
          email: {
            required: "Email không được rỗng",
            email: "Email không hợp lệ"
          },
          noidung: "Nội dung không được rỗng"
        },
        submitHandler: function(form) {
          form.submit();
        }
      });
    });
  }
}



JAMES.videoIndex = function() {
  $('#video_load').load("ajax/video_load.php?id=" + active_youtube);
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
}

JAMES.slideSlick = function() {
  if(index=='yes'){
    loadCSS(plugin_path + 'css/pe-icon-7-stroke.css');
    loadCSS(plugin_path + 'plugins/slick/slick.css');
    loadCSS(plugin_path + 'plugins/slick/slick-theme.css');
    loadScript(plugin_path + 'plugins/slick/slick.min.js', function() {
      if($('#slickAbout').exists()){
        $('#slickAbout').slick({
          dots: true,
          infinite: true,
          speed: 300,
          vertical: false,
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          autoplay: true,
          autoplaySpeed: 2000
        });
      }
      if($('#slickYkien').exists()){
        $('#slickYkien').slick({
          dots: false,
          infinite: true,
          speed: 2000,
          vertical: false,
          slidesToShow: 3,
          slidesToScroll: 1,
          arrows: false,
          autoplay: true,
          autoplaySpeed: 1000,
          responsive: [{
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 992,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1
            }
          }]
        });
      }
      if($('#sliclSupport').exists()){
        $('#sliclSupport').slick({
          dots: false,
          infinite: true,
          speed: 2000,
          vertical: false,
          slidesToShow: 5,
          slidesToScroll: 1,
          arrows: false,
          autoplay: false,
          autoplaySpeed: 1000,
          responsive: [{
            breakpoint: 1024,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 992,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 500,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1
            }
          }]
        });
      }
      if($('.slickViSao').exists()){
        $('.slickViSao').slick({
          dots: false,
          infinite: true,
          speed: 2000,
          vertical: false,
          slidesToShow: 4,
          slidesToScroll: 1,
          arrows: false,
          autoplay: true,
          autoplaySpeed: 1000,
          responsive: [{
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 992,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 500,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }]
        });
      }
      if($('.slickProductBC').exists()){
        $('.slickProductBC').slick({
          dots: false,
          infinite: true,
          speed: 2000,
          vertical: false,
          slidesToShow: 8,
          slidesToScroll: 1,
          arrows: true,
          autoplay: true,
          autoplaySpeed: 1000,
          responsive: [{
            breakpoint: 1024,
            settings: {
              slidesToShow: 6,
              slidesToScroll: 1
            }
          },{
            breakpoint: 992,
            settings: {
              slidesToShow: 5,
              slidesToScroll: 1
            }
          },{
            breakpoint: 600,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 1
            }
          },{
            breakpoint: 500,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1
            }
          }]
        });
      }
      if($('#slickYkienHocVien').exists()){
        $('#slickYkienHocVien').slick({
          dots: false,
          infinite: true,
          speed: 2000,
          vertical: false,
          slidesToShow: 3,
          slidesToScroll: 1,
          arrows: false,
          autoplay: true,
          autoplaySpeed: 1000,
          responsive: [{
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1
            }
          },{
            breakpoint: 992,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1
            }
          },{
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1
            }
          },{
            breakpoint: 500,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }]
        });
      }
      if($('#slickNews').exists()){
        $('#slickNews').slick({
          dots: false,
          infinite: true,
          speed: 2000,
          vertical: true,
          slidesToShow: 3,
          slidesToScroll: 1,
          arrows: false,
          autoplay: false,
          autoplaySpeed: 1000,
          responsive: [{
            breakpoint: 1024,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1
            }
          }]
        });
      }
      if($('#slickVideo').exists()){
        $('#slickVideo').slick({
          dots: false,
          infinite: true,
          speed: 3000,
          vertical: false,
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          autoplay: true,
          autoplaySpeed: 2000
        });
      }

      if($('#partnerSlick').exists()){
        $('#partnerSlick').slick({
          dots: false,
          infinite: true,
          speed: 2000,
          vertical: false,
          slidesToShow: 6,
          slidesToScroll: 1,
          arrows: false,
          autoplay: true,
          autoplaySpeed: 1000,
          responsive: [{
            breakpoint: 1024,
            settings: {
              slidesToShow: 6,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 992,
            settings: {
              slidesToShow: 5,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1
            }
          }]
        });
      }

      if($('#slickSliderIndex').exists()){
        $('#slickSliderIndex').slick({
          vertical:false,
          infinite: true,
          accessibility:true,
          slidesToShow: 1,    
          slidesToScroll: 1, 
          autoplay:false,  
          autoplaySpeed:3000, 
          speed:1000,
          arrows:false, 
          centerMode:false,  
          dots:true,  
          draggable:true,  
          pauseOnHover:true
        });
      }
      
      /*
      $('#slickSliderIndex').on('afterChange', function(event, slick, currentSlide, nextSlide){
        if($(this).slick('slickCurrentSlide')==0){
          changesVideo(0);
          playVid();
        }else{
          changesVideo(3);
        }
      });*/

    });
  }
 
  
}

JAMES.slideSlickDetail = function() {
  if($detail_product.exists()){
    loadCSS(plugin_path + 'plugins/magiczoomplus/magiczoomplus.css');
    loadCSS(plugin_path + 'css/pe-icon-7-stroke.css');
    loadCSS(plugin_path + 'plugins/slick/slick.css');
    loadCSS(plugin_path + 'plugins/slick/slick-theme.css');
    loadScript(plugin_path + 'plugins/slick/slick.min.js', function() {
      $('.slickDetail').slick({
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

      if($('#slickProduct').exists()){
        $('#slickProduct').slick({
          dots: true,
          infinite: true,
          speed: 2000,
          vertical: false,
          slidesToShow: 4,
          slidesToScroll: 1,
          arrows: false,
          autoplay: true,
          autoplaySpeed: 1000,
          responsive: [{
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 992,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1
            }
          }]
        });
      }

    });
    loadScript(plugin_path + 'plugins/magiczoomplus/magiczoomplus.js', function() {

    });

   
  }
}

JAMES.gallery = function(){
  if($gallery.exists()){
    loadCSS(plugin_path + 'plugins/fancybox/dist/jquery.fancybox.min.css');
    loadScript(plugin_path + 'plugins/fancybox/dist/jquery.fancybox.min.js', function() {
      
    });
  }
}

var video = document.getElementById("videochinh"); 
function changesVideo(time){
  if(time < 1){
    var time = parseFloat(video.duration);
  }else{
    var time = time;
  }
  setTimeout(function(){
    $('#slickSliderIndex').slick('slickNext');
  },time*1000);
}
function playVid() { 
  video.play(); 
}

var _arr_script = {};
function loadScript(scriptName, callback) {
    if (!_arr_script[scriptName]) {
        _arr_script[scriptName] = true;
        var body = document.getElementsByTagName('body')[0];
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = scriptName;
        script.onload = callback;
        body.appendChild(script);
    } else if (callback) {
        callback();
    }
};

var _arr_css = {};
function loadCSS(cssName) {
    if (!_arr_css[cssName]) {
        _arr_css[cssName] = true;
        var head = document.getElementsByTagName('head')[0];
        var script = document.createElement('link');
        script.type = 'text/css';
        script.rel = 'stylesheet';
        script.href = cssName;
        head.appendChild(script);
    }
};
$window.load(function() {
  JAMES.preloader();
  /*if(index=='yes'){
    changesVideo(0);
  }*/
  
});
function afterAction() {
    this.$elem.find('.owl-item').each(function() {
        var check = $(this).hasClass('active');
        if (check == true) {
            $(this).find('.animated').each(function() {
                var anime = $(this).attr('data-animated');
                $(this).addClass(anime);
            });
        } else {
            $(this).find('.animated').each(function() {
                var anime = $(this).attr('data-animated');
                $(this).removeClass(anime);
            });
        }
    });
    var owl = this;
    var visible = this.owl.visibleItems;
    var first_item = visible[0];
    var last_item = visible[visible.length - 1];
    this.$elem.find('.owl-item').removeClass('first-item');
    this.$elem.find('.owl-item').removeClass('last-item');
    this.$elem.find('.owl-item').eq(first_item).addClass('first-item');
    this.$elem.find('.owl-item').eq(last_item).addClass('last-item');
}

function background() {
    $('.bg-slider .item-slider').each(function() {
        $(this).find('.banner-thumb img').css('height', $(this).find('.banner-thumb img').attr('height'));
        var src = $(this).find('.banner-thumb img').attr('src');
        $(this).css('background-image', 'url("' + src + '")');
    });
}

function owl_slider() {
    //Carousel Slider
    if ($('.sv-slider').length > 0) {
        $('.sv-slider').each(function() {
            var seff = $(this);
            var loop = seff.attr("data-loop");
            var item = seff.attr('data-item');
            var speed = seff.attr('data-speed');
            var itemres = seff.attr('data-itemres');
            var animation = seff.attr('data-animation');
            var nav = seff.attr('data-navigation');
            var pag = seff.attr('data-pagination');
            var text_prev = seff.attr('data-prev');
            var text_next = seff.attr('data-next');
            var pagination = false,
                navigation = false,
                singleItem = false;
            var autoplay;
            if (speed != '') autoplay = speed;
            else autoplay = false;
            var loopauto;
            if (loop != ''){ loopauto = false; }else{ loopauto = true; }

            // Navigation
            if (nav) navigation = true;
            if (pag) pagination = true;
            if (animation != '') {
                singleItem = true;
                item = '1';
            } else animation = false;
            var prev_text = '<i class="fa fa-angle-left"></i>';
            var next_text = '<i class="fa fa-angle-right"></i>';
            if (text_prev) prev_text = text_prev;
            if (text_next) next_text = text_next;
            if (itemres == '' || itemres === undefined) {
                if (item == '1') itemres = '0:1,480:1,768:1,1200:1';
                if (item == '2') itemres = '0:1,480:1,768:2,1200:2';
                if (item == '3') itemres = '0:1,480:2,768:2,992:3';
                if (item == '4') itemres = '0:1,480:2,840:3,1200:4';
                if (item >= '5') itemres = '0:1,480:2,768:3,1024:4,1200:' + item;
            }
            itemres = itemres.split(',');
            var i;
            for (i = 0; i < itemres.length; i++) {
                itemres[i] = $.map(itemres[i].split(':'), function(value) {
                    return parseInt(value, 10);
                });
            }
            seff.owlCarousel({
                items: item,
                loop: loopauto,
                itemsCustom: itemres,
                autoPlay: autoplay,
                pagination: pagination,
                navigation: navigation,
                navigationText: [prev_text, next_text],
                singleItem: singleItem,
                beforeInit: background,
                addClassActive: true,
                afterAction: afterAction,
                touchDrag: true,
                transitionStyle: animation
            });
        });
    }
}
$document.ready(function() {
  background();
  owl_slider();
  JAMES.backToTop(), 
  JAMES.menuFixedTop(), 
  JAMES.contactForm(), 
  JAMES.videoIndex(),
  JAMES.slideSlick(), 
  JAMES.gallery(),
  JAMES.slideSlickDetail(), 
  JAMES.searchPosition(),
  JAMES.loadIndex(),
  JAMES.menuMobile(),
  JAMES.clickPartner();
});
