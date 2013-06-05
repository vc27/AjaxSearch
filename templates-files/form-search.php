<?php
/**
 * File Name form-search.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.13
 **/
#################################################################################################### */

?>
<div id="form-search">
	<form class="search-posts-form" method="post" name="search-posts" action="" data-switch_case="search-posts" data-nonce="<?php echo wp_create_nonce('search-ajax'); ?>">
		<input type="text" name="post_title" class="required" minlength="2" value="" />
		<input type="submit" value="Search" />
	</form>
	<div id="display-search-results"></div>
</div>