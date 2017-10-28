<?php

namespace backend\services;

use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;


class ImageUploader {

	public static function uploadTo($file, $path, $id) {

		$this->path

		$file = UploadedFile::getInstance($model, 'file');
        if ($file && $file->tempName) {
            $model->file = $file;
            if ($model->validate(['file'])) {
                
                $model->save(false);

                $school_id = $model->id;
                
                $dir = Yii::getAlias('@frontend/web/images/schools/'.$school_id . '/');
                Yii::$app->controller->createDirectory($dir);
                $fileName = $model->url . '_' . $school_id . '.' . $model->file->extension;
                $model->file->saveAs($dir . $fileName);
                $model->file = $fileName; // без этого ошибка
                $model->general_image = '/images/schools/' . $school_id . '/' . $fileName;
                    // Для ресайза фотки до 800x800px по большей стороне надо обращаться 
                    // к функции Box() или widen, так как в обертках доступны только 5 простых 
                    // функций: crop, frame, getImagine, setImagine, text, thumbnail, watermark
                $photo = Image::getImagine()->open($dir . $fileName);
                $photo->thumbnail(new Box(800, 800))->save($dir . $fileName, ['quality' => 90]);
                    //$imagineObj = new Imagine();
                    //$imageObj = $imagineObj->open(\Yii::$app->basePath . $dir . $fileName);
                    //$imageObj->resize($imageObj->getSize()->widen(400))->save(\Yii::$app->basePath . $dir . $fileName);
                
                // Yii::$app->controller->createDirectory(Yii::getAlias('/frontend/web/images/schools/'.$school_id.'/thumbs')); 
                // Image::thumbnail($dir . $fileName, 150, 70)
                // ->save(Yii::getAlias($dir .'thumbs/'. $fileName), ['quality' => 80]);
            }
        }
	}
}