<?php

$url = get_field('url');
$subtitle = get_field('subtitle');
$title = get_field('title');

?>

<div class="text-banner">
  <a href="<?php echo $url ?>">
    <div class="text-banner-content">
      <p class="text-banner-subtitle"><?php echo $subtitle; ?></p>
      <h4 class="text-banner-title"><?php echo $title; ?></h4>
      <a class="text-banner-button" href="<?php echo $url ?>"><span class="qodef-m-icon" style="width: auto;"><span class="qodef-m-icon-inner"><svg viewBox="0 0 13 12" height="12" width="13" xmlns="http://www.w3.org/2000/svg">
        <path d="M1.044,6.144A0.625,0.625,0,0,1,1.493,5.07H5.868V0.695a0.625,0.625,0,1,1,1.25,0V5.07h4.375a0.625,0.625,0,1,1,0,1.25H7.118V10.7a0.625,0.625,0,1,1-1.25,0V6.32H1.493A0.608,0.608,0,0,1,1.044,6.144Z"></path>
        </svg>
        </span></span>
      </a>
    </div>
  <a>
</div>
