<?php
/**
 * Created by PhpStorm.
 * User: Zodiac
 * Date: 22.03.2019
 * Time: 14:48
 */

namespace common\models;


use Yii;

class RaptorHelper
{
    public static function fileUpload() {
        $preview = $config = $errors = [];
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
        $input = 'fileUpload';
        if (empty($_FILES[$input])) {
            return [];
        }
        $total = is_array($_FILES[$input]['name']) ? count($_FILES[$input]['name']) : 1;
        $path = Yii::getAlias('@common') . '/../static/article/';
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
                $newFileUrl = $protocol . Yii::$app->params['fileStore'] . '/article/' . $dir . '/' . $fileName;

                //Upload the file into the new path
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $fileId = $fileName . $i; // some unique key to identify the file
                    $preview[] = $newFileUrl;
                    $_SESSION['upload_files'][] = $newFileUrl;
                    $config[] = [
                        'key' => $fileId,
                        'caption' => $fileName,
                        'size' => $fileSize,
                        'downloadUrl' => $newFileUrl, // the url to download the file
                        'url' => '/delete.php', // server api to delete the file based on key
                    ];
                } else {
                    $errors[] = $fileName;
                }
            } else {
                $errors[] = $fileName;
            }
        }

        $out = ['initialPreview' => $preview, 'initialPreviewConfig' => $config, 'initialPreviewAsData' => true];
        if (!empty($errors)) {
            $img = count($errors) === 1 ? 'file "' . $errors[0]  . '" ' : 'files: "' . implode('", "', $errors) . '" ';
            $out['error'] = 'Oh snap! We could not upload the ' . $img . 'now. Please try again later.';
        }
        return $out;
    }
}
