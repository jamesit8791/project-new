<style type="text/css">
	.wrap-ht{ width:363px; position:fixed; top:195px; right:-325px; transition:right 1s; -webkit-transition:right 1s; -moz-transition:left 1s; z-index:9;background:url('images/support.png') no-repeat left center;color:#333;font-style: italic;}
	.wrap-ht:hover{ right:0px;}
	.ht-tit{ width:38px; float:left;margin-top:50px; }
	.ht-box{ width:325px; float:left; border:2px solid #ffd502; box-sizing:border-box; -webkit-box-sizing:border-box; -moz-box-sizing:border-box; background:#FFF; min-height:250px; padding:10px;}
	.ht-li{ margin-bottom:5px; font-size:16px; font-weight:bold;}
	.ht-li img{ vertical-align:middle;}
	.yh_icon{
		margin:10px 20px;	
	}
	.name .a2{
		color:#f00;
		font-weight:bold;	
	}
	.yh_dienthoai .a1{
		color:#f00;
		font-weight:bold;
		font-size:20px;	
	}
	.yh_item{
		border-bottom:1px dotted #ccc;	
	}
	.yh_item:last-child{
		border:0px;
		padding:5px 0px;
	}
	.wrap-ht .name{
		color: #ed7720;
		font-weight: bold;
		text-align: center;
		border-bottom: 1px dotted #ed7720;
		padding-bottom:10px ;
		text-transform: uppercase;
	}
	.yh_ifo{
		padding:4px 0px;
	}
	.yh_ifo p{font-weight: bold;color: #ed7720;}
</style>
<div class="wrap-ht">
	<div class="ht-tit"></div>
    <div class="ht-box">
    	<div class="yh_item">
        	<div class="fb-page" data-href="<?=$row_setting['facebook']?>" data-width="300" data-height="230" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?=$row_setting['facebook']?>"><a href="<?=$row_setting['facebook']?>"><?=$row_setting['ten_'.$lang]?></a></blockquote></div></div>
        </div>
    </div>
    <div style="clear:both"></div>
</div>

