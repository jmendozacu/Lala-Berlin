<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header('magento'); ?>
        <div class="main-container col1-layout">
            <div class="main">
<?php
            $args = array(
			    'posts_per_page' => 9,
			    'offset' => 0,
			    'category' => the_category_ID(FALSE),
			    'orderby' => 'post_date',
			    'order' => 'DESC',
			    'post_type' => 'post',
			    'post_status' => 'publish',
			    'suppress_filters' => true
			);
			$posts = wp_get_recent_posts($args);
			
			/* ------------------------- Post last new ------------------------- */

			if ( !empty($posts) AND is_array($posts) AND count($posts) )
			{
				$category = get_the_category();
				echo '
				<div class="home-page-recent-articles page-category">
					<div class="page-category-title">
						<div class="category-label">'.__('Category').'</div>
						<div class="category-value">'.qtrans_use(mage_get_language(),$category[0]->name).'</div>
					</div>
					<div class="row">';
				foreach ($posts as $post)
				{
					$caption = explode(' ', qtrans_use(mage_get_language(), $post['post_content']));

					echo '
					<div class="small-12 medium-4 large-4 large-recent-articles columns">
						<div class="home-page-recent-articles-image">
							<img src="'.(dirname(get_site_url()).'/lib/timthumb.php?src='.wp_get_attachment_url( get_post_thumbnail_id($post['ID']) ).'&w=412&h=252').'" />
							<a class="a-view-more" href="'.qtrans_convertURL(get_permalink($post['ID']), mage_get_language()).'">'.__('View').'</a>
						</div>
						<div class="home-page-recent-articles-description">
							<div class="title"><a href="'.qtrans_convertURL(get_permalink($post['ID']), mage_get_language()).'">'.qtrans_use(mage_get_language(),get_the_title($post['ID'])).'</a></div>
							<div class="description">'.strip_tags(implode(' ',array_slice($caption,0,10))).'</div>
							<div class="bottom">
								<div class="bottom-view"><a href="'.qtrans_convertURL(get_permalink($post['ID']), mage_get_language()).'">'.__('View post').'</a></div>
								<div class="bottom-date">['.date("d-m-Y", strtotime($post['post_date'])).']</div>
							</div>
						</div>
					</div>';
				}
						
				echo'
					</div>
				</div>
				';
			}
?>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer('magento');?>