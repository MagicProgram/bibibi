<?php  
namespace backend\models\validate;

use yii\validators\Validator;
use yii\helpers\Inflector;



class UrlValidate extends Validator {
				
		//$model - принимаем из Validator
		//$attribute- принимаем из Validator

	function validateAttribute($model, $attribute)
	{
		
	    //проверка на пустоту
	    if ($model->$attribute == '') {

	   		$model->$attribute = 'dsdsdsdds';

	   		return true;

	    } else {

	    $url = Inflector::transliterate($model->name);
	    
	    $model->$attribute = $url;

	    return true;

		}
	    
	}
}





?>