<?php
/**
 * core file : /eyoom/core/board/write_update.head.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 글등록 회수 제한이 있는지 체크
 */
if ($w=='' && $eyoom_board['bo_write_limit'] && !$is_admin) {
    if (!$is_member) {
        alert("비회원은 본 게시판에 글을 작성하실 수 없습니다.");
    } else {
        $wr_limit = sql_fetch("select count(*) as cnt from {$write_table} where wr_id = wr_parent and (mb_id = '{$member['mb_id']}' or wr_ip = '" . $_SERVER['REMOTE_ADDR'] . "') and wr_datetime between '" . date('Y-m-d') . " 00:00:00' and '" . date('Y-m-d') . " 23:59:59' ");
        if ($wr_limit['cnt'] >= $eyoom_board['bo_write_limit']) {
            alert("[{$board['bo_subject']}]에는 하루에 {$eyoom_board['bo_write_limit']}개의 글을 작성하실 수 있습니다.");
        }
    }
}

/**
 * 한줄게시판 - 비회원 글수정일 경우 비밀번호 확인
 */
if (isset($_POST['bbs_no_view']) && $_POST['bbs_no_view'] == '1' && $w == 'u') {
    if (!$is_admin) {
        $write = sql_fetch("select mb_id, wr_password from {$write_table} where wr_id = '{$wr_id}' ");
        if (!$write['mb_id']) {
            if (!check_password($_POST['wr_password'], $write['wr_password'])) {
                alert('비밀번호가 틀립니다.');
            }
        }
    }
}

/**
 * 투표마감일 설정
 */
if ($eyoom_board['bo_use_addon_poll'] == '1') {
    $wr_poll_use = (int) clean_xss_tags(trim($_POST['wr_poll_use']));

    $wr_poll_limit  = isset($_POST['poll_limit_date']) ? clean_xss_tags(trim($_POST['poll_limit_date'])) : '0000-00-00';
    if ($wr_poll_use == '1' && $wr_poll_limit == '0000-00-00') {
        alert("투표 종료일을 설정해 주세요.");
    } else {
        $wr_poll_limit .= isset($_POST['poll_limit_hour'])   ? ' '.clean_xss_tags(trim($_POST['poll_limit_hour']))   : ' 00';
        $wr_poll_limit .= isset($_POST['poll_limit_minute']) ? ':'.clean_xss_tags(trim($_POST['poll_limit_minute'])) : ':00';
        $wr_poll_limit .= isset($_POST['poll_limit_second']) ? ':'.clean_xss_tags(trim($_POST['poll_limit_second'])) : ':00';

        $wr_poll_result = isset($_POST['wr_poll_result'])   ? clean_xss_tags(trim($_POST['wr_poll_result'])) : '';
        $wr_poll_text   = isset($_POST['wr_poll_text'])     ? clean_xss_tags(trim($_POST['wr_poll_text']))   : '';
        $wr_poll_video  = isset($_POST['wr_poll_video'])    ? clean_xss_tags(trim($_POST['wr_poll_video']))  : '';
    }
}

/**
 * 게시판 스킨파일
 */
@include_once($eyoom_skin_path['board'].'/write_update.head.skin.php');

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/board/write_update.head.skin.php');