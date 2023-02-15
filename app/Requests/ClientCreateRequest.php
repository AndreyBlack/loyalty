<?php

namespace App\Requests;

use App\Contracts\BaseDTO;
use App\Enums\CustomerStatus;
use App\Enums\Gender;
use App\Enums\FamilyStatus;
use App\Enums\ContactType;
use App\Enums\LoyaltyType;
use App\Enums\HasChildren;
use Illuminate\Validation\Rule;
use App\Contracts\GetterDTO;
use App\DTO\CustomerAddDTO;
use Illuminate\Validation\Rules\Enum;

class ClientCreateRequest extends SmsVerificationRequest implements GetterDTO
{
    public function rules()
    {
        return parent::rules() + [
                'lastName' => ['required', 'string'],
                'firstName' => ['required', 'string'],
                'middleName' => ['required', 'string'],
                'genderCode' => ['required', Rule::in(Gender::getValues())],
                'emailAddress' => ['string'],
                'birthDate' => ['date', 'before:today'],
                'familyStatusCode' => [new Enum(FamilyStatus::class)],
                'hasChildrenCode' => [new Enum(HasChildren::class)],
                'orgUnitId' => [new Enum(LoyaltyType::class)],
                'communicationMethod' => [Rule::in(ContactType::getValues())],
                'status' => [new Enum(CustomerStatus::class)],
                'allowNotification' => ['bool'],
                'allowEmail' => ['bool'],
                'allowSms' => ['bool'],
                'allowPhone' => ['bool'],
                'allowPush' => ['bool']
            ];
    }

    public function messages()
    {
        return [
            'phone.required'       => __('customer.phone_required'),
            'phone.regex'          => __('customer.phone_mallformed'),
            'firstName.required'   => __('customer.first_name_required'),
            'lastName.required'    => __('customer.last_name_required'),
            'middleName.string'    => __('customer.middle_name_required'),
            'birthdate.required'   => __('customer.birthdate_required'),
            'birthdate.date'       => __('customer.birthdate_invalid'),
            'gender.required'      => __('customer.gender_required'),
        ];
    }

    public function getDTO(): BaseDTO
    {
        return new CustomerAddDTO($this->val);
    }
}