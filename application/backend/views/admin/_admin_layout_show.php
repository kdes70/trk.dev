<html>
<!Doctype html>
<!--[if IE 7 ]><html class="ie7"> <![endif]-->
<!--[if IE 8 ]><html class="ie8"> <![endif]-->
<!--[if IE 9 ]><html class="ie9"> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html lang="ru"> <!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />-->

<link type="text/css" rel="stylesheet" href="<?php echo site_url('css/admin/style.css'); ?>" media="all" />
<link type="text/css" rel="stylesheet" href="<?php echo site_url('css/admin/datepicker.css'); ?>" media="all" />
<link type="text/css" rel="stylesheet" href="<?php echo site_url('css/jquery-ui.min.css'); ?>" media="all" />

<script type="text/javascript" src="<?php echo site_url('js/jquery-1.11.0.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('js/jquery-ui.min.js'); ?>"></script> 

<?php if(isset($sortable) && $sortable === TRUE): ?>
<script type="text/javascript" src="<?php echo site_url('js/jcarousellite_1.0.1.js'); ?>"></script> 
<?php endif; ?>

<script type="text/javascript" src="<?php echo site_url('tmce4/tinymce.min.js'); ?>"></script>
    <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <title>Admin panel</title>
</head>
<body>

<div id="wrepper">
    <header>
    <h2><?php echo $meta_title; ?></h2>
    <div class="right">
   </div>
        <nav>
            <ul>
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Админка</a></li>
                <li><?php echo anchor('/', 'На сайт'); ?></li>
                <li><a href="">Настройки</a></li>
                <li><a href="">Мета данные</a></li>
                <li>Привет <?php echo $this->session->userdata('name'); ?></li>
                <li><?php echo anchor('admin/user/logout', 'Выход'); ?></li>
            </ul>
        </nav>

        <hr>
    </header>
    <section id="content">
        <aside id="left">
             <ul>
                <li><a href="<?php echo base_url('admin/page'); ?>">страницы</a></li>
                <li><a href="<?php echo base_url('admin/news'); ?>">новости</a></li>
                <li><a href="<?php echo base_url('admin/guest'); ?>">коментарии</a></li>
                <li> <a href="<?php echo base_url('admin/gallery'); ?>" >Галлерея</a></li>
                <li><a href="">----</a></li>
            </ul>
        </aside>
       <section id="page">
           <?php $this->load->view($subview); ?>
       </section>
           
      
        <div class="clear"></div>
    </section>
</div>




<script type="text/javascript" src="<?php echo site_url('js/admin/jquery.mjs.nestedSortable.js'); ?>"></script> 
<script type="text/javascript">
   tinymce.PluginManager.load('moxiecut', '/tmce4/plugins/moxiecut/plugin.min.js');
    tinymce.init({
        selector: ".moxiecut",
        theme: "modern",
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen textcolor",
            "insertdatetime colorpicker emoticons colorpicker media table contextmenu directionality youtube moxiecut"
        ],
           
        //toolbar: " code emoticons fullscreen | ltr rtl | styleselect | bullist numlist outdent indent || bold italic | alignleft aligncenter alignright alignjustify | forecolor backcolor | link insertfile image media youtube",
       
        toolbar: "newdocument fullscreen bold italic underline strikethrough |  ltr rtl | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect forecolor backcolor | cut copy paste bullist numlist outdent indent blockquote undo redo removeformat subscript superscript | link insertfile image media youtube",
        style_formats: [
        {title: 'Headers', items: [
            {title: 'Header H1', block: 'h1'},
            {title: 'Header H2', block: 'h2'},
            {title: 'Header H3', block: 'h3'},
            {title: 'Header H4', block: 'h4'},
            {title: 'Header H5', block: 'h5'},
            {title: 'Header H6', block: 'h6'}
        ]},


        {title: 'Blocks', items: [
            {title: 'p', block: 'p'},
            {title: 'div', block: 'div'},
            {title: 'span', block: 'span'},
            {title: 'pre', block: 'pre'}
        ]},

        {title: 'Containers', items: [
            {title: 'section', block: 'section', wrapper: true, merge_siblings: false},
            {title: 'article', block: 'article', wrapper: true, merge_siblings: false},
            {title: 'blockquote', block: 'blockquote', wrapper: true},
            {title: 'code', block: 'code', wrapper: true},
            {title: 'hgroup', block: 'hgroup', wrapper: true},
            {title: 'aside', block: 'aside', wrapper: true},
            {title: 'figure', block: 'figure', wrapper: true}
        ]}
        ],
        image_class_list: [
                {title: 'None', value: ''},
                {title: 'Dog', value: 'dog'},
                {title: 'Cat', value: 'cat'}
            ],


image_advtab: true,
        language : 'ru',
        media_alt_source: false,
        autosave_ask_before_unload: false,
        height: 500,
        statusbar: false,
        relative_urls: false,
        forced_root_block : false,
        force_br_newlines : true,
        force_p_newlines : false,
        visualblocks_default_state: true,
        verify_html : false,
        entity_encoding: 'raw'
    });
</script>

<script type="text/javascript" src="<?php echo site_url('js/admin/main.js'); ?>"></script>
</body>
</html>
