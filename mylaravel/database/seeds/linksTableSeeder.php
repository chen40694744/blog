<?php

use Illuminate\Database\Seeder;

class linksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $date=[
            [
            'link_name' => '我是友情链接',
            'link_title' => '友情链接',
            'link_url' => 'www.chenfengspace.com',
            'link_ord' => 1,
            ],
            [
                'link_name' => '我是友情链接',
                'link_title' => '百度搜索',
                'link_url' => 'www.baidu.com',
                'link_ord' => 2,
            ]
        ];
        DB::table('links')->insert($date);

    }
}
