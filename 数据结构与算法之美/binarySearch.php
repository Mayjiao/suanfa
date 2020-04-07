<?php
//递归实现
function binarySearch($numbers, $low, $high, $value)
{
    if ($low > $high) {
	    return -1;
	}
    
	//如果low和high比较大的话，两者之和就有可能会溢出。改进的方法是将mid的计算方式写成low+(high-low)/2
	//我们可以将这里的除以2操作转化成位运算low+((high-low)>>1)。因为相比除法运算来说，计算机处理位运算要快得多
	$mid = $low + (($high - $low) >> 1);
	if ($numbers[$mid] > $value) {
	    return binarySearch($numbers, $low, $mid-1, $value);
	} elseif ($numbers[$mid] < $value) {
	    return binarySearch($numbers, $mid+1, $high, $value);
	} else {
	    return $mid;
	}
}


//非递归实现
function binarySearch2($numbers, $low, $high, $value)
{
    while ($low <= $high) {
	    $mid = intval(($low + $high)/2);
		if ($numbers[$mid] == $value) {
		    return $mid;
		} elseif ($numbers[$mid] > $value) {
		    $high = $mid - 1;
		} else {
		    $low = $mid + 1;
		}
		return -1;
	}
}

//求算术平方根
function squareRoot($number)
{
    if ($number < 0) {
	    return -1;
	} elseif ($number < 1) {
	    $max = 1;
		$min = $number;
	} else {
	    $max = $number;
		$min = 1;
	}
	$mid = $min + ($max-$min)/2;
    while (getDecimalPlaces($mid) < 6) {
        $square = $mid * $mid;
        if ($square > $number) {
            $max = $mid;
        } elseif ($square < $number) {
            $min = $mid;
        } else {
            return $mid;
        }
        $mid = $min + ($max-$min)/2;
    }   
    return $mid;
}

function getDecimalPlaces($number)
{
    $temp = explode('.', $number);
    if (isset($temp[1])) {
        return strlen($temp[1]);
    }

    return 0;
}

$arr = array(1,2,5,7,8,9);
$result = binarySearch($arr, 0, 5, 7);
$result2 = binarySearch2($arr, 0, 5, 5);
var_dump($result);
var_dump($result2);
$squareroot = squareRoot(3);
var_dump($squareroot);
