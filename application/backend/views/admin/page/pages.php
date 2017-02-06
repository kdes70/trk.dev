<h1>Pages list</h1>
<div id="table_page">
    <hr>
    <div id="seting_pahel">
      <p><?php echo anchor('admin/page/edit', '&#43; Добавить страницу'); ?>
        <?php echo anchor('admin/page/order', 'Сортировать станицы'); ?>
      </p>
    </div>
    <hr>
<table>
    <thead>
        <tr>
            <td>Название</td>
             <td>URL</td>
             <td>Главная</td>
             <td>Позиция</td>
             <td>Шаблон</td>
             <td>Статус</td>
             <td>Действия</td>
        </tr>
    </thead>
    <tbody>
    <?php foreach($pages as $page): ?>

        <tr>
            <td> <?php echo $page->name; ?></td>
            <td><?php echo $page->url_page; ?></td>
            <td><?php echo $page->parent_slug; ?></td>
            <td><?php echo $page->block; ?></td>
            <td><?php echo $page->template; ?></td>
            <td><?php echo $page->public; ?></td>
              <td><a href="<?php echo base_url('admin/page/edit/'.$page->id_page); ?>">Изминить</a>
            <?php echo anchor('admin/page/delete/'.$page->id_page, 'Удалить'); ?>
        </td>
        </tr>
       
      
      
    <?php endforeach; ?>
    </tbody>
</table>
</div>