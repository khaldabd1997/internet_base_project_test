<?php

function validate($tc, $name, $surname, $position, $mobile, $image, $email){
    $ret = '';

    if (!preg_match("/^[0-9]*$/", $tc) ){  
        $ret .= '\nTC must be only digits';
    }
    if (!(strlen($tc)>=8 and  strlen($tc)<=12)){  
        $ret .= '\nTC must be 8 to 12 digits';
    }
    if (!preg_match("/^[a-zA-Z ]*$/", $name) ){  
        $ret .= '\nName must be only letters';
    }
    if (strlen($name) < 1){  
        $ret .= '\nPlease enter the name';
    }
    if (!preg_match("/^[a-zA-Z ]*$/", $surname) ){  
        $ret .= '\nName must be only letters';
    }
    if (strlen($surname) < 1){  
        $ret .= '\nPlease enter the surname';
    }
    if (strlen($position) < 1){  
        $ret .= '\nPlease choose the position';
    }
    if (!preg_match("/^[0-9]*$/", $mobile) ){  
        $ret .= '\nNumber must be only digits';
    }
    if (!(strlen($mobile)>=8 and  strlen($mobile)<=12)){  
        $ret .= '\nNumber must be 8 to 12 digits';
    }
    if (strlen($email) < 1){  
        $ret .= '\nPlease enter the surname';
    }
    /*if(strlen($image) < 1){
        $ret .= '\nPlease select an image';
    }*/

    return /*'';//*/substr($ret, 2);
}