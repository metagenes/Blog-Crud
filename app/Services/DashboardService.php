<?php

namespace App\Services;

use App\Utils\ApiUtil;
use Illuminate\Support\Arr;

class DashboardService
{
    // COMPANY API //
    public function addCompany($data)
    {

        $result = [];

        $headers = [];

        $headers['X-Auth-Key'] = config('kong.secret_key');

        if (session('data.form.status') == 1) {
            $status = 'true';
        } else {
            $status = 'false';
        }

        $params = [
            'name' => session('data.form.name'),
            'status' => $status
        ];
        $response = ApiUtil::post(config('kong.url') . '/companies', [
            "headers" => $headers,
            "form_params" => $params
        ], 30);

        if ($response['status_code'] == 201 || $response['status_code'] == 200) {
            if (Arr::get($response, 'data.status') === true) {
                $result = Arr::get($response, 'data');
                $responseSave = json_encode(Arr::get($response, 'data'));
            } else {
                $result['status'] = Arr::get($response, 'data.status');
                $result['message'] = Arr::get($response, 'data.message');
            }
        } else {
            $service = "add company";
            $this->createErrorSession($service, Arr::get($response, 'message'));
            $result['status'] = Arr::get($response, 'status');
            $result['message'] = json_encode(Arr::get($response, 'message'));
        }

        return $result;
    }

    public function getMerchantList()
    {

        $result = [];

        $headers = [];

        $headers['X-Auth-Key'] = config('kong.secret_key');

        $response = ApiUtil::get(config('kong.url') . '/companies', [
            "headers" => $headers
        ], 30);

        if ($response['status_code'] == 201 || $response['status_code'] == 200) {
            $result = Arr::get($response, 'data');
            dd($result);
            $result = Arr::get($response, 'data.data');
            $result = json_encode(Arr::get($response, 'data.data'));
        } else {
            $service = "get company";
            $this->createErrorSession($service, Arr::get($response, 'message'));
            $result['status'] = $response['status_code'];
            $result['message'] = json_encode(Arr::get($response, 'message'));
        }
        return $result;
    }

    public function showCompany($id)
    {

        $result = [];

        $headers = [];

        $headers['X-Auth-Key'] = config('kong.secret_key');

        $response = ApiUtil::get(config('kong.url') . '/companies/' . $id, [
            "headers" => $headers
        ], 30);

        if ($response['status_code'] == 201 || $response['status_code'] == 200) {
            $result = Arr::get($response, 'data.name');

        } else {
            $service = "show company";
            $this->createErrorSession($service, Arr::get($response, 'message'));
            $result['status'] = $response['status_code'];
            $result['message'] = json_encode(Arr::get($response, 'message'));
        }
        return $result;
    }

    public function showUsedQuota($id)
    {

        $result = [];

        $headers = [];

        $headers['X-Auth-Key'] = config('kong.secret_key');

        $response = ApiUtil::get(config('kong.url') . '/companies/' . $id . '/token', [
            "headers" => $headers
        ], 30);

        if ($response['status_code'] == 201 || $response['status_code'] == 200) {
            $result = Arr::get($response, 'data');
        } else {
            $service = "add user to company";
            $this->createErrorSession($service, Arr::get($response, 'message'));
            $result['status'] = $response['status_code'];
            $result['message'] = json_encode(Arr::get($response, 'message'));
        }
        return $result;
    }

    public function updateCompany($dataForm = null, $id = null)
    {

        $result = [];

        $headers = [];

        $headers['X-Auth-Key'] = config('kong.secret_key');

        if (!is_null($dataForm['status'])) {
            if ($dataForm['status'] == 1) {
                $dataForm['status'] = 'true';
            } else {
                $dataForm['status'] = 'false';
            }
        }

        $params = [
            'name' => $dataForm['name'],
            'status' => $dataForm['status'],
        ];

        $response = ApiUtil::put(config('kong.url') . '/companies/' . $id, [
            "headers" => $headers,
            "form_params" => $params
        ], 30);

        if ($response['status_code'] == 201 || $response['status_code'] == 200) {
            $result = $response;
        } else {
            $service = "update company";
            $this->createErrorSession($service, Arr::get($response, 'message'));
            $result['status'] = Arr::get($response, 'status');
            $result['message'] = json_encode(Arr::get($response, 'message'));
        }
        return $result;
    }

