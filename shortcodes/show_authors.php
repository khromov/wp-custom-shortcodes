<?php
/**
 * Shortcode for list of events using Isotope for tiling (If theme supports it, the shortcode does not load Isotope)
 */
add_shortcode('show_authors', function($atts)
{
	/** Extract vars **/
	extract(shortcode_atts(array(
		'order' => 'ASC',
	), $atts));

	/** Assemble our query **/
	$args = array(
		'post_type' => 'book-author',
		'posts_per_page' => '-1',
		'order' => ($order === 'ASC') ? 'ASC' : 'DESC',
		'orderby' => 'title'
	);
	$query = new WP_Query($args);

	ob_start();
	?>
	<?php if($query->have_posts()) : ?>
		<ul class="authors-list">
			<?php while($query->have_posts()) : ?>
				<?php $query->the_post(); ?>
				<li class="author author-id-<?=get_the_ID()?>">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_title(); ?>
					</a>
				</li>
			<?php endwhile; ?>
		</ul>
	<?php endif;

	wp_reset_postdata();
	return do_shortcode(ob_get_clean());
});