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

                <p class="top_about__text animate">
                    大阪港振興協会とは、<br>
                    大阪港の振興と発展を目的として<br class="sp">活動する公益法人です。<br>
                    港湾に関わる企業や<br class="sp">関係機関と連携しながら、<br>
                    情報発信や交流事業、<br class="sp">その他活動を通じて、<br>
                    大阪港の魅力を広く伝えています
                </p>
                <a href="<?= esc_url(home_url('/')) ?>about" class="commonBtn center">
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

                                <time datetime="<?php echo get_the_date('c'); ?>" class="top_news__date"><?php echo get_the_date('Y.n.j'); ?></time>
                                <?php
                                $category = get_the_category();
                                if ($category) {
                                    $cat_link = get_category_link($category[0]->term_id);
                                    echo '<a href="' . esc_url($cat_link) . '" class="top_news__category">'
                                        . esc_html($category[0]->name) .
                                        '</a>';
                                }
                                ?>
                                <?php $link = get_field('news_link'); ?>
                                <p class="top_news__text">
                                    <?php if ($link): ?>
                                        <a href="<?php echo esc_url($link); ?>" class="top_news__link">
                                            <?php the_title(); ?>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php the_permalink(); ?>" class="top_news__link">
                                            <?php the_title(); ?>
                                        </a>
                                    <?php endif; ?>
                                </p>
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
            <?php
            $seminars = new WP_Query([
                'post_type' => 'seminar',
                'post_status' => 'publish',
                'posts_per_page' => 3,
            ]);
            $badge_modifiers = ['top_seminars__card-badge--gold', 'top_seminars__card-badge--green', 'top_seminars__card-badge--brown'];
            $format_japanese_event_datetime = static function ($date_raw, $time_start_raw, $time_end_raw) {
                $date_raw = trim((string) $date_raw);
                $time_start_raw = trim((string) $time_start_raw);
                $time_end_raw = trim((string) $time_end_raw);
                if ($date_raw === '') {
                    return '';
                }

                $timezone = function_exists('wp_timezone') ? wp_timezone() : new DateTimeZone('Asia/Tokyo');
                $date = null;
                $date_formats = ['Ymd', 'Y-m-d', 'Y/m/d', 'Y.n.j', 'Y年n月j日'];
                foreach ($date_formats as $date_format) {
                    $try_date = DateTimeImmutable::createFromFormat($date_format, $date_raw, $timezone);
                    if ($try_date instanceof DateTimeImmutable) {
                        $date = $try_date;
                        break;
                    }
                }
                if (!$date) {
                    $timestamp = strtotime($date_raw);
                    if ($timestamp) {
                        $date = (new DateTimeImmutable('@' . $timestamp))->setTimezone($timezone);
                    }
                }
                if (!$date) {
                    return '';
                }

                $year = (int) $date->format('Y');
                $era_name = '令和';
                $era_year = $year - 2018;
                if ($year < 2019) {
                    $era_name = '平成';
                    $era_year = $year - 1988;
                }
                if ($era_year < 1) {
                    $era_year = 1;
                }

                $week_map = ['日', '月', '火', '水', '木', '金', '土'];
                $week = $week_map[(int) $date->format('w')];
                $date_part = sprintf('%s%d年%d月%d日(%s)', $era_name, $era_year, (int) $date->format('n'), (int) $date->format('j'), $week);

                $normalize_time = static function ($time_raw) {
                    $time_raw = trim((string) $time_raw);
                    if ($time_raw === '') {
                        return '';
                    }
                    $time_formats = ['H:i', 'H:i:s', 'G:i', 'G:i:s'];
                    foreach ($time_formats as $time_format) {
                        $time = DateTimeImmutable::createFromFormat($time_format, $time_raw);
                        if ($time instanceof DateTimeImmutable) {
                            return $time->format('H:i');
                        }
                    }
                    return $time_raw;
                };

                $time_start = $normalize_time($time_start_raw);
                $time_end = $normalize_time($time_end_raw);
                if ($time_start !== '' && $time_end !== '') {
                    return $date_part . ' ' . $time_start . '〜' . $time_end;
                }
                if ($time_start !== '') {
                    return $date_part . ' ' . $time_start;
                }
                return $date_part;
            };
            ?>
            <div class="top_seminars__cards">
                <?php if ($seminars->have_posts()) : ?>
                    <?php $card_index = 0; ?>
                    <?php while ($seminars->have_posts()) : $seminars->the_post(); ?>
                        <?php
                        $post_terms = get_the_terms(get_the_ID(), 'seminar_category');
                        $primary_term = (!is_wp_error($post_terms) && !empty($post_terms)) ? $post_terms[0] : null;

                        $term_color_raw = ($primary_term && function_exists('get_field')) ? get_field('color', $primary_term) : '';
                        $term_color = is_string($term_color_raw) ? sanitize_hex_color($term_color_raw) : '';
                        if (!$term_color) {
                            $term_color = '#5a7696';
                        }

                        $event = function_exists('get_field') ? get_field('event') : null;
                        $event_rows = is_array($event) ? ($event['event-repeat'] ?? $event['event_repeat'] ?? []) : [];
                        if (!is_array($event_rows)) {
                            $event_rows = [];
                        }
                        $event_row = !empty($event_rows) && is_array($event_rows[0]) ? $event_rows[0] : [];

                        $event_datetime_legacy = (string) ($event_row['event_datetime'] ?? '');
                        $event_datetime = $format_japanese_event_datetime(
                            (string) ($event_row['event_date'] ?? ''),
                            (string) ($event_row['event_time_s'] ?? ''),
                            (string) ($event_row['event_time_e'] ?? '')
                        );
                        if ($event_datetime === '') {
                            $event_datetime = $event_datetime_legacy;
                        }

                        $seminars_year = '';
                        $seminars_date = $event_datetime;
                        if (preg_match('/^((?:令和|平成)\d+年)\s*(.+)$/u', $event_datetime, $datetime_parts)) {
                            $seminars_year = trim($datetime_parts[1]);
                            $seminars_date = trim($datetime_parts[2]);
                        }

                        $event_location = (string) ($event_row['event_location'] ?? '');
                        $is_closed = !empty($event['close']);

                        $badge_modifier = $badge_modifiers[$card_index % count($badge_modifiers)];
                        $card_index++;
                        ?>
                        <article class="top_seminars__card">
                            <a href="<?php the_permalink(); ?>" class="top_seminars__card-link">
                                <div class="top_seminars__card-img">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('large'); ?>
                                    <?php else : ?>
                                        <img src="<?= esc_url(get_template_directory_uri() . '/assets/img/common/no-image.jpg'); ?>" alt="">
                                    <?php endif; ?>
                                </div>
                                <div class="top_seminars__card-body">
                                    <?php if ($primary_term instanceof WP_Term) : ?>
                                        <span class="top_seminars__card-badge <?= esc_attr($badge_modifier); ?>" style="<?= esc_attr('background-color:' . $term_color . ';'); ?>">
                                            <?= esc_html($primary_term->name); ?>
                                        </span>
                                    <?php endif; ?>
                                    <h3 class="top_seminars__card-title"><?php the_title(); ?></h3>
                                    <?php if ($is_closed) : ?>
                                        <div class="top_seminars__card-status">本セミナーは終了しました</div>
                                    <?php endif; ?>
                                    <dl class="top_seminars__card-info">
                                        <?php if ($event_datetime !== '') : ?>
                                            <div class="top_seminars__card-info-group">
                                                <dt>日時</dt>
                                                <dd>
                                                    <?php if ($seminars_year !== '') : ?>
                                                        <span class="seminars-year"><?= esc_html($seminars_year); ?></span>
                                                    <?php endif; ?>
                                                    <span class="seminars-date"><?= esc_html($seminars_date); ?></span>
                                                </dd>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($event_location !== '') : ?>
                                            <div class="top_seminars__card-info-group">
                                                <dt>場所</dt>
                                                <dd><?= wp_kses_post($event_location); ?></dd>
                                            </div>
                                        <?php endif; ?>
                                    </dl>
                                    <div class="top_seminars__card-btn-wrap">
                                        <span class="top_seminars__card-btn commonBtn center"><span>詳細・申し込みはこちら</span></span>
                                    </div>
                                </div>
                            </a>
                        </article>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
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
                <a href="<?php echo get_post_type_archive_link('seminar'); ?>" class="top_seminars__more-btn commonBtn center">
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
                                                <?php
                                                $term_link = get_term_link($term);
                                                if (!is_wp_error($term_link)) :
                                                ?>
                                                    <a href="<?php echo esc_url($term_link); ?>"
                                                        class="top_topics__card-badge cat-<?php echo esc_attr($term->slug); ?>">
                                                        <?php echo esc_html($term->name); ?>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                    </div>
                                    <?php $link = get_field('topics_link'); ?>
                                    <h3 class="top_topics__card-title">
                                        <?php if ($link): ?>
                                            <a href="<?php echo esc_url($link); ?>" class="top_topics__card-link">
                                                <?php echo mb_strimwidth(get_the_title(), 0, 60, '...'); ?>
                                            </a>
                                        <?php else: ?>
                                            <a href="<?php the_permalink(); ?>" class="top_topics__card-link"><?php echo mb_strimwidth(get_the_title(), 0, 60, '...'); ?></a>
                                        <?php endif; ?>
                                    </h3>
                                </div>


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
            <?php
            $joho = new WP_Query(array(
                'post_type' => 'joho',
                'posts_per_page' => 1,
            ));

            if ($joho->have_posts()) :
                while ($joho->have_posts()) : $joho->the_post();
            ?>
                    <!-- 2カラムコンテンツ -->
                    <div class="top_magazine__content">

                        <!-- 左：表紙画像 -->
                        <div class="top_magazine__image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php else: ?>
                                <img src="<?php echo imdir(); ?>/joho/joho_dummy.png" alt="">
                            <?php endif; ?>
                        </div>

                        <!-- 右：リスト -->
                        <div class="top_magazine__info">
                            <h3 class="top_magazine__issue"><?php the_title(); ?></h3>
                            <?php
                            $type = get_field('description_type');

                            // デフォルトを text に
                            if (!$type) {
                                $type = 'text';
                            }

                            if ($type === 'list' && have_rows('description_list')) :

                                echo '<ul class="top_magazine__list disc_list">';
                                while (have_rows('description_list')) {
                                    the_row();
                                    $item = get_sub_field('item');
                                    if ($item) {
                                        echo '<li>' . esc_html($item) . '</li>';
                                    }
                                }
                                echo '</ul>';

                            else :

                                // text（デフォルト含む）
                                $text = get_field('description_text');
                                if ($text) {
                                    echo '<div class="description_text">';
                                    echo wp_kses_post($text);
                                    echo '</div>';
                                }

                            endif;
                            ?>
                        </div>

                    </div>
            <?php
                endwhile;
            endif;
            wp_reset_postdata();
            ?>

            <!-- ボタン -->
            <div class="top_magazine__more">
                <a href="<?php echo get_post_type_archive_link('joho'); ?>" class="top_magazine__more-btn commonBtn center">
                    <span>情報誌「大阪港」一覧へ</span>
                </a>
            </div>

        </div>
    </section>
    <section class="top_goods">

        <div class="top_goods__inner sec_inner">
            <div class="top_goods_img01 img_con wave_img"><img src="<?php echo imdir(); ?>/top/top_goods_img01.svg" alt="船"></div>
            <div class="top_goods__image">
                <img src="<?php echo imdir(); ?>/top/top_goods_image@2x.jpg" alt="グッズ・刊行物のイメージ画像">
            </div>
            <div class="top_goods__content">
                <h2 class="top_goods__title-en main_ttl"><span class="font_big">G</span>oods &<br><span class="font_big">P</span>ublications</h2>
                <p class="top_goods__title-ja main_ttl_ja">グッズ・刊行物</p>

                <p class="top_goods__text">
                    当協会が制作・発行しているグッズおよび<br class="sp">刊行物を掲載しています。<br>
                    協会の取り組みや想いを形にしたアイテムを、<br class="sp">ぜひご覧ください。
                </p>

                <!-- 一覧へボタン -->
                <a href="<?php echo get_post_type_archive_link('press'); ?>" class="top_goods__btn commonBtn">
                    <span>グッズ・刊行物一覧へ</span>
                </a>
            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>