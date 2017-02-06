<div id="page_form">
<h1>Галлерея</h1>
<hr>
<?php echo form_open_multipart(); ?>
 <?php echo validation_errors(); ?>
<div id="seting_pahel">

    <input type="submit" class="save_input" name="save" value="Сохранить">
</div>
<hr>
<div>
<p>
    <label>Заголовок
        <?php echo form_input('title', set_value('title')); ?>
    </label>
    <label for="">Фото
     
          <input type="text" id="imgg" name="img" size="20" />
          <a  href="javascript:;" onclick="moxman.browse({fields: 'imgg', no_host: true});">Загрузить</a>
      
    </label>
    <div style="display:none;">
      <textarea name="hidden" class="moxiecut" cols="30" rows="10"></textarea>
    </div>
    
</p>
<hr>
<?php echo form_close(); ?>
</div>
<table>
    <thead>
        <tr>
            <td>Название</td>
             <td>IMG</td>
        </tr>
    </thead>
    <tbody>
    <?php foreach($gallery as $photo): ?>

        <tr>
            <td> <?php echo $photo->title; ?></td>
            <td><img src="<?php echo $photo->img; ?>" width="60px" alt=""> </td>
              <td>
            <?php echo anchor('admin/gallery/delete/'.$photo->id, 'Удалить'); ?>
        </td>
        </tr>
       
      
      
    <?php endforeach; ?>
    </tbody>
</table>
 <script>
  

  </script>