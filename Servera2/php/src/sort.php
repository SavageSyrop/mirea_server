<?php
function quickSort($arr)
{
    // count () возвращает количество элементов в массиве
    $count = count($arr);
 
         // Определяем, нужна ли сортировка (исключая не массив, а количество элементов массива меньше или равно 1)
    if($count<=1) return $arr;
 
         // Определяем промежуточное значение, которое является ссылочным значением
    $baseValue = $arr[0];
    /**
           * Определить два пустых массива для разделения исходного массива слева и справа
           * $ leftArr хранит массив меньше, чем эталонное значение, которое является левым разделом
           * $ rightArr хранит массив больше, чем эталонное значение, которое является правильным разделом
     */
 
    $leftArr = $rightArr = array();
 
         // Сравнить среднее значение массива, обратить внимание на значение $ i, начиная с 1 (или $ i = 0; $ i <$ count-1)
    for ($i=1;$i<$count;$i++){
        if($baseValue>$arr[$i]){
                         // Меньше значения эталона помещается в левый раздел
            $leftArr[] = $arr[$i];
        }else{
                         // Меньше, чем эталонное значение помещается в правильный раздел
            $rightArr[] = $arr[$i];
        }
    }
 
         // Рекурсивная сортировка подпоследовательностей элементов, меньших, чем контрольное значение, и подпоследовательностей элементов, превышающих контрольное значение
    $leftArr = quickSort($leftArr);
    $rightArr = quickSort($rightArr);
 
         // Возвращаем объединенный и отсортированный массив, помещаем значения эталона в массив и объединяем их вместе, обращаем внимание на порядок, левый раздел помещается впереди, значение эталона размещается посередине, а правый раздел помещается сзади
    return array_merge($leftArr,array($baseValue),$rightArr);
}
 
$arr = [1488, 228, 54, 27, 1337, 2001, 9, 11];
$arr = quickSort($arr);
for ($cock=0; $cock<count($arr); $cock++){
    echo($arr[$cock]);
    echo " ";
}
?>