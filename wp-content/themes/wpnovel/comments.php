<?php
	if(isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die('please do not load this page directly. Thanks!');
?>
<div class="comment_entry">
    <?php
    if (!empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {
        // if there's a password
        // and it doesn't match the cookie
    ?>
    <li class="decmt-box">
        <p><a href="#addcomment">请输入密码再查看评论内容.</a></p>
    </li>
    <?php
        } else if ( !comments_open() ) {
    ?>
    <li class="decmt-box">
        <p><a href="#addcomment">评论功能已经关闭!</a></p>
    </li>
    <?php
        } else if ( !have_comments() ) {
    ?>
    <li class="decmt-box">
        <p><a href="#addcomment">还没有任何评论，你来说两句吧</a></p>
    </li>
    <?php
        } else {
            wp_list_comments('type=comment&callback=wpnovel_comment');
        }
    ?>
</div>
<?php
	if(!comments_open()):
	//If registration required and not logged in.
	elseif (get_option('comment_registration') && !is_user_logged_in()) :
?>
<p>你必须 <a href="<?php echo wp_login_url( get_permalink() ); ?>">登录</a> 才能发表评论.</p>
<?php else : ?>

	<div class="comment_form">
		<p class="advice" id="respond">对本章发表意见</p>
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" name="commentform">
		<?php if(!is_user_logged_in()) :?>
			<span>
			<label>昵称</label><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1"/></span>
			<span>
			<label>邮箱</label><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2"/></span>
			<span>
			<label>网址</label><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3"/></span>
		<?php else : ?>
			<p>您已登录:<a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="退出登录">退出 &raquo;</a></p>
		<?php endif; ?>
			<p><textarea name="comment" id="comment" tabindex="4" rows="10" cols="58"></textarea></p>
			<div class="submit_wrapper">
			<input type="submit" name="submit" id="submit" tabindex="5" class="submit" value="提交评论"/>
			</div>
		<?php comment_id_fields(); ?>
		<?php do_action('comment_form',$post->ID);?>
		</form>
	<?php endif;?>
	</div>