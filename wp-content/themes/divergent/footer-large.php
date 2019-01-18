</div>
<?php $divergentfooterhide = get_option('divergent_hidefooter'); ?>
<?php $divergenthidesidebar = get_option('divergent_hidesidebar'); ?>
    <?php if ($divergentfooterhide != "true") { ?>
    <!-- FOOTER -->
    <footer id="footer" class="fixed-footer xlarge">
        <div class="cv-credits">
            <?php $divergentfootertext = get_option('divergent_footermessage'); ?>
            <?php echo stripslashes(balanceTags($divergentfootertext)); ?>
        </div>
        <!-- BACK TO TOP BUTTON -->
        <div id="cv-back-to-top" class="tooltip-gototop" title="<?php echo esc_attr( 'Go to top', 'divergent' ); ?>"></div>
    </footer>
<?php } ?>
<?php if ($divergenthidesidebar != "true") { ?>
    <!-- SIDEBAR -->
    <aside id="cv-sidebar">
        <div id="cv-sidebar-inner">
            <?php if ( has_nav_menu( 'divergent-menu' ) ) { ?>
            <div class="cv-panel-widget">
            <div class="cv-sidebar-title">
                <h5><?php echo esc_attr( 'MENU', 'divergent' ); ?></h5>
            </div>
                    <?php
$defaults = array(
	'theme_location'  => 'divergent-menu',
	'menu'            => '',
	'container'       => 'nav',
	'container_class' => 'cv-submenu',
	'container_id'    => 'cv-submenu',
	'menu_class'      => '',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => '',
	'items_wrap'      => '<ul id="%1$s" class="nav %2$s">%3$s</ul>',
    'depth'           => 2
);
wp_nav_menu( $defaults );
                    ?>
            </div>
            <?php } ?>
            <?php if ( !function_exists( 'dynamic_sidebar') || !dynamic_sidebar( 'divergentmainsidebar') ) : ?>
            <?php endif; ?>
        </div>
    </aside>
<?php } ?>
<?php wp_footer(); ?>
</body>

</html>