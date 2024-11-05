<?php
get_header(); 
?>

<div class="single-deer-test">
    <?php
    while (have_posts()) : the_post(); 

        $start_date = get_field('start_date');
        $end_date = get_field('end_date');
        $description = get_field('description');
        $cover_image = get_field('cover_image');
        $application_link = get_field('application_link');
        
    ?>
        <h1><?php the_title(); ?></h1>
        <p>Start Date: <?php echo esc_html($start_date);?></p> 
        <p>End Date: <?php echo esc_html($end_date);?></p>
        <p>Description: <?php echo esc_html($description);?></p>

        <?php if( $application_link ) : 

            $link_url = $application_link['url'];
            $link_title = $application_link['title'];
            $link_target = $$application_link['target'] ? $application_link['target'] : '_self';    
            
        ?>
            <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                <?php echo esc_html( $link_title ); ?>
            </a>
        <?php endif; ?>

        <?php if( $cover_image ) : ?>
            <div>
                <img src="<?php echo $cover_image; ?>" width="100%"  />
            </div>
        <?php endif; ?>

        <div><?php the_content(); ?></div>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>
