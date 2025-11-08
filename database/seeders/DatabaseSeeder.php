<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('explainings')->insert([
            ['id' => 1, 'EText' => 'توضيح أول (تجريبي)'],
            ['id' => 2, 'EText' => 'توضيح ثاني (تجريبي)'],
        ]);


        // ============================
        // ⚖️ RulingOfHadiths
        // ============================
        DB::table('ruling_of_hadiths')->insert([
            ['id' => 1, 'RulingText' => 'صحيح'],
            ['id' => 2, 'RulingText' => 'ضعيف'],
        ]);

        // ============================
        // 📚 Books
        // ============================
        DB::table('books')->insert([
            ['id' => 1, 'BookName' => 'صحيح البخاري', 'Muhaddith' => 1, 'NumOfHadiths' => 7563],
            ['id' => 2, 'BookName' => 'صحيح مسلم', 'Muhaddith' => 2, 'NumOfHadiths' => 3033],
            ['id' => 10, 'BookName' => 'صحيح الجامع', 'Muhaddith' => 9, 'NumOfHadiths' => 8201],
            ['id' => 14, 'BookName' => 'كتاب آخر (من بيانات الحديث رقم 6)', 'Muhaddith' => 1, 'NumOfHadiths' => 0],
        ]);

        // ============================
        // 👳 Narrators
        // ============================
        DB::table('narrators')->insert([
            ['id' => 20, 'Name' => 'أبو هريرة', 'Gender' => 'M', 'NarratorType' => 'Rawi'],
        ]);

        // ============================
        // 📖 Hadiths
        // ============================
        DB::table('hadiths')->insert([
            [
                'id' => 1,
                'SubValid' => null,
                'AdminID' => 1,
                'Explaining' => 1,
                'HadithType' => 'مرفوع',
                'HadithText' => 'لَيَأْتِيَنَّ علَى النَّاسِ زَمانٌ، لا يُبالِي المَرْءُ بما أخَذَ المالَ، أمِنْ حَلالٍ أمْ مِن حَرامٍ',
                'HadithNumber' => 2083,
                'RulingOfMuhaddith' => 1,
                'FinalRuling' => 1,
                'Narrator' => 20,
                'Source' => 1
            ],
            [
                'id' => 2,
                'SubValid' => null,
                'AdminID' => 1,
                'Explaining' => 1,
                'HadithType' => 'مرفوع',
                'HadithText' => ' لَيَأْتِيَنَّ علَى الناسِ زمانٍ لَا يُبَالِي المرءُ بِما أخذَ المالَ ؟ أَمِنْ حلالٍ، أم مِنْ حرامٍ ؟',
                'HadithNumber' => 5344,
                'RulingOfMuhaddith' => 1,
                'FinalRuling' => 1,
                'Narrator' => 20,
                'Source' => 10
            ],
            [
                'id' => 4,
                'SubValid' => null,
                'AdminID' => 1,
                'Explaining' => 2,
                'HadithType' => 'قدسي',
                'HadithText' => 'يَنْزِلُ رَبُّنا تَبارَكَ وتَعالَى كُلَّ لَيْلَةٍ إلى السَّماءِ الدُّنْيا...',
                'HadithNumber' => 7494,
                'RulingOfMuhaddith' => 1,
                'FinalRuling' => 1,
                'Narrator' => 20,
                'Source' => 1
            ],
            [
                'id' => 5,
                'SubValid' => null,
                'AdminID' => 1,
                'Explaining' => 2,
                'HadithType' => 'قدسي',
                'HadithText' => 'إذا مَضَى شَطْرُ اللَّيْلِ، أوْ ثُلُثاهُ، يَنْزِلُ اللَّهُ تَبارَكَ وتَعالَى إلى السَّماءِ الدُّنْيا...',
                'HadithNumber' => 758,
                'RulingOfMuhaddith' => 1,
                'FinalRuling' => 1,
                'Narrator' => 20,
                'Source' => 2
            ],
            [
                'id' => 6,
                'SubValid' => null,
                'AdminID' => 1,
                'Explaining' => 2,
                'HadithType' => 'قدسي',
                'HadithText' => 'ينزِلُ ربُّنا تبارَكَ وتعالى كلَّ ليلةٍ إلى سماءِ الدُّنيا حينَ يبقى ثلثُ اللَّيلِ الآخرِ...',
                'HadithNumber' => 1315,
                'RulingOfMuhaddith' => 1,
                'FinalRuling' => 1,
                'Narrator' => 20,
                'Source' => 14
            ],
        ]);
    }
}
