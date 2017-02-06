<div id="bg_menu"><!-- menu -->
    <nav id="menu_block">
       <!--  <ul>
            <?php if($top_menu): ?>
                <?php foreach($top_menu as $memu): ?>
                <li><a href="<?php echo base_url('page/'.$memu->url_page); ?>"><?=$memu->name; ?></a></li>
                <?php endforeach; ?>
           <?php endif; ?>
        </ul> -->
         <?php echo get_menu($menutop); ?>
    </nav>
</div><!-- menu END -->