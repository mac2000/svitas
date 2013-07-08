<?php
$query = new WP_Query('post_type=slider');
if ($query->have_posts()):
    ?>
    <div id="sliderHolder">
        <div class="container">
         <div id="slider" class="carousel slide">
            <ol class="carousel-indicators">
            <?php $idx = 0; while ($query->have_posts()): $query->the_post(); ?>
            	<li data-target="#slider" data-slide-to="<?php echo $idx?>" class="<?php echo $idx == 0 ? 'active' : ''?>"></li>
            <?php $idx++; endwhile; ?>
            </ol>        
<?php endif;
wp_reset_postdata();

$query = new WP_Query('post_type=slider');
if ($query->have_posts()):
    ?>
    		<div class="carousel-inner">
            <?php $idx = 0; while ($query->have_posts()): $query->the_post(); ?>
                <div class="item <?php echo $idx == 0 ? 'active' : ''?>">
                	<?php echo the_post_thumbnail('thumbnail', array('alt' => get_the_title()));?>
                	<div class="carousel-caption">
                      <h4><?php the_title()?></h4>
                      <?php the_content()?>
                    </div>
                </div>
            <?php $idx++; endwhile; ?>
            </div>
            </div>
        </div>
    </div>
<?php endif;
wp_reset_postdata();