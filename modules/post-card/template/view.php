<?php
$settings = $this->get_settings_for_display();
$this->add_inline_editing_attributes( 'title', 'none' );
$this->add_render_attribute( 'title', 'class', 'awe-post-title' );

$this->add_inline_editing_attributes( 'content', 'none' );
$this->add_render_attribute( 'content', 'class', 'cap awe-post-con' );

$this->add_inline_editing_attributes( 'cat', 'none' );
$this->add_render_attribute( 'cat', 'class', 'case-studies awe-post-cat' );

$this->add_inline_editing_attributes( 'author', 'none' );
$this->add_render_attribute( 'author', 'class', 'awe-post-author' );

$this->add_inline_editing_attributes( 'date', 'none' );
$this->add_render_attribute( 'date', 'class', 'dot awe-post-date' );

$get_post_name = $settings['post_name'];
if( $get_post_name >= 1 ) { 
    $posts_ids = implode(', ', $get_post_name); 
} else { $posts_ids = ''; }
$post_names = explode(',', $posts_ids);

$args = array(
    'post_type'             => 'post',
    'post_status'           => 'publish',
    'ignore_sticky_posts'   => 1,
    'posts_per_page'        => -1,
);
if ( "0" != $get_post_name ) {
    $args['post__in'] = $post_names;
}
$single_post = new \WP_Query( $args );
?>
<?php 
  if( $single_post->have_posts() ):
      while( $single_post->have_posts() ): $single_post->the_post();
?>


    <?php if($settings['style'] === 'style1'):?>
     
        <div class="main-card-div">
            <a href="<?php the_permalink();?>">
                <div class="thubmnail">
                    <?php the_post_thumbnail( 'full' );  ?>
                </div>
                </a>
                <?php
                    foreach ( get_the_category() as $category ) {
                    $term_link = get_term_link( $category );
                    if($settings['show_category'] == 'yes' ):
                 ?>
                    <div <?php echo $this->get_render_attribute_string( 'cat' ); ?> class=""><?php echo esc_attr( $category->name );?></div>
                <?php endif; }?>
                
                <div class="cir-img">
                    <?php $user = wp_get_current_user();?>
                    <img src="<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>" alt="">
                </div>
                <div class="caption">
                    <?php if($settings['show_title'] == 'yes' ):?>
                        <h3 <?php echo $this->get_render_attribute_string( 'title' ); ?>><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                    <?php endif;?>
                    <?php if($settings['show_content'] == 'yes' ):?>
                        <div <?php echo $this->get_render_attribute_string( 'content' ); ?>><p><?php echo wp_trim_words( get_the_content(), 21, '' ); ?></p></div>
                    <?php endif;?>
                    <?php if($settings['show_excerpt'] == 'yes' ):?>
                        <div <?php echo $this->get_render_attribute_string( 'content' ); ?>><p><?php the_excerpt(); ?></p></div>
                    <?php endif;?>
                </div>
                
            <div class="fotter">
                <?php if($settings['show_author'] == 'yes' ):?>
                    <span <?php echo $this->get_render_attribute_string( 'author' ); ?>><?php the_author();?></span>
                <?php endif;?>
                <?php if($settings['show_date'] == 'yes' ):?>
                     <span <?php echo $this->get_render_attribute_string( 'date' ); ?> > <?php the_time(esc_html__('d F Y','aw_elementor'));?></span>
                <?php endif;?>
            </div>
        </div> 
 
   <?php endif;?>

<?php endwhile; wp_reset_postdata(); wp_reset_query(); endif; ?>

<?php if($settings['style'] === 'style2'):?>
 
<?php endif;?>