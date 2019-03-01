<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

/**
 * Created By Interactive Knowledge Development
 * User: luca.patera
 * Date: 07/08/2018
 * Time: 18:42
 */

namespace ikdev\ikpanel\app\Http\Classes;


use ikdev\ikpanel\app\Users;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class PanelUtilities {
	
	/**
	 * Save user avatar
	 * @param int $userID ID dell'utente
	 * @param UploadedFile $file File da salvare. Es. $request->file('key');
	 * @return bool
	 */
	public static function saveUserAvatar($userID, $file) {
		
		
		$fileName = $userID . '.' . $file->extension();
		$folderPath = 'public/users_avatar/';
		$file->storeAs($folderPath, $fileName);
		
		$fullFolderPath = base_path('storage/app/' . $folderPath);
		$fullFolderPathWithName = $fullFolderPath . $fileName;
		
		$manager = new ImageManager();
		$img = $manager->make($fullFolderPathWithName);
		$img->encode('jpg', 100);
		$img->fit(200, 200, function($constraint) {
			$constraint->upsize();
		});
		
		Storage::delete($folderPath . $fileName);
		
		$img->save($fullFolderPath . $userID . '.jpg', 100);
		
		/** @var Users $user */
		$user = Users::find($userID);
		$user->avatar = 'storage/users_avatar/' . $userID . '.jpg';
		$user->save();
		
		return true;
	}
	
}
