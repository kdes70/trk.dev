<div id="page_form">
<h1><?php echo empty($page->id_page)?'Добавление страницы ':'Изменение страницы '.$page->name ?></h1>
<hr>

<?php echo form_open(); ?>
<div id="seting_pahel">
<?php echo anchor('admin/page', '<- Назад') ?>
    <input type="submit" class="save_input" name="save" value="Сохранить">

    <label for="">Родитель</label>
<?php 
    
    echo form_dropdown('parent_id', $pages_no_parents, $this->input->post('parent_id') ? $this->input->post('parent_id') : $page->parent_id);
 ?>

</div>
 <?php echo validation_errors(); ?>
<hr>
<div>
<p>
    <label>Название станицы
        <input type="text" name="name" id="name_pages" value="<?php echo set_value('name', $page->name); ?>" >
    </label>
    
    <label>URL станицы
        <input type="text" name="url_page" id="url_page" onkeyup="this.value = this.value.replace (/[а-я]/, '')" value="<?php echo set_value('url_page', $page->url_page); ?>" >
    </label>
</p>
<hr>
<p><label for="">Позиция</label>
    <?php 
        $option = array('none'=>'none', 'top'=>'top', 'left'=>'left');
        echo form_dropdown('block', $option, set_value('block', $page->block));
     ?>
    
    <label for="">Шаблон</label>
        <?php echo form_dropdown('template', array('page' => 'Page', 'news_archive' => 'News archive', 'homepage' => 'Homepage', 'guest_book'=>'Guest book', 'gallery'=>'Gallery'), $this->input->post('template') ? $this->input->post('template') : $page->template); ?>
        </p>
</div>
<hr>
<textarea name="text" class="moxiecut"><?php echo set_value('text', $page->text); ?></textarea>
<?php echo form_close(); ?>
</div>
<script type="text/javascript">
    // function copy_input() {
    //     var inp_1 = $('#name_pages').val();

    

    // //   $('#url_page').val(inp_1);
    //      }
         <!--// onkeyup='copy_input();' -->
</script>
