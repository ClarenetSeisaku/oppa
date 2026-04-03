<?php

/***　
固定ページ
 **/
get_header();
?>
<main class="middle">
    <section class="middle_mv">
        <!-- アニメーション装飾エリア -->
        <div class="middle_mv__decoration">

            <!-- 波 -->
            <div class="middle_mv__wave-sway">
                <div class="middle_mv__wave-move">
                    <svg class="middle_mv__wave" viewBox="0 0 1440 150" preserveAspectRatio="none">
                        <path d="M 0,60 Q 360,100 720,60 T 1440,60 L 1440,150 L 0,150 Z"></path>
                    </svg>
                    <svg class="middle_mv__wave" viewBox="0 0 1440 150" preserveAspectRatio="none">
                        <path d="M 0,60 Q 360,100 720,60 T 1440,60 L 1440,150 L 0,150 Z"></path>
                    </svg>
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
            <h2 class="page_ttl"><?php the_field('middle_ttl'); ?></h2>
            <p class="page_sub_ttl"><?php the_field('middle_sub_ttl'); ?></p>
        </div>
    </section>

    <?php the_content(); ?>

</main>


<?php get_footer(); ?>