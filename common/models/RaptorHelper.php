<?php
/**
 * Created by PhpStorm.
 * User: Zodiac
 * Date: 22.03.2019
 * Time: 14:48
 */

namespace common\models;


use Yii;
use yii\helpers\Url;

class RaptorHelper
{
    public static function fileUpload($module = 'article', $controller = 'default') {
        $preview = $config = $errors = [];
        $newShortUrl = '';
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
        $input = 'fileUpload';
        if (empty($_FILES[$input])) {
            return [];
        }
        $total = is_array($_FILES[$input]['name']) ? count($_FILES[$input]['name']) : 1;
        $path = Yii::getAlias('@common') . '/../static/'.$module.'/';
        $dir = md5(date('m.Y'));
        if (!file_exists($path . $dir)) {
            mkdir($path . $dir, 0777);
        }
        for ($i = 0; $i < $total; $i++) {
            $tmpFilePath = $_FILES[$input]['tmp_name'][$i];
            $fileName = $_FILES[$input]['name'][$i];
            $fileSize = $_FILES[$input]['size'][$i];
            if ($tmpFilePath != ""){
                $newFilePath = $path . $dir . '/'. $fileName;
                $newFileUrl = $protocol . Yii::$app->params['fileStore'] . '/'.$module.'/' . $dir . '/' . $fileName;
                $newShortUrl = '/'.$module.'/' . $dir . '/' . $fileName;

                //Upload the file into the new path
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $fileId = $fileName . $i; // some unique key to identify the file
                    $preview[] = $newFileUrl;
                    $_SESSION['upload_files'][] = $newFileUrl;
                    $config[] = [
                        'key' => $newShortUrl,
                        'caption' => $fileName,
                        'size' => $fileSize,
                        'downloadUrl' => $newFileUrl, // the url to download the file
                        'url' => Url::to(['/'.$module.'/'.$controller.'/removefile'])
                    ];
                } else {
                    $errors[] = $fileName;
                }
            } else {
                $errors[] = $fileName;
            }
        }

        $out = ['initialPreview' => $preview, 'initialPreviewConfig' => $config, 'initialPreviewAsData' => true, 'urlForSave' => $newShortUrl];
        if (!empty($errors)) {
            $img = count($errors) === 1 ? 'file "' . $errors[0]  . '" ' : 'files: "' . implode('", "', $errors) . '" ';
            $out['error'] = 'Oh snap! We could not upload the ' . $img . 'now. Please try again later.';
        }
        
        return $out;
    }

    public static function fileRemove() {
        $file = Yii::getAlias('@common') . '/../static' . Yii::$app->request->post('key');
        if (file_exists($file)) {
            if (unlink($file)) {
                return [
                    'message' => Yii::t('art_mod', 'ARTICLE_FILE_DELETED')
                ];
            } else {
                return [
                    'error' => true
                ];
            }
        } else {
            return [
                'message' => Yii::t('art_mod', 'ARTICLE_FILE_DELETED')
            ];
        }
    }
}
