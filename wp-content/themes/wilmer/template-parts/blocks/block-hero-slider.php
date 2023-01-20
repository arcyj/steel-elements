<?php

$title = get_field('title');
$text = get_field('text');
$image = get_field('image');

?>

<div class="hero-slider">
  <div class="hero-slider-item" style="background-image: url('<?php echo wp_get_attachment_url($image['ID'], 'large', null) ?>')">
    <div class="hero-slider-bg"></div>
    <div class="hero-slider-item-content">
      <div class="hero-slider-item-info">
        <?php if (! empty($title)) { ?>
            <h3> <?php echo $title ?></h3>
        <?php } ?>
        <?php if (! empty($text)) { ?>
            <p> <?php echo $text ?> </p>
        <?php } ?>

      </div>
    </div>
  </div>
</div>
