<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotFoundException;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;


class MediaController extends Controller
{
    use ApiResponse;

    public function uploadProfileImage(Request $request)
    {
        
            $request->validate(['image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048']);
            
            $user = auth()->user();

            $fileName = time() . '.' . $request->image->extension();
            $path = $request->file('image')->storeAs('storage\app\public\profiles', $fileName);
            
            $user->media()->updateOrCreate(
                ['mediable_id' => $user->id, 'mediable_type' => User::class],
                ['file_path' => $path,]
            );
            
            return $this->success('تم رفع الصورة بنجاح', $path);
        
    }
}
