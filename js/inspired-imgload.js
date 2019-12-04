(function($){
	$.fn.imgLoad = function(object){
		// Khởi tạo các giá trị mặc định
		var objDefault = {
			imgLoad : 'images/ring.gif',
			timeLoad : 500, // Thời gian load hình
			heightImg : 215, // Chiều cao tối thiểu của khung chứa hình ảnh
			itemFirst: 4, // Số lượng hình load trong lần load đầu tiên
			fixHeightClass: '.imgFixheight'
		};
		object = $.extend(objDefault,object);
		var $this = $(this);
		$this.attr('data-load',false).hide();
		$this.each(function(){
			$(this).removeAttr('data-load');
			$(this).wrap('<div class="insLoadIMG"></div>')
			$(this).parents('.insLoadIMG').css({'min-height' : object.heightImg, 'position' : 'relative'});
			$(this).after('<img class="insIconLoad" src="'+ object.imgLoad +'" alt="Icon loading" />');
		})
		var imgFirstTop = 0;
		var loadMethods = {
			init: function(){
				this.insMainLoad();
			},
			insMainLoad: function(){
				$(window).bind("resize", function() {
					var scrollTop = $(window).scrollTop(), // Lấy vị trí thanh scroll
							desktopHeight = $(window).innerHeight(), // Lấy chiều cao của màn hình
							fullScreen = scrollTop + desktopHeight, // Lấy vị trí từ đầu đến màn hình hiện tại
							maxScroll = $(document).height() - $(window).height(), // Vị trí khi scroll đến cuối trang
							imgSize = $this.length,
							checkResize = false,
							historyLoadResize = $('.insLoadIMG.isShow').length;
					if($('.insFixheight')){
						$('.insFixheight').css('height','auto');	
					}
					if( historyLoadResize == imgSize ){
						loadMethods.fixHeightIMG();
					}
					loadMethods.loadImgFirst(scrollTop,fullScreen)
					loadMethods.scrollToLoad(desktopHeight,maxScroll,imgSize,checkResize);
				})
			},
			loadImgFirst: function(scroll,screen){ // Load những hình ảnh đầu tiên khi vào trang
				var imgFirstTop = $this.eq(0).parents('.insLoadIMG').offset().top; // Lấy hình ảnh ở vị trí đầu tiên
				var setLoop = setInterval(function(){
					//var count = 0;
					$this.each(function(i,v){
						var $v = $(v)
						var dataSRC = $v.attr('data-src');
						var dataALT = $v.attr('data-alt');
						if(dataSRC != '' && dataSRC != null){
							loadMethods.loadIMG($v,scroll,screen,setLoop);
						}
					});
				},1000)
				},
			loadIMG: function($el,scroll,screen,setLoop){
				//console.log($el.data('src') + ' -- ' + $el.data('load'));
				var imgTop = $el.parents('.insLoadIMG').offset().top;
				if( imgTop >= scroll && imgTop <= screen || (imgTop + object.heightImg) <= screen){
					setTimeout(function(){
						$el.attr({'src' : $el.data('src'), 'data-load': 'true' }).removeAttr('data-src').fadeIn();
						$el.next().fadeOut(500).delay(1000).remove();
						$el.parents('.insLoadIMG').css('min-height','auto').addClass('isShow');
					},object.timeLoad);

					setTimeout(function(){
						$el.attr({'alt' : $el.data('alt'), 'data-load': 'true' }).removeAttr('data-alt').fadeIn();
					},object.timeLoad+500)

				}else{
					if(setLoop != null){
						clearInterval(setLoop);
					}
					return false;
				}

			},
			scrollToLoad: function(desktopHeight,maxScroll,imgSize,checkResize){
				var scrollFullScreen = 0;
				$(window).scroll(function(){
					var windowScroll = $(this).scrollTop();
					var historyLoad = $('.insLoadIMG.isShow').length;
					scrollFullScreen = windowScroll + desktopHeight;
					$this.each(function(i,v){
						var $v = $(v)
						var dataSRC = $v.attr('data-src');
						var dataALT = $v.attr('data-alt');
						if(dataSRC != '' && dataSRC != null){
							loadMethods.loadIMG($v,windowScroll,scrollFullScreen,null);
						}else if ((maxScroll == windowScroll || historyLoad == imgSize) && checkResize == false){
							checkResize = true;
							loadMethods.fixHeightIMG();
						}else{
							//loadMethods.fixHeightIMG()
						}
					});
				})
			},
			fixHeightIMG: function(){
				var maxHeight = 0;
				$this.each(function(i,v){
					var $el = $(v);
					if($el.parents('.imgFixheight').length > 0 ){
						$el.parents('.insLoadIMG').addClass('insFixheight');
						var heightTam = $el.height();
						if( heightTam > maxHeight ){
							maxHeight = heightTam;
						}
					}
				})
				setTimeout(function(){
					//console.log(maxHeight);
					$('.insFixheight').height(maxHeight);
					return false;
				},500)
			}
		};
		loadMethods.init();
		return this;
	};

})(jQuery)