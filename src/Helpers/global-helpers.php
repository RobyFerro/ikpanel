<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

use App\Tags;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\App;

/**
 * Termina lo script con un messaggio di errore con il codice http 422
 * @param string $message Messaggio di errore
 */
function setError($message) {
	header('HTTP/1.1 422 Unprocessable Entity');
	header('Content-Type: application/json; charset=UTF-8');
	
	$message = [
		"message" => $message
	];
	
	die(json_encode($message));
}

/**
 * Url frontend
 * @param string $url Url relativo
 * @return string
 */
function app_url($url = '') {
	if (App::runningInConsole()) {
		$main_domain = config('admin-panel.main_domain');
		$fullurl = (ends_with($main_domain, '/') ? $main_domain : $main_domain . '/') . $url;
		return $fullurl;
	} else {
		if (config('app.url') == '/') {
			$protocol = 'http' . (Request::secure() ? 's' : '') . '://';
			$host = $_SERVER['HTTP_HOST'] . str_replace('/index.php', '', $_SERVER['PHP_SELF']);
			$fullurl = $host . (empty($url) ? '' : '/' . $url);
			$fullurl = str_replace('//', '/', $fullurl);
			$fullurl = $protocol . $fullurl;
		} else {
			$fullurl = config('admin-panel.main_domain') . (empty($url) ? '' : '/' . $url);
			$fullurl = str_replace('//', '/', $fullurl);
		}
		return $fullurl;
	}
}

/**
 * Url del pannello admin
 * @param string $url Url relativo
 * @return string
 */
function admin_url($url = '') {
	if (App::runningInConsole()) {
		$fullurl = env('IKPANEL_URL') . '/' . $url;
		return env('MAIN_DOMAIN') . $fullurl;
	} else {
		$protocol = 'http' . (Request::secure() ? 's' : '') . '://';
		$host = $_SERVER['HTTP_HOST'] . str_replace('/index.php', '', $_SERVER['PHP_SELF']);
		$fullurl = $host . (\Illuminate\Support\Facades\Config::get('ikpanel-config.admin_panel_url') == '/' ? '' : \Illuminate\Support\Facades\Config::get('ikpanel-config.admin_panel_url')) . $url;
		$fullurl = str_replace('//', '/', $fullurl);
		return $protocol . $fullurl;
	}
}

/**
 * Url main domain
 * @param string $url Url relativo
 * @return string
 */
function main_domain($url = '') {
	//prendo il main_domain dal config/env
	$main_domain = config('admin-panel.main_domain');
	
	//faccio il parsing della struttura dell'url
	$main_domain_parse = parse_url($main_domain);
	
	//ritorno protocollo+host+url
	return $main_domain_parse['scheme'] . '://' .
		$main_domain_parse['host'] .
		(starts_with($url, '/') ? $url : "/$url");
}

/**
 * Crea un tag script
 * @param string $url URL dello script oppure una costante stringa (sempre tra gli apici): SELECT2
 * @param bool $nocache Invalida la cache e costringe il browser a ricaricare lo script
 * @return string
 */
function script($url, $nocache = false) {
	return '<script type="text/javascript" src="' . asset($url) . ($nocache ? ('?nocache=' . time()) : '') . '"></script>';
}

/**
 * Crea un tag link (css)
 * @param string $url URL del file css
 * @param bool $nocache Invalida la cache e costringe il browser a ricaricare lo script
 * @return string
 */
function css($url, $nocache = false) {
	return '<link type="text/css" media="screen" rel="stylesheet" href="' . asset($url) . ($nocache ? ('?nocache=' . time()) : '') . '"/>';
}

/**
 * Imposta la proprietà isSelected ad un oggetto della collezione se l'id corrisponde a quello inserito
 * @param \Illuminate\Database\Eloquent\Collection|array $collection Collezione o array di oggetti
 * @param string|int|array $id ID da cercare
 * @return mixed
 */
function setIsSelected($collection, $id) {
	
	$collection->each(function($item, $i) use ($id) {
		if (is_array($id)) {
			$item->isSelected = in_array($item->id, $id) ? 'selected' : '';
		} else {
			$item->isSelected = $item->id == $id ? 'selected' : '';
		}
	});
	
	return $collection;
}

/**
 * Restituisce checked se value è true
 * @param boolean|string|integer $value
 * @return mixed
 */
function setIsChecked($value) {
	return ($value == true || $value == 'true' || $value == 1) ? 'checked' : '';
}

/**
 * Tronca una stringa
 * @param string $text Stringa da troncare
 * @param int $length Lunghezza stringa
 * @param string $char Carattere da inserire alla fine della stringa troncata
 * @return string
 */
function truncateString($text, $length = 100, $char = '...') {
	return strlen($text) > $length ? substr($text, 0, $length) . $char : $text;
}

/**
 * Evidenzia un testo in base a dei caratteri da cercare
 * @param string $search Testo da cercare
 * @param string $text Testo in cui cercare
 * @return mixed
 */
function highlightText($search, $text) {
	$search_array = explode(' ', $search);
	if (count($search_array) > 1) {
		$text_array = explode(' ', $text);
		$found = [];
		foreach ($text_array as $i => &$text_word) {
			foreach ($search_array as $j => $search_word) {
				if (preg_match('/' . preg_quote($search_word, '/') . '/i', $text_word) && !in_array($i, $found)) {
					
					$highlighted = preg_filter('/' . preg_quote($search_word, '/') . '/i',
						'<mark>$0</mark>',
						$text_word
					);
					if (!empty($highlighted)) {
						$text_word = $highlighted;
					}
					$found[] = $i;
				}
				
			}
		}
		$text = implode(' ', $text_array);
	} else {
		$highlighted = preg_filter('/' . preg_quote($search, '/') . '/i',
			'<mark>$0</mark>',
			$text
		);
		if (!empty($highlighted)) {
			$text = $highlighted;
		}
	}
	return $text;
}

