<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{

    private $data = [
        [
            'parent_id' => 0,
            'order' => 0,
            'title' => 'API Keys',
            'icon' => 'fa-key',
            'uri' => '/api-keys',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->data as $item) {
            if (DB::table('admin_menu')->where('uri', $item['uri'])->exists()) {
                continue;
            }
            DB::table('admin_menu')->insert($item);
        }
    }
}