 <section>
  <header  class="page_title">
         <h1><?php echo $page->name; ?></h1>
    </header><!-- /header -->
     
    <!--  <?php if($pagination): ?>
             <section class="pagination"><?php// echo $pagination; ?></section>
     <?php endif; ?> -->
     <div class="prew_row">
     <?php if (count($guest)): foreach ($guest as $post): ?>
                 <article class="guest_row">
                     <p><span><?php echo e($post->date_init); ?></span> \ <?php echo e($post->name); ?></p>
                     <hr>
                     <p>
                         <?php echo e($post->text); ?>
                     </p>
                 </article>

     <?php endforeach; endif; ?>
     <!--  <?php if($pagination): ?>
             <section class="pagination"><?php// echo $pagination; ?></section>
     <?php endif; ?> -->
     </div>



     <div id="guest_form">
     <h1>Оставить отзыв</h1>
    <p class="lines"></p>
    <?php echo validation_errors(); ?>
         <?php echo  $this->session->flashdata('code_bed');?>
         <?php echo form_open(); ?>
    <p>
        <label for="name">Ваше имя: </label>
            <?php echo form_input('name', set_value('name'));?>
       
    </p>
    <p>
         <label for="email">Email:</label>
            <?php echo form_input('email', set_value('email'), 'style="margin-left: 133px;"');?>
    </p>
    <p>
        <textarea name="text"  cols="30" rows="10"><?php echo set_value('text'); ?></textarea>
    </p>
        <p class="caption_block">
            <label for="name">Введите код: </label>
            <img style="-webkit-user-select: none" src="http://rk-tomsk.ru/captcha">
             <?php echo form_input('captcha', set_value('captcha'));?>


        </p>
    <p>
        <input type="submit" class="button" name="ok" value="Отправить">
    </p>
         <?php echo form_close(); ?>
     </div>
 </section>
