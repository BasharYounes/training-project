<?php 

namespace App\Services\Channel;

use App\Exceptions\FileStorageException;
use Storage;



 class ChannelService 
{
  public function storeAudio($file, $subPath = '') {

        $fileName = time() . '.' . $file->extension();

        $audioPath = Storage::disk('public')->putFileAs(
            $subPath, 
            $file, 
            $fileName
        );

          if(!$audioPath)
        {
            throw new FileStorageException('خطأ في تخزين الصوت');
        }

        return $audioPath;
    }

    public function storeCover($file, $subPath = '',) {


        $fileName = time() . '.' . $file->extension();


        $coverPath = Storage::disk('public')->putFileAs(
            $subPath, 
            $file, 
            $fileName
        );

         if(!$coverPath)
        {
            throw new FileStorageException('خطأ في تخزين الصورة');
        }

        return $coverPath;
    }

}
