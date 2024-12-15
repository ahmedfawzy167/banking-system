<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['name_en' => 'Cairo', 'name_ar' => 'القاهرة', 'country_id' => 1],
            ['name_en' => 'Alexandria', 'name_ar' => 'الإسكندرية', 'country_id' => 1],
            ['name_en' => 'Giza', 'name_ar' => 'الجيزة', 'country_id' => 1],
            ['name_en' => 'New York', 'name_ar' => 'نيويورك', 'country_id' => 2],
            ['name_en' => 'Los Angeles', 'name_ar' => 'لوس أنجلوس', 'country_id' => 2],
            ['name_en' => 'Chicago', 'name_ar' => 'شيكاغو', 'country_id' => 2],
            ['name_en' => 'Paris', 'name_ar' => 'باريس', 'country_id' => 3],
            ['name_en' => 'Marseille', 'name_ar' => 'مرسيليا', 'country_id' => 3],
            ['name_en' => 'Lyon', 'name_ar' => 'ليون', 'country_id' => 3],
            ['name_en' => 'Berlin', 'name_ar' => 'برلين', 'country_id' => 4],
            ['name_en' => 'Munich', 'name_ar' => 'ميونخ', 'country_id' => 4],
            ['name_en' => 'Hamburg', 'name_ar' => 'هامبورغ', 'country_id' => 4],
            ['name_en' => 'Tokyo', 'name_ar' => 'طوكيو', 'country_id' => 5],
            ['name_en' => 'Osaka', 'name_ar' => 'أوساكا', 'country_id' => 5],
            ['name_en' => 'Kyoto', 'name_ar' => 'كيوتو', 'country_id' => 5],
            ['name_en' => 'Beijing', 'name_ar' => 'بكين', 'country_id' => 6],
            ['name_en' => 'Shanghai', 'name_ar' => 'شنغهاي', 'country_id' => 6],
            ['name_en' => 'Guangzhou', 'name_ar' => 'قوانغتشو', 'country_id' => 6],
            ['name_en' => 'Sydney', 'name_ar' => 'سيدني', 'country_id' => 7],
            ['name_en' => 'Melbourne', 'name_ar' => 'ملبورن', 'country_id' => 7],
            ['name_en' => 'Brisbane', 'name_ar' => 'بريزبان', 'country_id' => 7],
            ['name_en' => 'Moscow', 'name_ar' => 'موسكو', 'country_id' => 8],
            ['name_en' => 'Saint Petersburg', 'name_ar' => 'سانت بطرسبرغ', 'country_id' => 8],
            ['name_en' => 'Kazan', 'name_ar' => 'قازان', 'country_id' => 8],
            ['name_en' => 'London', 'name_ar' => 'لندن', 'country_id' => 9],
            ['name_en' => 'Manchester', 'name_ar' => 'مانشستر', 'country_id' => 9],
            ['name_en' => 'Birmingham', 'name_ar' => 'برمنغهام', 'country_id' => 9],
            ['name_en' => 'Madrid', 'name_ar' => 'مدريد', 'country_id' => 10],
            ['name_en' => 'Barcelona', 'name_ar' => 'برشلونة', 'country_id' => 10],
            ['name_en' => 'Seville', 'name_ar' => 'إشبيلية', 'country_id' => 10],
            ['name_en' => 'Rome', 'name_ar' => 'روما', 'country_id' => 11],
            ['name_en' => 'Milan', 'name_ar' => 'ميلانو', 'country_id' => 11],
            ['name_en' => 'Naples', 'name_ar' => 'نابولي', 'country_id' => 11],
            ['name_en' => 'Istanbul', 'name_ar' => 'إسطنبول', 'country_id' => 12],
            ['name_en' => 'Ankara', 'name_ar' => 'أنقرة', 'country_id' => 12],
            ['name_en' => 'Izmir', 'name_ar' => 'إزمير', 'country_id' => 12],
            ['name_en' => 'Mexico City', 'name_ar' => 'مكسيكو سيتي', 'country_id' => 13],
            ['name_en' => 'Guadalajara', 'name_ar' => 'غوادالاخارا', 'country_id' => 13],
            ['name_en' => 'Monterrey', 'name_ar' => 'مونتيري', 'country_id' => 13],
            ['name_en' => 'Luxor', 'name_ar' => 'الأقصر', 'country_id' => 1],
            ['name_en' => 'Suez', 'name_ar' => 'السويس', 'country_id' => 1],
            ['name_en' => 'Hurghada', 'name_ar' => 'الغردقة', 'country_id' => 1],
            ['name_en' => 'Port Said', 'name_ar' => 'بورسعيد', 'country_id' => 1],
            ['name_en' => 'Aswan', 'name_ar' => 'أسوان', 'country_id' => 1],
            ['name_en' => 'Fayoum', 'name_ar' => 'الفيوم', 'country_id' => 1],
        ];

        City::insert($cities);
    }
}
