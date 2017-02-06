<div id="content"><!-- content -->
    <aside id="left_block"><!-- left_block -->
        <div id="left_head">
        <img src="<?php echo base_url('img/min_logo.png'); ?>" alt="">
            <h5>Томский <br>
                научно-производственный 
                рыболовный комплекс</h5>
        <p class="lines"></p>
        </div>
        <div class="left_cont">
            <b class="left_title">Услуги:</b>
            <?php if($left_page): ?>
             <ul>
            <?php foreach($left_page as $item): ?>
                    <li><a href="<?php echo base_url().$item->url_page; ?>"><?php echo $item->name; ?></a></li>
            <?php endforeach; ?>
             </ul>
          <?php endif; ?>
           
        
           
        </div>
         <div class="left_cont">
 
<!-- Gismeteo informer START -->
<link rel="stylesheet" type="text/css" href="http://www.gismeteo.ru/static/css/informer2/gs_informerClient.min.css">
<div id="gsInformerID-Nrw6TA3fGjKokN" class="gsInformer" style="width:270px;height:203px">
  <div class="gsIContent">
   <div id="cityLink">
     <a href="http://www.gismeteo.ru/city/daily/4652/" target="_blank">Погода в Томске</a>
   </div>
   <div class="gsLinks">
     <table>
       <tr>
         <td>
           <div class="leftCol">
             <a href="http://www.gismeteo.ru" target="_blank">
               <img alt="Gismeteo" title="Gismeteo" src="http://www.gismeteo.ru/static/images/informer2/logo-mini2.png" align="absmiddle" border="0" />
               <span>Gismeteo</span>
             </a>
           </div>
           <div class="rightCol">
             <a href="http://www.gismeteo.ru/city/weekly/4652/" target="_blank">Прогноз на 2 недели</a>
           </div>
           </td>
        </tr>
      </table>
    </div>
  </div>
</div>
<script src="http://www.gismeteo.ru/api/informer/getinformer/Nrw6TA3fGjKokN/" type="text/javascript"></script>
<!-- Gismeteo informer END -->
         </div>
       <!-- Календарь клева рыбы -->
         <div class="left_cont">
         <center>
           <style type="text/css">
    #oxcalentar table td {font-size: 10px; padding: 0; margin: 0; text-align: center;}
    #oxcalentar .oxleg {font-size: 10px; margin-left: 5px; text-align: left;}
    #oxcalentar img {margin: 0 1px 0 1px; border: 0; padding: 0}
    </style></p>
    <div id="oxcalentar">
    <div>Календарь клева рыбы</div>
    <a href="http://oxothik.ru/index.php?action=calendar">Прогноз на неделю »</a></div>
    <script type="text/javascript" src="http://informer.oxothik.ru/informer3.php" charset="UTF-8"></script> <script type="text/javascript">
    try {
    fishinformer("oxcalentar");
    } catch(err) {}</script>
         </center>
         </div>
     <!-- Календарь клева рыбы -->
    </aside><!-- left_block END -->