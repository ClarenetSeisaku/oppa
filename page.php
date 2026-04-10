<?php

/***　
固定ページ
 **/
get_header();
?>
<main class="middle">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
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

            <div class="pankuzu_wrap">
                <?php
                // 現在のページの親ページのidを遡って先祖まで取得
                // 親 → 先祖の順で並んでいるため 先祖 → 親の順に並べ替え
                $ancestors_ids = array_reverse(get_post_ancestors($post));
                ?>
                <ul class="pankuzu sec_inner">
                    <li><a href="<?= esc_url(home_url()) ?>">TOP</a></li>
                    <?php foreach ($ancestors_ids as $ancestors_id) { ?>
                        <li><a href="<?php echo get_page_link($ancestors_id); ?>">
                                <?php echo get_page($ancestors_id)->post_title; ?>
                            </a></li>
                    <?php } ?>
                    <li><?php the_title(); ?></li>
                </ul>
            </div>
            <section class="middle_ttl_sec">
                <div class="sec_inner">
                    <?php
                    $middle_ttl = function_exists('get_field') ? (string) get_field('middle_ttl') : '';
                    $middle_sub_ttl = function_exists('get_field') ? (string) get_field('middle_sub_ttl') : '';
                    if ($middle_ttl === '') {
                        $middle_ttl = get_the_title();
                    }
                    ?>
                    <h2 class="page_ttl"><?php echo esc_html($middle_ttl); ?></h2>
                    <p class="page_sub_ttl"><?php echo esc_html($middle_sub_ttl); ?></p>
                </div>
            </section>

            <section>
                <?php
                ob_start();
                the_content();
                $rendered_content = ob_get_clean();
                echo $rendered_content;

                // Fallback: if shortcode text remains, render it explicitly.
                if (strpos($rendered_content, '[member_search]') !== false) {
                    echo do_shortcode('[member_search]');
                }
                ?>
            </section>
    <?php endwhile;
    endif; ?>


</main>


<?php get_footer(); ?>