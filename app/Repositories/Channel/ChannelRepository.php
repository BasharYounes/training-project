<?php 

namespace App\Repositories\Channel;

use App\Exceptions\Content\ContentRegistrationException;
use App\Models\Channel;
use App\Models\Content;

class ChannelRepository 

{
      public function createChannel($validated)
    {
        $validated['user_id'] = auth()->user()->id;
        return Channel::create($validated);
    }

       public function createObjectContent(Array $data, $audioPath, $coverPath)
    {
        $data['file_path'] = $audioPath;
        $data['cover_image'] = $coverPath;

        $content = new Content($data);
        
      

        return $content;
    }
    
    public function createAndSaveContent($Objcontent,$channel,$content)
    {
            $Objcontent->channel()->associate($channel);
                            
            $Objcontent->contentable()->associate($content);

            $Objcontent->save();

            if(!$Objcontent)
                {
                    throw new ContentRegistrationException();
                }
        return $Objcontent;       
    }

    public function findChannel($id)
    {
        $channel = Channel::where('id',$id)->firstOrFail();

        return $channel;
    }

}
