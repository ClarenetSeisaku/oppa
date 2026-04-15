<?php

/**
 *　グッズ・刊行物　一覧
 *
 */
?>
<?php
get_header();
?>
<main class="middle">
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
            <li>グッズ・刊行物一覧</li>
        </ul>
    </section>
    <section class="middle_ttl_sec">
        <div class="sec_inner">
            <h2 class="page_ttl">グッズ・刊行物</h2>
            <p class="page_sub_ttl">Goods and Publications</p>
        </div>
    </section>

    <section id="press_all">
        <div class="sec_inner">
            <?php
            $categories = get_terms(array(
                'taxonomy' => 'press-category',
                'hide_empty' => true,
            ));

            $current_term = get_queried_object();

            echo '<ul class="category-list">';

            // すべて
            echo '<li>';
            echo '<a href="' . esc_url(get_post_type_archive_link('press')) . '" class="cat-all ' . (is_post_type_archive('press') ? 'is-active' : '') . '">';
            echo 'すべて';
            echo '</a>';
            echo '</li>';

            // カテゴリー
            if (!empty($categories) && !is_wp_error($categories)) {
                foreach ($categories as $cat) {

                    $is_active = (isset($current_term->term_id) && $current_term->term_id === $cat->term_id) ? 'is-active' : '';

                    echo '<li>';
                    echo '<a href="' . esc_url(get_term_link($cat)) . '" class="cat-' . esc_attr($cat->slug) . ' ' . $is_active . '">';
                    echo esc_html($cat->name);
                    echo '</a>';
                    echo '</li>';
                }
            }

            echo '</ul>';
            ?>
            <ul class="press_list grid_box_list grid_3_2_1">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <li>
                            <a href="<?php the_permalink(); ?>" class="arrow">
                                <figure>
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium'); ?>
                                    <?php else: ?>
                                        <img src="<?php echo imdir(); ?>/press/good_dummy.png" alt="ダミー画像">
                                    <?php endif; ?>
                                </figure>
                                <p class="press_ttl"><?php the_title(); ?></p>
                            </a>
                        </li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>現在グッズ・刊行物はありません。</p>
                <?php endif; ?>
            </ul>
            <?php if (function_exists('wp_pagenavi')) : ?>
                <?php wp_pagenavi(); ?>
            <?php endif; ?>
        </div>
    </section>

</main>
<?php
get_footer();
?>