<?php
$query = new WP_Query('post_type=example');
if ($query->have_posts()):
    ?>

    <h2 class="title">Examples</h2>
        <?php $idx = 0; while ($query->have_posts()): $query->the_post();
            if (!has_post_thumbnail()) continue; ?>

            <p>
                <a class="show-example" href="#examples-<?php echo $idx; ?>" data-idx="<?php echo $idx; ?>" title="<?php the_title(); ?>">
                    <?php echo the_post_thumbnail('thumbnail', array('class' => 'thumbnail', 'alt' => get_the_title())); ?>
                    <?php the_title(); ?>
                </a>
            </p>

        <?php
        $idx++;
        endwhile;
endif;
wp_reset_postdata();
?>
