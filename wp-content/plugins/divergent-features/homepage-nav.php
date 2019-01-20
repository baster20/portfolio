<?php
$homeslug = sanitize_title(get_option('divergent_homeslug'));
$hometitle = get_option('divergent_hometitle');
$menuicon = get_option('divergent_menuicon');
$homeicon = get_option('divergent_homeicon');

$menuargs = array(
    'post_type' => 'dvsections',
    'posts_per_page' => 99
);
$menu_query = new WP_Query( $menuargs );
$count = 2;
?>
<div id="cv-menu">
    <nav id="cv-main-menu">
        <ul>
            <?php $hidesidebar = get_option('divergent_hidesidebar'); ?>
                <?php if ($hidesidebar != "true") { ?>
                    <li class="cv-menu-icon"><a href="#" class="cv-menu-button fa <?php if (!empty($menuicon)) { echo esc_attr($menuicon); } else { echo esc_attr('fa-bars'); } ?>"><?php esc_attr_e('Menu', 'divergentcpt'); ?></a>
                    </li>
                    <?php } ?>
                        <li class="links-to-floor-li cv-active" data-id="1" data-slug="<?php if (!empty($homeslug)) { echo esc_attr($homeslug); } else { echo esc_attr('home'); } ?>"><a href="#<?php if (!empty($homeslug)) { echo esc_attr($homeslug); } else { echo esc_attr('home'); } ?>" class="fa <?php if (!empty($homeicon)) { echo esc_attr($homeicon); } else { echo esc_attr('fa-home'); } ?> tooltip-menu" title="<?php if (!empty($hometitle)) { echo esc_attr($hometitle); } else { echo esc_attr('HOME'); } ?>"><?php if (!empty($hometitle)) { echo esc_attr($hometitle); } else { echo esc_attr('HOME'); } ?></a>
                        </li>
            <?php while($menu_query->have_posts()) : $menu_query->the_post(); ?>
            <?php $icon = get_fa($format = false, get_the_ID()); ?>
                        <li class="links-to-floor-li" data-id="<?php echo $count++; ?>" data-slug="<?php echo divergent_slug(); ?>"><a href="#<?php echo divergent_slug(); ?>" class="fa <?php if (!empty($icon)) { echo esc_attr($icon); } else { echo esc_attr('fa-file'); } ?> tooltip-menu" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                        </li>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </ul>
    </nav>
</div>