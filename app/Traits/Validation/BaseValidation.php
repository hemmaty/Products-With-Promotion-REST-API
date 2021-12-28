<?php
namespace App\Traits\Validation;


use App\Enum\Response\ResponseHelper;
use Illuminate\Http\Request;

Trait BaseValidation
{

    /**
     * @param Request $request
     * @param array $errors
     * @return mixed
     */
    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        if (isset(static::$responseBuilder)) {
            return (static::$responseBuilder)($request, $errors);
        }

        return response()->error($errors,ResponseHelper::ERROR,ResponseHelper::HTTP_VALIDATION_ERROR);
    }
}