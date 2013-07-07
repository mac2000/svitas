<?php
$query = new WP_Query('post_type=partner');
if ($query->have_posts()):
    ?>
    <h2><?php _e('Our partners') ?></h2>
    <div class="row-fluid">
        <ul class="thumbnails">
            <?php while ($query->have_posts()): $query->the_post(); ?>
                <li class="span3">
                    <?php if (has_post_thumbnail()): echo the_post_thumbnail('thumbnail', array('class' => 'thumbnail', 'alt' => get_the_title(), 'title' => get_the_title())); else: continue; endif; ?>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
<?php endif;
wp_reset_postdata(); ?>
