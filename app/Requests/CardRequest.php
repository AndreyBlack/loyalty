<?php

namespace App\Requests;

class CardRequest extends SmsVerificationRequest
{
    public function rules()
    {
        return parent::rules() + [
                'card' => ['required'],
            ];
    }

    public function getCard(): string
    {
        return $this->input('card');
    }

    protected function prepareForValidation()
    {
        $this->merge(['card' => $this->route('cardId')]);
    }

    public function messages()
    {
        return [
            'card.required' => __('loyalty.empty_field_card'),
            'card.card'    => __('loyalty.empty_field_card'),
        ];
    }
}
