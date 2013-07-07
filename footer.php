<div class="footer">
    <div class="navbar">
        <div class="navbar-inner">
            <?php wp_nav_menu(array(
                'container_class' => 'container',
                'menu_class' => 'nav'
            ))?>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
             <?php echo get_option('footer_copyright', '&copy; ' . date('Y')); ?>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
