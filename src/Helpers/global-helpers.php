<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

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
	$protocol = 'http' . (Request::secure() ? 's' : '') . '://';
	$host = $_SERVER['HTTP_HOST'] . str_replace('/index.php', '', $_SERVER['PHP_SELF']);
	$fullurl = $host . (env('APP_URL') == '/' ? '' : env('APP_URL')) . $url;
	$fullurl = str_replace('//', '/', $fullurl);
	return $protocol . $fullurl;
}

/**
 * Url del pannello admin
 * @param string $url Url relativo
 * @return string
 */
function admin_url($url = '') {
	$protocol = 'http' . (Request::secure() ? 's' : '') . '://';
	$host = $_SERVER['HTTP_HOST'] . str_replace('/index.php', '', $_SERVER['PHP_SELF']);
	$fullurl = $host . (env('IKPANEL_URL') == '/' ? '' : env('IKPANEL_URL')) . $url;
	$fullurl = str_replace('//', '/', $fullurl);
	return $protocol . $fullurl;
}

/**
 * Crea un tag script
 * @param string $url URL dello script oppure una costante stringa (sempre tra gli apici): SELECT2
 * @param bool $nocache Invalida la cache e costringe il browser a ricaricare lo script
 * @return string
 */
function script($url, $nocache = false) {
	$out = '';
	
	if (is_array($url)) {
		foreach ($url as $item) {
			$out .= '<script type="text/javascript" src="' . asset($item) . ($nocache ? ('?nocache=' . time()) : '') . '"></script>\n';
		}
	} else {
		$out .= '<script type="text/javascript" src="' . asset($url) . ($nocache ? ('?nocache=' . time()) : '') . '"></script>';
	}
	
	return $out;
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
 * @param string|int $id ID da cercare
 * @return mixed
 */
function setIsSelected($collection, $id) {
	
	$collection->each(function($item, $i) use ($id) {
		$item->isSelected = $item->id == $id ? 'selected' : '';
	});
	
	return $collection;
}

/**
 * Imposta la proprietà isChecked ad un oggetto della collezione se l'id corrisponde a quello inserito
 * @param \Illuminate\Database\Eloquent\Collection|array $collection Collezione o array di oggetti
 * @param string|int $id ID da cercare
 * @return mixed
 */
function setIsChecked($collection, $id) {
	
	$collection->each(function($item, $i) use ($id) {
		$item->isSelected = $item->id == $id ? 'checked' : '';
	});
	
	return $collection;
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
 * @param string $background Colore di sfondo in HEX (Es. #FFFF66)
 * @param string $color Colore del testo in HEX (Es. #000000)
 * @return mixed
 */
function highlightText($search, $text) {
	$explode = explode(' ', $search);
	if (count($explode) > 1) {
		foreach ($explode as $ex) {
			$highlighted = preg_filter('/' . preg_quote($ex, '/') . '/i',
				'<mark style="padding:0;background:#FFFF66;color:#000000;">$0</mark>',
				$text
			);
			if (!empty($highlighted)) {
				$text = $highlighted;
			}
		}
	} else {
		$highlighted = preg_filter('/' . preg_quote($search, '/') . '/i',
			'<mark style="padding:0;background:#FFFF66;color:#000000;">$0</mark>',
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