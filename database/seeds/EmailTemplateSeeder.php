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
            'template_name' => 'Anlegen einer neuen Reise',
            'title' => 'Eine neue Fahrt wurde angelegt,',
            'text' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam.',
            'closing' => 'mit freundlichen Grüßen

Ihr Team.'
        ]);

        App\EmailTemplate::create([
            'event_id' => 1,
            'template_name' => 'Bestätigung des Benutzer-Accounts',
            'title' => 'Hallo',
            'text' => 'Deine E-Mail Adresse wurde bestätigt. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam.',
            'closing' => 'mit freundlichen Grüßen

Ihr Team.'
        ]);

    }
}
