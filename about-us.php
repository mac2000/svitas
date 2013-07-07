<?php
/*
Template Name: About Us
*/
get_header(); ?>
<div class="container">
<div class="row">
    <div class="span8">
        <?php while (have_posts()) : the_post(); ?>
            <h1 class="title"><?php the_title(); ?></h1>
            <p><?php post_categories_labels() ?></p>
            <?php the_content(); ?>

            <?php include 'partials/partners/logos.php'?>

        <?php endwhile; ?>


    </div>
    <!-- /.span8 -->
    <div class="span4">
        <?php include 'partials/examples/sidebar.php'?>
    </div>
    <!-- /.span4 -->
</div>
</div>
<?php include 'partials/examples/modal.php'?>
<?php get_footer(); ?>
