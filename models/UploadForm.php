<?php
namespace app\models;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    // public $file_path;
    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }
    /**
     * [文件上传]
     * @AuthorHTL
     * @DateTime  2017-01-28T12:56:37+0800
     * @return    文件所在路径                   [description]
     */
    public function upload()
    {
        if ($this->validate()) {
            $image_name = uniqid();
            $file_path = 'uploads/' . $image_name . '.' . $this->imageFile->extension;
            if($this->imageFile->saveAs($file_path)){
                return $file_path;
            }
        } else {
            return false;
        }
    }
}