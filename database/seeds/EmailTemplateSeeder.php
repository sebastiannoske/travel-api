<?php

use Illuminate\Database\Seeder;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\EmailTemplate::create([
            'event_id' => 1,
            'template_name' => 'Anlegen einer neuen Fahrt',
            'title' => 'Hallo,',
            'text' => 'bitte rufen Sie den folgenden Link auf, um Ihren Eintrag in der Mitfahrbörse zu bestätigen. Erst dann wird Ihr Eintrag veröffentlicht:',
            'closing' => 'Sie bekommen dann noch eine Email von uns, mit Ihren persönlichen Zugangsdaten für die Mitfahrbörse. Damit können Sie Ihren Eintrag jederzeit bearbeiten oder auch löschen.

Wir wünschen eine gute Anreise!

Am 2. Juli auf nach Hamburg zur G20-Protestwelle!

Beste Grüße
Marius Brey

––––––––––––––––––––––-
Marius Brey
Anreisekoordination
Tel: 030 81056025-8
Email: brey@g20-protestwelle.de'
        ]);

        App\EmailTemplate::create([
            'event_id' => 1,
            'template_name' => 'Bestätigung des Benutzer-Accounts',
            'title' => 'Hallo,',
            'text' => 'mit Ihrer Emailadresse und dem folgenden Passwort können Sie sich nun auf der Mitfahrbörse anmelden und Ihre Einträge bearbeiten oder auch löschen.',
            'closing' => 'Wir wünschen eine gute Anreise!

Am 2. Juli auf nach Hamburg zur G20-Protestwelle!

Beste Grüße
Marius Brey

––––––––––––––––––––––-
Marius Brey
Anreisekoordination
Tel: 030 81056025-8
Email: brey@g20-protestwelle.de'
        ]);

    }
}
