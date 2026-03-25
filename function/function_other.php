<?php

// ===========================
// = スラッグの日本語禁止  =
// ===========================

/* function auto_post_slug($slug, $post_ID, $post_status, $post_type) {
 if (preg_match('/(%[0-9a-f]{2})+/', $slug))
 {
 $slug = utf8_uri_encode($post_type) . '-' . $post_ID;
 }
 return $slug; } add_filter('wp_unique_post_slug', 'auto_post_slug', 10, 4); */


// ===========================
// = カスタム投稿管理画面に表示項目追加　（1つ）  =
// ===========================

/* function add_custom_column($defaults)
{
  $defaults['jinken-cat'] = 'カテゴリ'; //'jinken-cat'はタクソノミー名 
  return $defaults;
}
add_filter('manage_jinken_item_posts_columns', 'add_custom_column'); //ここでの'jinken'はカスタム投稿タイプ

function add_custom_column_id($column_name, $id)
{
  $terms = get_the_terms($id, $column_name);
  if ($terms && !is_wp_error($terms)) {
    $jinken_cat_link = array();
    foreach ($terms as $term) {
      $jinken_cat_link[] = $term->name;
    }
    echo join(", ", $jinken_cat_link);
  }
}
add_action('manage_jinken_item_posts_custom_column', 'add_custom_column_id', 10, 2); //ここでの'jinken'はカスタム投稿タイプ
 */

// ===========================
// = カスタム投稿管理画面に表示項目追加　（複数）  =
// ===========================

/* function add_custom_column($defaults)
{
  global $post_type;
  if ('player' == $post_type)
  {
    $defaults['player-cat'] = 'カテゴリー';
    $defaults['player-ob'] = 'OB';
  }
  elseif ('game' == $post_type)
  {
    $defaults['game-team'] = '対戦チーム';
  }
  return $defaults;
}
add_filter('manage_posts_columns', 'add_custom_column');
function add_custom_column_id($column_name, $id)
{
  if ($column_name == 'player-cat')
  {
    echo get_the_term_list($id, 'player-cat', '', ', ');
  }
  elseif ($column_name == 'player-ob')
  {
    echo get_the_term_list($id, 'player-ob', '', ', ');
  }
  elseif ($column_name == 'game-team')
  {
    echo get_the_term_list($id, 'game-team', '', ', ');
  }
}
add_action('manage_player_posts_custom_column', 'add_custom_column_id', 10, 2);
add_action('manage_game_posts_custom_column', 'add_custom_column_id', 10, 2); */


// ===========================
// = 404ページを表示せずに任意のページへリダイレクトさせる  =
// ===========================

/* add_action( 'template_redirect', 'is404_redirect_home' );
function is404_redirect_home() {
  if ( is_404() ) {
    wp_safe_redirect( home_url( '/' ) );
    exit();
  }
} */


// ===========================
//特定のカテゴリー非表示
// ===========================

/* function query_at_detail($query)
{
  if (is_admin() || !$query->is_main_query())
    return;
  if ($query->is_tax('jinken-cat')) {
    global $post;
    $terms = get_queried_object()->slug;
    $query->set('post_type', 'jinken_item');
    $query->set(
      'tax_query',
      array(array(
        'taxonomy' => 'jinken-cat',
        'field' => 'slug',
        'terms' => $terms,
        'include_children' => false
      ))
    );
  }
}
add_action('pre_get_posts', 'query_at_detail'); */


// ===========================
// ツールバーの「SEO」非表示
// ===========================

/* function remove_adminbar_plugin()
{
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('aioseo-main');
}
add_action('admin_bar_menu', 'remove_adminbar_plugin', 1000); */

?>