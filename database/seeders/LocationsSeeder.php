<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::insert([
            [
                'name' => 'Европа',
                'code' => 'EU',
                'currency_code' => 'EUR',
            ],
            [
                'name' => 'Америка',
                'code' => 'USA',
                'currency_code' => 'USD'
            ]
        ]);

        Country::insert([
            [
                'location_id' => 2,
                'name' => 'Ангилья',
                'code' => 'AI',
            ],
            [
                'location_id' => 2,
                'name' => 'Антигуа и Барбуда',
                'code' => 'AG',
            ],
            [
                'location_id' => 2,
                'name' => 'Аргентина',
                'code' => 'AR',
            ],
            [
                'location_id' => 2,
                'name' => 'Аруба',
                'code' => 'AW',
            ],
            [
                'location_id' => 2,
                'name' => 'Багамы',
                'code' => 'BS',
            ],
            [
                'location_id' => 2,
                'name' => 'Барбадос',
                'code' => 'BB',
            ],
            [
                'location_id' => 2,
                'name' => 'Белиз',
                'code' => 'BZ',
            ],
            [
                'location_id' => 2,
                'name' => 'Бермуды',
                'code' => 'BM',
            ],
            [
                'location_id' => 2,
                'name' => 'Боливия',
                'code' => 'BO',
            ],
            [
                'location_id' => 2,
                'name' => 'Бонайре, Саба и Синт-Эстатиус',
                'code' => 'BQ',
            ],
            [
                'location_id' => 2,
                'name' => 'Бразилия',
                'code' => 'BR',
            ],
            [
                'location_id' => 2,
                'name' => 'Венесуэла',
                'code' => 'VE',
            ],
            [
                'location_id' => 2,
                'name' => 'Виргинские острова, Британские',
                'code' => 'VG',
            ],
            [
                'location_id' => 2,
                'name' => 'Виргинские острова, США',
                'code' => 'VI',
            ],
            [
                'location_id' => 2,
                'name' => 'Гаити',
                'code' => 'HT',
            ],
            [
                'location_id' => 2,
                'name' => 'Гайана',
                'code' => 'GY',
            ],
            [
                'location_id' => 2,
                'name' => 'Гваделупа',
                'code' => 'GP',
            ],
            [
                'location_id' => 2,
                'name' => 'Гватемала',
                'code' => 'GT',
            ],
            [
                'location_id' => 2,
                'name' => 'Гондурас',
                'code' => 'HN',
            ],
            [
                'location_id' => 2,
                'name' => 'Гренада',
                'code' => 'GD',
            ],
            [
                'location_id' => 2,
                'name' => 'Гренландия',
                'code' => 'GL',
            ],
            [
                'location_id' => 2,
                'name' => 'Доминика',
                'code' => 'DM',
            ],
            [
                'location_id' => 2,
                'name' => 'Доминиканская Республика',
                'code' => 'DO',
            ],
            [
                'location_id' => 2,
                'name' => 'Канада',
                'code' => 'CA',
            ],
            [
                'location_id' => 2,
                'name' => 'Колумбия',
                'code' => 'CO',
            ],
            [
                'location_id' => 2,
                'name' => 'Коста-Рика',
                'code' => 'CR',
            ],
            [
                'location_id' => 2,
                'name' => 'Куба',
                'code' => 'CU',
            ],
            [
                'location_id' => 2,
                'name' => 'Кюрасао',
                'code' => 'CW',
            ],
            [
                'location_id' => 2,
                'name' => 'Мартиника',
                'code' => 'MQ',
            ],
            [
                'location_id' => 2,
                'name' => 'Мексика',
                'code' => 'MX',
            ],
            [
                'location_id' => 2,
                'name' => 'Монтсеррат',
                'code' => 'MS',
            ],
            [
                'location_id' => 2,
                'name' => 'Нидерландские Антилы',
                'code' => 'AN',
            ],
            [
                'location_id' => 2,
                'name' => 'Никарагуа',
                'code' => 'NI',
            ],
            [
                'location_id' => 2,
                'name' => 'Остров Клиппертон',
                'code' => 'CP',
            ],
            [
                'location_id' => 2,
                'name' => 'Остров Святого Мартина',
                'code' => 'MF',
            ],
            [
                'location_id' => 2,
                'name' => 'Острова Кайман',
                'code' => 'KY',
            ],
            [
                'location_id' => 2,
                'name' => 'Острова Теркс и Кайкос',
                'code' => 'TC',
            ],
            [
                'location_id' => 2,
                'name' => 'Панама',
                'code' => 'PA',
            ],
            [
                'location_id' => 2,
                'name' => 'Парагвай',
                'code' => 'PY',
            ],
            [
                'location_id' => 2,
                'name' => 'Перу',
                'code' => 'PE',
            ],
            [
                'location_id' => 2,
                'name' => 'Пуэрто-Рико',
                'code' => 'PR',
            ],
            [
                'location_id' => 2,
                'name' => 'Сен-Бартельми',
                'code' => 'BL',
            ],
            [
                'location_id' => 2,
                'name' => 'Сен-Пьер и Микелон',
                'code' => 'PM',
            ],
            [
                'location_id' => 2,
                'name' => 'Сент-Винсент и Гренадины',
                'code' => 'VC',
            ],
            [
                'location_id' => 2,
                'name' => 'Сент-Китс и Невис',
                'code' => 'KN',
            ],
            [
                'location_id' => 2,
                'name' => 'Сент-Люсия',
                'code' => 'LC',
            ],
            [
                'location_id' => 2,
                'name' => 'Синт-Мартен',
                'code' => 'SX',
            ],
            [
                'location_id' => 2,
                'name' => 'Соединенные Штаты',
                'code' => 'US',
            ],
            [
                'location_id' => 2,
                'name' => 'Суринам',
                'code' => 'SR',
            ],
            [
                'location_id' => 2,
                'name' => 'Тринидад и Тобаго',
                'code' => 'TT',
            ],
            [
                'location_id' => 2,
                'name' => 'Уругвай',
                'code' => 'UY',
            ],
            [
                'location_id' => 2,
                'name' => 'Фолклендские острова (Мальвинские)',
                'code' => 'FK',
            ],
            [
                'location_id' => 2,
                'name' => 'Французская Гвиана',
                'code' => 'GF',
            ],
            [
                'location_id' => 2,
                'name' => 'Чили',
                'code' => 'CL',
            ],
            [
                'location_id' => 2,
                'name' => 'Эквадор',
                'code' => 'EC',
            ],
            [
                'location_id' => 2,
                'name' => 'Эль-Сальвадор',
                'code' => 'SV',
            ],
            [
                'location_id' => 2,
                'name' => 'Ямайка',
                'code' => 'JM',
            ],
            [
                'location_id' => 1,
                'name' => 'Австрия',
                'code' => 'AT',
            ],
            [
                'location_id' => 1,
                'name' => 'Албания',
                'code' => 'AL',
            ],
            [
                'location_id' => 1,
                'name' => 'Андорра',
                'code' => 'AD',
            ],
            [
                'location_id' => 1,
                'name' => 'Беларусь',
                'code' => 'BY',
            ],
            [
                'location_id' => 1,
                'name' => 'Бельгия',
                'code' => 'BE',
            ],
            [
                'location_id' => 1,
                'name' => 'Болгария',
                'code' => 'BG',
            ],
            [
                'location_id' => 1,
                'name' => 'Босния и Герцеговина',
                'code' => 'BA',
            ],
            [
                'location_id' => 1,
                'name' => 'Венгрия',
                'code' => 'HU',
            ],
            [
                'location_id' => 1,
                'name' => 'Германия',
                'code' => 'DE',
            ],
            [
                'location_id' => 1,
                'name' => 'Гернси',
                'code' => 'GG',
            ],
            [
                'location_id' => 1,
                'name' => 'Гибралтар',
                'code' => 'GI',
            ],
            [
                'location_id' => 1,
                'name' => 'Греция',
                'code' => 'GR',
            ],
            [
                'location_id' => 1,
                'name' => 'Дания',
                'code' => 'DK',
            ],
            [
                'location_id' => 1,
                'name' => 'Джерси',
                'code' => 'JE',
            ],
            [
                'location_id' => 1,
                'name' => 'Ирландия',
                'code' => 'IE',
            ],
            [
                'location_id' => 1,
                'name' => 'Исландия',
                'code' => 'IS',
            ],
            [
                'location_id' => 1,
                'name' => 'Испания',
                'code' => 'ES',
            ],
            [
                'location_id' => 1,
                'name' => 'Италия',
                'code' => 'IT',
            ],
            [
                'location_id' => 1,
                'name' => 'Косово',
                'code' => 'RK',
            ],
            [
                'location_id' => 1,
                'name' => 'Латвия',
                'code' => 'LV',
            ],
            [
                'location_id' => 1,
                'name' => 'Литва',
                'code' => 'LT',
            ],
            [
                'location_id' => 1,
                'name' => 'Лихтенштейн',
                'code' => 'LI',
            ],
            [
                'location_id' => 1,
                'name' => 'Люксембург',
                'code' => 'LU',
            ],
            [
                'location_id' => 1,
                'name' => 'Македония',
                'code' => 'MK',
            ],
            [
                'location_id' => 1,
                'name' => 'Мальта',
                'code' => 'MT',
            ],
            [
                'location_id' => 1,
                'name' => 'Молдова, Республика',
                'code' => 'MD',
            ],
            [
                'location_id' => 1,
                'name' => 'Монако',
                'code' => 'MC',
            ],
            [
                'location_id' => 1,
                'name' => 'Нидерланды',
                'code' => 'NL',
            ],
            [
                'location_id' => 1,
                'name' => 'Норвегия',
                'code' => 'NO',
            ],
            [
                'location_id' => 1,
                'name' => 'Остров Мэн',
                'code' => 'IM',
            ],
            [
                'location_id' => 1,
                'name' => 'Папский Престол (Государство - город Ватикан)',
                'code' => 'VA',
            ],
            [
                'location_id' => 1,
                'name' => 'Польша',
                'code' => 'PL',
            ],
            [
                'location_id' => 1,
                'name' => 'Португалия',
                'code' => 'PT',
            ],
            [
                'location_id' => 1,
                'name' => 'Россия',
                'code' => 'RU',
            ],
            [
                'location_id' => 1,
                'name' => 'Румыния',
                'code' => 'RO',
            ],
            [
                'location_id' => 1,
                'name' => 'Сан-Марино',
                'code' => 'SM',
            ],
            [
                'location_id' => 1,
                'name' => 'Сербия',
                'code' => 'RS',
            ],
            [
                'location_id' => 1,
                'name' => 'Словакия',
                'code' => 'SK',
            ],
            [
                'location_id' => 1,
                'name' => 'Словения',
                'code' => 'SI',
            ],
            [
                'location_id' => 1,
                'name' => 'Соединенное Королевство',
                'code' => 'GB',
            ],
            [
                'location_id' => 1,
                'name' => 'Украина',
                'code' => 'UA',
            ],
            [
                'location_id' => 1,
                'name' => 'Фарерские острова',
                'code' => 'FO',
            ],
            [
                'location_id' => 1,
                'name' => 'Финляндия',
                'code' => 'FI',
            ],
            [
                'location_id' => 1,
                'name' => 'Франция',
                'code' => 'FR',
            ],
            [
                'location_id' => 1,
                'name' => 'Хорватия',
                'code' => 'HR',
            ],
            [
                'location_id' => 1,
                'name' => 'Черногория',
                'code' => 'ME',
            ],
            [
                'location_id' => 1,
                'name' => 'Чешская Республика',
                'code' => 'CZ',
            ],
            [
                'location_id' => 1,
                'name' => 'Швейцария',
                'code' => 'CH',
            ],
            [
                'location_id' => 1,
                'name' => 'Швеция',
                'code' => 'SE',
            ],
            [
                'location_id' => 1,
                'name' => 'Шпицберген и Ян Майен',
                'code' => 'SJ',
            ],
            [
                'location_id' => 1,
                'name' => 'Эландские острова',
                'code' => 'AX',
            ],
            [
                'location_id' => 1,
                'name' => 'Эстония',
                'code' => 'EE',
            ],
        ]);
    }
}
