<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Illuminate\Validation\Rule;

class UserData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $username,
        public string $email,
        public bool $is_email_verified,
    ) {
    }

    public static function rules(): array
    {
      return [
            'id' => ['required', 'regex:/^[0-9]+$/i'],
            'name' => ['required', 'min:2', 'max:55'],
            'username' => ['required', 'min:2', 'max:55'],
            'email' => ['required', 'min:2', 'max:55', 'email', ],
            'is_email_verified' => ['required', 'boolean',],
        ];
    }
}