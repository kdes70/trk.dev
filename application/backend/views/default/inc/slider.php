<section id="center" class=""><!-- center -->
<?php //  $news_list = array_slice($news_list, 3); ?>
 <?php if(count($news_slider) > 3): ?>
<div id="slider"> <!-- SLIDER -->
   <div class="arr_prev"></div>
   <div id="news_slider"> 
 
   <?php echo news_slider_links($news_slider); ?>
  
    </div>
<div class="arr_next"></div>
</div><!-- SLIDER END -->
<?php endif; ?>