/**
 * Rimuove tutti i tag html insieme al contenuto
 * @param $text
 * @param string $tags
 * @param bool $invert
 * @return null|string|string[]
 */
function strip_tags_content($text, $tags = '', $invert = false) {
	
	preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
	$tags = array_unique($tags[1]);
	
	if (is_array($tags) AND count($tags) > 0) {
		if ($invert == false) {
			return preg_replace('@<(?!(?:' . implode('|', $tags) . ')\b)(\w+)\b.*?>.*?</\1>@si', '', $text);
		} else {
			return preg_replace('@<(' . implode('|', $tags) . ')\b.*?>.*?</\1>@si', '', $text);
		}
	} elseif ($invert == false) {
		return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);
	}
	return $text;
}

/**
 * Rimuove solo tag html selezionati
 * @param string $text
 * @param array $tags
 * @return mixed
 */
function strip_tags_inverted($text, $tags) {
	foreach ($tags as $tag) {
		$text = preg_replace("/<\\/?" . $tag . "(.|\\s)*?>/", '', $text);
	}
	return $text;
}

/**
 * Rimuovo solo i tag selezionati insieme al contenuto
 * @param $text
 * @param $tags
 * @return null|string|string[]
 */
function strip_tags_inverted_content($text, $tags) {
	return preg_replace('#<(' . implode('|', $tags) . ')(?:[^>]+)?>.*?</\1>#s', '', $text);
}

/**
 * Inizializza un oggetto paginazione
 * @param $limit
 * @param $path
 * @return LengthAwarePaginator
 */
function initializePagination($limit, $path) {
	return (new LengthAwarePaginator([], 0, $limit))
		->withPath($path);
}

/**
 * Validazione skills
 * @param $skills
 */
function validateSkills($skills) {
	
	if ($skills->isNotEmpty()) {
		$custom = [];
		$real = [];
		$parsed_skill = [];
		
		foreach ($skills as $skill) {
			
			if (!in_array(strtolower($skill['text']), $parsed_skill)) {
				if (is_null($skill['id'])) {
					$custom[] = trim(strtolower($skill['text']));
				} else if (is_int($skill['id'])) {
					
					if (!Tags::find($skill['id'])->exists()) {
						setError('Tag ID non valido.');
					} // if
					
					$real[] = $skill['id'];
					$custom[] = trim(strtolower($skill['text']));
				} else {
					setError('Tipo tag non valido.');
				} // if
				
				$parsed_skill[] = strtolower($skill['text']);
				
			} else {
				setError("Tag duplicati");
			} // if
			
		} // foreach
		
		if (count(array_unique($custom)) < count($custom)) {
			setError('Non possono esserci 2 skill uguali.');
		}
		if (count(array_unique($real)) < count($real)) {
			setError('Tag duplicati.');
		}
	}
	
}

/**
 * Elimina un file se esiste
 * @param $file_path
 */
function unlink_if_exists($file_path) {
	if (file_exists($file_path)) {
		unlink($file_path);
	}
}

/**
 * Ottiene l'url dell'avatar di default
 * @return string
 */
function defaultAvatar() {
	return app_url('/ecit/assets/img/profiles/avatar-default.png');
}

/**
 * Converte una richiesta FormData in una richiesta normale
 * @param Request $request
 * @return Request
 */
function formDataConverter(Request $request) {
	$data = json_decode($request->data, true);
	$request->request->remove('data');
	foreach ($data as $item) {
		$myvalue = isset($item['value']) ? $item['value'] : null;
		if (is_string($myvalue) && strlen($myvalue) == 0) {
			$myvalue = null;
		}
		$request->request->set($item['id'], $myvalue);
	}
	return $request;
}

/**
 * Convert number with unit byte to bytes unit
 * @link https://en.wikipedia.org/wiki/Metric_prefix
 * @param string $value a number of bytes with optinal SI decimal prefix (e.g. 7k, 5mb, 3GB or 1 Tb)
 * @return integer|float A number representation of the size in BYTES (can be 0). otherwise FALSE
 */
function str2bytes($value) {
	
	if (preg_match('/(\d*(\.\d*)?)([a-zA-Z]*)?/', $value, $matches)) {
		
		$digit = (int)$matches[1];
		$unit = strtolower($matches[3]);
		
		switch ($unit) {
			case 'p':    // petabyte
			case 'pb':
				$digit *= 1024;
			case 't':    // terabyte
			case 'tb':
				$digit *= 1024;
			case 'g':    // gigabyte
			case 'gb':
				$digit *= 1024;
			case 'm':    // megabyte
			case 'mb':
				$digit *= 1024;
			case 'k':    // kilobyte
			case 'kb':
				$digit *= 1024;
			case 'b':    // byte
				return $digit *= 1;
				break; // make sure
			default:
				return false;
		}
	}
	
	return false;
}

/**
 * Converte i byte in un formato più leggibile
 * @param $bytes
 * @return string
 */
function bytes2str($bytes) {
	if ($bytes >= 1073741824) {
		$bytes = number_format($bytes / 1073741824, 0) . ' GB';
	} elseif ($bytes >= 1048576) {
		$bytes = number_format($bytes / 1048576, 0) . ' MB';
	} elseif ($bytes >= 1024) {
		$bytes = number_format($bytes / 1024, 0) . ' KB';
	} elseif ($bytes > 1) {
		$bytes = $bytes . ' bytes';
	} elseif ($bytes == 1) {
		$bytes = $bytes . ' byte';
	} else {
		$bytes = '0 bytes';
	}
	
	return $bytes;
}
