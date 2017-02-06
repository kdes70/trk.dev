
    <h1>Сортировать станицы</h1>
    <p>Перетащите для сортировки страниц, а затем нажмите кнопку "Сохранить"</p>
    <hr>
    <div id="seting_pahel">
        <?php echo anchor('admin/page', '<- Назад') ?>
         <input type="button" id="save" value="Сохранить" class="save_input" />

    </div>
    <hr>
    <div id="orderResult"></div>
   

<script>
$(function() {
    $.post('<?php echo site_url('admin/page/order_ajax'); ?>', {}, function(data){
        $('#orderResult').html(data);
    });

    $('#save').click(function(){
        oSortable = $('.sortable').nestedSortable('toArray');

        $('#orderResult').slideUp(function(){
            $.post('<?php echo site_url('admin/page/order_ajax'); ?>', { sortable: oSortable }, function(data){
                $('#orderResult').html(data);
                $('#orderResult').slideDown();
            });
        });
        
    });
});
</script>