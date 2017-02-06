<h1>Страница новостей</h1>
<div id="table_page">
    <hr>
    <div id="seting_pahel">
      <p><?php echo anchor('admin/news/edit', '&#43; Добавить новость'); ?>
      <!--   <?php echo anchor('admin/news/order', 'Сортировать станицы'); ?> -->
      </p>
    </div>
    <hr>
<table>
    <thead>
        <tr>
            <td>Название</td>
             <td>IMG</td>
             <td>URL</td>
             <td>Даста создания</td>
             <td>Статус</td>
             <td>Действия</td>
        </tr>
    </thead>
    <tbody>
    <?php foreach($news_list as $news): ?>

        <tr>
            <td> <?php echo $news->title; ?></td>
            <td><img src="<?php echo $news->img; ?>" width="60px" alt=""> </td>
            <td><?php echo $news->slug; ?></td>
           
            <td><?php echo $news->created; ?></td>
            <td><?php echo $news->public; ?></td>
              <td><a href="<?php echo base_url('admin/news/edit/'.$news->id_news); ?>">Изминить</a>
            <?php echo anchor('admin/news/delete/'.$news->id_news, 'Удалить'); ?>
        </td>
        </tr>
       
      
      
    <?php endforeach; ?>
    </tbody>
</table>
</div>