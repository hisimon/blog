<?php
/**
 * Template Name: Portfolio A
 * 
 * Page for displaying special feature posts
 *
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php get_header(); ?>

<?php 	
	global $blogBox_option;
	$blogBox_option = blogBox_get_options();
?>

<div id="fullwidth">
	<span class="portfolio_title"><?php the_title(); ?></span>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="portfolio_post">
			<div class="entry">
				<?php the_content('Read more'); ?>
			</div>
		</div>
	<?php endwhile; else : endif; ?>
	<?php // additional loop via get_posts
	$category_ID = get_cat_ID(sanitize_text_field($blogBox_option['bB_portfolioA_category']));
	global $post,$feature_pic_count;
	$args = array('category'=>$category_ID,'numberposts'=>999);
	$custom_posts = get_posts($args);
	if ($blogBox_option['bB_portfolioA_cols'] == "2") {
		echo '<div class="portfolio_two_column_wrap">';
	} elseif ($blogBox_option['bB_portfolioA_cols'] == "3") {
		echo '<div class="portfolio_three_column_wrap">';
	} elseif ($blogBox_option['bB_portfolioA_cols'] == "4") {
		echo '<div class="portfolio_four_column_wrap">';
	} else {
		echo '<div class="portfolio_one_column_wrap">';
	}
	if ($category_ID !== 0 && $custom_posts){
		$feature_pic_count == 0;
		foreach($custom_posts as $post) : setup_postdata($post);
			if ($blogBox_option['bB_portfolioA_cols'] == "1") {
		 		if (has_post_thumbnail()) {
		 			echo '<div class="portfolio_one_column">';
		 				$feature_pic_count ++;
						echo '<div class="left_col">';
        					echo '<a href="';the_permalink();echo '" title="';the_title_attribute(); echo '" >';
  								the_post_thumbnail(array(450,300));
      						echo '</a>';
      						if($blogBox_option['bB_portfolioA_feature_caption'] == 1) {
      							echo '<div class="display_caption">';
      								echo '<h4>';echo get_post(get_post_thumbnail_id())->post_excerpt;echo '</h4>';
								echo '</div>';
							}
      						if($blogBox_option['bB_portfolioA_feature_description'] == 1) {
      							echo '<div class="display_description">';
									echo '<p>'; echo get_post(get_post_thumbnail_id())->post_content;echo '<br/></p>';
								echo '</div>';
							}
      					echo '</div>';
      					echo '<div class="right_col">';
      						echo '<h3>';echo the_title_attribute();echo '<br/></h3>';
       						blogBox_the_excerpt_dynamic(450);
						echo '</div>';
	   					echo '<div class="clearfix"></div>';
					echo '</div>';					
				}
			} elseif ($blogBox_option['bB_portfolioA_cols'] == "2") {
				if(is_int($feature_pic_count/2)){
					echo '<div class="clearfix" ></div>';
				}
			 	if (has_post_thumbnail()) {
					echo '<div class="portfolio_two_column">';
						$feature_pic_count ++;
						echo '<div class="image_container">';
							echo '<a href="';the_permalink();echo'" title="';the_title_attribute();echo '" >';
		  						the_post_thumbnail(array(450,300));
		      				echo '</a>';
						echo '</div>';
	      				if($blogBox_option['bB_portfolioA_feature_caption'] == 1) {
	      					echo '<div class="display_caption">';
								$content = get_post(get_post_thumbnail_id())->post_excerpt;
								echo '<h3>';
	      							blogBox_portfolio_titles($content,100);
	      						echo '</h3>';
							echo '</div>';
						}
	      				if($blogBox_option['bB_portfolioA_feature_description'] == 1) {
	      					echo '<div class="display_description">';
								$content = get_post(get_post_thumbnail_id())->post_content;
								blogBox_portfolio_feature_description($content,250);
							echo '</div>';
						}
	      				if($blogBox_option['bB_portfolioA_content'] == 1) {
	      					$content = the_title_attribute('echo=0');
							echo '<h3>';
	      						blogBox_portfolio_titles($content,100);
	      					echo '</h3>';
	      					echo '<div class="display_post">';
	      						blogBox_the_excerpt_dynamic(350);
							echo '</div>';
						}
		   			echo '</div>';
				}
			} elseif ($blogBox_option['bB_portfolioA_cols'] == "3") {
				if(is_int($feature_pic_count/3)){
					echo '<div class="clearfix" ></div>';
				}
				if (has_post_thumbnail()) {
					echo '<div class="portfolio_three_column">';
						$feature_pic_count ++;
						echo '<div class="image_container">';
							echo '<a href="';the_permalink();echo'" title="';the_title_attribute();echo '" >';
  								the_post_thumbnail(array(450,300));
      						echo '</a>';
						echo '</div>';
	      				if($blogBox_option['bB_portfolioA_feature_caption'] == 1) {
	      					echo '<div class="display_caption">';
								$content = get_post(get_post_thumbnail_id())->post_excerpt;
								echo '<h5>';
	      							blogBox_portfolio_titles($content,80);
	      						echo '</h5>';
							echo '</div>';
						}
	      				if($blogBox_option['bB_portfolioA_feature_description'] == 1) {
	      					echo '<div class="display_description">';
	      						$content = get_post(get_post_thumbnail_id())->post_content;
								blogBox_portfolio_feature_description($content,120);
							echo '</div>';
						}
						if($blogBox_option['bB_portfolioA_content'] == 1) {
	      					$content = the_title_attribute('echo=0');
							echo '<h5>';
	      						blogBox_portfolio_titles($content,80);
	      					echo '</h5>';
	      					echo '<div class="display_post">';
	      						blogBox_the_excerpt_dynamic(180);
							echo '</div>';
						}
					echo '</div>';
				}
			} else {
				if(is_int($feature_pic_count/4)){
					echo '<div class="clearfix" ></div>';
				}
				if (has_post_thumbnail()) {
					echo '<div class="portfolio_four_column">';
						$feature_pic_count ++;
						echo '<div class="image_container">';
							echo '<a href="';the_permalink();echo'" title="';the_title_attribute();echo '" >';
	  							the_post_thumbnail(array(450,300));
	      					echo '</a>';
						echo '</div>';
	      				if($blogBox_option['bB_portfolioA_feature_caption'] == 1) {
	      					echo '<div class="display_caption">';
								$content = get_post(get_post_thumbnail_id())->post_excerpt;
								echo '<h6>';
	      							blogBox_portfolio_titles($content,60);
	      						echo '</h6>';
							echo '</div>';
						}
	      				if($blogBox_option['bB_portfolioA_feature_description'] == 1) {
	      					echo '<div class="display_description">';
	      						$content = get_post(get_post_thumbnail_id())->post_content;
								blogBox_portfolio_feature_description($content,100);
							echo '</div>';
						}
						if($blogBox_option['bB_portfolioA_content'] == 1) {
	      					$content = the_title_attribute('echo=0');
							echo '<h6>';
	      						blogBox_portfolio_titles($content,60);
	      					echo '</h6>';
	      					echo '<div class="display_post">';
	      						blogBox_the_excerpt_dynamic(120);
							echo '</div>';
						}
					echo '</div>';
				}
			}
		endforeach;
	} else {
		echo '<div class="portfolio_error">';
		echo '<h3>'.__('Error: no posts or categories are wrong!','blogBox').'</h3>';
		echo '</div>';
	}
	echo '</div>';
	if ($feature_pic_count == 0){
		echo '<div class="portfolio_error">';
		echo '<h3>'.__('Error: There were no feature images found?','blogBox').'</h3>';
		echo '</div>';
	}

?>
</div>
<div class="clearfix" ></div><br/><br/>

<?php get_footer(); ?>