<?php
namespace frontend\components;

use yii\base\Component;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;
use Yii;

class Common extends Component{

    const EVENT_NOTIFY = 'notify_admin';

    public function sendMail($subject,$body,$email="optimus58@mail.ru",$name=''){
        \Yii::$app->mail->compose()
            ->setFrom([ \Yii::$app->params['supportEmail'] => \Yii::$app->name])
            ->setTo([$email => $name])
            ->setSubject($subject)
            ->setTextBody($body)
            ->send();

        $this->trigger(self::EVENT_NOTIFY);
    }

    public function notifyAdmin($event){

        print "Notify Admin";
    }


    public static function getTitleAdvert($data){

        return $data['bedroom'].' Bed Rooms and '.$data['kitchen'].' Kitchen Room Aparment on Sale';
    }

    public static function getImageAdvert($data,$general = true){

        $image = [];
        $base = '/';
        if($general){

            $image[] = $base.'uploads/adverts/'.$data['idadvert'].'/general/small_'.$data['general_image'];
        }
        else{
            $path = \Yii::getAlias("@frontend/web/uploads/adverts/".$data['idadvert']);
            $files = BaseFileHelper::findFiles($path);

            foreach($files as $file){
                if (strstr($file, "small_") && !strstr($file, "general")) {
                    $image[] = $base . 'uploads/adverts/' . $data['idadvert'] . '/' . basename($file);
                }
            }
        }

        return $image;
    }

    public static function substr($text,$start=0,$end=50){

        return mb_substr($text,$start,$end);
    }

    public static function getType($row){
        return ($row['sold']) ? 'Sold' : 'New';
    }

    public function getUrlAdvert($row){

        return Url::to(['/main/main/view-advert', 'id' => $row['idadvert']]);
    }

    public function getCity(){

        $url = Yii::$app->request->url;
        $url = explode('/', $url);
        $url = explode('?', $url['1']);
        return (string)$url['0'];
    }


    // Установка дескрипшена
        // $data - строка description
        // $generate - массив для генерации
        // $data - для какой вьюшки генерировать description
    public function setDescription($data = '', $generate = '', $view = ''){

        if ($data != '') {
            Yii::$app->params['seo']['description'] = $data;
        }

        if ($data == '' && $generate != '' && $view == 'view') {
            Yii::$app->params['seo']['description'] = 
                                        'Описание школы боевых искусств ' . 
                                        $generate['name'] . ' ' . $generate['city'] .
                                        '. Адрес, телефоны, расписание. Виды боевых искусств которые преподаются в школе.';
        }
 
    }

    // получение дескрипшена
    public function getDescription(){

        // print_r(array_key_exists('seo', Yii::$app->params));die;

        if (array_key_exists('seo', Yii::$app->params) 
            && array_key_exists('description', Yii::$app->params['seo']))
        {

            return Yii::$app->params['seo']['description'];

        } else {

            return '';

        }
    }




    // Установка тайтла
        // $data - строка тайтла
        // $generate - массив для генерации
        // $data - для какой вьюшки генерировать тайтл
    public function setTitle($data = '', $generate = '', $view = ''){

        if ($data != '') {
            Yii::$app->params['seo']['title'] =  $data;
        }

        if ($data == '' && $generate != '' && $view == 'view') {
            Yii::$app->params['seo']['title'] = $generate['name'] . ' в ' . $generate['city'] .
                                        '. Информация о школе боевых искусств';
        }
 
    }

    // получение дескрипшена
    public function getTitle(){

        if (array_key_exists('seo', Yii::$app->params) 
            && array_key_exists('title', Yii::$app->params['seo']))
        {

            return Yii::$app->params['seo']['title'];

        } else {

            return '';

        }
    }

}