<?php
/**
 * Created by PhpStorm.
 * User: playboy
 * Date: 18/8/3
 * Time: 11:06
 */


/**
 * 根据用户id生成邀请码
 */
function createInvitationCode($user_id){

    static $source_string = '4B1NOPIJ2RSTUV67MWX89KLYZE5FCDG3HQA';  //
    $num = $user_id;
    $code = '';

    while($num > 0){
        $mod = $num % 35;
        $num = ($num - $mod) / 35;
        $code = $source_string[$mod].$code;
    }

    if(empty($code[3])){
        $code = str_pad($code,4,'0',STR_PAD_LEFT);
    }

    return $code;
}

/**
 * 根据邀请码推算出用户id
 */
function decodeInvitationCode($code) {

    static $source_string = '4B1NOPIJ2RSTUV67MWX89KLYZE5FCDG3HQA';

    if (strrpos($code, '0') !== false)
    $code = substr($code, strrpos($code, '0')+1);
    $len = strlen($code);
    $code = strrev($code);
    $num = 0;

    for ($i=0; $i < $len; $i++) {
        $num += strpos($source_string, $code[$i]) * pow(35, $i);
    }

    return $num;

}


