<?php

namespace App\Services\PhoneService\Model;


use App\Services\PhoneService\Error\PhoneError;
use App\Services\PhoneService\Traits\ValidationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use function RingCentral\Psr7\str;

class PhoneService
{
    use ValidationTrait;

    const SERVER = "notify.eskiz.uz/api/";
    public $authorization = null;

    public function authorize()
    {
        $response = Http::post(self::SERVER . "auth/login", [
            "email" => env("SMS_EMAIL"),
            "password" => env("SMS_PASSWORD")
        ]);
        if ($response->getStatusCode() == 401 || $response->getStatusCode() == 400) {
            throw new PhoneError("Failed To Authorize to Sms channel. Error " . $response->json()['message'], 401);
        }
        $response = $response->object();
        $this->authorization = $response->data->token;
        $this->put_env(["SMS_AUTHORIZATION" => $this->authorization]);
    }

    function put_env(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {

                $str .= "\n"; // In case the searched variable is in the last line without \n
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }

            }
        }

        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str)) return false;
        return true;
    }

    private function leftOnlyIntegers($phone)
    {
        return preg_filter("/[^0-9]*/", "", strval($phone));
    }

    public static function validationSeparator(): string
    {
        return "\n";
    }

    public function send($phone_to_send, string $message)
    {
        $phone = $this->leftOnlyIntegers($phone_to_send);;
        $this->usualException([
            'phone' => $phone
        ], [
            'phone' => "max:12|min:12"
        ]);
        $secret = $this->authorization ?? env("SMS_AUTHORIZATION");
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $secret,
        ])->post(self::SERVER . 'message/sms/send', [
            'mobile_phone' => $phone,
            'message' => $message,
            'from' => '4546'
        ]);
        $response_decoded = $response->json();
        if ($response->getStatusCode() == 401 ||
            (isset($response_decoded['status_code'])
                && $response_decoded['status_code'] == 500)) {
            $this->authorize();
            return $this->send($phone_to_send, $message);
        }
        if ($response->getStatusCode() == 400) {
            throw new PhoneError(__("Возниклы проблемы с вашим номером телефона"), 400);
        }
        return $response_decoded;
    }
}
