<?php

namespace ikdev\ikpanel\app;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Logs
 * @package ikdev\ikpanel\app
 * @property int $id
 * @property int $userid
 * @property string $ip
 * @property string $date
 * @property string $action
 * @property string $type
 */
class Logs extends Model{
	protected $table = 'logs';
	protected $primaryKey = 'id';
	protected $dates = ['date'];
	public $timestamps = false;
	
	const TYPE_INFO = 'INFO';
	const TYPE_SUCCESS = 'SUCCESS';
	const TYPE_WARNING = 'WARNING';
	const TYPE_DANGER = 'DANGER';
	const TYPE_ERROR = 'ERROR';
	
	public function user(){
		return $this->belongsTo(Users::class, 'userid', 'id');
	}
	
	public function getDateAttribute($value){
		return Carbon::createFromFormat('Y-m-d H:i:s',$value)->format('d/m/Y H:i:s');
	}
	
	/**
	 * Logga un'azione
	 * @param $action
	 * @param string $type
	 * @param array $args
	 * @throws \Exception
	 */
	private static function log($action, $type,$args=[]){
		
		if(!is_string($action) || strlen($action)>255){
			throw new \Exception('Il parametro $action deve essere una stringa di massimo 255 caratteri.');
		}
		
		if(!in_array($type,[self::TYPE_INFO,self::TYPE_SUCCESS,self::TYPE_WARNING,self::TYPE_DANGER,self::TYPE_ERROR])){
			throw new \Exception('Il parametro type non è valido.');
		}
		
		$model=new Logs();
		$model->userid=Auth::id();
		$model->ip=request()->ip();
		$model->action=self::format($action,$args);
		$model->type=$type;
		$model->save();
	}
	
	/**
	 * Logga un'azione di tipo INFO
	 * @param $action
	 * @throws \Exception
	 */
	public static function info($action){
		self::log($action, self::TYPE_INFO,func_get_args());
	}
	
	/**
	 * Logga un'azione di tipo SUCCESS
	 * @param $action
	 * @throws \Exception
	 */
	public static function success($action){
		self::log($action,self::TYPE_SUCCESS,func_get_args());
	}
	
	/**
	 * Logga un'azione di tipo WARNING
	 * @param $action
	 * @throws \Exception
	 */
	public static function warning($action){
		self::log($action,self::TYPE_WARNING,func_get_args());
	}
	
	/**
	 * Logga un'azione di tipo DANGER
	 * @param $action
	 * @throws \Exception
	 */
	public static function danger($action){
		self::log($action,self::TYPE_DANGER,func_get_args());
	}
	
	/**
	 * Logga un'azione di tipo ERROR
	 * @param $action
	 * @throws \Exception
	 */
	public static function error($action){
		self::log($action,self::TYPE_ERROR,func_get_args());
	}
	
	private static function format($format,$args)
	{
		//$args = func_get_args();
		$format = array_shift($args);
		
		preg_match_all('/(?=\{)\{(\d+)\}(?!\})/', $format, $matches, PREG_OFFSET_CAPTURE);
		$offset = 0;
		foreach ($matches[1] as $data)
		{
			$i = $data[0];
			$format = substr_replace($format, @$args[$i], $offset + $data[1] - 1, 2 + strlen($i));
			$offset += strlen(@$args[$i]) - 2 - strlen($i);
		}
		
		return $format;
	}
}

