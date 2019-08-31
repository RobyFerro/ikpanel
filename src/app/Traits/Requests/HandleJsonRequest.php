<?php

namespace ikdev\ikpanel\App\Traits\Requests;


use Illuminate\Http\Request;

trait HandleJsonRequest
{
    
    protected $parserRequest;
    
    /**
     * HandleJsonRequest constructor.
     * @param  Request  $request
     */
    public function __construct(Request $request)
    {
        $data = json_decode($request->data, true);
        $request->request->remove('data');
        foreach ($data as $item) {
            $myvalue = isset($item['value']) ? $item['value'] : null;
            if (is_string($myvalue) && strlen($myvalue) == 0) {
                $myvalue = null;
            }
            $request->request->set($item['id'], $myvalue);
        }
        
        $this->parserRequest = $request;
    }
    
}