    public function topUpToken($dataForm)
    {

        $result = [];

        $headers = [];

        $headers['X-Auth-Key'] = config('kong.secret_key');

        $params = [
            'quota' => $request->get('token'),
        ];

        $response = ApiUtil::post(config('kong.url') . '/companies/' . $companyId->company_kong_id . '/services/' . $companyId->company_kong_id, [
            "headers" => $headers,
            "form_params" => $params
        ], 30);

        if ($response['status_code'] == 201 || $response['status_code'] == 200) {
            $result = Arr::get($response, 'data');
        } else {
            $service = "top up company token";
            $this->createErrorSession($service, Arr::get($response, 'message'));
            $result['status'] = Arr::get($response, 'status');
            $result['message'] = json_encode(Arr::get($response, 'message'));
        }
        return $result;
    }

    public function companyBalance($id)
    {

        $result = [];

        $headers = [];

        $headers['X-Auth-Key'] = config('kong.secret_key');

        $response = ApiUtil::get(config('kong.url') . '/companies/' . $id . '/token/', [
            "headers" => $headers
        ], 30);

        if ($response['status_code'] == 201 || $response['status_code'] == 200) {
            $result = Arr::get($response, 'data');
        } else {
            $service = "show company balance";
            $this->createErrorSession($service, Arr::get($response, 'message'));
            $result['status'] = $response['status_code'];
            $result['message'] = json_encode(Arr::get($response, 'message'));
        }
        return $result;
    }

    public function addCompanyService($company, $service)
    {

        $result = [];

        $headers = [];

        $headers['X-Auth-Key'] = config('kong.secret_key');

        if (session('data.form.is_postpaid') == 1) {
            $status = 'true';
        } else {
            $status = 'false';
        }

        if (session('data.form.token') == NULL) {
            $token = 0;
        } else {
            $token = session('data.form.token');
        }

        $params = [
            'quota' => $token,
            'is_postpaid' => $status
        ];
        
        $response = ApiUtil::post(config('kong.url') . '/companies/' . $company->company_kong_id . '/services/' . $service, [
            "headers" => $headers,
            "form_params" => $params
        ], 30);
        
        if ($response['status_code'] == 201 || $response['status_code'] == 200) {
            if (Arr::get($response, 'data.status') === true) {
                $result = Arr::get($response, 'data');
                $responseSave = json_encode(Arr::get($response, 'data'));
            } else {
                $result['status'] = Arr::get($response, 'status');
                $result['message'] = Arr::get($response, 'data.message');
            }
        } else {
            $service = "add company";
            $this->createErrorSession($service, Arr::get($response, 'message'));
            $result['status'] = Arr::get($response, 'status');
            $result['message'] = json_encode(Arr::get($response, 'message'));
        }

        return $result;
    }

    public function deleteCompanyService($company, $service)
    {
        $result = [];

        $headers = [];

        $headers['X-Auth-Key'] = config('kong.secret_key');

        $params = [
            'quota' => $service->token,
        ];

        $response = ApiUtil::delete(config('kong.url') . '/companies/' . $company . '/services/' . $service->service_id, [
            "headers" => $headers,
            "form_params" => $params
        ], 30);

        if ($response['status_code'] == 201 || $response['status_code'] == 200) {
            if (Arr::get($response, 'data.status') === true) {
                $result = Arr::get($response, 'data');
                $responseSave = json_encode(Arr::get($response, 'data'));
            } else {
                $result['status'] = Arr::get($response, 'data.status');
                $result['message'] = Arr::get($response, 'data.message');
            }
        } else {
            $service = "delete company service";
            $this->createErrorSession($service, Arr::get($response, 'message'));
            $result['status'] = Arr::get($response, 'status');
            $result['message'] = json_encode(Arr::get($response, 'message'));
        }

        return $result;
    }
    
