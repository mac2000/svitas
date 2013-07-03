<?php get_header(); ?>

<div class="row">
    <div class="span8">
        <?php while (have_posts()) : the_post(); ?>
            <div class="media">
                <a class="pull-left" href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark">
                    <?php if ( has_post_thumbnail() ) : echo the_post_thumbnail('thumbnail'); else: ?>
                        DEFAULT
                    <?php endif; ?>
                </a>
                <div class="media-body">
                    <h1 class="title"><?php the_title(); ?></h1>
                    <p><?php the_category(' ') ?></p>
                    <p>TODO: addthis</p>
                </div>
            </div><!-- /.media -->
            <?php the_content(); ?>
            <p>TODO: similar posts</p>
        <?php endwhile;?>

    </div><!-- /.span8 -->
    <div class="span4">
        <?php get_search_form(); ?>
        <ul class="unstyled">
            <?php wp_list_categories('title_li='); ?>
        </ul>
        <p>TODO: ads</p>
    </div><!-- /.span4 -->
</div>

<?php get_footer(); ?>
