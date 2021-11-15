<?php

namespace App\Supports\Facades\Classes;

use Illuminate\Support\Facades\Storage;
use App\Models\File;

class FileFacade
{
    public function upload($file, $dir)
    {
        $ext = $file->getClientOriginalExtension();
		$fileName = uniqid().time().'.'.$ext;
		Storage::putFileAs($dir, $file, $fileName);
		return $fileName;
    }

    public function show($id)
	{
		$photo = File::find($id);
		$filePath = $photo->getFullWebPath();
		$data['contentType'] = Storage::getMimetype($filePath);
		$file = Storage::get($filePath);
		$data['file'] = $file;
		return $data;
	}

    public function move($newObjectID, $newObjectType, $vaultFileID) 
	{
		$photo = File::find($vaultFileID);
		$oldPath = $photo->getBaseDir();
		$photo->object_id = $newObjectID;
		$photo->object_type = $newObjectType;
		if ($photo->save()) {
			$newPath = $photo->getBaseDir();
			Storage::move($oldPath, $newPath);
		}
	}

    // public function move($tmpId, $dirId)
    // {
    //     if (!$tmpId) {
    //         return "";
    //     }
    //     $tmpId = decodeId($tmpId);
    //     $fileImage = File::findOrFail($tmpId)->first();
    //     $imageName = basename($fileImage->image_path);
    //     $toPath = $fileImage->type . '/' . $dirId . '/' . $imageName;
    //     Storage::move($fileImage->image_path, $toPath);
    //     $fileImage->delete();
    //     return $toPath;
    // }

    // public function delete()
    // {
        
    // }
}
