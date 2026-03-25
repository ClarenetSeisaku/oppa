<?php

/***　
固定ページ
**/
get_header();
?>
<main class="middle">
    <section class="middle_mv">
        <h2 class="page_ttl"><span><?php the_field('middle_ttl'); ?></span></h2>
    </section>

    <div class="pankuzu_wrap">
    <?php
    // 現在のページの親ページのidを遡って先祖まで取得
    // 親 → 先祖の順で並んでいるため 先祖 → 親の順に並べ替え
    $ancestors_ids = array_reverse(get_post_ancestors( $post ));
    ?>
        <ul class="pankuzu sec_inner">
            <li><a href="<?= esc_url(home_url()) ?>">TOP</a></li>
            <?php foreach($ancestors_ids as $ancestors_id){ ?>
            <li><a href="<?php echo get_page_link( $ancestors_id );?>">
                    <?php echo get_page($ancestors_id)->post_title; ?>
                </a></li>
            <?php } ?>
            <li><?php the_title(); ?></li>
        </ul>
    </div>
    
    <?php the_content(); ?>

</main>


<?php get_footer(); ?>
