<?php

/**
 *　トピックス　一覧
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
            <li><a href="<?= esc_url(home_url('topics')) ?>">トピックス一覧</a></li>
            <li><?php single_term_title(); ?></li>
        </ul>
    </section>
    <section class="middle_ttl_sec">
        <div class="sec_inner">
            <h2 class="page_ttl"><?php single_term_title(); ?></h2>
            <p class="page_sub_ttl">Topics</p>
        </div>
    </section>

    <section id="topics_all">
        <div class="sec_inner">
            <ul class="topics_list">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <li>
                            <a href="<?php the_permalink(); ?>" class="arrow">
                                <figure>
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium'); ?>
                                    <?php else: ?>
                                        <img src="<?php echo imdir(); ?>/common/oppa_topics_dummy.png" alt="ダミー画像">
                                    <?php endif; ?>
                                </figure>
                                <div class="topics_contents">
                                    <div class="topics_flex_box">
                                        <span class="topics_category">
                                            <?php
                                            $terms = get_the_terms(get_the_ID(), 'topics-category');

                                            if (!empty($terms) && !is_wp_error($terms)) {
                                                foreach ($terms as $term) {
                                                    echo '<span class="cat-item cat-' . esc_attr($term->slug) . '">';
                                                    echo esc_html($term->name);
                                                    echo '</span>';
                                                }
                                            }
                                            ?>
                                        </span>
                                        <time><?php echo get_the_date('Y.n.j'); ?></time>
                                    </div>
                                    <p class="topics_ttl"><?php the_title(); ?></p>
                                    <p>
                                        <?php
                                        $text = get_the_content();
                                        $text = wp_strip_all_tags($text);
                                        echo mb_substr($text, 0, 200) . '...';
                                        ?>
                                    </p>
                                </div>
                            </a>
                        </li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>現在トピックスはありません。</p>
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