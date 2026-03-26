<?php
// ===========================
// =アイキャッチ画像を使用する設定 =
// ===========================
add_theme_support('post-thumbnails');


// ===========================
// = get_template_directory_uriを短く =
// ===========================
function imdir($file_name = NULL)
{
  if ($file_name)
  {
    $url = esc_url(get_template_directory_uri() . '/assets/img/' . slug() . '/' . $file_name);
    $path = get_template_directory() . '/assets/img/' . slug() . '/' . $file_name;
    return $url . '?v=' . date("YmdHis", filemtime($path));
  }
  else
  {
    return esc_url(get_template_directory_uri() . '/assets/img');
  }
}


// ===========================
// = 画像パスの短縮（固定ページ） =
// ===========================
function imagepassshort($arg)
{
  $content = str_replace('"assets/img/', '"' . get_bloginfo('template_directory') . '/assets/img/', $arg);
  return $content;
}
add_action('the_content', 'imagepassshort');

// ===========================
// = 【管理画面】コメントを非表示 =
// ===========================
function remove_admin_menu() {
  remove_menu_page('edit-comments.php'); // コメント
}
add_action('admin_menu', 'remove_admin_menu');

// ===========================
// = 【管理画面】投稿メニューを非表示 =
// ===========================
/*function remove_menus()
{
  global $menu;
  remove_menu_page('edit.php'); // 投稿を非表示
}
add_action('admin_menu', 'remove_menus');*/


// ===========================
// = 「投稿」の表記変更 =
// ===========================

function Change_menulabel()
{
  global $menu;
  global $submenu;
  $name = 'お知らせ';
  $menu[5][0] = $name;
  $submenu['edit.php'][5][0] = $name . '一覧';
  $submenu['edit.php'][10][0] = '新規' . $name . '投稿';
}
function Change_objectlabel()
{
  global $wp_post_types;
  $name = 'お知らせ';
  $labels = & $wp_post_types['post']->labels;
  $labels->name = $name;
  $labels->singular_name = $name;
  $labels->add_new = _x('追加', $name);
  $labels->add_new_item = $name . 'の新規追加';
  $labels->edit_item = $name . 'の編集';
  $labels->new_item = '新規' . $name;
  $labels->view_item = $name . 'を表示';
  $labels->search_items = $name . 'を検索';
  $labels->not_found = $name . 'が見つかりませんでした';
  $labels->not_found_in_trash = 'ゴミ箱に' . $name . 'は見つかりませんでした';
}
add_action('init', 'Change_objectlabel');
add_action('admin_menu', 'Change_menulabel'); 


// ===========================
// = 既存の『投稿』のアーカイブ任意のURLにする  =
// ===========================
function post_has_archive($args, $post_type){
  if ('post' == $post_type)
  {
    $args['rewrite'] = true;
    $args['has_archive'] = 'news'; // 任意のURL
  }
  return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2); 


// ===========================
//ビジュアルエディタにeditor-style.cssを読み込ませる
// ===========================
add_editor_style("editor-style.css");


// ===========================
// = body に　id付与 =
// ===========================
function body_id()
{
  $body_id = "";
  global $post;
  if (is_home() || is_front_page())
  {
    $body_id = "index";
  }
  /*  elseif (is_post_type_archive("experience") || is_singular("experience") || is_tax("experience-cat"))
   {
   $body_id = "experience";
   } */
  elseif (is_archive() || is_category() || is_single())
  {
    $body_id = "news";
  }
  elseif (is_page(array('contact', 'confirm', 'thanks')))
  {
    $body_id = "contact";
  }
  elseif (isset($post->post_name))
  {
    $body_id = $post->post_name;
  }
  return $body_id;
}


// ===========================
// = カスタム投稿 =
// ===========================
require(__DIR__."/function/function_cms.php");


// ===========================
// = ログイン画面カスタマイズするstyle-login.css =
// ===========================
function my_login_stylesheet()
{
  wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/style-login.css');
}
add_action('login_enqueue_scripts', 'my_login_stylesheet');


// ===========================
// = ビジュアルエディターを非表示 =
// ===========================
function disable_visual_editor_in_page()
{
  global $typenow;
  if ($typenow == 'page')
  {
    add_filter('user_can_richedit', 'disable_visual_editor_filter');
  }
}
function disable_visual_editor_filter()
{
  return false;
}
add_action('load-post.php', 'disable_visual_editor_in_page');
add_action('load-post-new.php', 'disable_visual_editor_in_page');


// ===========================
// = 固定ページの勝手なbr禁止  =
// ===========================
function disable_page_wpautop()
{
  if (is_page())
    remove_filter('the_content', 'wpautop'); // 記事の自動整形を無効化
  if (is_page())
    remove_filter('the_excerpt', 'wpautop'); // 抜粋の自動整形を無効化
}
add_action('wp', 'disable_page_wpautop');


// ===========================
// = phpファイルを固定ページにinclude  =
// ===========================
function my_php_Include($params = array())
{
  extract(shortcode_atts(array('file' => 'default'), $params));
  ob_start();
  include(STYLESHEETPATH . "/$file.php");
  return ob_get_clean();
}
add_shortcode('myphp', 'my_php_Include');



function my_theme_enqueue_styles() {
    wp_enqueue_style( 'my-main-style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

// ===========================
// =  その他function  =
// ===========================
require(__DIR__."/function/function_other.php");


// ===========================
// = css/jsの読み込み =
// ===========================
require(__DIR__."/function/function_dev.php");

?>