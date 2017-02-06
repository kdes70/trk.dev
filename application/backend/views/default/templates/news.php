<section>
 <header  class="page_title">
       <h1><?php echo $news->title; ?></h1>
    </header><!-- /header -->
     <small> <p><?php echo $news->pubdate; ?></p></small>
    <div><img src="<?php echo base_url($news->img); ?>" /></div>
  
    
         <p><?php echo $news->text; ?></p>

</section>
         