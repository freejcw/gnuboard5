<?php
if (!defined('_GNUBOARD_')) exit;

$begin_time = get_microtime();

include_once(G5_PATH.'/head.sub.php');

function print_menu1($key, $no)
{
    global $menu;

    $str = print_menu2($key, $no);

    return $str;
}

function print_menu2($key, $no)
{
    global $menu, $auth_menu, $is_admin, $auth, $g5;

    $str .= "<ul class=\"gnb_2dul\">";
    for($i=1; $i<count($menu[$key]); $i++)
    {
        if ($is_admin != 'super' && (!array_key_exists($menu[$key][$i][0],$auth) || !strstr($auth[$menu[$key][$i][0]], 'r')))
            continue;

        if ($menu[$key][$i][4] == 1 && $gnb_grp_style == false) $gnb_grp_div = 'gnb_grp_div';
        else if ($menu[$key][$i][4] != 1 && $gnb_grp_style == true) $gnb_grp_div = 'gnb_grp_div';
        else $gnb_grp_div = '';

        if ($menu[$key][$i][4] == 1) $gnb_grp_style = 'gnb_grp_style';
        else $gnb_grp_style = '';

        $str .= '<li class="gnb_2dli"><a href="'.$menu[$key][$i][2].'" class="gnb_2da '.$gnb_grp_style.' '.$gnb_grp_div.'">'.$menu[$key][$i][1].'</a></li>';

        $auth_menu[$menu[$key][$i][0]] = $menu[$key][$i][1];
    }
    $str .= "</ul>";

    return $str;
}
?>

<script>
var tempX = 0;
var tempY = 0;

function imageview(id, w, h)
{

    menu(id);

    var el_id = document.getElementById(id);

    //submenu = eval(name+".style");
    submenu = el_id.style;
    submenu.left = tempX - ( w + 11 );
    submenu.top  = tempY - ( h / 2 );

    selectBoxVisible();

    if (el_id.style.display != 'none')
        selectBoxHidden(id);
}
</script>

<div id="to_content"><a href="#container">본문 바로가기</a></div>

<header id="hd">
    <div id="hd_wrap">
        <h1><?php echo $config['cf_title'] ?></h1>

        <div id="logo"><a href="<?php echo G5_ADMIN_URL ?>"><img src="<?php echo G5_ADMIN_URL ?>/img/logo.jpg" alt="<?php echo $config['cf_title'] ?> 관리자"></a></div>

        <ul id="tnb">
            <li><a href="<?php echo G5_ADMIN_URL ?>/member_form.php?w=u&amp;mb_id=<?php echo $member['mb_id'] ?>">관리자정보</a></li>
            <li><a href="<?php echo G5_ADMIN_URL ?>/config_form.php">환경설정</a></li>
            <li><a href="<?php echo G5_URL ?>/">홈페이지</a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
        </ul>

        <nav id="gnb">
            <h2>관리자 주메뉴</h2>
            <script>$('#gnb').addClass('gnb_js');</script>
            <?php
            $gnb_str = "<ul id=\"gnb_1dul\">";
            foreach($amenu as $key=>$value) {
                $href1 = $href2 = '';
                if ($menu['menu'.$key][0][2]) {
                    $href1 = '<a href="'.$menu['menu'.$key][0][2].'" class="gnb_1da">';
                    $href2 = '</a>';
                } else {
                    continue;
                }
                $current_class = "";
                if (isset($sub_menu) && (substr($sub_menu, 0, 2) == substr($menu['menu'.$key][0][0], 0, 2)))
                    $current_class = " gnb_1dli_air";
                $gnb_str .= '<li class="gnb_1dli'.$current_class.'">'.PHP_EOL;
                $gnb_str .=  $href1 . $menu['menu'.$key][0][1] . $href2;
                $gnb_str .=  print_menu1('menu'.$key, 1);
                $gnb_str .=  "</li>";
                if ($current_class) $current_class = ""; // 클래스 반복부여 방지
            }
            $gnb_str .= "</ul>";
            echo $gnb_str;
            ?>
        </nav>
    </div>

</header>

<div id="wrapper">

    <!-- <ul id="qnb">
        <li><a href="<?php echo G5_ADMIN_URL ?>/member_list.php">회원</a></li>
        <li><a href="<?php echo G5_ADMIN_URL ?>/board_list.php">게시판</a></li>
        <li><a href="<?php echo G5_ADMIN_URL ?>/visit_list.php">접속자</a></li>
    </ul> -->

    <div id="container">
        <div id="text_size">
            <!-- font_resize('엘리먼트id', '제거할 class', '추가할 class'); -->
            <button onclick="font_resize('container', 'ts_up ts_up2', '');">기본</button>
            <button onclick="font_resize('container', 'ts_up ts_up2', 'ts_up');">크게</button>
            <button onclick="font_resize('container', 'ts_up ts_up2', 'ts_up2');">더크게</button>
        </div>
        <h1><?php echo $g5['title'] ?></h1>
