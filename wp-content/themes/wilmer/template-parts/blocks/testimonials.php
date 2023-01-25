<?php
/**
 * Setup query to show the ‘services’ post type with ‘8’ posts.
 * Output the title with an excerpt.
 */
    $args = array(
        'post_type' => 'testimonials',
        'post_status' => 'publish',
        'posts_per_page' => 8,
        'orderby' => 'title',
        'order' => 'ASC',
    );

    $loop = new WP_Query( $args );
?>
<div class="testimonial-wrapper">
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
<?php
    while ( $loop->have_posts() ) : $loop->the_post();
        ?>
      <div class="swiper-slide">

        <div class="testimonial-item">
          <div class="testimonial-content-wrapper">
            <span class="testimonial-qoute">
            <svg xml:space="preserve" viewBox="0 0 69 55" y="0px" x="0px" xmlns="http://www.w3.org/2000/svg" version="1.1">
              <g>
              <path d="M0,30.759c0-9.233,2.428-16.668,7.285-22.306C12.141,2.82,19.223,0,28.531,0v12.834
                                                  c-7.152,0-10.724,4.618-10.724,13.852v3.056h12.95V55H4.249C1.416,46.852,0,38.774,0,30.759z M38.446,30.759
                                                  c0-9.233,2.393-16.668,7.183-22.306C50.415,2.82,57.466,0,66.774,0v12.834c-7.016,0-10.522,4.618-10.522,13.852v3.056H69V55H42.493
                                                  C39.792,46.718,38.446,38.637,38.446,30.759z" fill="currentColor"></path>
              </g>
            </svg>
            </span>
            <div class="testimonial-item-image">
            <?php if (has_post_thumbnail( get_the_ID() ) ): ?>
                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ); ?>
                <img src="<?php echo $image[0]; ?>"/>
            <?php endif; ?>
            </div>
            <div class="testimonial-item-content">
              <p class="testimonial-item-name"> <?php echo the_title(); ?></p>
              <p class="testimonial-item-text"><?php echo get_field("text", get_the_ID());  ?></p>
            </div>
          </div>
        </div>

          </div>
        <?php
    endwhile;
    ?>
      </div>
      <div class="swiper-pagination"></div>
      </div>
      </div>
    <?php
    wp_reset_postdata();
