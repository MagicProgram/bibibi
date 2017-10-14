<?php  
namespace backend\models\validate;

use yii\validators\Validator;




class PhoneValidate extends Validator {
				
		//$model - принимаем из Validator
		//$attribute- принимаем из Validator

	function validateAttribute($model,$attribute)
	{
		
	    //проверка на пустоту
	    if (empty($model->$attribute)) {
	    return true;
	    }
	    
	    $phones = '';
	    
	    //explode - формирует массив из строки.
	    $phone = explode( ',' , $model->$attribute);
	    
	    foreach ($phone as $key) {
	        //preg_replace — Выполняет поиск и замену по регулярному выражению
	        //удоляем не нужные символы.
	        $phone = preg_replace("/[^0-9]/", "", $key);
	        //записываем телефон в нужный формат по регулярным выражениям;
	        if (strlen($phone) == 10) {
	         $phones .= preg_replace("/([0-9]{3})([0-9]{3})([0-9]{2})([0-9]{2})/", "+7 ($1) $2-$3-$4", $phone) . ', ';
	        //strlen — Возвращает длину строки
	        }  elseif (strlen($phone) == 11) {
	            $phones .= preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{2})([0-9]{2})/", "+$1 ($2) $3-$4-$5", $phone) . ', ';
	        }
	        
	    }
	    //substr — Возвращает подстроку.
	    //убираем запятую после последнего номера
	    $phones = substr($phones,0,-2);

		$model->$attribute = $phones;

	    return true;
	}
}





?>