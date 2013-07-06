<?php get_header(); ?>

<?php if (have_posts()) :?>
    <div class="row">
        <div class="span8">
    <?php while (have_posts()) : the_post(); ?>
			<div class="media">
                <a class="pull-left thumbnail" href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark">
                    <?php if ( has_post_thumbnail() ) : echo the_post_thumbnail('thumbnail'); else: ?>
                        DEFAULT
                    <?php endif; ?>
                </a>
                <div class="media-body">
                    <h2 class="title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                    <p><?php post_categories_labels()?></p>
                </div>
			</div><!-- /.media -->
<?php endwhile;?>
    <div class="clearfix">
        <p class="pull-left"><?php next_posts_link('&laquo; Older Entries') ?></p>
        <p class="pull-right"><?php previous_posts_link('Newer Entries &raquo;') ?></p>
    </div>
    </div><!-- /.span8 -->
    <div class="span4">
        <?php get_sidebar();?>
    </div><!-- /.span4 -->
    </div>
<?php else: ?>
	<div class="no-results">
		<p><strong><?php _e('There has been an error.'); ?></strong></p>
		<p><?php _e('We apologize for any inconvenience, please hit back on your browser or use the search form below.'); ?></p>
		<?php get_search_form(); ?>
	</div><!--noResults-->
<?php endif; ?>
<?php get_footer(); ?>
