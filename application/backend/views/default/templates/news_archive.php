 <section>
    <header  class="page_title">
         <h1><?php echo $page->name; ?></h1>
    </header><!-- /header -->
        
     <?php if($pagination): ?>
             <section class="pagination"><?php echo $pagination; ?></section>
     <?php endif; ?>
     <div class="prew_row">
     <?php if (count($news)): foreach ($news as $post): ?>
                 <article class="news_priv"><?php echo get_excerpt($post); ?><hr></article>

     <?php endforeach; endif; ?>
      <?php if($pagination): ?>
             <section class="pagination"><?php echo $pagination; ?></section>
     <?php endif; ?>
     </div>
 </section>
