<?php

/**
 *　新着情報　一覧
 *
 */
?>
<?php
get_header();
?>
<main class="middle">
    <section class="middle_mv">
        <h2 class="page_ttl"><span>お知らせ</span></h2>
    </section>


    <section class="pankuzu_wrap">
    <ul class="pankuzu sec_inner">
        <li><a href="<?= esc_url(home_url()) ?>">TOP</a></li>
        <li>お知らせ一覧</li>
    </ul>
    </section>

    <section id="news_all">
    <div class="sec_inner">
    <ul class="news_list">
        <?php
        $topics = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => 12,
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
        <li>
        <a href="<?php the_permalink(); ?>" class="arrow">
          <figure>
           <img src="<?php echo imdir(); ?>/common/dummy.jpg" alt="">
          </figure>
          <time><?php echo get_the_date('Y.n.j'); ?></time>
          <p><span><?php the_title(); ?></span></p>
          </a>
        </li>
        <?php endwhile; endif; wp_reset_postdata(); ?>
    </ul>
    <?php if (function_exists('wp_pagenavi')) :
              wp_pagenavi(array('query' => $topics));
    endif; ?>
    </div>
    </section>
    
</main>
<?php
get_footer();
?>