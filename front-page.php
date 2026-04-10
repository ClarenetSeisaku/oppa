<?php

/**
 * トップページ
 *
 */
?>
<?php
get_header();
?>
<main>

    <!-- メインビジュアル -->
    <section class="top_mv">

        <!-- 背景画像 -->
        <div class="top_mv__bg">
            <video id="heroVideo"
                class="hero__video"
                playsinline
                autoplay
                muted
                loop
                loading="eager"
                poster="<?php echo imdir(); ?>/top/top_mv.jpg">
                <source src="<?php echo imdir(); ?>/top/oppa_mv.mp4" type="video/mp4">
                <!-- fallback text -->
                このブラウザは動画をサポートしていません。
            </video>
        </div>

        <!-- キャッチコピー -->
        <div class="top_mv__inner">
            <h2 class="top_mv__title">
                海とともに歩み、<br>
                海から未来をひらく大阪港
            </h2>
            <p class="top_mv__subtitle">Osaka Port Promotion Association</p>
            <!-- 左下のストップボタン -->
            <button id="stopBtn" class="video-stop-btn is-pause">
                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none" class="icon-pause">
                    <rect x="0.5" y="0.5" width="33" height="33" rx="3.5" stroke="#DCE1E5" />
                    <path d="M14 11V23" stroke="#DCE1E5" />
                    <path d="M20 11V23" stroke="#DCE1E5" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none" class="icon-play">
                    <rect x="0.5" y="0.5" width="33" height="33" rx="3.5" stroke="#DCE1E5" />
                    <path d="M12.5 22.1914L12.5 11.8086L22.8818 17L12.5 22.1914Z" stroke="#DCE1E5" />
                </svg>
            </button>
        </div>
        <!-- アニメーション装飾エリア -->
        <div class="top_mv__decoration">

            <!-- 波 -->
            <div class="top_mv__wave-sway">
                <div class="top_mv__wave-move">
                </div>
            </div>
        </div>

    </section>
    <section class="top_about">
        <div class="top_about__bg-text">Osaka Port Promotion Association</div>
        <div class="top_about_img01 img_con">
            <picture>
                <source media="(min-width: 769px)" srcset="<?php echo imdir(); ?>/common/top_about_img01.png"><img src="<?php echo imdir(); ?>/common/top_about_img01_sp@2x.png" alt="">
            </picture>
        </div>
        <div class="top_about_img04 img_con">
            <picture>
                <source media="(min-width: 769px)" srcset="<?php echo imdir(); ?>/top/top_about_img04.png"><img src="<?php echo imdir(); ?>/top/top_about_img04_sp@2x.png" alt="">
            </picture>
        </div>
        <div class="sec_inner">
            <div class="top_about_img02 img_con kamome_img"><img src="<?php echo imdir(); ?>/common/top_about_img02.svg" alt="かもめ"></div>
            <div class="top_about_img03 img_con wave_img"><img src="<?php echo imdir(); ?>/common/top_about_img03.svg" alt="船"></div>
            <div class="top_about__inner">

                <p class="top_about__text">
                    大阪港振興協会とは、<br>
                    大阪港の振興と発展を目的として<br class="sp">活動する公益法人です。<br>
                    港湾に関わる企業や<br class="sp">関係機関と連携しながら、<br>
                    情報発信や交流事業、<br class="sp">その他活動を通じて、<br>
                    大阪港の魅力を広く伝えています
                </p>
                <a href="#" class="commonBtn center">
                    <span>大阪港振興協会とは</span>
                </a>
            </div>
            <div class="top_about_img05 img_con wave_img"><img src="<?php echo imdir(); ?>/top/top_about_img05.svg" alt="船"></div>
        </div>
        <div class="top_about_img06 img_con"><img src="<?php echo imdir(); ?>/top/top_about_img06.png" alt=""></div>

    </section>
    <section class="top_flow_animation">

        <div class="top_flow_animation__track">
            <img src="<?php echo imdir(); ?>/top/flow_animation.png" alt="フローアニメーション">
            <!-- 無限ループさせるためにもう1つ同じ画像を置く -->
            <img src="<?php echo imdir(); ?>/top/flow_animation.png" alt="" aria-hidden="true">
        </div>
        <div class="top_flow_animation_img01 img_con">
            <picture>
                <source media="(min-width: 769px)" srcset="<?php echo imdir(); ?>/top/top_news_img01.png"><img src="<?php echo imdir(); ?>/top/top_news_img01_sp@2x.png" alt="">
            </picture>
        </div>
        <div class="top_flow_animation_img02 img_con"><img src="<?php echo imdir(); ?>/top/top_news_img02.png" alt=""></div>
    </section>
    <section class="top_news">

        <div class="top_news_img03 img_con">
            <picture>
                <source media="(min-width: 769px)" srcset="<?php echo imdir(); ?>/top/top_news_img03.png"><img src="<?php echo imdir(); ?>/top/top_news_img03_sp@2x.png" alt="">
            </picture>
        </div>
        <div class="top_news__inner sec_inner">
            <!-- 左カラム（タイトル＆ボタン） -->
            <div class="top_news__header">
                <h2 class="top_news__title-en en_font">News</h2>
                <p class="top_news__title-ja">新着情報</p>
                <a href="<?= esc_url(home_url('/')) ?>news" class="top_news__btn pc commonBtn">
                    <span>新着情報一覧</span>
                </a>
            </div>

            <!-- 右カラム（ニュースリスト） -->
            <div class="top_news__content">
                <ul class="top_news__list">
                    <?php
                    $topics = new WP_Query(array(
                        'post_type' => 'post',
                        'posts_per_page' => 4,
                        'paged' => $paged,
                    ));
                    ?>
                    <?php
                    if ($topics->have_posts()) :
                    ?>
                        <?php
                        while ($topics->have_posts()) :
                            $topics->the_post();
                        ?>
                            <li class="top_news__item">
                                <a href="<?php the_permalink(); ?>" class="top_news__link">
                                    <time datetime="<?php echo get_the_date('c'); ?>" class="top_news__date"><?php echo get_the_date('Y.n.j'); ?></time>
                                    <?php
                                    $category = get_the_category();
                                    if ($category) {
                                        echo '<span class="top_news__category">' . esc_html($category[0]->name) . '</span>';
                                    }
                                    ?>
                                    <p class="top_news__text"><?php the_title(); ?></p>
                                </a>
                            </li>
                    <?php endwhile;
                    endif;
                    wp_reset_postdata(); ?>
                </ul>
                <a href="<?= esc_url(home_url('/')) ?>news" class="top_news__btn sp commonBtn">
                    <span>新着情報一覧</span>
                </a>
            </div>
        </div>

        <!-- アニメーション装飾エリア -->
        <div class="top_news__decoration">

            <!-- 波 -->
            <div class="top_news__wave-sway">
                <div class="top_news__wave-move">
                    <svg class="top_news__wave" viewBox="0 0 1440 150" preserveAspectRatio="none">
                        <path d="M 0,60 Q 360,100 720,60 T 1440,60 L 1440,150 L 0,150 Z"></path>
                    </svg>
                    <svg class="top_news__wave" viewBox="0 0 1440 150" preserveAspectRatio="none">
                        <path d="M 0,60 Q 360,100 720,60 T 1440,60 L 1440,150 L 0,150 Z"></path>
                    </svg>
                </div>
            </div>

            <!-- ボート -->
            <img src="<?php echo imdir(); ?>/top/boat_img.svg" alt="ボート" class="top_news__boat wave_img">
        </div>
    </section>
    <section class="top_seminars">
        <div class="top_seminars__inner sec_inner">
            <!-- タイトル -->
            <div class="top_seminars__header">
                <h2 class="top_seminars__title-en main_ttl"><span class="sp_text_left"><span class="font_big">S</span>eminars & </span><span class="sp_text_right"><span class="font_big">E</span>vents</span></h2>
                <p class="top_seminars__title-ja main_ttl_ja">セミナー・イベントのご案内</p>
            </div>

            <!-- カードリスト -->
            <div class="top_seminars__cards">
                <article class="top_seminars__card">
                    <a href="#" class="top_seminars__card-link">
                        <div class="top_seminars__card-img"><img src="<?php echo imdir(); ?>/top/img01.jpg" alt=""></div>
                        <div class="top_seminars__card-body">
                            <span class="top_seminars__card-badge top_seminars__card-badge--gold">カテゴリー</span>
                            <h3 class="top_seminars__card-title">世界のコンテナ港湾について〜14年間の国際港湾協会活動で学んだこと〜</h3>
                            <dl class="top_seminars__card-info">
                                <div class="top_seminars__card-info-group">
                                    <dt>日時</dt>
                                    <dd><span class="seminars-year">令和8年</span> <span class="seminars-date">2月25日(水) 15:30〜17:00</span></dd>
                                </div>
                                <div class="top_seminars__card-info-group">
                                    <dt>場所</dt>
                                    <dd>第一大阪港ビル 8階会議室（大阪市港区築港2−1−2）</dd>
                                </div>
                            </dl>
                            <div class="top_seminars__card-btn-wrap">
                                <span class="top_seminars__card-btn commonBtn center"><span>詳細・申し込みはこちら</span></span>
                            </div>
                        </div>
                    </a>
                </article>

                <article class="top_seminars__card">
                    <a href="#" class="top_seminars__card-link">
                        <div class="top_seminars__card-img"><img src="<?php echo imdir(); ?>/top/img02.jpg" alt=""></div>
                        <div class="top_seminars__card-body">
                            <span class="top_seminars__card-badge top_seminars__card-badge--green">カテゴリー</span>
                            <h3 class="top_seminars__card-title">海運論基礎講座（全5回）</h3>
                            <dl class="top_seminars__card-info">
                                <div class="top_seminars__card-info-group">
                                    <dt>日時</dt>
                                    <dd><span class="seminars-year">令和8年</span> <span class="seminars-date">1月21日(水)、28日(水)、2月4日(水)、18日(水)、2/25(水) 15:30〜17:00</span></dd>
                                </div>
                                <div class="top_seminars__card-info-group">
                                    <dt>場所</dt>
                                    <dd>第一大阪港ビル 8階会議室（大阪市港区築港2−1−2）</dd>
                                </div>
                            </dl>
                            <div class="top_seminars__card-btn-wrap">
                                <span class="top_seminars__card-btn commonBtn center"><span>詳細・申し込みはこちら</span></span>
                            </div>
                        </div>
                    </a>
                </article>

                <article class="top_seminars__card">
                    <a href="#" class="top_seminars__card-link">
                        <div class="top_seminars__card-img"><img src="<?php echo imdir(); ?>/top/img03.jpg" alt=""></div>
                        <div class="top_seminars__card-body">
                            <span class="top_seminars__card-badge top_seminars__card-badge--brown">カテゴリー</span>
                            <h3 class="top_seminars__card-title">内航海運・フェリー業界の現状と課題発行記念講演会2025開催</h3>
                            <div class="top_seminars__card-status">本セミナーは終了しました</div>
                            <dl class="top_seminars__card-info">
                                <div class="top_seminars__card-info-group">
                                    <dt>日時</dt>
                                    <dd><span class="seminars-year">令和7年</span> <span class="seminars-date">12月5日(金) 15:30〜17:00</span></dd>
                                </div>
                                <div class="top_seminars__card-info-group">
                                    <dt>場所</dt>
                                    <dd>第一大阪港ビル 8階会議室（大阪市港区築港2−1−2）</dd>
                                </div>
                            </dl>
                            <div class="top_seminars__card-btn-wrap">
                                <span class="top_seminars__card-btn commonBtn center"><span>詳細・申し込みはこちら</span></span>
                            </div>
                        </div>
                    </a>
                </article>
            </div>
            <!-- 下部 ボタン群 -->
            <div class="top_seminars__actions sp">
                <!-- コントローラー（矢印） -->
                <div class="top_seminars__controls">
                    <button class="top_seminars__control-btn seminars__js-prev" aria-label="前へ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="8" viewBox="0 0 28 8" fill="none">
                            <path d="M28 4H8" stroke="#244668" />
                            <path d="M0 4L8 0V8L0 4Z" fill="#244668" />
                        </svg>
                    </button>
                    <button class="top_seminars__control-btn seminars__js-next" aria-label="次へ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="8" viewBox="0 0 28 8" fill="none">
                            <path d="M0 4H20" stroke="#244668" />
                            <path d="M28 4L20 0V8L28 4Z" fill="#244668" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- 一覧へボタン -->
            <div class="top_seminars__more">
                <a href="#" class="top_seminars__more-btn commonBtn center">
                    <span>セミナー・イベント一覧へ</span>
                </a>
            </div>
        </div>

        <!-- 下部の風景画像＋グラデーションマスク -->
        <div class="top_seminars__parallax">
            <img src="<?php echo imdir(); ?>/top/top_seminer_bg@2x.jpg" alt="大阪港の風景">
        </div>

    </section>

    <section class="top_topics">
        <div class="top_topics_img01 img_con">
            <picture>
                <source media="(min-width: 769px)" srcset="<?php echo imdir(); ?>/top/top_topics_img01@2x.png"><img src="<?php echo imdir(); ?>/top/top_topics_img01_sp@2x.png" alt="">
            </picture>
        </div>
        <div class="top_topics_img02 img_con kamome_img"><img src="<?php echo imdir(); ?>/top/top_topics_img02.svg" alt="かもめ"></div>
        <div class="top_topics__inner">

            <!-- 左カラム（タイトル＆タブ） -->
            <div class="top_topics__sidebar">
                <h2 class="top_topics__title-en main_ttl"><span class="font_big">T</span>opics</h2>
                <p class="top_topics__title-ja main_ttl_ja">トピックス</p>

                <ul class="top_topics__tabs">
                    <!-- 一番上は最初から is-active でホバー状態 -->
                    <li><button class="top_topics__tab" data-slug="all">すべて</button></li>
                    <li><button class="top_topics__tab" style="--line-color: #A7913A;" data-slug="kyakusen">客船</button></li>
                    <li><button class="top_topics__tab" style="--line-color: #468492;" data-slug="newsletter">ニュースレター</button></li>
                    <li><button class="top_topics__tab" style="--line-color: #B55538;" data-slug="records">大阪港の記録</button></li>
                </ul>
            </div>

            <!-- 右カラム（スライダー） -->
            <div class="top_topics__content">
                <div class="top_topics__slider">
                    <?php
                    $topics = new WP_Query(array(
                        'post_type' => 'topics',
                        'posts_per_page' => 6,
                    ));

                    if ($topics->have_posts()) :
                        while ($topics->have_posts()) : $topics->the_post();

                            // 1回だけ取得
                            $terms = get_the_terms(get_the_ID(), 'topics-category');

                            // クラス用配列
                            $term_classes = [];

                            if (!empty($terms) && !is_wp_error($terms)) {
                                foreach ($terms as $term) {
                                    $term_classes[] = 'cat-' . $term->slug;
                                }
                            }
                    ?>

                            <article class="top_topics__card <?php echo implode(' ', $term_classes); ?>">
                                <a href="<?php the_permalink(); ?>" class="top_topics__card-link">

                                    <div class="top_topics__card-img">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium'); ?>
                                        <?php else: ?>
                                            <img src="<?php echo imdir(); ?>/common/oppa_topics_dummy.png" alt="">
                                        <?php endif; ?>
                                    </div>

                                    <div class="top_topics__card-body">
                                        <div class="top_topics__card-meta">

                                            <time datetime="<?php echo get_the_date('c'); ?>" class="top_topics__card-date">
                                                <?php echo get_the_date('Y.m.d'); ?>
                                            </time>

                                            <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
                                                <?php foreach ($terms as $term) : ?>
                                                    <span class="top_topics__card-badge cat-<?php echo esc_attr($term->slug); ?>">
                                                        <?php echo esc_html($term->name); ?>
                                                    </span>
                                                <?php endforeach; ?>
                                            <?php endif; ?>

                                        </div>

                                        <h3 class="top_topics__card-title">
                                            <?php echo mb_strimwidth(get_the_title(), 0, 60, '...'); ?>
                                        </h3>
                                    </div>

                                </a>
                            </article>

                    <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>

                </div>
            </div>

            <!-- 下部 ボタン群 -->
            <div class="top_topics__actions">
                <!-- コントローラー（矢印） -->
                <div class="top_topics__controls">
                    <button class="top_topics__control-btn js-prev" aria-label="前へ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="8" viewBox="0 0 28 8" fill="none">
                            <path d="M28 4H8" stroke="#244668" />
                            <path d="M0 4L8 0V8L0 4Z" fill="#244668" />
                        </svg>
                    </button>
                    <button class="top_topics__control-btn js-next" aria-label="次へ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="8" viewBox="0 0 28 8" fill="none">
                            <path d="M0 4H20" stroke="#244668" />
                            <path d="M28 4L20 0V8L28 4Z" fill="#244668" />
                        </svg>
                    </button>
                </div>
                <!-- 一覧へボタン -->
                <a href="<?php echo get_post_type_archive_link('topics'); ?>" class="top_topics__more-btn commonBtn">
                    <span>トピックス一覧へ</span>
                </a>
            </div>

        </div>
    </section>
    <section class="top_magazine">
        <div class="top_magazine_img01 img_con">
            <picture>
                <source media="(min-width: 769px)" srcset="<?php echo imdir(); ?>/top/top_magazine_img01@2x.png"><img src="<?php echo imdir(); ?>/top/top_magazine_img01_sp@2x.png" alt="">
            </picture>
        </div>
        <div class="top_magazine_img03 img_con"><img src="<?php echo imdir(); ?>/top/top_magazine_img03@2x.png" alt=""></div>
        <div class="top_magazine_img04 img_con">
            <picture>
                <source media="(min-width: 769px)" srcset="<?php echo imdir(); ?>/top/top_magazine_img04@2x.png"><img src="<?php echo imdir(); ?>/top/top_magazine_img04_sp@2x.png" alt="">
            </picture>
        </div>
        <div class="top_magazine__inner sec_inner">
            <div class="top_magazine_img02 img_con wave_img"><img src="<?php echo imdir(); ?>/top/top_magazine_img02.svg" alt="船"></div>
            <!-- タイトル -->
            <div class="top_magazine__header">
                <h2 class="top_magazine__title-en main_ttl"><span class="font_big">M</span>agazine</h2>
                <p class="top_magazine__title-ja main_ttl_ja">情報誌「大阪港」</p>
            </div>

            <!-- 2カラムコンテンツ -->
            <div class="top_magazine__content">

                <!-- 左：表紙画像 -->
                <div class="top_magazine__image">
                    <img src="<?php echo imdir(); ?>/top/magazine.jpg" alt="情報誌 大阪港 2026年1月号 表紙">
                </div>

                <!-- 右：リスト -->
                <div class="top_magazine__info">
                    <h3 class="top_magazine__issue">2026年1月号　77巻第1号</h3>
                    <ul class="top_magazine__list">
                        <li>2026年世界と日本を読み解く</li>
                        <li>釜山新港完全自動化コンテナターミナル視察</li>
                        <li>「実は職のインフラを支えている」</li>
                        <li>〜イシダの取組〜（第1回）</li>
                        <li>クルーズの時代（３）現代クルーズの成長と伝統的クルーズの再生</li>
                        <li>港と人、そして帆船〜連続エッセイ②〜</li>
                        <li>古代の難波でおこなわれた国際貿易（第2回）</li>
                        <li>安治川の開発と大阪の発展（第2回）</li>
                        <li>海運界・造船界の偉人・川村貞次郎の功績（第3回）</li>
                        <li>大阪市上海事務所だより</li>
                        <li>「世界のコンテナ港とターミナルオペレーターの現状」「内航海運・フェリーの現状と課題」発行</li>
                        <li>大阪港のクルーズ客船入港予定表(2026年1〜3月)</li>
                        <li>大阪港の主な初入港船(2025年9〜11月)</li>
                    </ul>
                </div>

            </div>

            <!-- ボタン -->
            <div class="top_magazine__more">
                <a href="#" class="top_magazine__more-btn commonBtn center">
                    <span>情報誌「大阪港」一覧へ</span>
                </a>
            </div>

        </div>
    </section>
    <section class="top_goods">

        <div class="top_goods__inner sec_inner">
            <div class="top_goods_img01 img_con wave_img"><img src="<?php echo imdir(); ?>/top/top_goods_img01.svg" alt="船"></div>
            <!-- 左：画像エリア -->
            <div class="top_goods__image">
                <!-- グレーのダミー画像を配置 -->
                <img src="https://placehold.jp/dddddd/dddddd/600x600.png" alt="グッズ・刊行物のイメージ">
            </div>

            <!-- 右：コンテンツエリア -->
            <div class="top_goods__content">
                <h2 class="top_goods__title-en main_ttl"><span class="font_big">G</span>oods &<br><span class="font_big">P</span>ublications</h2>
                <p class="top_goods__title-ja main_ttl_ja">グッズ・刊行物</p>

                <p class="top_goods__text">
                    当協会が制作・発行しているグッズおよび<br class="sp">刊行物を掲載しています。<br>
                    協会の取り組みや想いを形にしたアイテムを、<br class="sp">ぜひご覧ください。
                </p>

                <!-- 一覧へボタン -->
                <a href="#" class="top_goods__btn commonBtn">
                    <span>グッズ・刊行物一覧へ</span>
                </a>
            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>