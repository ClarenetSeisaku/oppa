<?php
//　オリジナルブロック追加
function add_custom_blocks() {
    $dir = get_stylesheet_directory() . '/blocks/';
    $url = get_stylesheet_directory_uri() . '/blocks/';

    // blocksフォルダ内のすべての.jsファイルを取得
    foreach ( glob( $dir . '*.js' ) as $file ) {
        // ファイル名をハンドル名として使う（例：table-block.js → table-block_script）
        $handle = 'block_' . basename( $file, '.js' );

        wp_enqueue_script(
            $handle,
            $url . basename( $file ),
            array( 'wp-blocks', 'wp-element', 'wp-block-editor' ),
            filemtime( $file ), // キャッシュ対策
            true // フッターに出力
        );

        // JS にテーマ情報を渡す
        wp_localize_script( $handle, 'myTheme', array(
            'themeUrl' => get_stylesheet_directory_uri(), // 子テーマでもOK
        ));
    }
}
add_action( 'enqueue_block_editor_assets', 'add_custom_blocks' );

// ブロックカテゴリーを追加
function add_original_block_category( $categories, $post ) {
    // 既に同名カテゴリが存在しないかチェック
    foreach ( $categories as $category ) {
        if ( $category['slug'] === 'original' ) {
            return $categories; // 既にあるなら何もしない
        }
    }

    // 新しいカテゴリーを追加
    $new_category = array(
        'slug'  => 'original',
        'title' => __( 'オリジナル', 'text-domain' ), // 表示名
    );

    // カテゴリーを配列の先頭に追加（または末尾でもOK）
    array_unshift( $categories, $new_category );

    return $categories;
}
add_filter( 'block_categories_all', 'add_original_block_category', 10, 2 );

// 投稿編集ページ（ブロックエディター）でのみCSSを読み込む
function add_block_editor_style() {
    wp_enqueue_style(
        'block_editor_css', // ハンドル名
        get_stylesheet_directory_uri() . '/blocks/block_editor.css', // CSSファイルのURL
        array( 'wp-edit-blocks' ), // 依存（必要に応じて）
        filemtime( get_stylesheet_directory() . '/blocks/block_editor.css' ) // キャッシュ防止（更新検知用）
    );
}
add_action( 'enqueue_block_editor_assets', 'add_block_editor_style' );
?>