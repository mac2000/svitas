<div id="ExamplesModal" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-header-title">Examples</h3>
    </div>
    <div class="modal-body">
        <div id="ExamplesCarousel" class="carousel slide">
            <?php
            $query = new WP_Query('post_type=example');
            if ($query->have_posts()):
                ?>
                <ol class="carousel-indicators">
                    <?php $idx = 0; while ($query->have_posts()): $query->the_post();
                        if (!has_post_thumbnail()) continue; ?>
                        <li data-target="#ExamplesCarousel" data-slide-to="<?php echo $idx++; ?>"></li>
                    <?php endwhile; ?>
                </ol>
            <?php endif;
            wp_reset_postdata(); ?>

            <?php
            $idx = 0;
            $query = new WP_Query('post_type=example');
            if ($query->have_posts()):
                ?>
                <div class="carousel-inner">
                    <?php while ($query->have_posts()): $query->the_post();
                        if (!has_post_thumbnail()) continue; ?>
                        <div class="item <?php echo $idx == 0 ? 'active' : ''?>">
                            <?php echo the_post_thumbnail('medium', array('alt' => get_the_title())); ?>

                            <div class="carousel-caption">
                                <h4 class="hide"><?php the_title(); ?></h4>

                                <p><?php the_excerpt(); ?></p>
                            </div>
                        </div>
                        <?php $idx++; endwhile; ?>
                </div>
            <?php endif;
            wp_reset_postdata(); ?>

            <a class="left carousel-control" href="#ExamplesCarousel" data-slide="prev">‹</a>
            <a class="right carousel-control" href="#ExamplesCarousel" data-slide="next">›</a>
        </div>
    </div>
    <div class="modal-footer">
        <div class="row-fluid">
            <?php
            $query = new WP_Query('post_type=example');
            if ($query->have_posts()):
                ?>
                <ul class="thumbnails">
                    <?php $idx = 0; while ($query->have_posts()): $query->the_post();
                        if (!has_post_thumbnail()) continue; ?>

                        <li class="span2">
                            <a class="show-example" href="#examples-<?php echo $idx; ?>" data-idx="<?php echo $idx; ?>" title="<?php the_title(); ?>">
                                <?php echo the_post_thumbnail('thumbnail', array('class' => 'thumbnail', 'alt' => get_the_title())); ?>
                            </a>
                        </li>

                        <?php
                        $idx++;
                    endwhile;
                    ?>
                </ul>
            <?php
            endif;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</div>

<script>
    (function ($) {
        var ExamplesModal = $('#ExamplesModal'),
            ExamplesModalTitle = $('#ExamplesModal h3.modal-header-title'),
            ExamplesCarousel = $('#ExamplesCarousel'),
            ExamplesCarouselItems = ExamplesCarousel.find('.item'),
            total = $('#ExamplesModal .item').size();

        if((window.location + '').match(/#examples-\d+$/)) ShowExample((window.location + '').split('#examples-').pop());

        ExamplesCarousel.carousel().carousel('pause').on('slid', function(e){
            ExamplesModalTitle.html((1 + ExamplesCarouselItems.filter('.active').index()) + '/' + total + ' ' + ExamplesCarouselItems.filter('.active').find('h4.hide:first').text());
        });

        function ShowExample(idx) {
            idx = parseInt(idx);
            ExamplesModal.modal('show');
            ExamplesCarousel.carousel(idx);
            ExamplesModalTitle.html((1 + idx) + '/' + total + ' ' + $('#ExamplesCarousel .item:eq(' + idx + ') h4.hide:first').text());
        }

        $('a.show-example').on('click', function(e){
            ShowExample($(this).attr('data-idx'));
        });
    })(jQuery);
</script>
