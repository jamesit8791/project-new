 $(document).ready(function(){

    // PHƯƠNG THỨC SHOW HÌNH LOADING
    function loading_show(){
       $("#loadbody").fadeIn("fast");
    }

    // PHƯƠNG THỨC ẨN HÌNH LOADING
    function loading_hide(){
        $("#loadbody").fadeOut("fast");
    }        	
    
    // LOAD GIÁ TRỊ MẶC ĐỊNH PAGE = 1 CHO LẦN ĐẦU TIÊN
    //loadData(1);  

    // LOAD KẾT QUẢ CHO TRANG
    //$('#container .pagination li.active').live('click',function(){
       // var page = $(this).attr('p');
      //  loadData(page);
   // });  

    // PHƯƠNG THỨC DÙNG ĐỂ HIỆN KẾT QUẢ KHI NHẬP GIÁ TRỊ PAGE VÀO TEXTBOX
    // BẠN CÓ THỂ MỞ TEXTBOX LÊN TRONG CLASS PHÂN TRANG
    //$('#go_btn').live('click',function(){
        //var page = parseInt($('#goto').val());
        //var no_of_pages = parseInt($('.total').attr('a'));
        //if(page != 0 && page <= no_of_pages){
       //     loadData(page);
       // }else{
       //     alert('HÃY NHẬP GIÁ TRỊ TỪ 1 ĐẾN '+no_of_pages);
       //     $('.goto').val("").focus();
      //      return false;
       // }
    //});
});