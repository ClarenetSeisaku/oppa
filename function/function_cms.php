<?php
add_action('init', 'new_post_type');
function new_post_type()
{
  register_post_type(
    'topics',
    array(
      'label' => 'トピックス',
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
    'topics-category', // カスタム分類名
    'topics', // カスタム分類を使用する投稿タイプ名
    array(
      'hierarchical' => true,
      'label' => 'トピックスカテゴリー',
      'singular_label' => 'トピックスカテゴリー',
      'public' => true,
      'show_ui' => true,
      'show_in_rest' => true,
    )
  );
  register_post_type(
    'press',
    array(
      'label' => 'グッズ・刊行物',
      'public' => true,
      'has_archive' => true,
      'show_in_rest' => true,
      'menu_position' => 4,
      'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'revisions',
        'custom-fields',
      ),
    )
  );
  register_taxonomy(
    'press-category', // カスタム分類名
    'press', // カスタム分類を使用する投稿タイプ名
    array(
      'hierarchical' => true,
      'label' => 'グッズ・刊行物カテゴリー',
      'singular_label' => 'グッズ・刊行物カテゴリー',
      'public' => true,
      'show_ui' => true,
      'show_in_rest' => true,
    )
  );
}

// ===========================
// グッズ・刊行物は12件表示
// ===========================

function change_press_posts_per_page($query)
{
  if (!is_admin() && $query->is_main_query()) {

    if (is_post_type_archive('press') || is_tax('press-category')) {
      $query->set('posts_per_page', 12);
    }
  }
}
add_action('pre_get_posts', 'change_press_posts_per_page');


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













add_action('after_setup_theme', function () {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
});

add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style(
    'seminar-minimal-style',
    get_stylesheet_uri(),
    [],
    wp_get_theme()->get('Version')
  );
});

add_action('init', function () {
  register_post_type('seminar', [
    'labels' => [
      'name' => 'セミナー・イベント',
      'singular_name' => 'セミナー・イベント',
      'add_new_item' => '新規セミナー・イベントを追加',
      'edit_item' => 'セミナー・イベントを編集',
      'new_item' => '新規セミナー・イベント',
      'view_item' => 'セミナー・イベントを表示',
      'search_items' => 'セミナー・イベントを検索',
    ],
    'public' => true,
    'has_archive' => true,
    'menu_position' => 20,
    'menu_icon' => 'dashicons-welcome-learn-more',
    'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
    'taxonomies' => ['seminar_category'],
    'show_in_rest' => true,
    'rewrite' => ['slug' => 'seminar'],
  ]);

  register_taxonomy('seminar_category', 'seminar', [
    'labels' => [
      'name' => 'セミナー・イベントカテゴリー',
      'singular_name' => 'セミナー・イベントカテゴリー',
      'search_items' => 'セミナー・イベントカテゴリーを検索',
      'all_items' => 'すべてのセミナー・イベントカテゴリー',
      'edit_item' => 'セミナー・イベントカテゴリーを編集',
      'update_item' => 'セミナー・イベントカテゴリーを更新',
      'add_new_item' => '新規セミナー・イベントカテゴリーを追加',
      'new_item_name' => '新しいセミナー・イベントカテゴリー名',
      'menu_name' => 'セミナー・イベントカテゴリー',
    ],
    'public' => true,
    'hierarchical' => true,
    'show_ui' => true,
    'show_admin_column' => true,
    'show_in_rest' => true,
    'rewrite' => ['slug' => 'seminar-category'],
  ]);
});
?>