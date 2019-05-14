<?php
/**
 * Search Form WordPress file
 *
 * This file is the search form used in the theme
 * 
 *
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2012, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<form method="get" action="<?php echo home_url(); ?>/">
<div id="searchform"><input type="text" value="<?php the_search_query(); ?>" name="s" class="keyword" />
<input type="submit" class="button" value="Search" />
</div></form>
