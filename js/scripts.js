	function createXMLHttp() {
	     var xmlhttp;
	     try {
	         // Mozilla / Safari / IE7
	         xmlhttp = new XMLHttpRequest();
	     } catch (e) {
	          // IE
	          var XMLHTTP_IDS = new Array('MSXML2.XMLHTTP.5.0',
	                                    'MSXML2.XMLHTTP.4.0',
                                    	'MSXML2.XMLHTTP.3.0',
	                                    'MSXML2.XMLHTTP',
                                    	'Microsoft.XMLHTTP' );
         var success = false;
         for (var i=0;i < XMLHTTP_IDS.length && !success; i++) {
         try {
	                  xmlhttp = new ActiveXObject(XMLHTTP_IDS[i]);
	                     success = true;
	               } catch (e) {}
	         }
	         if (!success) {
	             throw new Error('Unable to create XMLHttpRequest.');
	         }
	    }
	    return xmlhttp;
	}


/*	function createXMLHttp(){
		if(typeof XMLHttpRequest != "undefined"){
			return new XMLHttpRequest();
		}else if(window.ActiveXObject){
			var aVersions = ["MSXML2.XMLHttp.5.0",
        "MSXML2.XMLHttp.4.0","MSXML2.XMLHttp.3.0",
        "MSXML2.XMLHttp","Microsoft.XMLHttp"];
			
			for(var i = 0; i < aVersions.length; i++){
				try{
					var oXMLHttp = new ActiveXObject(aVersions[i]);
					return oXMLHttp;
				}catch(oError){
					//Do nothing
				}
			}
		}
		
		throw new Error("XMLHttp object could be created.");
	}*/
	function setClick() {
		var oXmlHttp = createXMLHttp();
		var name = document.getElementById("name").value;
		var address = document.getElementById("address").value;
		var phone = document.getElementById("phone").value;
		var ngaygiao = document.getElementById("ngaygiao").value;
		var ngonngu = document.getElementById("ngonngu").value;
		oXmlHttp.open("get","process_ajax1.php?user=" + name,true);
		oXmlHttp.onreadystatechange = function (){
			if(oXmlHttp.readyState == 4){
				if(oXmlHttp.status == 200){
					if(ngonngu == "vi"){
						if(name !="" && address !="" && phone !="" && ngaygiao !=""){
							document.dathangonline.submit();
						}else if(name !="" && address =="" && phone =="" && ngaygiao ==""){
							document.getElementById("alert1").innerHTML = "";
							document.getElementById("alert2").innerHTML = "Bạn không được phép để trống trường này.";
							document.getElementById("alert3").innerHTML = "Bạn không được phép để trống trường này.";
							document.getElementById("alert4").innerHTML = "Bạn không được phép để trống trường này.";
						}else if(address !="" && phone =="" && ngaygiao =="") {
							document.getElementById("alert1").innerHTML = "";
							document.getElementById("alert2").innerHTML = "";
							document.getElementById("alert3").innerHTML = "Bạn không được phép để trống trường này.";
							document.getElementById("alert4").innerHTML = "Bạn không được phép để trống trường này.";
						}else if(phone !="" && ngaygiao ==""){
							document.getElementById("alert1").innerHTML = "";
							document.getElementById("alert2").innerHTML = "";
							document.getElementById("alert3").innerHTML = "";
							document.getElementById("alert4").innerHTML = "Bạn không được phép để trống trường này.";
						}else{
							document.getElementById("alert1").innerHTML = "Bạn không được phép để trống trường này.";
							document.getElementById("alert2").innerHTML = "Bạn không được phép để trống trường này.";
							document.getElementById("alert3").innerHTML = "Bạn không được phép để trống trường này.";
							document.getElementById("alert4").innerHTML = "Bạn không được phép để trống trường này.";
						}
					}else if(ngonngu =="en"){
						if(name !="" && address !="" && phone !="" && ngaygiao !=""){
							document.dathangonline.submit();
						}else if(name !="" && address =="" && phone =="" && ngaygiao ==""){
							document.getElementById("alert1").innerHTML = "";
							document.getElementById("alert2").innerHTML = "Please enter data in this area.";
							document.getElementById("alert3").innerHTML = "Please enter data in this area.";
							document.getElementById("alert4").innerHTML = "Please enter data in this area.";
						}else if(address !="" && phone =="" && ngaygiao =="") {
							document.getElementById("alert1").innerHTML = "";
							document.getElementById("alert2").innerHTML = "";
							document.getElementById("alert3").innerHTML = "Please enter data in this area.";
							document.getElementById("alert4").innerHTML = "Please enter data in this area.";
						}else if(phone !="" && ngaygiao ==""){
							document.getElementById("alert1").innerHTML = "";
							document.getElementById("alert2").innerHTML = "";
							document.getElementById("alert3").innerHTML = "";
							document.getElementById("alert4").innerHTML = "Please enter data in this area.";
						}else{
							document.getElementById("alert1").innerHTML = "Please enter data in this area.";
							document.getElementById("alert2").innerHTML = "Please enter data in this area.";
							document.getElementById("alert3").innerHTML = "Please enter data in this area.";
							document.getElementById("alert4").innerHTML = "Please enter data in this area.";
						}
					}else if(ngonngu =="cn"){
						if(name !="" && address !="" && phone !="" && ngaygiao !=""){
							document.dathangonline.submit();
						}else if(name !="" && address =="" && phone =="" && ngaygiao ==""){
							document.getElementById("alert1").innerHTML = "";
							document.getElementById("alert2").innerHTML = "在這方面，請輸入數據.";
							document.getElementById("alert3").innerHTML = "在這方面，請輸入數據.";
							document.getElementById("alert4").innerHTML = "在這方面，請輸入數據.";
						}else if(address !="" && phone =="" && ngaygiao =="") {
							document.getElementById("alert1").innerHTML = "";
							document.getElementById("alert2").innerHTML = "";
							document.getElementById("alert3").innerHTML = "在這方面，請輸入數據.";
							document.getElementById("alert4").innerHTML = "在這方面，請輸入數據.";
						}else if(phone !="" && ngaygiao ==""){
							document.getElementById("alert1").innerHTML = "";
							document.getElementById("alert2").innerHTML = "";
							document.getElementById("alert3").innerHTML = "";
							document.getElementById("alert4").innerHTML = "在這方面，請輸入數據.";
						}else{
							document.getElementById("alert1").innerHTML = "在這方面，請輸入數據.";
							document.getElementById("alert2").innerHTML = "在這方面，請輸入數據.";
							document.getElementById("alert3").innerHTML = "在這方面，請輸入數據.";
							document.getElementById("alert4").innerHTML = "在這方面，請輸入數據.";
						}
					}
					
				}else{
					alert(oXmlHttp.statusText);
				}
			}
		};
		oXmlHttp.send(null);
		
	}

	
	function send_info(str) {
		var oXmlHttp = createXMLHttp();
		oXmlHttp.open("get","process_ajax1.php?idc=" + str,true);
		oXmlHttp.onreadystatechange = function (){
			if(oXmlHttp.readyState == 4){
				if(oXmlHttp.status == 200){
					document.getElementById("qk_ct").innerHTML = oXmlHttp.responseText;
				}else{
					alert(oXmlHttp.statusText);
				}
			}
		};
		oXmlHttp.send(null);
		
	}
	
	function send_info2(str, v) {
		var oXmlHttp = createXMLHttp();
		oXmlHttp.open("get","process_ajax1.php?idc=" + v + "&size=" + str,true);
		oXmlHttp.onreadystatechange = function (){
			if(oXmlHttp.readyState == 4){
				if(oXmlHttp.status == 200){
					document.getElementById("send_info2").innerHTML = oXmlHttp.responseText;
				}else{
					alert(oXmlHttp.statusText);
				}
			}
		};
		oXmlHttp.send(null);
		
	}
	
	function setvalue(a, b) {
		var dem=a;
		var dem1=b;
		var tong=0;
		for(var i=0; i<dem;i++){
			tong+=document.getElementById('soluong_'+i).value * document.getElementById('gia_'+i).value;	
		}
		for(var j=0; j<dem1;j++){
			tong+=document.getElementById('order_phukien_'+j).value * document.getElementById('soluongpk_'+j).value;	
		}

		var oXmlHttp = createXMLHttp();
		oXmlHttp.open("get","process_ajax2.php?tong=" + tong,true);
		oXmlHttp.onreadystatechange = function (){
			if(oXmlHttp.readyState == 4){
				if(oXmlHttp.status == 200){
					document.getElementById("tongcong").innerHTML = oXmlHttp.responseText;
				}else{
					alert(oXmlHttp.statusText);
				}
			}
		};
		oXmlHttp.send(null);
		
	}

	
