<?php

$title = get_field('title');
$text = get_field('text');
$image = get_field('image');

echo '<div class="hero-slider">';
  echo '<div class="hero-slider-item" style="background-image: url(' . wp_get_attachment_url($image['ID'], 'large', null) . ')">';
    echo '<div class="hero-slider-item-content">';
      echo '<div class="hero-slider-item-info">';
        if (! empty($title)) {
            echo '<h3>' . $title . '</h3>';
        }
        if (! empty($text)) {
            echo '<p>' . $text . '</p>';
        }
      echo '</div>';
    echo '</div>';
  echo '</div>';
echo '</div>';
