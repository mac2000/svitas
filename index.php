<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="row">
		<div class="span8">
			<div class="post-single">
				<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<?php if ( has_post_thumbnail() ) { echo '<div class="featured-thumbnail">'; the_post_thumbnail(); echo '</div>'; } ?>
				<div class="post-content">
					<?php the_content(__('Read more', 'svitas'));?>
				</div>
				<div class="post-meta">
					<p><?php _e('Written on ', 'svitas'); the_time('F j, Y'); _e(' at '); the_time(); _e(', by ', 'svitas'); the_author_posts_link(); ?></p>
					<p><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?>
					<p><?php _e('Categories: ', 'svitas'); the_category(', ') ?></p>
					<p><?php if (the_tags('Tags: ', ', ', ' ')); ?></p>
				</div><!-- /.post-meta -->
			</div><!-- /.post-single -->
			<div class="oldernewer">
				<p class="older"><?php next_posts_link('&laquo; Older Entries') ?></p>
				<p class="newer"><?php previous_posts_link('Newer Entries &raquo;') ?></p>
			</div><!--.oldernewer-->
		</div>
		<div class="span4">
			<?php get_search_form(); ?>
			<ul class="unstyled">
				<?php wp_list_categories('title_li='); ?>
			</ul>
			<p>TODO: ads</p>
		</div>
	</div>


<?php endwhile; else: ?>
	<div class="no-results">
		<p><strong><?php _e('There has been an error.'); ?></strong></p>
		<p><?php _e('We apologize for any inconvenience, please hit back on your browser or use the search form below.'); ?></p>
		<?php get_search_form(); ?>
	</div><!--noResults-->
<?php endif; ?>
<?php get_footer(); ?>