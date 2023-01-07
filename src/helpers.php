<?php

function array_cartesian() {
    $_ = func_get_args();
    if(count($_) == 0)
        return array(array());
    $a = array_shift($_);
    $c = call_user_func_array(__FUNCTION__, $_);
    $r = array();
    foreach($a as $v)
        foreach($c as $p)
            $r[] = array_merge(array($v), $p);
    return $r;
}

function getCombination( $array ){
    $a = $array[0];
    for($i = 1 ; $i < sizeof($array); $i++)
    {
        $a = array_cartesian($a, $array[$i]);
        $combination= [];
        foreach ($a as $b ){
            sort($b);
            $combination[] = implode( ',', $b );
        }
        $a = $combination;
    }
    return $a;
}

?>
