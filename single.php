<?php get_header(); ?>
<div class="container">
<div class="row">
    <div class="span8">
        <?php while (have_posts()) : the_post(); ?>
            <div class="media">
                <div class="pull-left thumbnail">
                    <?php if ( has_post_thumbnail() ) : echo the_post_thumbnail('thumbnail'); else: ?>
                        DEFAULT
                    <?php endif; ?>
                </div>
                <div class="media-body">
                    <h1 class="title"><?php the_title(); ?></h1>
                    <p><?php post_categories_labels()?></p>
                    <p>TODO: addthis</p>
                </div>
            </div><!-- /.media -->
            <?php the_content(); ?>
            <p>TODO: similar posts</p>
        <?php endwhile;?>

    </div><!-- /.span8 -->
    <div class="span4">
        <?php get_sidebar();?>
    </div><!-- /.span4 -->
</div>
</div>
<?php get_footer(); ?>
