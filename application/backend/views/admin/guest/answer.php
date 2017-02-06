<div id="page_form">
<h1><?php echo empty($guest->id_guest)?'Добавление коментария ':'Ответ на коментарий '.$guest->name ?></h1>
<hr>

<?php echo form_open(); ?>
 <?php echo validation_errors(); ?>
<div id="seting_pahel">
<?php echo anchor('admin/guest', '<- Назад') ?>
    <input type="submit" class="save_input" name="save" value="Ответить">
<hr>

<div>
  <input type="hidden" name="parent_id" value="<?php echo $guest->id_guest; ?>">
  <input type="hidden" name="name" value="Администратор">
  <textarea name="text" rows="10" cols="60"><?php echo set_value('text'); ?></textarea>
 
</div>
 <?php echo form_close(); ?>
</div>
</div>

 