<?php
//冒泡排序
function bubbleSort(&$arr)
{
    $length = count($arr);
	if ($length <= 1) {
	    return;
	}

	for ($i = 0; $i < $length; $i++) {
	    $flag = false;
		for ($j = 0; $j < $length-$i-1; $j++) {
		    if ($arr[$j] > $arr[$j+1]) {
			    $tmp = $arr[$j];
				$arr[$j] = $arr[$j+1];
				$arr[$j+1] = $tmp;
				$flag = true;
			}
		}
		if (!$flag) {
		    break;
		}
	}
}

//插入排序
function insertionSort(&$arr)
{
    $n = count($arr);
	if ($n <= 1) {
	    return;
	}

	for ($i = 1; $i < $n; ++$i) {
	    $value = $arr[$i];
		$j = $i - 1;
		for (; $j >= 0; --$j) {
		    if ($arr[$j] > $value) {
			    $arr[$j+1] = $arr[$j];
			} else {
			    break;
			}
		}
		$arr[$j+1] = $value;
	}
}

//选择排序
function selectionSort(&$arr) 
{
    $length = count($arr);
	if ($length <= 1) {
	    return false;
	}

	for ($i = 0; $i < $length; $i++) {
	    //假设最小值的位置
		$p = $i;
		for ($j = $i + 1; $j < $length; $j++) {
		    if ($arr[$p] > $arr[$j]) {
			    $p = $j;
			}
		}
		$tmp = $arr[$p];
		$arr[$p] = $arr[$i];
		$arr[$i] = $tmp;
	}
}

//快速排序
function quickSort($arr)
{
    $count = count($arr);
    if ($count < 2) {
        return $arr;
    }
    //创建临时数组，以基准值为分界线，大于基准值的放在右侧，小鱼基准值的放在左侧
    $leftArr = $rightArr = array();
    //基准值，一般取数组第一个元素
    $middle = $arr[0];
    //循环数组与基准值比较
    for ($i = 1; $i < $count; $i++) {
        if ($arr[$i] < $middle) {
            $leftArr[] = $arr[$i];
        } else {
            $rightArr[] = $arr[$i];
        }
    }
    //递归，将左右数组排序
    $leftArr = quickSort($leftArr);
    $rightArr = quickSort($rightArr);

    //将排好序的临时数组合并
    return array_merge($leftArr, array($middle), $rightArr);

}

$bubbleArr = array(4,5,6,3,2,1);
bubbleSort($bubbleArr);
var_dump($bubbleArr);

$insertArr = array(4,5,6,1,3,2);
insertionSort($insertArr);
var_dump($insertArr);

$selectArr = array(7,6,5,3,4,1);
selectionSort($selectArr);
var_dump($selectArr);

$quickArr = array(9,8,6,4,2,1);
quickSort($quickArr);
var_dump($quickArr);
