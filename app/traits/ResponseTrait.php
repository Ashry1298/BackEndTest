<?php

namespace App\Traits;

use App\Http\Resources\Api\UserResource;

trait ResponseTrait
{
    public function response($key, $msg, $data = [], $anotherKey = [], $page = false)
    {

        $allResponse['key'] = (string) $key;
        $allResponse['msg'] = (string) $msg;

     
        if (!empty($anotherKey)) {
            foreach ($anotherKey as $otherkey => $value) {
                $allResponse[$otherkey] = $value;
            }
        }

        if ([] != $data && (in_array($key, ['success', 'needActive', 'exception']))) {
            $allResponse['data'] = $data;
        }

        return response()->json($allResponse);
    }
    public function failMsg($msg)
    {
        return $this->response('fail', $msg);
    }

    public function successMsg($msg = 'done')
    {
        return $this->response('success', $msg);
    }

    public function successData($data)
    {
        return $this->response('success', trans('apis.success'), $data);
    }
}
