<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();

$breadcrumb_terms = get_the_terms(get_queried_object_id(), 'seminar_category');
$breadcrumb_term = (!is_wp_error($breadcrumb_terms) && !empty($breadcrumb_terms)) ? $breadcrumb_terms[0] : null;
?>
<main class="middle">
    <div class="seminar-wrap__container">
        <div class="pankuzu_wrap">
            <ul class="pankuzu sec_inner">
                <li><a href="<?= esc_url(home_url()) ?>">TOP</a></li>
                <li><a href="<?= esc_url(home_url('seminar')) ?>">Seminars / Events</a></li>
                <?php if ($breadcrumb_term instanceof WP_Term) : ?>
                    <?php $breadcrumb_term_url = add_query_arg('seminar_category', $breadcrumb_term->slug, get_post_type_archive_link('seminar')); ?>
                    <li>
                        <a href="<?= esc_url($breadcrumb_term_url) ?>">
                            <?= esc_html($breadcrumb_term->name) ?>
                        </a>
                    </li>
                <?php endif; ?>
                <li><?php the_title(); ?></li>
            </ul>
        </div>
    </div>

    <?php while (have_posts()) : the_post(); ?>
        <div class="seminar-wrap">
            <div class="cloud1 img_con">
                <picture>
                    <source media="(min-width: 769px)" srcset="<?php echo imdir(); ?>/common/footer_img01@2x.png"><img src="<?php echo imdir(); ?>/common/footer_img01_sp@2x.png" alt="">
                </picture>
            </div>

            <div class="cloud2 img_con">
                <picture>
                    <source media="(min-width: 769px)" srcset="<?php echo imdir(); ?>/top/top_about_img04.png"><img src="<?php echo imdir(); ?>/top/top_about_img04_sp@2x.png" alt="">
                </picture>
            </div>

            <div class="top_about_img02 img_con kamome_img">
                <img src="<?php echo imdir(); ?>/common/top_about_img02.svg" alt="かもめ">
            </div>

            <div class="top_about_img05 img_con wave_img">
                <img src="<?php echo imdir(); ?>/common/top_about_img03.svg" alt="船">
            </div>

            <div class="seminar-wrap__container">
                <?php
                $seminar_terms = get_the_terms(get_the_ID(), 'seminar_category');
                if (!is_wp_error($seminar_terms) && !empty($seminar_terms)) :
                ?>
                    <ul class="seminar-wrap__terms">
                        <?php foreach ($seminar_terms as $seminar_term) : ?>
                            <?php
                            $term_color_raw = function_exists('get_field') ? get_field('color', $seminar_term) : '';
                            $term_color = is_string($term_color_raw) ? sanitize_hex_color($term_color_raw) : '';
                            if (!$term_color) {
                                $term_color = '#5a7696';
                            }
                            ?>
                            <li class="seminar-wrap__term" style="<?php echo esc_attr('background-color:' . $term_color . ';'); ?>">
                                <?php echo esc_html($seminar_term->name); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <p class="seminar-wrap__subtitle">サブタイトルが入ります。ダミーです。</p>
                <h1 class="seminar-wrap__title"><?php the_title(); ?></h1>

                <section class="seminar-wrap__card seminar-wrap__card--detail">
                    <h2 class="seminar-wrap__heading">セミナー・イベント詳細</h2>
                    <div class="seminar-wrap__content">
                        <?php if (trim((string) get_the_content()) !== '') : ?>
                            <?php the_content(); ?>
                        <?php else : ?>
                            <p>公益社団法人大阪港振興協会と大阪港埠頭株式会社は、国際港湾協会(IAPH)の活動に 14 年間の長きにわたり携わり、同協会副会長を務められた篠原正治氏をお招きし、「世界のコンテナ港湾について～14 年間の国際港湾協会活動で学んだこと ～」と題した講演会を開催いたします。同氏は長年港湾行政の第一線で活躍されるとともに、世界の港湾事情に精通され、豊富な実務経験と高い学識を兼ね備えた港湾分野の第一人者です。<br>
                                本講演では、IAPH の活動概要とその中で得られた教訓をはじめ、世界の自動化ターミナルの最新動向、ロサンゼルス港・ロングビーチ港（LA・LB）などに見られる近接港湾における協調と競争の関係、さらに、篠原氏が提唱された「Total Yard Move」という考え方に基づく、コンテナターミナルの生産性・効率性評価などについて、具体的な事例を交えながらお話しいただきます。</p>
                        <?php endif; ?>
                    </div>
                </section>

                <?php
                $speaker = function_exists('get_field') ? get_field('speaker') : null;
                $speaker_role = is_array($speaker) ? ($speaker['speaker-role'] ?? $speaker['speaker_role'] ?? '') : '';
                $speaker_name = is_array($speaker) ? ($speaker['speaker-name'] ?? $speaker['speaker_name'] ?? '') : '';
                $speaker_bio = is_array($speaker) ? ($speaker['speaker-bio'] ?? $speaker['speaker_bio'] ?? '') : '';
                $speaker_image = is_array($speaker) ? ($speaker['speaker-image'] ?? $speaker['speaker_image'] ?? '') : '';
                $speaker_image_url = '';
                $speaker_image_alt = '';

                if (is_array($speaker_image)) {
                    $speaker_image_url = isset($speaker_image['url']) ? (string) $speaker_image['url'] : '';
                    $speaker_image_alt = isset($speaker_image['alt']) ? (string) $speaker_image['alt'] : '';
                } elseif (is_numeric($speaker_image)) {
                    $speaker_image_url = (string) wp_get_attachment_image_url((int) $speaker_image, 'large');
                    $speaker_image_alt = (string) get_post_meta((int) $speaker_image, '_wp_attachment_image_alt', true);
                } elseif (is_string($speaker_image)) {
                    $speaker_image_url = $speaker_image;
                }

                if ($speaker_image_alt === '' && $speaker_name !== '') {
                    $speaker_image_alt = $speaker_name;
                }
                ?>
                <section class="seminar-wrap__card seminar-wrap__card--speaker">
                    <div class="seminar-wrap__speaker-main">
                        <h2 class="seminar-wrap__heading">講師</h2>
                        <?php if (!empty($speaker_role)) : ?>
                            <p class="seminar-wrap__speaker-role"><?php echo esc_html($speaker_role); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($speaker_name)) : ?>
                            <h3 class="seminar-wrap__speaker-name"><?php echo esc_html($speaker_name); ?></h3>
                        <?php endif; ?>
                        <?php if (!empty($speaker_bio)) : ?>
                            <div class="seminar-wrap__speaker-bio"><?php echo wp_kses_post($speaker_bio); ?></div>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($speaker_image_url)) : ?>
                        <div class="seminar-wrap__speaker-image">
                            <img src="<?php echo esc_url($speaker_image_url); ?>" alt="<?php echo esc_attr($speaker_image_alt); ?>">
                        </div>
                    <?php else : ?>
                        <div class="seminar-wrap__speaker-image" aria-hidden="true"></div>
                    <?php endif; ?>
                </section>

                <section class="seminar-wrap__card seminar-wrap__card--summary">
                    <h2 class="seminar-wrap__heading">概要</h2>

                    <?php
                    $event = function_exists('get_field') ? get_field('event') : null;

                    $event_rows = is_array($event) ? ($event['event-repeat'] ?? $event['event_repeat'] ?? []) : [];
                    if (!is_array($event_rows)) {
                        $event_rows = [];
                    }

                    $pdf_rows = is_array($rows = get_field('pdf-repeat')) ? $rows : [];

                    $event_rows = is_array($event) ? ($event['event-repeat'] ?? $event['event_repeat'] ?? []) : [];
                    if (!is_array($event_rows)) {
                        $event_rows = [];
                    }

                    $close = $event['close'] ?? false;

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
                        $date_part = sprintf(
                            '%s%d年%d月 %d 日 (%s)',
                            $era_name,
                            $era_year,
                            (int) $date->format('n'),
                            (int) $date->format('j'),
                            $week
                        );

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
                            return $date_part . ' ' . $time_start . '～' . $time_end;
                        }
                        if ($time_start !== '') {
                            return $date_part . ' ' . $time_start;
                        }

                        return $date_part;
                    };
                    ?>

                    <?php if ($close): ?>
                        <p class="seminar-wrap__summary-status">本セミナーは終了しました</p>
                    <?php endif; ?>


                    <?php foreach ($event_rows as $event_row) : ?>
                        <?php
                        $event_datetime_legacy = (string) ($event_row['event_datetime'] ?? '');
                        $event_datetime = $format_japanese_event_datetime(
                            (string) ($event_row['event_date'] ?? ''),
                            (string) ($event_row['event_time_s'] ?? ''),
                            (string) ($event_row['event_time_e'] ?? '')
                        );
                        if ($event_datetime === '') {
                            $event_datetime = $event_datetime_legacy;
                        }
                        $event_location = (string) ($event_row['event_location'] ?? '');
                        $event_capacity = (string) ($event_row['event_capacity'] ?? '');
                        $event_fee = (string) ($event_row['event_fee'] ?? '');
                        $event_application_method = (string) ($event_row['event_application_method'] ?? '');
                        $event_application_url = (string) ($event_row['event_application_url'] ?? '');
                        $event_deadline = (string) ($event_row['event_deadline'] ?? '');
                        $event_office = (string) ($event_row['event_office'] ?? '');
                        $event_organizer = (string) ($event_row['event_organizer'] ?? '');
                        ?>

                        <table class="seminar-wrap__summary-table">
                            <?php if ($event_datetime !== '') : ?>
                                <tr>
                                    <td>開催日時</td>
                                    <td><?php echo esc_html($event_datetime); ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if ($event_location !== '') : ?>
                                <tr>
                                    <td>開催場所</td>
                                    <td><?php echo wp_kses_post($event_location); ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if ($event_capacity !== '') : ?>
                                <tr>
                                    <td>応募人数</td>
                                    <td><?php echo esc_html($event_capacity); ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if ($event_fee !== '') : ?>
                                <tr>
                                    <td>参加費</td>
                                    <td><?php echo wp_kses_post($event_fee); ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if ($event_application_method !== '') : ?>
                                <tr>
                                    <td>申込方法</td>
                                    <td><?php echo wp_kses_post($event_application_method); ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if ($event_deadline !== '') : ?>
                                <tr>
                                    <td>申込締切</td>
                                    <td><?php echo esc_html($event_deadline); ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if ($event_office !== '') : ?>
                                <tr>
                                    <td>事務局</td>
                                    <td><?php echo wp_kses_post($event_office); ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if ($event_organizer !== '') : ?>
                                <tr>
                                    <td>主催</td>
                                    <td><?php echo wp_kses_post($event_organizer); ?></td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    <?php endforeach; ?>

                    <?php foreach ($pdf_rows as $pdf_row) : ?>
                        <a href="<?php echo esc_url($pdf_row['pdf']); ?>" class="seminar-wrap__summary-link">
                            <span>タイトルが入りますダミーですタイトルが入りますダミーです</span>
                        </a>
                    <?php endforeach; ?>
                </section>
            </div>
        </div>

        <div class="middle_mv__wave-sway" style="position: relative;">
            <div class="middle_mv__wave-move">
                <svg class="middle_mv__wave" viewBox="0 0 1440 150" preserveAspectRatio="none">
                    <path d="M 0,60 Q 360,100 720,60 T 1440,60 L 1440,150 L 0,150 Z"></path>
                </svg>
                <svg class="middle_mv__wave" viewBox="0 0 1440 150" preserveAspectRatio="none">
                    <path d="M 0,60 Q 360,100 720,60 T 1440,60 L 1440,150 L 0,150 Z"></path>
                </svg>
            </div>
        </div>

        <section class="seminar-entry">
            <h2 class="seminar-entry__title">タイトルが入ります。ダミーです。タイトルが入ります。</h2>
            <h3 class="seminar-entry__subtitle">お申込みフォーム</h3>
            <div id="form" class="seminar-entry__form">
                <?php echo do_shortcode('[seminar_entry_form]'); ?>
            </div>
        </section>
    <?php endwhile; ?>


</main>
<?php get_footer(); ?>