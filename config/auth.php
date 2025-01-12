<?php
//
//return [
//
//    /*
//    |--------------------------------------------------------------------------
//    | Authentication Defaults
//    |--------------------------------------------------------------------------
//    |
//    | This option defines the default authentication "guard" and password
//    | reset "broker" for your application. You may change these values
//    | as required, but they're a perfect start for most applications.
//    |
//    */
//
//    'defaults' => [
//        'guard' => env('AUTH_GUARD', 'web'),
//        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
//    ],
//
//    /*
//    |--------------------------------------------------------------------------
//    | Authentication Guards
//    |--------------------------------------------------------------------------
//    |
//    | Next, you may define every authentication guard for your application.
//    | Of course, a great default configuration has been defined for you
//    | which utilizes session storage plus the Eloquent user provider.
//    |
//    | All authentication guards have a user provider, which defines how the
//    | users are actually retrieved out of your database or other storage
//    | system used by the application. Typically, Eloquent is utilized.
//    |
//    | Supported: "session"
//    |
//    */
//
//    'guards' => [
//        'web' => [
//            'driver' => 'session',
//            'provider' => 'users',
//        ],
//    ],
//
//    /*
//    |--------------------------------------------------------------------------
//    | User Providers
//    |--------------------------------------------------------------------------
//    |
//    | All authentication guards have a user provider, which defines how the
//    | users are actually retrieved out of your database or other storage
//    | system used by the application. Typically, Eloquent is utilized.
//    |
//    | If you have multiple user tables or models you may configure multiple
//    | providers to represent the model / table. These providers may then
//    | be assigned to any extra authentication guards you have defined.
//    |
//    | Supported: "database", "eloquent"
//    |
//    */
//
//    'providers' => [
//        'users' => [
//            'driver' => 'eloquent',
//            'model' => env('AUTH_MODEL', App\Models\User::class),
//
//        ],
//
//        // 'users' => [
//        //     'driver' => 'database',
//        //     'table' => 'users',
//        // ],
//    ],
//
//    /*
//    |--------------------------------------------------------------------------
//    | Resetting Passwords
//    |--------------------------------------------------------------------------
//    |
//    | These configuration options specify the behavior of Laravel's password
//    | reset functionality, including the table utilized for token storage
//    | and the user provider that is invoked to actually retrieve users.
//    |
//    | The expiry time is the number of minutes that each reset token will be
//    | considered valid. This security feature keeps tokens short-lived so
//    | they have less time to be guessed. You may change this as needed.
//    |
//    | The throttle setting is the number of seconds a user must wait before
//    | generating more password reset tokens. This prevents the user from
//    | quickly generating a very large amount of password reset tokens.
//    |
//    */
//
//    'passwords' => [
//        'users' => [
//            'provider' => 'users',
//            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
//            'expire' => 60,
//            'throttle' => 60,
//        ],
//    ],
//
//    /*
//    |--------------------------------------------------------------------------
//    | Password Confirmation Timeout
//    |--------------------------------------------------------------------------
//    |
//    | Here you may define the amount of seconds before a password confirmation
//    | window expires and users are asked to re-enter their password via the
//    | confirmation screen. By default, the timeout lasts for three hours.
//    |
//    */
//
//    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),
//
//];


return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | Tutaj definiujemy domyślne ustawienia dla autoryzacji. Strażnik (guard)
    | 'web' jest używany dla sesji, a 'users' jest domyślnie używany do
    | resetowania haseł. Możemy to zmienić w zależności od potrzeb.
    |
    */

    'defaults' => [
        'guard' => 'web', // Ustawienie strażnika sesji jako domyślnego
        'passwords' => 'users', // Ustawienie domyślnego brokera dla resetu haseł
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Strażnicy (guards) definiują, w jaki sposób użytkownicy są autoryzowani.
    | 'web' wykorzystuje sesje (dla użytkowników korzystających z przeglądarki).
    | 'api' wykorzystuje tokeny API, które są przesyłane w nagłówku zapytania.
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session', // Sesje są używane do przechowywania sesji logowania
            'provider' => 'users', // Dostawcą danych jest model User
        ],

        'api' => [
            'driver' => 'token', // Używamy tokenów API do autoryzacji
            'provider' => 'customers', // Użytkownicy API są pobierani z tabeli 'customers'
            'hash' => false, // Nie haszujemy tokenów, używamy prostych losowych ciągów
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Dostawcy definiują, skąd pochodzą dane użytkowników. Można tutaj ustawić
    | kilka źródeł, na przykład jedna tabela dla użytkowników back-office, a
    | inna tabela dla użytkowników API.
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent', // Korzystamy z Eloquent ORM
            'model' => App\Models\User::class, // Użytkownicy back-office
        ],

        'customers' => [
            'driver' => 'eloquent', // Korzystamy z Eloquent ORM
            'model' => App\Models\Customer::class, // Użytkownicy API z tabeli 'customers'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Opcje dotyczące resetowania haseł. Można ustawić, która tabela ma być
    | używana do przechowywania tokenów do resetowania haseł oraz określić
    | czas, na jaki token resetowania jest ważny (domyślnie 60 minut).
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users', // Brokera resetowania haseł dla użytkowników back-office
            'table' => 'password_resets', // Tabela, w której przechowywane są tokeny do resetowania
            'expire' => 60, // Token resetowania hasła jest ważny przez 60 minut
            'throttle' => 60, // Minimalna liczba sekund między próbami resetu
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Czas, po jakim użytkownik musi ponownie wprowadzić swoje hasło przy
    | wykonywaniu pewnych wrażliwych operacji (np. zmiana hasła). Domyślnie
    | ustawione na 3 godziny.
    |
    */

    'password_timeout' => 10800, // Timeout dla potwierdzenia hasła (w sekundach)

];
