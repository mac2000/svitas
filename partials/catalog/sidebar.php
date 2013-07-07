<?php $terms = get_terms('catalog', array('hierarchical' => false)); ?>
<div class="accordion" id="CatalogSidebar">
    <?php $tidx = 0; foreach ($terms as $term): ?>
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#CatalogSidebar"
                   href="#<?php echo $term->slug ?>">
                    <?php s8_get_taxonomy_image($term); ?>
                    <?php echo $term->name; ?>
                </a>
            </div>
            <div id="<?php echo $term->slug ?>" class="accordion-body collapse <?php echo $tidx++ == '0' ? 'in' : '' ?>">
                <div class="accordion-inner">


                    <?php
                    $query = new WP_Query(array(
                        'post_type' => 'catalog',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'catalog',
                                'field' => 'slug',
                                'terms' => $term->slug
                            )
                        )
                    ));
                    if ($query->have_posts()):
                        ?>
                            <?php while ($query->have_posts()): $query->the_post(); ?>

                                <p>
                                    <a href="#<?php echo $post->post_name ?>"><?php the_title() ?></a>
                                </p>

                            <?php
                            endwhile;
                            ?>
                    <?php
                    endif;
                    wp_reset_postdata();
                    ?>

                </div>
            </div>
        </div>

    <?php endforeach; ?>
</div>