    public function resetCompanyService($company, $service_id)
    {
        
        $result = [];

        $headers = [];

        $headers['X-Auth-Key'] = config('kong.secret_key');

        $response = ApiUtil::post(config('kong.url') . '/companies/' . $company . '/services/' . $service_id . '/reset', [
            "headers" => $headers
        ], 30);
        
        if ($response['status_code'] == 201 || $response['status_code'] == 200) {
            if (Arr::get($response, 'data.status') === true) {
                $result = Arr::get($response, 'data');
                $responseSave = json_encode(Arr::get($response, 'data'));
            } else {
                $result['status'] = Arr::get($response, 'data.status');
                $result['message'] = Arr::get($response, 'data.message');
            }
        } else {
            $service = "delete company service";
            $this->createErrorSession($service, Arr::get($response, 'message'));
            $result['status'] = Arr::get($response, 'status');
            $result['message'] = json_encode(Arr::get($response, 'message'));
        }

        return $result;
    }
    // COMPANY API -END //

    // USER API //
    public function addUser($data = null)
    {

        $result = [];

        $headers = [];

        $headers['X-Auth-Key'] = config('kong.secret_key');

        if( !isset($data['company_id']) )
        {

            $company = $this->companyRepository->find(auth()->user()->company_id);
    
        }
        else
        {
            
            $company = $this->companyRepository->find($data['company_id']);

        }

        if ($data['status'] == 1) {
            $status = 'true';
        } else {
            $status = 'false';
        }

        $params = [
            'username' => $data['email'],
            'company_id' => $company->company_kong_id,
            'status' => $status,
        ];

        $response = ApiUtil::post(config('kong.url') . '/consumers', [
            "headers" => $headers,
            "form_params" => $params
        ], 30);

        if ($response['status_code'] == 201 || $response['status_code'] == 200) {
            if (Arr::get($response, 'data.status') === true) {
                $result = Arr::get($response, 'data');
                $responseSave = json_encode(Arr::get($response, 'data'));
            } else {
                $result['status'] = Arr::get($response, 'data.status');
                $result['message'] = Arr::get($response, 'data.message');
            }
        } else {
            $service = "add company";
            $this->createErrorSession($service, Arr::get($response, 'message'));
            $result['status'] = Arr::get($response, 'status');
            $result['message'] = json_encode(Arr::get($response, 'message'));
        }

        return $result;
    }

    public function authKey($data)
    {
   
        $result = [];

        $headers = [];

        $headers['X-Auth-Key'] = config('kong.secret_key');

        $responseAuthKey = ApiUtil::post(config('kong.url') . '/consumers/' . $data . '/key-auth', [
            "headers" => $headers,
        ], 30);

        if ($responseAuthKey['status_code'] == 201 || $responseAuthKey['status_code'] == 200) {
            if (Arr::get($responseAuthKey, 'status') === true) {
                $result = Arr::get($responseAuthKey, 'data');
                $responseSave = json_encode(Arr::get($responseAuthKey, 'data'));
            } else {
                $result['status'] = Arr::get($responseAuthKey, 'status');
            }
        } else {
            $service = "add keyauth customer";
            $result['status'] = Arr::get($responseAuthKey, 'status');
        }

        return $result;
    }

    public function showUser($id)
    {

        $result = [];

        $headers = [];

        $headers['X-Auth-Key'] = config('kong.secret_key');

        $response = ApiUtil::get(config('kong.url') . '/consumers/' . $id, [
            "headers" => $headers
        ], 30);
        
        if ($response['status_code'] == 201 || $response['status_code'] == 200) {
            $result = Arr::get($response, 'data');
            $result['status_true'] = true;
        } else {
            $service = "show user";
            $this->createErrorSession($service, Arr::get($response, 'message'));
            $result['status'] = "Not Found";
            $result['status_true'] = false;
            $result['message'] = json_encode(Arr::get($response, 'message'));
        }
        return $result;
    }

