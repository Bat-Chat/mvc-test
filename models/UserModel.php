<?php

namespace app\models;

use app\core\models\DbModel;

class UserModel extends DbModel
{
    public int $id = 0;
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $phone = '';
    public string $password = '';

    public static function getTableName(): string
    {
        return 'users';
    }

    public function getAttributes(): array
    {
        return ['firstname', 'lastname', 'email', 'phone', 'password'];
    }

    public function save(): bool
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        return parent::save();
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'phone' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
        ];
    }

    public function labels(): array
    {
        return [
            'firstname' => 'First name',
            'lastname' => 'Last name',
            'email' => 'E-mail',
            'phone' => 'Mobile phone',
            'password' => 'Password',
        ];
    }
}
