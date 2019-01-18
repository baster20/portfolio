<?php if (post_password_required()) { ?>
<?php return; } ?>
<div class="comments_block">
<?php if (have_comments()) : ?>
<hr/>    
<h3><?php _e("Comments", "divergent"); ?></h3>
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
        <div class="previous"><?php previous_comments_link(esc_attr__( '&#8249; Older comments', 'divergent' )); ?></div>
        <div class="next"><?php next_comments_link(esc_attr__( 'Newer comments &#8250;', 'divergent' )); ?></div>
        <div class="clear"></div> 
    <?php endif; ?>

    <ol class="commentlist">
        <?php wp_list_comments('type=comment&callback=divergent_comment'); ?>
    </ol>
    
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
        <hr/>
        <div class="previous"><?php previous_comments_link(esc_attr__( '&#8249; Older comments', 'divergent' )); ?></div>
        <div class="next"><?php next_comments_link(esc_attr__( 'Newer comments &#8250;', 'divergent' )); ?></div>
        <div class="clear"></div> 
    <?php endif; ?>

<?php else : ?>

<?php endif; ?>

<?php
if (!empty($comments_by_type['pings'])) :
    $count = count($comments_by_type['pings']);
    ($count !== 1) ? $txt = esc_attr__('Pings&#47;Trackbacks', 'divergent') : $txt = esc_attr__('Pings&#47;Trackbacks', 'divergent');
?>

    <h6 id="pings"><?php printf( esc_attr__( '%1$d %2$s for "%3$s"', 'divergent'), $count, $txt, get_the_title() )?></h6>

    <ol class="commentlist">
        <?php wp_list_comments('type=pings&max_depth=<em>'); ?>
    </ol>

<?php endif; ?>
<?php if (comments_open()) : ?>
<hr/>    
<?php comment_form(); ?>   
<?php endif; ?> 
</div>    

