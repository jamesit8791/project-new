<div class="container">
    <div class="title">
      <h1><?=$title?></h1>
    </div>
    <div class="content mt-20">
        <div class="m-detail">
            <?php if($row_setting['link_history']!='' && $com=='khoa-hoc-sinh-trac-dau-van-tay'){ ?>
            <div class="detail">
                <iframe src="<?=$row_setting['link_history']?>" width="100%" height="650" frameborder="0"></iframe>
            </div>
            <?php } ?>
            <div class="detail">
                <?php if($row_detail['noidung_'.$lang]==''){ ?>
                    <p class="t-center"><?=_tb?></p>
                <?php }else{ ?>
                    <?=stripcslashes($row_detail['noidung_'.$lang])?>
                <?php } ?>
            </div>
            <div class="detail mt-20 mb-20">
                <div class="socialmediaicons ds-flex ">
                    <!-- Twitter -->
                    <a href="https://twitter.com/share?url=<?=getCurrentPageURL()?>" target="_blank" rel="nofollow" class="fa fa-twitter"></a>
                    <a href="https://www.facebook.com/sharer.php?u=<?=getCurrentPageURL()?>" target="_blank" rel="nofollow" class="fa fa-facebook"></a>
                    <a href="https://plus.google.com/share?url=<?=getCurrentPageURL()?>" target="_blank" rel="nofollow" class="fa fa-google"></a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?=getCurrentPageURL()?>" target="_blank" rel="nofollow" class="fa fa-linkedin"></a>
                    <a target="_blank" rel="nofollow" class="fa bg-info"><div class="zalo-share-button" data-href="<?=getCurrentPageURL()?>" data-oaid="<?=$config['zalo-id']?>" data-layout="2" data-color="blue" data-customize=false></div></a>
                    <a href="mailto:?Subject=<?=$row_detail['email']?> <?=getCurrentPageURL()?>" rel="nofollow" class="fa fa-envelope"></a>
                    <a href="javascript:;" onclick="window.print()" rel="nofollow" class="fa fa-print"></a>
                </div>
            </div>
        </div>
    </div>

</div>