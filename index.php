<?php
define('PATH', $_SERVER['DOCUMENT_ROOT']);
define('BASE_URL', 'http://anthony-diaz');
include(PATH.'/vendor/autoload.php');

$parse_url = explode('/', $_SERVER['REQUEST_URI']);
// dump($parse_url);
$controller = !empty($parse_url[1]) ? $parse_url[1] : 'home';
$action = isset($parse_url[2]) ? $parse_url[2] : false;
$id_article_parse = isset($parse_url[3]) ? $parse_url[3] : false;
$id_article = intval($id_article_parse);
// dump($controller);
// dump($_SESSION);


switch($controller){
    case('home'):
        include(PATH.'/app/view/core/head.php');
        include(PATH.'/app/view/core/nav.php');
        include(PATH.'/app/view/home.php');
        include(PATH.'/app/view/core/footer.php');
        break;
    case('projets'):
        include(PATH.'/app/view/core/head.php');
        include(PATH.'/app/view/core/nav.php');
        include(PATH.'/app/view/projets.php');
        include(PATH.'/app/view/core/footer.php');
        break;
    case('veille'):
        include(PATH.'/app/view/core/head.php');
        include(PATH.'/app/view/core/nav.php');
        include(PATH.'/app/view/veille.php');
        include(PATH.'/app/view/core/footer.php');
        break;
    case('ajax_contact'):
        include(PATH.'/app/src/ajax_contact.php');
        break;
    default:
        include(PATH.'/app/view/core/head.php');
        include(PATH.'/app/view/core/404.php');
        break;
}

?>
