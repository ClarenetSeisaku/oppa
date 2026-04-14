<section class="banner_contents">
    <?php if (is_home() || is_front_page()) : ?>
        <div class="banner_contents_img02 img_con">
            <picture>
                <source media="(min-width: 769px)" srcset="<?php echo imdir(); ?>/common/top_goods_img02@2x.png"><img src="<?php echo imdir(); ?>/common/top_goods_img02_sp@2x.png" alt="">
            </picture>
        </div>
    <?php endif; ?>
    <div class="banner_contents_img01 img_con">
        <picture>
            <source media="(min-width: 769px)" srcset="<?php echo imdir(); ?>/common/top_banner_img01@2x.png"><img src="<?php echo imdir(); ?>/common/top_banner_img01_sp@2x.png" alt="">
        </picture>
    </div>
    <div class="sec_inner">
        <div class="banner_list">
            <div class="banner_box"><a href="#"><img src="<?php echo imdir(); ?>/common/top_banner01.jpg" alt="バナー1"></a></div>
            <div class="banner_box"><a href="#"><img src="<?php echo imdir(); ?>/common/top_banner02.jpg" alt="バナー2"></a></div>
            <div class="banner_box"><a href="#"><img src="<?php echo imdir(); ?>/common/top_banner03.jpg" alt="バナー3"></a></div>
        </div>
    </div>
</section>

<!-- 右側追従ボタン（ページ全体で追従） -->
<?php if (is_singular("seminar")): ?>
    <a href="#form" class="fixed-btn">
        <img src="<?php echo imdir(); ?>/common/seminar_icon.svg" alt="セミナーのアイコン">
        <span>申込みフォーム</span>
    </a>
<?php elseif (is_singular("press")): ?>
    <a href="#purchase" class="fixed-btn">
        <img src="<?php echo imdir(); ?>/common/seminar_icon.svg" alt="セミナーのアイコン">
        <span>申込みフォーム</span>
    </a>
<?php elseif (is_page("join")): ?>
    <a href="<?= esc_url(home_url('/')) ?>membership_form" class="fixed-btn">
        <img src="<?php echo imdir(); ?>/common/seminar_icon.svg" alt="セミナーのアイコン">
        <span>申込みフォーム</span>
    </a>
<?php elseif (is_front_page()): ?>
    <a href="#" class="fixed-btn">
        <img src="<?php echo imdir(); ?>/common/boat_wh.svg" alt="船のアイコン">
        <span>クルーズ船情報</span>
    </a>
<?php endif; ?>


<!-- トップへ戻るボタン -->
<a href="#" class="page-top-btn pageTop" aria-label="トップへ戻る">
</a>
<footer class="footer">
    <div class="footer_img01 img_con">
        <picture>
            <source media="(min-width: 769px)" srcset="<?php echo imdir(); ?>/common/footer_img01@2x.png"><img src="<?php echo imdir(); ?>/common/footer_img01_sp@2x.png" alt="">
        </picture>
    </div>
    <div class="footer__inner sec_inner">
        <div class="footer_img02 img_con kamome_img"><img src="<?php echo imdir(); ?>/common/footer_img02.svg" alt="かもめ"></div>
        <div class="footer_img03 img_con"><img src="<?php echo imdir(); ?>/common/footer_img03.svg" alt="船"></div>

        <!-- ーー 上部 ーー -->
        <div class="footer__top">

            <!-- 左カラム：協会情報 -->
            <div class="footer__info">
                <div class="footer__logo">
                    <img src="<?php echo imdir(); ?>/common/logo_f.svg" alt="ロゴ" class="logo">
                </div>
                <p class="footer__name">公益社団法人 大阪港振興協会</p>
                <p class="footer__address">
                    〒552-0021<br>
                    大阪府大阪市港区築港2-1-2　<br class="sp">第一大阪港ビル7階<br>
                </p>
                <p class="footer__tell">
                    <a href="tel:0665759575">TEL: 06-6575-9575</a>
                </p>
            </div>

            <!-- 中央カラム：ナビゲーション -->
            <nav class="footer__nav">
                <div class="footer__nav-col">
                    <a href="#" class="footer__nav-link">TOP</a>
                </div>
                <div class="footer__nav-col">
                    <a href="<?= esc_url(home_url('/')) ?>about" class="footer__nav-link">大阪港振興協会とは</a>
                    <a href="<?= esc_url(home_url('/')) ?>news" class="footer__nav-link">新着情報</a>
                    <a href="<?= esc_url(home_url('/')) ?>seminar" class="footer__nav-link">セミナー・イベント情報</a>
                    <a href="<?= esc_url(home_url('/')) ?>joho" class="footer__nav-link">情報誌「大阪港」</a>
                </div>
                <div class="footer__nav-col">
                    <a href="<?= esc_url(home_url('/')) ?>ship" class="footer__nav-link">客船・フェリー情報</a>
                    <a href="<?= esc_url(home_url('/')) ?>topics-category/records" class="footer__nav-link">大阪港の記録</a>
                    <a href="<?= esc_url(home_url('/')) ?>press" class="footer__nav-link">グッズ・刊行物</a>
                    <a href="<?= esc_url(home_url('/')) ?>topics-category/newsletter" class="footer__nav-link">ニュースレター</a>
                </div>
                <div class="footer__nav-col">
                    <a href="<?= esc_url(home_url('/')) ?>join" class="footer__nav-link">入会案内</a>
                    <a href="<?= esc_url(home_url('/')) ?>member-list" class="footer__nav-link">会員情報</a>
                    <a href="<?= esc_url(home_url('/')) ?>access" class="footer__nav-link">アクセス</a>
                </div>
            </nav>

            <!-- 右カラム：アクションボタン -->
            <div class="footer__actions">
                <a href="#" class="footer__btn footer__btn--outline">
                    大阪港振興倶楽部
                    <!-- 外部リンクアイコン -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none" class="icon-right">
                        <rect x="1.6333" y="1.63379" width="8.63333" height="8.63333" stroke="#AFCCDA" stroke-linejoin="round" />
                        <path d="M3.73328 12.3667C4.23558 12.3667 9.69812 12.3667 12.3666 12.3667V3.7334" stroke="#AFCCDA" />
                    </svg>
                </a>

                <a href="<?= esc_url(home_url('/')) ?>contact" class="footer__btn footer__btn--fill">
                    <!-- メールアイコン -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="icon-left">
                        <path d="M22.6 5H1.40002V19H22.6V5Z" stroke="white" stroke-linejoin="round" />
                        <path d="M1.40002 5L12 12.228L22.6 5" stroke="white" stroke-linejoin="round" />
                    </svg>
                    お問い合わせ
                </a>

                <!-- SNS -->
                <div class="footer__sns">
                    <a href="#" class="footer__sns-link" aria-label="X (Twitter)">
                        <svg viewBox="0 0 24 24">
                            <path d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z" />
                        </svg>
                    </a>
                    <a href="#" class="footer__sns-link" aria-label="YouTube">
                        <svg viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>

        <!-- ーー 下部 ーー -->
        <div class="footer__bottom">
            <p class="footer__copy">&copy;公益社団法人 大阪港振興協会</p>
            <a href="#" class="footer__privacy">プライバシーポリシー</a>
        </div>



    </div>
</footer>

<!-- js -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<?php wp_footer(); ?>
</body>

</html>