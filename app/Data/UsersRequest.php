<?php

namespace App\Data;

use App\Data\UserData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Carbon\CarbonImmutable;

class UsersRequest extends Data
{
    public function __construct(
        /** @var DataCollection<UserData> */
        public DataCollection $users,
    ) {
    }


    public static function rules(): array
    {
        return [
            'users' => ['required'],
        ];
    }
}