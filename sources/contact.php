<?php if(!defined('_source')) die("Error");
		
	$breadcumb ='<ul id="breadcrumb">
            <li><a href="">'._home.'</a></li>
            <li><a href="'.$com.'.html">'.$bread.'</a></li>
          </ul>';
		
	$d->reset();
	$sql = "select noidung_$lang,title,keywords,description from #_company where type='lienhe' ";
	$d->query($sql);
	$row_detail = $d->fetch_array();

	$d->reset();
	$sql = "select title,keywords,description from #_seo where type='".$com."'";
	$d->query($sql);
	$row_seo = $d->fetch_array();

	$title_bar = $row_seo['title'];
	$keyword_bar = $row_seo['keywords'];
	$description_bar = $row_seo['description'];

	
	if(!empty($_POST)){

		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {

		    // Build POST request:
		    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
		    $recaptcha_secret = $config['keysecret'];
		    $recaptcha_response = $_POST['recaptcha_response'];

		    // Make and decode POST request:
		    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
		    $recaptcha = json_decode($recaptcha);

		    // Take action based on the score returned:
		    if ($recaptcha->score >= 0.5) {


		    	$tieude = ($_POST['tieude']!='') ? $_POST['tieude']:'Liên hệ từ website';

		        $body = '<table>
					<tr>
						<th colspan="2">&nbsp;</th>
					</tr>
					<tr>
						<th colspan="2">Thư liên hệ từ website <a href="http://'.$company_mail['website'].'">'.$company_mail['website'].'</a></th>
					</tr>
					<tr>
						<th colspan="2">&nbsp;</th>
					</tr>
					<tr>
						<th>Họ tên :</th><td>'.$_POST['hoten'].'</td>
					</tr>';
					if($_POST['diachi']!=''){
						$body .='<tr>
							<th>Địa chỉ :</th><td>'.$_POST['diachi'].'</td>
						</tr>';
					}
					if($_POST['dienthoai']!=''){
						$body .='<tr>
							<th>Điện thoại :</th><td>'.$_POST['dienthoai'].'</td>
						</tr>';
					}
					if($_POST['email']!=''){
						$body .='<tr>
							<th>Email :</th><td>'.$_POST['email'].'</td>
						</tr>';
					}

					$body .='<tr>
						<th>Tiêu đề :</th><td>'.$tieude.'</td>
					</tr>';
					if($_POST['noidung']!=''){
						$body .='<tr>
								<th>Nội dung :</th><td>'.$_POST['noidung'].'</td>
							</tr>';
					}

				$body .='</table>';


				$data['ten'] = magic_quote($_POST['hoten']);
				$data['diachi'] = magic_quote($_POST['diachi']);
				$data['dienthoai'] = magic_quote($_POST['dienthoai']);
				$data['email'] = magic_quote($_POST['email']);
				$data['tieude'] = magic_quote($tieude);
				$data['noidung'] = magic_quote($_POST['noidung']);
				$email = array();
				$email[0] = $row_setting['email'];
				
				$data['ngaytao'] = time();
				$d->setTable('contact');
				$d->insert($data);
		        if(sendMailIndex($data['ten'],$tieude,$body,$email)){
		        	transfer("Thông tin liên hệ được gửi.<br>Cảm ơn.", "http://".$config_url);
		        }else{
		        	transfer("Xin lỗi quý khách.<br>Hệ thống bị lỗi, xin quý khách thử lại.", "lien-he.html");
		        }

		    } else {
		        transfer("Vui lòng kiềm tra captcha", "http://".$config_url);
		    }
		}
	}
		
?>