    public function updateUser($dataForm = null, $user = null)
    {

        $result = [];

        $headers = [];

        $headers['X-Auth-Key'] = config('kong.secret_key');

        if (!is_null($dataForm['status'])) {
            if ($dataForm['status'] == 1) {
                $status = 'true';
            } else {
                $status = 'false';
            }
        }

        $params = [
            'username' => $dataForm['email'],
            'company_id' => $user->company->company_kong_id,
            'status' => $status
        ];

        $response = ApiUtil::put(config('kong.url') . '/consumers/' . $user->user_kong_id, [
            "headers" => $headers,
            "form_params" => $params
        ], 30);

        if ($response['status_code'] == 201 || $response['status_code'] == 200) {
            $result = $response;
        } else {
            $service = "update company";
            $this->createErrorSession($service, Arr::get($response, 'message'));
            $result['status'] = "Not Found";
            $result['message'] = json_encode(Arr::get($response, 'message'));
        }
        return $result;
    }

    public function getServices()
    {

        $result = [];

        $headers = [];

        $headers['X-Auth-Key'] = config('kong.secret_key');

        $response = ApiUtil::get(config('kong.url') . '/services', [
            "headers" => $headers
        ], 30);

        if ($response['status_code'] == 201 || $response['status_code'] == 200) {
            $result = Arr::get($response, 'data.data');
            dd($result);
            $result = Arr::get($response, 'data.data');
            $result = json_encode(Arr::get($response, 'data.data'));
        } else {
            $service = "get services";
            $this->createErrorSession($service, Arr::get($response, 'message'));
            $result['status'] = $response['status_code'];
            $result['message'] = json_encode(Arr::get($response, 'message'));
        }
        return $result;
    }

    public function getServiceDetail($serviceId)
    {
        $result = [];

        $headers = [];

        $headers['X-Auth-Key'] = config('kong.secret_key');

        $response = ApiUtil::get(config('kong.url') . '/services', [
            "headers" => $headers
        ], 30);

        if ($response['status_code'] == 201 || $response['status_code'] == 200) {
            $result = Arr::get($response, 'data.data');
            foreach ($result as $key => $value) {
                if ($value['id'] == $serviceId) {
                    $result = $value;
                } else {
                    unset($result[$key]);
                }
            }
        }

        return $result;

    }

    // public function getServiceDetail($serviceId)
    // {
    //     $result = [];

    //     $headers = [];

    //     $headers['X-Auth-Key'] = config('kong.secret_key');

    //     $response = ApiUtil::get(config('kong.url') . '/services', [
    //         "headers" => $headers
    //     ], 30);

    //     if ($response['status_code'] == 201 || $response['status_code'] == 200) {
    //         $result = Arr::get($response, 'data.data');
    //         foreach ($result as $key => $value) {
    //             // get prefix before - 
    //             $prefix = explode('-', $value['name']);
    //             if ($prefix[0] == 'PERMATA' || $prefix[0] == 'COLLECTION') {
    //                 $result[$key]['id'] = $value['id'];
    //                 $result[$key]['name'] = $value['name'];    
    //             } else {
    //                 unset($result[$key]);
    //             }
    //         }

    //         // $result = Arr::get($response, 'data.data');
    //         // $result = json_encode(Arr::get($response, 'data.data'));
    //     } else {
    //         $service = "get services";
    //         $this->createErrorSession($service, Arr::get($response, 'message'));
    //         $result['status'] = $response['status_code'];
    //         $result['message'] = json_encode(Arr::get($response, 'message'));
    //     }
    //     return $result;

    // }
    // USER API -END //

    private function createErrorSession($service, $errorMessage)
    {
        session()->put('data.errors.' . $service, [
            'label' => Arr::get($service, 'label'),
            'url' => Arr::get($service, 'endpoint'),
            'error_message' => $errorMessage
        ]);
    }
}
