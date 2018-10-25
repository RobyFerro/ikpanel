<?php
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
	 * Salva avatar utente
	 * @param int $userID ID dell'utente
	 * @param UploadedFile $file File da salvare. Es. $request->file('key');
	 * @return bool
	 */
	public static function saveUserAvatar($userID, $file) {
		
		//nome file e cartella dove salvare il file
		$fileName = $userID . '.' . $file->extension();
		$folderPath = 'public/users_avatar/';
		
		//salvo il file nello storage
		$file->storeAs($folderPath, $fileName);
		
		//percorsi completi al file
		$fullFolderPath = base_path('storage/app/' . $folderPath);
		$fullFolderPathWithName = $fullFolderPath . $fileName;
		
		//eventuale conversione in jpg e resize
		$manager = new ImageManager();
		$img = $manager->make($fullFolderPathWithName);
		$img->encode('jpg', 100);
		$img->fit(200, 200, function($constraint) {
			$constraint->upsize();
		});
		
		//elimino vecchia immagine
		Storage::delete($folderPath . $fileName);
		
		//salvo nuova immagine
		$img->save($fullFolderPath . $userID . '.jpg', 100);
		
		//salvo il percorso dell'avatar nel database
		/** @var Users $user */
		$user = Users::find($userID);
		$user->avatar = 'storage/users_avatar/' . $userID . '.jpg';
		$user->save();
		
		//restituisco risposta
		return true;
	}
	
}