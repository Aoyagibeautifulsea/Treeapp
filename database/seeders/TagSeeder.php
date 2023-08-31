<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;
class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
                'name' => '紀元前',
                'category' => '時代',
         ]);
         DB::table('tags')->insert([
            'name' => '上代（奈良時代）',
            'category' => '時代',
        ]);
        DB::table('tags')->insert([
            'name' => '中古（平安時代）',
            'category' => '時代',
        ]);
        DB::table('tags')->insert([
            'name' => '中世（鎌倉時代、南北朝時代、室町時代）',
            'category' => '時代',
        ]);
        DB::table('tags')->insert([
            'name' => '近世（安土桃山時代、江戸時代）',
            'category' => '時代',
        ]);
        DB::table('tags')->insert([
            'name' => '近代（明治時代）',
            'category' => '時代',
        ]);
        DB::table('tags')->insert([
            'name' => '近代（大正時代）',
            'category' => '時代',
        ]);
        DB::table('tags')->insert([
            'name' => '現代（昭和時代）',
            'category' => '時代',
        ]);
        DB::table('tags')->insert([
            'name' => '現代（平成時代）',
            'category' => '時代',
        ]);
        DB::table('tags')->insert([
            'name' => '最新の作品（令和時代）',
            'category' => '時代',
        ]);
        DB::table('tags')->insert([
            'name' => '日本の作品',
            'category' => '地域',
        ]);
        DB::table('tags')->insert([
            'name' => '異国の作品',
            'category' => '地域',
        ]);
        DB::table('tags')->insert([
            'name' => '神話・伝説',
            'category' => '形態',
        ]);
        DB::table('tags')->insert([
            'name' => '物語・説話',
            'category' => '形態',
        ]);
        DB::table('tags')->insert([
            'name' => '小説（フィクション）',
            'category' => '形態',
        ]);
        DB::table('tags')->insert([
            'name' => '戯曲',
            'category' => '形態',
        ]);
        DB::table('tags')->insert([
            'name' => '随筆（エッセイ）',
            'category' => '形態',
        ]);
        DB::table('tags')->insert([
            'name' => '紀行',
            'category' => '形態',
        ]);
        DB::table('tags')->insert([
            'name' => '日記',
            'category' => '形態',
        ]);
        DB::table('tags')->insert([
            'name' => '自伝、伝記、評伝',
            'category' => '形態',
        ]);
        DB::table('tags')->insert([
            'name' => '評論、書評',
            'category' => '形態',
        ]);
        DB::table('tags')->insert([
            'name' => 'ノンフィクション',
            'category' => '形態',
        ]);
        DB::table('tags')->insert([
            'name' => '詩歌（和歌、短歌、蓮歌、狂歌）',
            'category' => '形態',
        ]);
        DB::table('tags')->insert([
            'name' => '詩歌（俳句、連句、川柳）',
            'category' => '形態',
        ]);
        DB::table('tags')->insert([
            'name' => '詩歌（漢詩）',
            'category' => '形態',
        ]);
        DB::table('tags')->insert([
            'name' => 'ミステリー',
            'category' => 'ジャンル',
        ]);
        DB::table('tags')->insert([
            'name' => 'サスペンス',
            'category' => 'ジャンル',
        ]);
        DB::table('tags')->insert([
            'name' => 'コメディ',
            'category' => 'ジャンル',
        ]);
        DB::table('tags')->insert([
            'name' => 'SF',
            'category' => 'ジャンル',
        ]);
        DB::table('tags')->insert([
            'name' => 'ファンタジー',
            'category' => 'ジャンル',
        ]);
        DB::table('tags')->insert([
            'name' => 'アクション',
            'category' => 'ジャンル',
        ]);
        DB::table('tags')->insert([
            'name' => '歴史（歴史物語も含む）',
            'category' => 'ジャンル',
        ]);
        DB::table('tags')->insert([
            'name' => '写実主義',
            'category' => '主義・派閥',
        ]);
        DB::table('tags')->insert([
            'name' => '理想主義',
            'category' => '主義・派閥',
        ]);
        DB::table('tags')->insert([
            'name' => 'ロマン主義',
            'category' => '主義・派閥',
        ]);
        DB::table('tags')->insert([
            'name' => '自然主義',
            'category' => '主義・派閥',
        ]);
        DB::table('tags')->insert([
            'name' => '反自然主義',
            'category' => '主義・派閥',
        ]);
        DB::table('tags')->insert([
            'name' => '新心理主義',
            'category' => '主義・派閥',
        ]);
        DB::table('tags')->insert([
            'name' => '民主主義',
            'category' => '主義・派閥',
        ]);
        DB::table('tags')->insert([
            'name' => '社会主義',
            'category' => '主義・派閥',
        ]);
        DB::table('tags')->insert([
            'name' => 'プロレタリア文学',
            'category' => '主義・派閥',
        ]);
        DB::table('tags')->insert([
            'name' => '硯友社',
            'category' => '主義・派閥',
        ]);
        DB::table('tags')->insert([
            'name' => '耽美派',
            'category' => '主義・派閥',
        ]);
        DB::table('tags')->insert([
            'name' => '白樺派',
            'category' => '主義・派閥',
        ]);
        DB::table('tags')->insert([
            'name' => '新思潮派',
            'category' => '主義・派閥',
        ]);
        DB::table('tags')->insert([
            'name' => '奇蹟派',
            'category' => '主義・派閥',
        ]);
        DB::table('tags')->insert([
            'name' => '新感覚派',
            'category' => '主義・派閥',
        ]);
        DB::table('tags')->insert([
            'name' => '新興芸術派',
            'category' => '主義・派閥',
        ]);
        DB::table('tags')->insert([
            'name' => '無頼派',
            'category' => '主義・派閥',
        ]);
    }
}
