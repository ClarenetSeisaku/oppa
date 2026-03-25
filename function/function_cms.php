<?php
add_action('init', 'works_post_type');
function works_post_type()
{
  register_post_type(
    'works',
    array(
      'label' => '実績',
      'public' => true,
      'has_archive' => true,
      'show_in_rest' => true,
      'menu_position' => 4,
      'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'revisions',
      ),
    )
  );
  register_taxonomy(
     'works-category', // カスタム分類名
     'works', // カスタム分類を使用する投稿タイプ名
     array(
        'hierarchical' => true,
        'label' => 'カテゴリー',
        'singular_label' => 'カテゴリー',
        'public' => true,
        'show_ui' => true,
     )
  );
  register_taxonomy(
    'works-tag',
    'works',
    array(
      'label' => 'タグ',
      'hierarchical' => false,
      'public' => true,
      'show_in_rest' => true,
      'update_count_callback' => '_update_post_term_count',
    )
  );
}


// ===========================
// カスタム投稿のアイコン変更
// ===========================
function my_dashboard_menu_styles()
{
?>
<style>
#dashboard_right_now .president_blog-count:before {
    content: "\f331";
}
#adminmenu #menu-posts-president_blog div.wp-menu-image:before {
    content: "\f331";
}
#dashboard_right_now .hospital_blog-count:before {
    content: "\f328";
}
#adminmenu #menu-posts-hospital_blog div.wp-menu-image:before {
    content: "\f328";
}
#dashboard_right_now .days_blog-count:before {
    content: "\f186";
}
#adminmenu #menu-posts-days_blog div.wp-menu-image:before {
    content: "\f186";
}
</style>
<?php
}
add_action('admin_print_styles', 'my_dashboard_menu_styles');

?>
