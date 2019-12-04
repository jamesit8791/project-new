<main id="lg_top">
    <section id="lg_topNav">
        <a href="http://<?=$config_url?>" title="" target="_blank">
           <i class="fa fa-reply-all" aria-hidden="true"></i> Vào trang web
        </a>
    </section>
    <section id="lg_box">
        <form action="index.php?com=user&act=login" id="validate" class="form" method="post">
            <section id="lg_pg_center">
                <header id="lg_header">
                    <h3><i class="fa fa-sign-in" aria-hidden="true"></i> Control Cpanel</h3>
                </header><!-- /header -->
                <section id="lg_content">
                    <aside class="lg_row">
                        <label>Tên đăng nhập: </label>
                        <input type="text" name="username" value="" id="username" class="validate[required]" placeholder="">
                    </aside>
                    <aside class="lg_row">
                        <label>Mật khẩu: </label>
                        <input type="password" name="password" value="" class="validate[required]" id="pass" placeholder="">
                    </aside>
                </section>
                <section id="lg_btn">
                    <input type="submit" name="" value="Vào hệ thống" class="logMeIn">
                </section>
                <div class="ajaxloader"><img src="images/loader.gif" alt="loader" /></div>
                <div id="loginError">

                </div>
            </section>
        </form>
    </section>
    <section id="lg_copy">
        Copyright &copy; 2016 by NINA CO., LTD
    </section>
</main>