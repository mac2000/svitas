<?php
/*
Template Name: Services
*/
get_header(); ?>
<div id="ServicesTabsContainer">
<div class="container">
    <?php while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; ?>


    <?php $terms = get_terms('service', array('hierarchical' => false));?>
    <ul class="nav nav-tabs" id="ServicesTabs">
        <?php foreach($terms as $term):?>
        <li>
            <a href="#<?php echo $term->slug ?>">
                <?php s8_taxonomy_image($term, array(130, 130)); ?>
                <?php echo $term->name?>
            </a>
        </li>
        <?php endforeach;?>
    </ul>
</div>
</div>
<div class="well green">
    <div class="container">
    <div class="tab-content">
        <?php foreach($terms as $term):?>
            <div class="tab-pane" id="<?php echo $term->slug ?>">

                <?php
                $query = new WP_Query(array(
                    'post_type' => 'service',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'service',
                            'field' => 'slug',
                            'terms' => $term->slug
                        )
                    )
                ));
                if ($query->have_posts()):
                    ?>
                <div class="accordion" id="CategoryServicesAccordion<?php echo $term->term_id?>">
                    <?php while ($query->have_posts()): $query->the_post(); ?>

                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#CategoryServicesAccordion<?php echo $term->term_id?>" href="#<?php echo $term->slug . '-' . $post->post_name ?>">
                                    <?php the_title()?>
                                </a>
                            </div>
                            <div id="<?php echo $term->slug . '-' . $post->post_name ?>" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <?php the_content()?>
                                </div>
                            </div>
                        </div>

                    <?php
                endwhile;
                ?>
                </div>
                <?php
                endif;
                wp_reset_postdata();
                ?>



            </div>
        <?php endforeach;?>
    </div>
    </div>
</div>

<div class="container">
<h2 class="title"><?php _e('Standard services', 'svitas')?></h2>
    <?php
    $query = new WP_Query('post_type=service&meta_key=standard_service&meta_value=1');
    if ($query->have_posts()):
        ?>
    <div class="accordion" id="CategoryStandardServicesAccordion">
        <?php while ($query->have_posts()): $query->the_post();?>

            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#CategoryStandardServicesAccordion" href="#<?php echo $post->post_name ?>">
                        <?php the_title()?>
                    </a>
                </div>
                <div id="<?php echo $post->post_name ?>" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <?php the_content()?>
                    </div>
                </div>
            </div>

        <?php
    endwhile;
        ?>
        </div>
        <?php
    endif;
    wp_reset_postdata();
    ?>



</div>
<script>
    (function($){
        $('#ServicesTabs a').click(function (e) {
            $(this).tab('show');
        });
        $('#ServicesTabs a:first').tab('show');

        if(window.location.hash) {
            if($('#ServicesTabs a[href="' + window.location.hash + '"]').size() > 0) {
                $('#ServicesTabs a[href="' + window.location.hash + '"]').tab('show');
            } else if($('div' + window.location.hash + '.accordion-body').size() > 0) {
                var accordionBody = $('div' + window.location.hash + '.accordion-body');
                accordionBody.collapse('show');
                var tabPane = accordionBody.closest('.tab-pane[id]').attr('id');
                if($('#ServicesTabs a[href="#' + tabPane + '"]').size() > 0) {
                    $('#ServicesTabs a[href="#' + tabPane + '"]').tab('show');
                }
            }
        }

        $('a.accordion-toggle').on('click', function(e){
            //window.location.hash = $(this).attr('href').split('#').pop();
        });
    })(jQuery);
</script>
<?php get_footer(); ?>
