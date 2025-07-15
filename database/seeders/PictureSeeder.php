<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\ProgressBar;


class PictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->command->line('Downloading 30 random images.');
        $this->command->getOutput()->progressStart(30);
        for ($i=1; $i<30; $i++) {
            $url = 'https://picsum.photos/seed/'.uniqid().'/200/200';
            $file_name = storage_path('/tmp/').$i.'.jpg';
            file_put_contents( $file_name,file_get_contents($url));
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
