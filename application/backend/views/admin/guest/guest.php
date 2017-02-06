<h1>Гостевая книга</h1>
<div >
   
<div>
 <hr>
   
    
  <?php if($guest): ?>
      <?php if($pagination): ?>
             <section class="pagination"><?php echo $pagination; ?></section>
     <?php endif; ?>
     <span>Всего : <?php echo $guest_count; ?></span>
      <hr>
    <?php foreach($guest as $item): ?>
    <div class="guest_item">
      <p><?php echo $item->date_init;?> | <b><a href="mailto:<?php echo $item->email;?>"><?php echo $item->name;?></a></b></p>
      <p><?php echo $item->text;?></p>
      <p><a href="<?php echo base_url('admin/guest/answer/'.$item->id_guest); ?>">Ответить</a><a href="<?php echo base_url('admin/guest/delete/'.$item->id_guest); ?>">Удалить</a></p>
    </div>
    <hr>
  <?php endforeach; ?>
    <?php if($pagination): ?>
             <section class="pagination"><?php echo $pagination; ?></section>
     <?php endif; ?>
  <?php endif; ?>
</div>



</div>