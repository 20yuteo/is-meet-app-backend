<?php

namespace App\Rules\User;

use Illuminate\Contracts\Validation\Rule;
use App\Domain\User\UserService;

class UpdateEmail implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $id)
    {
        $this->id = $id;
        $this->user_service = new UserService();
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
        return $this->user_service->checkToBeAbleToUpdateEmail($this->id, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'このメールアドレスは既に登録してあります。';
    }
}
