<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Domain\Member\MemberService;

class UniqueMemberName implements Rule
{
    private $member_service;

    private $token;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $token)
    {
        $this->member_service = new MemberService();

        $this->token = $token;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->member_service->checkExistsMemberName($this->token, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'この参加者名は既に登録されています。';
    }
}
