<?php get_header(); ?>
<div class="well">
<div class="container">
    <?php while (have_posts()) : the_post(); ?>
        <h1 class="title"><?php the_title(); ?></h1>
        <?php the_content(); ?>
    <?php endwhile;?>
</div>
</div>

<?php $terms = get_terms('service', array('hierarchical' => false));?>
    <?php $idx = 0; foreach($terms as $term):?>
        <?php echo $idx++ == 0 ? '' : '<hr>';?>
        <div class="container">
            <p>
                <a href="<?php echo get_page_link(get_services_page_id())?>#<?php echo $term->slug ?>"><?php echo $term->name?></a>
            </p>
            <p>
                <?php echo $term->description ?>
            </p>
        </div>
    <?php endforeach;?>

<?php get_footer(); ?>
