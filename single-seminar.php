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
                <?php
                $sub_title = function_exists('get_field') ? get_field('sub-title') : '';
                if (is_string($sub_title)) {
                    $sub_title = trim($sub_title);
                } else {
                    $sub_title = '';
                }
                ?>
                <?php if ($sub_title !== '') : ?>
                    <p class="seminar-wrap__subtitle"><?php echo esc_html($sub_title); ?></p>
                <?php endif; ?>
                <h1 class="seminar-wrap__title"><?php the_title(); ?></h1>

                <?php $has_detail_section = (trim((string) get_the_content()) !== ''); ?>
                <?php if ($has_detail_section) : ?>
                    <section class="seminar-wrap__card seminar-wrap__card--detail">
                        <h2 class="seminar-wrap__heading">セミナー・イベント詳細</h2>
                        <div class="seminar-wrap__content">
                            <?php the_content(); ?>
                        </div>
                    </section>
                <?php endif; ?>

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
                $has_speaker_section = (
                    $speaker_role !== '' ||
                    $speaker_name !== '' ||
                    $speaker_bio !== '' ||
                    $speaker_image_url !== ''
                );
                ?>
                <?php if ($has_speaker_section) : ?>
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
                <?php endif; ?>
                <?php
                $event = function_exists('get_field') ? get_field('event') : null;

                $event_group = is_array($event) ? ($event['event-group'] ?? $event['event_group'] ?? []) : [];
                if (!is_array($event_group)) {
                    $event_group = function_exists('get_field') ? (get_field('event-group') ?? get_field('event_group') ?? []) : [];
                }
                if (!is_array($event_group)) {
                    $event_group = [];
                }

                $pdf_rows = function_exists('get_field') ? get_field('pdf-repeat') : [];
                if (!is_array($pdf_rows)) {
                    $pdf_rows = [];
                }

                $close = is_array($event) ? ($event['close'] ?? false) : false;

                $format_japanese_event_datetime = static function ($date_raw, $time_start_raw, $time_end_raw) {
                    $date_raw = trim((string) $date_raw);
                    $time_start_raw = trim((string) $time_start_raw);
                    $time_end_raw = trim((string) $time_end_raw);

                    if ($date_raw === '') {
                        return '';
                    }

                    $timezone = function_exists('wp_timezone') ? wp_timezone() : new DateTimeZone('Asia/Tokyo');
                    $date = null;
                    $date_formats = ['Ymd', 'Y-m-d', 'Y/m/d', 'Y.n.j', 'd/m/Y', 'd-m-Y', 'd.m.Y', 'Y年n月j日'];
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
                        '%s%d年%d月%d日 (%s)',
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
                        return $date_part . ' ' . $time_start . '〜' . $time_end;
                    }
                    if ($time_start !== '') {
                        return $date_part . ' ' . $time_start;
                    }

                    return $date_part;
                };

                $event_datetime = $format_japanese_event_datetime(
                    (string) ($event_group['event_date'] ?? ''),
                    (string) ($event_group['event_time_s'] ?? ''),
                    (string) ($event_group['event_time_e'] ?? '')
                );
                $event_location = (string) ($event_group['event_location'] ?? '');
                $optional_field_rows = $event_group['optional_field_repeat'] ?? [];
                if (!is_array($optional_field_rows)) {
                    $optional_field_rows = [];
                }

                $has_summary_table = ($event_datetime !== '' || $event_location !== '' || !empty($optional_field_rows));
                $has_pdf_links = false;
                foreach ($pdf_rows as $pdf_row) {
                    if (is_array($pdf_row) && !empty($pdf_row['pdf'])) {
                        $has_pdf_links = true;
                        break;
                    }
                }
                $has_summary_section = ($close || $has_summary_table || $has_pdf_links);
                ?>
                <?php if ($has_summary_section) : ?>
                    <section class="seminar-wrap__card seminar-wrap__card--summary">
                        <h2 class="seminar-wrap__heading">概要</h2>

                        <?php if ($close): ?>
                            <p class="seminar-wrap__summary-status">本セミナーは終了しました</p>
                        <?php endif; ?>

                        <?php if ($has_summary_table) : ?>
                            <table class="seminar-wrap__summary-table">
                                <?php if ($event_datetime !== '') : ?>
                                    <tr>
                                        <th>開催日時</th>
                                        <td><?php echo esc_html($event_datetime); ?></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if ($event_location !== '') : ?>
                                    <tr>
                                        <th>開催場所</th>
                                        <td><?php echo wp_kses_post($event_location); ?></td>
                                    </tr>
                                <?php endif; ?>
                                <?php foreach ($optional_field_rows as $optional_field_row) : ?>
                                    <?php
                                    $optional_field_title = (string) ($optional_field_row['optional_field_title'] ?? '');
                                    $optional_field_content = (string) ($optional_field_row['optional_field_content'] ?? '');
                                    ?>
                                    <?php if ($optional_field_title !== '' || $optional_field_content !== '') : ?>
                                        <tr>
                                            <th><?php echo esc_html($optional_field_title); ?></th>
                                            <td><?php echo wp_kses_post($optional_field_content); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </table>
                        <?php endif; ?>

                        <?php foreach ($pdf_rows as $pdf_row) : ?>
                            <?php if (is_array($pdf_row) && !empty($pdf_row['pdf'])) : ?>
                                <a href="<?php echo esc_url($pdf_row['pdf']); ?>" class="seminar-wrap__summary-link">
                                    <span><?php echo esc_html($pdf_row['pdf_name']); ?></span>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </section>
                <?php endif; ?>
            </div>
        </div>

        <div class="middle_mv__wave-sway" style="position: relative;">
            <div class="middle_mv__decoration">

                <!-- 波 -->
                <div class="middle_mv__wave-sway">
                    <div class="middle_mv__wave-move">
                    </div>
                </div>
            </div>
        </div>

        <section id="seminar-entry" class="seminar-entry">
            <h2 class="seminar-entry__title"><?php the_title(); ?></h2>
            <h3 class="seminar-entry__subtitle">お申込みフォーム</h3>
            <div id="form" class="seminar-entry__form">
                <?php echo do_shortcode('[seminar_entry_form]'); ?>
            </div>
        </section>
    <?php endwhile; ?>


</main>
<?php get_footer(); ?>