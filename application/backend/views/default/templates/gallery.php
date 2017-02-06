 <section>
    <header  class="page_title">
         <h1><?php echo $page->name; ?></h1>
    </header><!-- /header -->
        <div class="ionTabs" id="tabs_1" data-name="gallery">
    <ul class="ionTabs__head">
        <li class="ionTabs__tab" data-target="Tab_1_name">Фото</li>
        <li class="ionTabs__tab" data-target="Tab_2_name">Видео</li>
       
    </ul>
    <div class="ionTabs__body">
        <div class="ionTabs__item" data-name="Tab_1_name">
          
         <?php echo form_open_multipart(); ?>
         <?php if(isset($error)): ?>
            <p style="color:red"><?php echo $error; ?></p>
         <?php endif; ?>
      <p id="add_photo">Загрузить изображение</p>
      <div class="hiiden">
        
       <p id="gallery_form">
            <label for="">
               Описание:
               <input type="text" name="title">
           </label>
           <input type="file" name="userfile" value="" placeholder="выберите">
       </p>
        <p>
        <input type="submit" class="button" name="upload" value="Отправить">
    </p>
        <?php echo form_close() ?>
      
      </div>
      <hr>

    <?php if($gallery): ?>
        <?php foreach($gallery as $photo): ?>
        <a href="<?php echo $photo->img; ?>" class="lightBox" ><img src="<?php echo $photo->img; ?>" width="100px" alt="<?php echo $photo->title; ?>"></a>
     <?php endforeach; ?>
    <?php endif; ?>
       
          </div>
        <div class="ionTabs__item" data-name="Tab_2_name">
            <p><?php echo $page->text; ?></p>
        </div>

        <div class="ionTabs__preloader"></div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
       // $('a[rel=lightbox]').lightBox();
        ;$("a.lightBox").colorbox({rel:'lightBox', transition:"fade"});
    });  
</script>
 </section>
