<div class="toolbar">
    <ul>
        <li>
            <a href="tel:<?=str_replace(' ','',str_replace('.','',$row_setting['hotline']))?>" title="Gọi điện">
                <img src="images/goidien.png" alt="images"><br>
                <span>Gọi điện</span>
            </a>
        </li>
        <li>
            <a href="sms:<?=str_replace(' ','',str_replace('.','',$row_setting['hotline']))?>" class="link_title ui-link" target="_blank" title="Nhắn tin">
                <img src="images/tn.png" alt="images"><br>
                <span>Nhắn tin</span>
            </a>
        </li>
        <li>
            <a href="<?=$row_setting['link_map']?>" title="Chỉ đường">
                <img src="images/chiduong.png" alt="images"><br>
                <span>Chỉ đường</span>
            </a>
        </li>
        <li>
            <a href="https://zalo.me/<?=str_replace(' ','',str_replace('.','',$row_setting['hotline']))?>" title="Chat zalo">
                <img src="images/icon-t3.png" alt="images"><br>
                <span>Chat zalo</span>
            </a>
        </li>
        <li>
            <a target="_blank" href="<?=$row_setting['facebook']?>" title="facebook">
                <img src="images/icon-t4.png" alt="images"><br>
                <span>Facebook</span>
            </a>
        </li>
    </ul>
</div>