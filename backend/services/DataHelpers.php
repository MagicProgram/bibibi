<?php

namespace backend\services;

use dosamigos\transliterator\TransliteratorHelper;
use yii\helpers\BaseInflector;

class DataHelpers {

	public static function cyrSlug($string) {

			$translit = TransliteratorHelper::process($string);
			return BaseInflector::slug($translit);
	}
}