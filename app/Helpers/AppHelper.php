<?php

namespace App\Helpers;

use App\Models\HospitalProfile;
use App\Models\User;
use Carbon\Carbon;
use Exception;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AppHelper
{
    const PNG_CLASS = [
        0 => 'flaticon-018-vaccine',
        1 => 'flaticon-025-serum',
        2 => 'flaticon-023-otoscope',
        3 => 'flaticon-020-examine',
        4 => 'flaticon-005-checklist',
        5 => 'flaticon-012-eye-test',
        6 => 'flaticon-003-blood-sample'

    ];

    public static function timeInTwelveHourFormat($time): string
    {
        return date('h:i A', strtotime($time));
    }

    public static function timeInTwentyFourHourFormat($time): string
    {
        return date('H:i', strtotime($time));
    }


    /**
     * @return int
     */
    public static function getAuthUserId(): int
    {
       return Auth::user()->id;
    }

    public static function getHospitalId()
    {
        $hospitalProfile =  HospitalProfile::select('id')->firstOrFail();
        return $hospitalProfile->id;
    }

    public static function findAdminUserAuthId()
    {
       $admin =  User::select('id')->where('role','admin')->firstOrFail();
        return $admin->id;
    }

    public static function removeSpecialChar($str)
    {
        $res = preg_replace('/[0-9\@\.\;\" "]+/', '', $str);
        return $res;
    }

    public static function getDoctorExperienceInYear($value)
    {
        $totalExperience = $value;
        $integer = floor($totalExperience);
        $decimal = $totalExperience - $integer;
        if($decimal >= 0.1){
           return $value;
        }else{
          return intval($value);
        }
    }

    public static function sendSuccessResponse($message, $data = null, $headers = [], $options = 0): JsonResponse
    {
        $response = [
            'status' => true,
            'message' => $message,
            'status_code' => 200,

        ];
        if (!is_null($data)) {
            $response['data'] = $data;
        }
        return response()->json($response, 200, $headers, $options);
    }

    public static function sendErrorResponse($message, $code = 500, array $errorFields = null): JsonResponse
    {
        $response = [
            'status' => false,
            'message' => $message,
            'status_code' => $code,
        ];
        if (!is_null($errorFields)) {
            $response['data'] = $errorFields;
        }
        if ($code < 200 || !is_numeric($code) || $code > 599) {
            $code = 500;
            $response['code'] = $code;
        }
        return response()->json($response, $code);
    }

}

