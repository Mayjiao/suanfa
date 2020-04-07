<?php
//查找第一个等于value的元素
function findFirstEqual(array $numbers, $value)
{
    $length = count($numbers);
    $low = 0;
    $high = $length -1;
    while ($low <= $high) {
        $mid = $low + (($high - $low)>>1);
        if ($numbers[$mid] > $value) {
            $high = $mid - 1;
        } elseif ($numbers[$mid] < $value) {
            $low = $mid + 1;
        } else {
            if ($mid == 0 || $numbers[$mid-1] != $value) {
                return $mid;
            } else {
                $high = $mid -1;
            }
        }
    }
    return -1;
}

//查找最后一个等于value的元素
function findLastEqual(array $numbers, $value)
{
    $length = count($numbers);
    $low = 0;
    $high = $length -1;
    while ($low <= $high) {
        $mid = $low + (($high - $low)>>1);
        if ($numbers[$mid] > $value) {
            $high = $mid - 1;
        } elseif ($numbers[$mid] < $value) {
            $low = $mid + 1;
        } else {
            if ($mid == $length-1 || $numbers[$mid+1] != $value) {
                return $mid;
            } else {
                $high = $mid + 1;
            }
        }
    }
    return -1;
}

//查找第一个大于等于value的元素
function findFirstGreaterEqual(array $numbers,$find) 
{
    $length = count($numbers);
    $low = 0;
    $high = $length - 1;
    while($low <= $high) {
        $mid = $low + (($high-$low)>>1);
        if($numbers[$mid] >= $find) {
            if ($mid == 0 || $numbers[$mid-1] < $find) {
                return $mid;
            }else {
                $high = $mid - 1;
            }
        }else  {
            $low  = $mid + 1;
        }
    }
    return -1;
}

//找到最后一个小于等于find的元素
function findLastLessEqual(array $numbers,$find) {
    $length = count($numbers);
    $low = 0;
    $high = $length - 1;
    while($low <= $high) {
        $mid = $low + (($high-$low)>>1);
        if($numbers[$mid] <= $find) {
           if($mid==$length-1 || $numbers[$mid+1]> $find) {
               return $mid;
           }
           $low = $mid + 1;
        }else  {
            $high = $mid - 1;
        }
    }
    return -1;
}


$arr = array(1,2,3,3,3,4,5);
var_dump(findFirstEqual($arr, 3));
