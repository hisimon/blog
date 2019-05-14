<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php if ( $paged > 1 ) { echo ('第'); echo ($paged); echo '页_';}?><?php if (is_home () ) { bloginfo('name'); echo "_"; echo "最新在线全文阅读及txt下载小说网点";} elseif ( is_category() ) { single_cat_title(); echo "_"; bloginfo('name'); }elseif ( is_single() ) { single_post_title(); echo"_"; foreach((get_the_category()) as $category) ; echo $category->cat_name; echo"_";bloginfo('name'); } elseif (is_page() ) { single_post_title(); echo "_"; bloginfo('name'); } elseif (is_search() ) { bloginfo('name'); echo "search results:"; echo wp_specialchars($s); } else { wp_title('',true); echo "_"; bloginfo('name'); } ?></title>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />

<!-- RSS FEED -->

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php if ( get_option('ht_feedburner_url') <> "" ) { echo get_option('ht_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" />

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="container">

	<div class="header">

		<div class="logo"><h1><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1></div>

		<div class="banner">

		<!--<script type="text/javascript">

		google_ad_client = "ca-pub-9642311778195731";

		/* 658x80, 创建于 10-1-6 */

		google_ad_slot = "5819779136";

		google_ad_width = 468;

		google_ad_height = 60;

		//

		</script>

		<script type="text/javascript"

		src="http://pagead2.googlesyndication.com/pagead/show_ads.js">

		</script>-->

		</div>

	</div>

	<div class="nav">

	<?php wp_nav_menu( array( 'theme_location' => 'header_menu' ) ); ?>

		<ul>

			

			<li class="end"><a href="<?php bloginfo('url'); ?>/feed">订阅本站</a></li>			

		</ul>

	</div>

	

	<!---<div class="ads">

		<li class="l"><a href="/" target="_blank" title="精品wordpress主题下载"><img src="<?php bloginfo('template_url'); ?>/images/adsl.jpg" alt="精品wordpress主题下载"></a></li>

		<li class="r"><a href="/" target="_blank" title="Windows8免费激活"><img src="<?php bloginfo('template_url'); ?>/images/adsr.jpg" alt="Windows8免费激活"></a></li>

	</div>-->