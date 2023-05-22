<?php

function validate($name, $date, $time, $duration, $lecturer){
    $ret = '';

    if (strlen($name) < 1){  
        $ret .= '\nPlease enter a name';
    }
    if (strlen($date) < 1){  
        $ret .= '\nPlease enter a date';
    }
    if (strlen($time) < 1){  
        $ret .= '\nPlease enter a time';
    }
    if (strlen($duration) < 1){  
        $ret .= '\nPlease enter a duration';
    }
    if (strlen($lecturer) < 1){  
        $ret .= '\nPlease enter a lecturer';
    }

    return /*'';//*/substr($ret, 2);
}