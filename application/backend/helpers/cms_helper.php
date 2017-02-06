<?php 


function password_generate($n)
{
  $symbol = array(
  'A','B','C','D','E','F',
  'G','H','I','J','K','L',
  'M','N','O','P','R','S',
  'T','U','V','X','Y','Z',
  '1','2','3','4','5','6',
  '7','8','9','0');

  $password="";

  for($i = 1; $i < $n; $i++)
      {
        $count=count($symbol);
        $index = rand(0,$count); 
        $password .= $symbol[$index];
      }

    $return['password'] = $password;
    $return['md5'] = md5($password);
    $return['hash'] = hash('sha512', $password. config_item('encryption_key'));
    
    return $return;
}


/**
 * [translits description]
 * @param  [type] $s [description]
 * @return [type]    [description]
 */
    function translits($s) {
        $s = (string) $s; // преобразуем в строковое значение
        $s = strip_tags($s); // убираем HTML-теги
        $s = str_replace(array("\n", "\r"), " ", $s); // убираем перевод каретки
        $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
        $s = trim($s); // убираем пробелы в начале и конце строки
        $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
        $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
        $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s); // очищаем строку от недопустимых символов
        $s = str_replace(" ", "-", $s); // заменяем пробелы знаком минус
    return $s; // возвращаем результат
    }

function news_link($article){
  return 'news/' . intval($article->id_news) . '/' . e($article->slug);
}

function news_slider_links($articles){
  $string = '<ul>';
  foreach ($articles as $article) {
    $url = news_link($article);
    $string .= '<li><div class="news_top_row">';
    $string .= '<div class="news_top_img"><img src="'.$article->img.'" alt=""></div>';
    $string .= '<h3>' . anchor($url, e($article->title)) .  ' ›</h3>';
   // $string .= '<p class="pubdate">' . e($article->pubdate) . '</p>';
    $string .= '</div></li>';
  }
  $string .= '</ul>';
  return $string;
}

                
            

function article_links($articles){
  $string = '<ul>';
  foreach ($articles as $article) {
    $url = news_link($article);
    $string .= '<li>';
    $string .= '<h3>' . anchor($url, e($article->title)) .  ' ›</h3>';
    $string .= '<p class="pubdate">' . e($article->pubdate) . '</p>';
    $string .= '</li>';
  }
  $string .= '</ul>';
  return $string;
}

function get_excerpt($article, $numwords = 50){
  $string = '';
  $url = news_link($article);
    $string .= '<img src="'.e($article->img).'" alt="'.e($article->title).'">';
  $string .= '<h2>' . anchor($url, e($article->title)) .  '</h2>';

  $string .= '<p class="pubdate">' . e($article->pubdate) . '</p>';
  $string .= '<p>' . e(limit_to_numwords(strip_tags($article->text), $numwords)) . '</p>';
  $string .= '<p>' . anchor($url, 'Читать далее ›', array('title' => e($article->title))) . '</p>';
  return $string;
}




function limit_to_numwords($string, $numwords){
  $excerpt = explode(' ', $string, $numwords + 1);
  if (count($excerpt) >= $numwords) {
    array_pop($excerpt);
  }
  $excerpt = implode(' ', $excerpt);
  return $excerpt;
}

    /**
     * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
     * @author Joost van Veen
     * @version 1.0
     */
    if (!function_exists('dump')) {
        function dump ($var, $label = 'Dump', $echo = TRUE)
        {
            // Store dump in variable 
            ob_start();
            var_dump($var);
            $output = ob_get_clean();
            
            // Add formatting
            $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
            $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';
            
            // Output
            if ($echo == TRUE) {
                echo $output;
            }
            else {
                return $output;
            }
        }
    }


    if (!function_exists('dump_exit')) {
        function dump_exit($var, $label = 'Dump', $echo = TRUE) {
            dump ($var, $label, $echo);
            exit;
        }
    }


function e($string){
  return  htmlspecialchars($string);
}

function get_menu ($array, $child = FALSE)
{
  $CI =& get_instance();
  $str = '';
  
  if (count($array)) {
    $str .= $child == FALSE ? '<ul class="nav">' . PHP_EOL : '<ul class="dropdown-menu">' . PHP_EOL;
    
    foreach ($array as $item) {
      
      $active = $CI->uri->segment(1) == $item['url_page'] ? TRUE : FALSE;
      if (isset($item['children']) && count($item['children'])) {
        $str .= $active ? '<li class="dropdown active">' : '<li class="dropdown">';
        $str .= '<a  class="dropdown-toggle" data-toggle="dropdown" href="' . site_url(e($item['url_page'])) . '">' . e($item['name']);
        $str .= '<b class="caret"></b></a>' . PHP_EOL;
        $str .= get_menu($item['children'], TRUE);
      }
      else {
        $str .= $active ? '<li class="active">' : '<li>';
        $str .= '<a href="' . site_url($item['url_page']) . '">' . e($item['name']) . '</a>';
      }
      $str .= '</li>' . PHP_EOL;
    }
    
    $str .= '</ul>' . PHP_EOL;
  }
  
  return $str;
}



function get_guest ($array, $child = FALSE)
{
  $CI =& get_instance();
  $str = '';
  
  if (count($array)) {
    $str .= $child == FALSE ? '<ul class="guest">' . PHP_EOL : '<ul class="dropdown_guest">' . PHP_EOL;
    
    foreach ($array as $item) {
      
    
      if (isset($item['children']) && count($item['children'])) {
        $str .= '<li class="dropdown">';
        $str .= '<p><span>'.e($item['date_init']).'</span> | '.e($item['name']).'</p> ';
        $str .= '<p class="caret">'.e($item['text']).'</p>' ;
        $str .= get_guest($item['children'], TRUE);
      }
      else {
        $str .= '<li>';
        $str .= '<p><span>'.e($item['date_init']).'</span> | '.e($item['name']).'</p>';
         $str .= '<p>'.e($item['text']).'</p>';
      }
      $str .= '<hr></li>' . PHP_EOL;
    }
    
    $str .= '</ul>' . PHP_EOL;
  }
  
  return $str;
}


















 ?>