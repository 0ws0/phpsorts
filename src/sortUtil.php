<?php
namespace UsualSortUtil;

class PhpSort
{

    /*
     *冒泡排序
     *对需要排序的数组从后往前（逆序）进行多遍的扫描，当发现相邻的两个数值的次序与排序要求的规则不一致时，
     *就将这两个数值进行交换。这样比较小（大）的数值就将逐渐从后面向前面移动。
     */
    function boubleSort($arr)
    {
        //先判断是否需要继续进行
        $length = count($arr);

        if ($length <= 1) {
            return $arr;
        }

        for ($i = 0; $i < $length; $i++) {
            for ($j = 0; $j < $length - $i - 1; $j++) {

                if ($arr[$j] > $arr[$j + 1]) {
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                }

            }

        }

        return $arr;
    }

    /*
     *快速排序
     *在数组中挑出一个元素（多为第一个）作为标尺，扫描一遍数组将比标尺小的元素排在标尺之前，
     *将所有比标尺大的元素排在标尺之后，通过递归将各子序列分别划分为更小的序列直到所有的序列顺序一致。
     */
    function quickSort($arr)
    {
        //先判断是否需要继续进行
        $length = count($arr);

        if ($length <= 1) {
            return $arr;
        }

        $base_num = $arr[0];//选择一个标尺 选择第一个元素

        //初始化两个数组
        $left_array = array();//小于标尺的

        $right_array = array();//大于标尺的

        for ($i = 1; $i < $length; $i++) {      //遍历 除了标尺外的所有元素，按照大小关系放入两个数组内
            if ($base_num > $arr[$i]) {
                //放入左边数组
                $left_array[] = $arr[$i];
            } else {
                //放入右边
                $right_array[] = $arr[$i];
            }
        }
        //再分别对 左边 和 右边的数组进行相同的排序处理方式

        //递归调用这个函数,并记录结果
        $left_array = $this->quickSort($left_array);

        $right_array = $this->quickSort($right_array);

        //合并左边 标尺 右边
        return array_merge($left_array, array($base_num), $right_array);
    }

    /*
     *选择排序
     *实现思路 双重循环完成，外层控制轮数，当前的最小值。内层 控制的比较次数
     */
    function selectSort($arr)
    {
        $len = count($arr);

        //$i 当前最小值的位置， 需要参与比较的元素
        for ($i = 0; $i < $len - 1; $i++) {
            //先假设最小的值的位置
            $p = $i;
            //$j 当前都需要和哪些元素比较，$i 后边的。
            for ($j = $i + 1; $j < $len; $j++) {
                //$arr[$p] 是 当前已知的最小值
                if ($arr[$p] > $arr[$j]) {
                    //比较，发现更小的,记录下最小值的位置；并且在下次比较时，应该采用已知的最小值进行比较。
                    $p = $j;
                }
            }
            //已经确定了当前的最小值的位置，保存到$p中。
            //如果发现 最小值的位置与当前假设的位置$i不同，则位置互换即可
            $tmp = $arr[$p];
            $arr[$p] = $arr[$i];
            $arr[$i] = $tmp;
        }

        return $arr;//返回最终结果
    }

    /*
     * 二分查找
     * 假设数据是按升序排序的，对于给定值x，从序列的中间位置开始比较，如果当前位置值等于x，则查找成功；
     * 若x小于当前位置值，则在数列的前半段中查找；若x大于当前位置值则在数列的后半段中继续查找，直到找到为止。
     *（数据量大的时候使用）
     */
    function halfSearch($arr, $low, $high, $k)
    {
        if ($low <= $high) {
            $mid = intval(($low + $high) / 2);

            if ($arr[$mid] == $k) {
                return $mid;
            } else if ($k < $arr[$mid]) {
                return $this->halfSearch($arr, $low, $mid - 1, $k);
            } else {
                return $this->halfSearch($arr, $mid + 1, $high, $k);
            }
        }

        return -1;
    }

    /**
     *顺序查找
     *基本思想：
     *从数组的第一个元素开始一个一个向下查找，如果有和目标一致的元素，查找成功；如果到最后一个元素仍没有目标元素，则查找失败。
     */
    public function querySearch($arr, $val)
    {
        foreach ($arr as $k => $v) {
            if ($v == $val) {
                return $k;
            }
        }

        return -1;
    }

}
