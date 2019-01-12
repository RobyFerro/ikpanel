<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 12/01/2019
 * Time: 11:11
 */

namespace ikdev\ikpanel\Modules\blog\app\Http\Controllers;


use Illuminate\Routing\Controller;

class BlogPostController extends Controller {
	
	public function show() {
		return view('ikpanel-blog::articles.show');
	}
	
}