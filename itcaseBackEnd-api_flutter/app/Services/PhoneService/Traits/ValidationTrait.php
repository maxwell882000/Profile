<?php

namespace App\Services\PhoneService\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait ValidationTrait
{
    private function initialValidation(array $object_data, array $rules)
    {
        $validator = Validator::make(
            $object_data,
            $rules,
            $this->validationMessage()
        );
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            $collapsed = collect($errors)->collapse();
            return $collapsed->join(self::validationSeparator());
        }
        return "";
    }

    protected function validating(array $object_data, array $rules)
    {
        $error = $this->initialValidation($object_data, $rules);
        if ($error != "")
            throw ValidationException::withMessages(["error" => $error]);
    }

    protected function usualException(array $object_data, array $rules)
    {
        $error = $this->initialValidation($object_data, $rules);
        if ($error != "")
            throw new \Exception($error);
    }

    static public function validationSeparator(): string
    {
        return "<br>";
    }

    protected function validationMessage(): array
    {

        return [];
    }
}