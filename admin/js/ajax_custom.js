
$(document).ready(function() {
	/* ajax hienthi*/
	$("a.diamondToggle").click(function(){
		if($(this).attr("rel")==0){
			$.ajax({
				type: "POST",
				url: "ajax/ajax_hienthi.php",
				data:{
					id: $(this).attr("data-val0"),
					bang: $(this).attr("data-val2"),
					type: $(this).attr("data-val3"),
					value:1
				}
			});
			$(this).addClass("diamondToggleOff");
			$(this).attr("rel",1);
			
		}else{
			
			$.ajax({
				type: "POST",
				url: "ajax/ajax_hienthi.php",
				data:{
					id: $(this).attr("data-val0"),
					bang: $(this).attr("data-val2"),
					type: $(this).attr("data-val3"),
					value:0
					}
			});
			$(this).removeClass("diamondToggleOff");
					$(this).attr("rel",0);
		}

	});
	/*end  ajax hienthi*/
	/*select danhmuc*/
	$(".select_danhmuc").change(function() {
		var child = $(this).data("child");
		var levell = $(this).data('level');
		var types = $(this).data('type');
		$.ajax({
			url: 'ajax/ajax_danhmuc.php',
			type: 'POST',
			data: {level: levell,
					id:$(this).val(),
					type: types},
			success:function(data){
				var op = "<option>Chọn danh mục</option>";

				if(levell=='0'){
					$("#id_cat").html(op);
					$("#id_item").html(op);
					$("#id_sub").html(op);
				}else if(levell=='1'){
					$("#id_sub").html(op);
					$("#id_item").html(op);
				}else if(levell=='2'){
					$("#id_sub").html(op);
				}
				$("#"+child).html(data);
			}
		});
	});
	/*end select danhmuc*/

	/*select danhmuc*/
	$(".select_dmbaiviet").change(function() {
		var child = $(this).data("child");
		var levell = $(this).data('level');
		var types = $(this).data('type');
		$.ajax({
			url: 'ajax/ajax_dmbaiviet.php',
			type: 'POST',
			data: {level: levell,
					id:$(this).val(),
					type: types},
			success:function(data){
				var op = "<option>Chọn danh mục</option>";

				if(levell=='0'){
					$("#id_cat").html(op);
					$("#id_item").html(op);
					$("#id_sub").html(op);
				}else if(levell=='1'){
					$("#id_sub").html(op);
					$("#id_item").html(op);
				}else if(levell=='2'){
					$("#id_sub").html(op);
				}
				$("#"+child).html(data);
			}
		});
	});
	/*end select danhmuc*/
});