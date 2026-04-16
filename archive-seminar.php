<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();

$selected_term_slug = isset($_GET['seminar_category']) ? sanitize_title(wp_unslash($_GET['seminar_category'])) : '';
$selected_term = $selected_term_slug !== '' ? get_term_by('slug', $selected_term_slug, 'seminar_category') : null;
$selected_term_slug = $selected_term instanceof WP_Term ? $selected_term->slug : '';

$paged = max(1, get_query_var('paged'), get_query_var('page'));
$query_args = [
    'post_type' => 'seminar',
    'post_status' => 'publish',
    'posts_per_page' => 9,
    'paged' => $paged,
];
if ($selected_term_slug !== '') {
    $query_args['tax_query'] = [[
        'taxonomy' => 'seminar_category',
        'field' => 'slug',
        'terms' => $selected_term_slug,
    ]];
}
$seminar_query = new WP_Query($query_args);

$seminar_terms = get_terms([
    'taxonomy' => 'seminar_category',
    'hide_empty' => true,
]);

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
<main class="middle seminar-archive">
    <section class="middle_mv">
        <!-- アニメーション装飾エリア -->
        <div class="middle_mv__decoration">

            <!-- 波 -->
            <div class="middle_mv__wave-sway">
                <div class="middle_mv__wave-move">
                </div>
            </div>
        </div>
    </section>

    <section class="pankuzu_wrap">
        <ul class="pankuzu sec_inner">
            <li><a href="<?= esc_url(home_url()) ?>">TOP</a></li>
            <li>セミナー・イベント</li>
        </ul>
    </section>

    <section class="middle_ttl_sec">
        <div class="sec_inner">
            <h2 class="page_ttl">セミナー・イベント</h2>
            <p class="page_sub_ttl">Seminar / Event</p>
        </div>
    </section>

    <section class="seminar-archive__section">
        <div class="sec_inner">
            <ul class="seminar-archive__terms">
                <li>
                    <a href="<?= esc_url(get_post_type_archive_link('seminar')); ?>" class="<?= $selected_term_slug === '' ? 'is-active' : ''; ?>">すべて</a>
                </li>
                <?php if (!is_wp_error($seminar_terms) && !empty($seminar_terms)) : ?>
                    <?php foreach ($seminar_terms as $seminar_term) : ?>
                        <?php
                        $tab_color_raw = function_exists('get_field') ? get_field('color', $seminar_term) : '';
                        $tab_color = is_string($tab_color_raw) ? sanitize_hex_color($tab_color_raw) : '';
                        if (!$tab_color) {
                            $tab_color = '#234b80';
                        }
                        ?>
                        <li>
                            <a
                                href="<?= esc_url(add_query_arg('seminar_category', $seminar_term->slug, get_post_type_archive_link('seminar'))); ?>"
                                class="<?= $selected_term_slug === $seminar_term->slug ? 'is-active' : ''; ?>"
                                style="<?= esc_attr('--seminar-tab-color:' . $tab_color . ';'); ?>">
                                <?= esc_html($seminar_term->name); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>

            <?php if ($seminar_query->have_posts()) : ?>
                <ul class="seminar-archive__grid">
                    <?php while ($seminar_query->have_posts()) : $seminar_query->the_post(); ?>
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
                        $event_date_raw = (string) ($event_row['event_date'] ?? '');
                        $event_datetime = $format_japanese_event_datetime(
                            $event_date_raw,
                            (string) ($event_row['event_time_s'] ?? ''),
                            (string) ($event_row['event_time_e'] ?? '')
                        );
                        if ($event_datetime === '') {
                            $event_datetime = $event_datetime_legacy;
                        }
                        $event_datetime_html = esc_html($event_datetime);
                        if (preg_match('/^((?:令和|平成)\d+年)\s*(.+)$/u', $event_datetime, $datetime_parts)) {
                            $event_datetime_html = esc_html($datetime_parts[1]) . ' <span class="is-strong">' . esc_html(trim($datetime_parts[2])) . '</span>';
                        } elseif ($event_datetime !== '') {
                            $event_datetime_html = '<span class="is-strong">' . esc_html($event_datetime) . '</span>';
                        }
                        $event_location = (string) ($event_row['event_location'] ?? '');
                        $is_closed = !empty($event['close']);
                        ?>
                        <li class="seminar-archive__item">
                            <article class="seminar-card">
                                <a href="<?php the_permalink(); ?>" class="seminar-card__thumb-link">
                                    <figure class="seminar-card__thumb">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('large'); ?>
                                        <?php else : ?>
                                            <img src="<?= esc_url(get_template_directory_uri() . '/assets/img/common/no-image.jpg'); ?>" alt="">
                                        <?php endif; ?>
                                    </figure>
                                </a>

                                <div class="seminar-card__body">
                                    <?php if ($primary_term instanceof WP_Term) : ?>
                                        <span class="seminar-card__term" style="<?php echo esc_attr('background-color:' . $term_color . ';'); ?>">
                                            <?= esc_html($primary_term->name); ?>
                                        </span>
                                    <?php endif; ?>

                                    <h3 class="seminar-card__title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>

                                    <?php if ($is_closed) : ?>
                                        <p class="seminar-card__status">本セミナーは終了しました</p>
                                    <?php endif; ?>

                                    <dl class="seminar-card__meta">
                                        <?php if ($event_datetime !== '') : ?>
                                            <div>
                                                <dt>日時</dt>
                                                <dd><?= wp_kses_post($event_datetime_html); ?></dd>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($event_location !== '') : ?>
                                            <div>
                                                <dt>場所</dt>
                                                <dd><?= wp_kses_post($event_location); ?></dd>
                                            </div>
                                        <?php endif; ?>
                                    </dl>

                                    <a href="<?php the_permalink(); ?>" class="top_news__btn commonBtn ">
                                        <span>詳細・申し込みはこちら</span>
                                    </a>
                                </div>
                            </article>
                        </li>
                    <?php endwhile; ?>
                </ul>

                <?php
                $total_pages = (int) $seminar_query->max_num_pages;
                if ($total_pages > 1) :
                    $page_args = $selected_term_slug !== '' ? ['seminar_category' => $selected_term_slug] : [];
                    $number_links = paginate_links([
                        'total' => $total_pages,
                        'current' => $paged,
                        'mid_size' => 1,
                        'end_size' => 1,
                        'type' => 'array',
                        'prev_next' => false,
                        'add_args' => $page_args,
                    ]);
                ?>
                    <nav class="seminar-archive__pager" aria-label="ページ送り">
                        <?php if ($paged > 1) : ?>
                            <a class="seminar-archive__pager-arrow is-prev" href="<?= esc_url(get_pagenum_link($paged - 1)); ?>" aria-label="前のページ">
                                <span aria-hidden="true">&#8592;</span>
                            </a>
                        <?php else : ?>
                            <span class="seminar-archive__pager-arrow is-prev is-disabled" aria-hidden="true">
                                <span>&#8592;</span>
                            </span>
                        <?php endif; ?>

                        <div class="seminar-archive__pager-numbers">
                            <?php if (is_array($number_links)) : ?>
                                <?php foreach ($number_links as $number_link) : ?>
                                    <?= wp_kses_post($number_link); ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <?php if ($paged < $total_pages) : ?>
                            <a class="seminar-archive__pager-arrow is-next" href="<?= esc_url(get_pagenum_link($paged + 1)); ?>" aria-label="次のページ">
                                <span aria-hidden="true">&#8594;</span>
                            </a>
                        <?php else : ?>
                            <span class="seminar-archive__pager-arrow is-next is-disabled" aria-hidden="true">
                                <span>&#8594;</span>
                            </span>
                        <?php endif; ?>
                    </nav>
                <?php endif; ?>
            <?php else : ?>
                <p class="seminar-archive__empty">記事はまだありません。</p>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>