<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUpload
{
    public $baseFolder;
    public $disk;

    /**
     * FileUpload constructor.
     * @param string $disk
     * @param string $baseFolder
     */
    public function __construct($disk = 'public', $baseFolder = '')
    {
        $this->baseFolder = $baseFolder;
        $this->disk = $disk;
    }

    /**
     * @param $uploadedFile
     * @param string $method
     * @param string $oldFile
     * @param null $fileName
     * @return mixed|null|string
     */
    public function save($uploadedFile = null, $method = 'save', $oldFile = '', $fileName = null)
    {

        if ($method == 'update') {
            $this->delete($oldFile);
        }



        $path = $this->baseFolder;
        if ($uploadedFile instanceof UploadedFile) {
            if(!$fileName) {
                $fileName = md5(time() . rand(0,25)).'.'.last(explode('.', $uploadedFile->getClientOriginalName()));
            }
            $file = $path = Storage::disk($this->disk)->putFileAs($path, $uploadedFile, $fileName);
        } else {
            if(!$fileName) {
                $fileName = md5(time() . rand(0,25)).'.'.last(explode('.', last(explode('/', $uploadedFile))));
            }

            $path .= $fileName;
            $file = Storage::disk($this->disk)->put($path, file_get_contents($uploadedFile));
        }

        return $file ? $path : null;
    }

    /**
     * @param $filePath
     * @return bool
     */
    public function delete($filePath)
    {
        if (empty($filePath)) {
            return false;
        }

        return Storage::disk($this->disk)->delete($filePath);
    }

    public function saveFile($request, $fieldName, $method = 'save', $oldImage = null)
    {
        if ($method == 'delete') {
            $this->delete($oldImage);
            return true;
        }

        $result = $this->save($request->file($fieldName),
            $method,
            $oldImage
        );
        if($result === false) {
            throw new HttpException(400, 'Cannot save file!');
        }
        return $result;
    }
}
