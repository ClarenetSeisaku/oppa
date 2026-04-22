<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        if (is_home()) {
            echo get_bloginfo('name');
        } else {
            wp_title('|', true, 'right');
            echo get_bloginfo('name');
        }
        ?>
    </title>
    <?php wp_head(); ?>

    <!-- favicon -->
    <link rel="shortcut icon" href="<?php echo imdir(); ?>/common/favicon.ico">
    <!-- <link rel="apple-touch-icon" sizes="180x180" href="<?php echo imdir(); ?>/common/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="<?php echo imdir(); ?>/common/android-chrome-512x512.png" sizes="192x192"> -->
    <!-- css -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.css">    -->


</head>

<body id="<?= body_id(); ?>">
    <header id="header">
        <div class="header_inner">
            <h1 class="h_logoarea">
                <a href="<?= esc_url(home_url('/')) ?>">
                    <img src="<?php echo imdir(); ?>/common/logo.svg" alt="ロゴ" class="logo">
                </a>
            </h1>
            <nav id="globalnav" class="globalnav" aria-label="メインメニュー">
                <ul class="gnav">
                    <li><a href="<?= esc_url(home_url('/')) ?>seminar">
                            <figure><img src="<?php echo imdir(); ?>/common/header_icon01.svg" alt="" class="pc hover_none"><img src="<?php echo imdir(); ?>/common/header_icon01_navy.svg" alt="" class="pc hover_block"><img src="<?php echo imdir(); ?>/common/header_icon01_sp.svg" alt="" class="sp"></figure><span>セミナー・<br class="pc">イベント</span>
                        </a></li>
                    <li><a href="<?= esc_url(home_url('/')) ?>joho">
                            <figure><img src="<?php echo imdir(); ?>/common/header_icon02.svg" alt="" class="pc hover_none"><img src="<?php echo imdir(); ?>/common/header_icon02_navy.svg" alt="" class="pc hover_block"><img src="<?php echo imdir(); ?>/common/header_icon02_sp.svg" alt="" class="sp"></figure>
                            <span>情報誌「大阪港」</span>
                        </a></li>
                    <li><a href="<?= esc_url(home_url('/')) ?>topics-category/newsletter">
                            <figure><img src="<?php echo imdir(); ?>/common/header_icon03.svg" alt="" class="pc hover_none"><img src="<?php echo imdir(); ?>/common/header_icon03_navy.svg" alt="" class="pc hover_block"><img src="<?php echo imdir(); ?>/common/header_icon03_sp.svg" alt="" class="sp"></figure>
                            <span>ニュースレター</span>
                        </a></li>
                    <li><a href="<?= esc_url(home_url('/')) ?>ship">
                            <figure><img src="<?php echo imdir(); ?>/common/header_icon04.svg" alt="" class="pc hover_none"><img src="<?php echo imdir(); ?>/common/header_icon04_navy.svg" alt="" class="pc hover_block"><img src="<?php echo imdir(); ?>/common/header_icon04_sp.svg" alt="" class="sp"></figure>
                            <span>客船・<br class="pc">フェリー情報</span>
                        </a></li>
                    <li><a href="<?= esc_url(home_url('/')) ?>topics-category/records">
                            <figure><img src="<?php echo imdir(); ?>/common/header_icon05.svg" alt="" class="pc hover_none"><img src="<?php echo imdir(); ?>/common/header_icon05_navy.svg" alt="" class="pc hover_block"><img src=" <?php echo imdir(); ?>/common/header_icon05_sp.svg" alt="" class="sp"></figure>
                            <span>大阪港の記録</span>
                        </a></li>
                    <li><a href="<?= esc_url(home_url('/')) ?>press">
                            <figure><img src="<?php echo imdir(); ?>/common/header_icon06.svg" alt="" class="pc hover_none"><img src="<?php echo imdir(); ?>/common/header_icon06_navy.svg" alt="" class="pc hover_block"><img src="<?php echo imdir(); ?>/common/header_icon06_sp.svg" alt="" class="sp"></figure>
                            <span>グッズ・刊行物</span>
                        </a></li>
                </ul>
                <div class="drawer">
                    <div class="drawer__inner">
                        <!-- サブリンク群 -->
                        <div class="drawer__links">
                            <div class="drawer__col drawer__col--top">
                                <ul>
                                    <li><a href="<?= esc_url(home_url('/')) ?>">TOP</a></li>
                                </ul>
                            </div>
                            <div class="drawer__col">
                                <ul>
                                    <li><a href="<?= esc_url(home_url('/')) ?>about">大阪港振興協会とは</a></li>
                                    <li><a href="<?= esc_url(home_url('/')) ?>news">新着情報</a></li>
                                    <li class="pc"><a href="<?= esc_url(home_url('/')) ?>seminar">セミナー・イベント情報</a></li>
                                    <li class="pc"><a href="<?= esc_url(home_url('/')) ?>joho">情報誌「大阪港」</a></li>
                                </ul>
                            </div>
                            <div class="drawer__col">
                                <ul>
                                    <li class="pc"><a href="<?= esc_url(home_url('/')) ?>ship">客船・フェリー情報</a></li>
                                    <li class="pc"><a href="<?= esc_url(home_url('/')) ?>topics-category/records">大阪港の記録</a></li>
                                    <li class="pc"><a href="<?= esc_url(home_url('/')) ?>press">グッズ・刊行物</a></li>
                                    <li><a href="<?= esc_url(home_url('/')) ?>topics-category/newsletter">ニュースレター</a></li>
                                </ul>
                            </div>
                            <div class="drawer__col">
                                <ul>
                                    <li><a href="<?= esc_url(home_url('/')) ?>seminar/?seminar_category=kyokai">協会事業報告</a></li>
                                    <li><a href="<?= esc_url(home_url('/')) ?>join">入会案内</a></li>
                                    <li><a href="<?= esc_url(home_url('/')) ?>member-list">会員情報</a></li>
                                    <li><a href="<?= esc_url(home_url('/')) ?>access">アクセス</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- アクションエリア（ボタン・SNS） -->
                        <div class="drawer__actions">
                            <!-- SP専用：アウトラインの倶楽部ボタン -->
                            <a href="#" class="drawer__btn drawer__btn--outline sp">
                                大阪港振興倶楽部
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none" class="icon-right">
                                    <rect x="1.6333" y="1.63379" width="8.63333" height="8.63333" stroke="#AFCCDA" stroke-linejoin="round" />
                                    <path d="M3.73328 12.3667C4.23558 12.3667 9.69812 12.3667 12.3666 12.3667V3.7334" stroke="#AFCCDA" />
                                </svg>
                            </a>
                            <!-- 共通：お問い合わせボタン -->
                            <a href="<?= esc_url(home_url('/')) ?>contact" class="drawer__btn drawer__btn--navy">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M22.6 5H1.40002V19H22.6V5Z" stroke="white" stroke-linejoin="round" />
                                    <path d="M1.40002 5L12 12.228L22.6 5" stroke="white" stroke-linejoin="round" />
                                </svg>
                                お問い合わせ
                            </a>
                            <!-- 共通：SNSアイコン -->
                            <div class="drawer__sns">
                                <a href="#" aria-label="X"><svg viewBox="0 0 24 24">
                                        <path d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z" />
                                    </svg></a>
                                <a href="#" aria-label="YouTube"><svg viewBox="0 0 24 24">
                                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                    </svg></a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="header_btn pc">
                <a href="#" class="headerBtn">
                    <p>大阪港振興倶楽部</p><svg class="icon-external" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="8" y="8" width="12" height="12" rx="1" />
                        <path d="M16 8V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2" />
                    </svg>
                </a>
            </div>
        </div>

        <button id="js-hamburger" class="hamburger" type="button" aria-label="メニューを開く" aria-controls="globalnav" aria-expanded="false">
            <span class="hamburger__line" aria-hidden="true"></span>
        </button>

        <div class="bg_Blur"></div>
    </header>