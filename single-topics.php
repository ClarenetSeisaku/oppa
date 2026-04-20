<?php

/**
 *　トピックス 詳細ページ
 *
 */
?>

<?php
get_header();
?>
<main class="middle">
  <div class="pankuzu_wrap">
    <ul class="pankuzu sec_inner">
      <li><a href="<?= esc_url(home_url()) ?>">TOP</a></li>
      <li><a href="<?= esc_url(home_url('topics')) ?>">トピックス一覧</a></li>
      <li><?php the_title(); ?></li>
    </ul>
  </div>

  <section id="topics_single">
    <div class="sec_inner sec_size02">
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
      <?php
      $link = get_field('topics_link');
      $blank = get_field('topics_link_blank');
      ?>
      <h2 class="topics_main_ttl">
        <?php if ($link): ?>
          <a href="<?php echo esc_url($link); ?>" <?php if ($blank): ?>target="_blank" rel="noopener noreferrer" <?php endif; ?>>
            <?php the_title(); ?>
          </a>
        <?php else: ?>
          <?php the_title(); ?>
        <?php endif; ?>
      </h2>
      <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('Y.m.d'); ?></time>
      <div class="single_inner">
        <?php the_content(); ?>
      </div>
      <div class="btn_inner">
        <!-- 一覧へボタン -->
        <a href="<?= esc_url(home_url('topics')) ?>" class="commonBtn center">
          <span>トピックス一覧へ戻る</span>
        </a>
      </div>
    </div>
  </section>

</main>
<?php
get_footer();
?>