<?php

namespace Database\Seeders;

use App\Models\MessageTemplate;
use Illuminate\Database\Seeder;

class MessageTemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MessageTemplate::insert([
            [
                'name' => 'Смена номера телефона',
                'content' => 'Код подтверждения: ',
                'key' => 'change_phone',
            ],
            [
                'name' => 'Регистрация',
                'content' => 'Код подтверждения: ',
                'key' => 'register',
            ],
            [
                'name' => 'Восстановление пароля',
                'content' => 'Код подтверждения: ',
                'key' => 'recover_password',
            ],
            [
                'name' => 'Удаление аккаунта',
                'content' => 'Код подтверждения: ',
                'key' => 'delete_account',
            ],
        ]);
    }
}
