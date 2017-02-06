<div id="page_form">
<h1><?php echo empty($news->id_news)?'Добавление новости ':'Изменение новости '.$news->title ?></h1>
<hr>

<?php echo form_open_multipart(); ?>
 <?php echo validation_errors(); ?>
<div id="seting_pahel">
<?php echo anchor('admin/news', '<- Назад') ?>
    <input type="submit" class="save_input" name="save" value="Сохранить">

<label for="">Дата публикации</label>
<?php echo form_input('pubdate', set_value('pubdate', $news->pubdate), 'id="datepicker"'); ?>

</div>

<hr>
<div>
<p>
    <label>Заголовок
        <?php echo form_input('title', set_value('title', $news->title)); ?>
    </label>

    <label for="">Фото-миниатюра
      <p >
     
            <input type="text" id="img" name="img" size="20" />
          <a href="javascript:;" onclick="upImag();">Загрузить</a>
      </p>
    </label>
    

    
</p>
<hr>

<textarea name="text" class="moxiecut"><?php echo set_value('text', $news->text); ?></textarea>
<?php echo form_close(); ?>
</div>

 <script>
  $(function() {
  //  $.datepicker.setDefaults( $.datepicker.regional["ru"] );
    $( "#datepicker" ).datepicker($.datepicker.regional["ru"]);

  });
function upImag() {
   moxman.browse({fields: 'img', no_host: true});
   
}


  </script>