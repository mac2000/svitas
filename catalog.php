<?php
/*
Template Name: Catalog
*/
get_header(); ?>
<div class="container">
<div class="row">
    <div class="span4">
        <?php include 'partials/catalog/sidebar.php'?>
    </div>
    <!-- /.span4 -->
    <div class="span8">
        <?php while (have_posts()) : the_post(); ?>
            <h1 class="title"><?php the_title(); ?></h1>
            <?php the_content(); ?>
        <?php endwhile; ?>

        <?php
        $query = new WP_Query('post_type=catalog');
        if ($query->have_posts()):
            ?>
            <?php $idx = 0; while ($query->have_posts()): $query->the_post(); ?>

            <div id="<?php echo $post->post_name ?>" class="catalog-item <?php echo $idx++ == 0 ? '' : 'hide'?>">
                <h2><?php the_title()?></h2>
                <?php the_content()?>
            </div>

        <?php
        endwhile;
            ?>
        <?php
        endif;
        wp_reset_postdata();
        ?>


    </div>
    <!-- /.span8 -->
</div>
</div>

<script>
    (function($){
        $('#CatalogSidebar .accordion-inner a').on('click', function(e){
            $('.catalog-item').addClass('hide').filter('[id="' + $(this).attr('href').split('#').pop() + '"]').removeClass('hide');
        });

        if(window.location.hash) {
            if($('.catalog-item[id="' + window.location.hash.split('#').pop() + '"]').size() > 0) {
                $('.catalog-item').addClass('hide').filter('.catalog-item[id="' + window.location.hash.split('#').pop() + '"]').removeClass('hide');
            }
        }
    })(jQuery);
</script>
<?php get_footer(); ?>
