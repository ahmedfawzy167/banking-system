<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['name_en' => 'Egypt', 'name_ar' => 'مصر', 'code' => 'EG'],
            ['name_en' => 'Afghanistan', 'name_ar' => 'أفغانستان', 'code' => 'AF'],
            ['name_en' => 'Albania', 'name_ar' => 'ألبانيا', 'code' => 'AL'],
            ['name_en' => 'Algeria', 'name_ar' => 'الجزائر', 'code' => 'DZ'],
            ['name_en' => 'Andorra', 'name_ar' => 'أندورا', 'code' => 'AD'],
            ['name_en' => 'Angola', 'name_ar' => 'أنغولا', 'code' => 'AO'],
            ['name_en' => 'Antigua and Barbuda', 'name_ar' => 'أنتيغوا وبربودا', 'code' => 'AG'],
            ['name_en' => 'Argentina', 'name_ar' => 'الأرجنتين', 'code' => 'AR'],
            ['name_en' => 'Armenia', 'name_ar' => 'أرمينيا', 'code' => 'AM'],
            ['name_en' => 'Australia', 'name_ar' => 'أستراليا', 'code' => 'AU'],
            ['name_en' => 'Austria', 'name_ar' => 'النمسا', 'code' => 'AT'],
            ['name_en' => 'Azerbaijan', 'name_ar' => 'أذربيجان', 'code' => 'AZ'],
            ['name_en' => 'Bahamas', 'name_ar' => 'الباهاماس', 'code' => 'BS'],
            ['name_en' => 'Bahrain', 'name_ar' => 'البحرين', 'code' => 'BH'],
            ['name_en' => 'Bangladesh', 'name_ar' => 'بنغلاديش', 'code' => 'BD'],
            ['name_en' => 'Barbados', 'name_ar' => 'بربادوس', 'code' => 'BB'],
            ['name_en' => 'Belarus', 'name_ar' => 'بيلاروسيا', 'code' => 'BY'],
            ['name_en' => 'Belgium', 'name_ar' => 'بلجيكا', 'code' => 'BE'],
            ['name_en' => 'Belize', 'name_ar' => 'بليز', 'code' => 'BZ'],
            ['name_en' => 'Benin', 'name_ar' => 'بنين', 'code' => 'BJ'],
            ['name_en' => 'Bhutan', 'name_ar' => 'بوتان', 'code' => 'BT'],
            ['name_en' => 'Bolivia', 'name_ar' => 'بوليفيا', 'code' => 'BO'],
            ['name_en' => 'Bosnia and Herzegovina', 'name_ar' => 'البوسنة والهرسك', 'code' => 'BA'],
            ['name_en' => 'Botswana', 'name_ar' => 'بوتسوانا', 'code' => 'BW'],
            ['name_en' => 'Brazil', 'name_ar' => 'البرازيل', 'code' => 'BR'],
            ['name_en' => 'Brunei', 'name_ar' => 'بروناي', 'code' => 'BN'],
            ['name_en' => 'Bulgaria', 'name_ar' => 'بلغاريا', 'code' => 'BG'],
            ['name_en' => 'Burkina Faso', 'name_ar' => 'بوركينا فاسو', 'code' => 'BF'],
            ['name_en' => 'Burundi', 'name_ar' => 'بوروندي', 'code' => 'BI'],
            ['name_en' => 'Cabo Verde', 'name_ar' => 'الرأس الأخضر', 'code' => 'CV'],
            ['name_en' => 'Cambodia', 'name_ar' => 'كمبوديا', 'code' => 'KH'],
            ['name_en' => 'Cameroon', 'name_ar' => 'الكاميرون', 'code' => 'CM'],
            ['name_en' => 'Canada', 'name_ar' => 'كندا', 'code' => 'CA'],
            ['name_en' => 'Central African Republic', 'name_ar' => 'جمهورية أفريقيا الوسطى', 'code' => 'CF'],
            ['name_en' => 'Chad', 'name_ar' => 'تشاد', 'code' => 'TD'],
            ['name_en' => 'Chile', 'name_ar' => 'تشيلي', 'code' => 'CL'],
            ['name_en' => 'China', 'name_ar' => 'الصين', 'code' => 'CN'],
            ['name_en' => 'Colombia', 'name_ar' => 'كولومبيا', 'code' => 'CO'],
            ['name_en' => 'Comoros', 'name_ar' => 'جزر القمر', 'code' => 'KM'],
            ['name_en' => 'Congo (Congo-Brazzaville)', 'name_ar' => 'الكونغو (برازافيل)', 'code' => 'CG'],
            ['name_en' => 'Costa Rica', 'name_ar' => 'كوستاريكا', 'code' => 'CR'],
            ['name_en' => 'Croatia', 'name_ar' => 'كرواتيا', 'code' => 'HR'],
            ['name_en' => 'Cuba', 'name_ar' => 'كوبا', 'code' => 'CU'],
            ['name_en' => 'Cyprus', 'name_ar' => 'قبرص', 'code' => 'CY'],
            ['name_en' => 'Czechia', 'name_ar' => 'التشيك', 'code' => 'CZ'],
            ['name_en' => 'Denmark', 'name_ar' => 'الدنمارك', 'code' => 'DK'],
            ['name_en' => 'Djibouti', 'name_ar' => 'جيبوتي', 'code' => 'DJ'],
            ['name_en' => 'Dominica', 'name_ar' => 'دومينيكا', 'code' => 'DM'],
            ['name_en' => 'Dominican Republic', 'name_ar' => 'جمهورية الدومينيكان', 'code' => 'DO'],
            ['name_en' => 'Ecuador', 'name_ar' => 'الإكوادور', 'code' => 'EC'],
            ['name_en' => 'El Salvador', 'name_ar' => 'السلفادور', 'code' => 'SV'],
            ['name_en' => 'Equatorial Guinea', 'name_ar' => 'غينيا الاستوائية', 'code' => 'GQ'],
            ['name_en' => 'Eritrea', 'name_ar' => 'إريتريا', 'code' => 'ER'],
            ['name_en' => 'Estonia', 'name_ar' => 'إستونيا', 'code' => 'EE'],
            ['name_en' => 'Eswatini', 'name_ar' => 'إسواتيني', 'code' => 'SZ'],
            ['name_en' => 'Ethiopia', 'name_ar' => 'إثيوبيا', 'code' => 'ET'],
            ['name_en' => 'Fiji', 'name_ar' => 'فيجي', 'code' => 'FJ'],
            ['name_en' => 'Finland', 'name_ar' => 'فنلندا', 'code' => 'FI'],
            ['name_en' => 'France', 'name_ar' => 'فرنسا', 'code' => 'FR'],
            ['name_en' => 'Gabon', 'name_ar' => 'الغابون', 'code' => 'GA'],
            ['name_en' => 'Gambia', 'name_ar' => 'غامبيا', 'code' => 'GM'],
            ['name_en' => 'Georgia', 'name_ar' => 'جورجيا', 'code' => 'GE'],
            ['name_en' => 'Germany', 'name_ar' => 'ألمانيا', 'code' => 'DE'],
            ['name_en' => 'Ghana', 'name_ar' => 'غانا', 'code' => 'GH'],
            ['name_en' => 'Greece', 'name_ar' => 'اليونان', 'code' => 'GR'],
            ['name_en' => 'Grenada', 'name_ar' => 'غرينادا', 'code' => 'GD'],
            ['name_en' => 'Guatemala', 'name_ar' => 'غواتيمالا', 'code' => 'GT'],
            ['name_en' => 'Guinea', 'name_ar' => 'غينيا', 'code' => 'GN'],
            ['name_en' => 'Guyana', 'name_ar' => 'غيانا', 'code' => 'GY'],
            ['name_en' => 'Haiti', 'name_ar' => 'هايتي', 'code' => 'HT'],
            ['name_en' => 'Honduras', 'name_ar' => 'هندوراس', 'code' => 'HN'],
            ['name_en' => 'Hungary', 'name_ar' => 'المجر', 'code' => 'HU'],
            ['name_en' => 'Iceland', 'name_ar' => 'آيسلندا', 'code' => 'IS'],
            ['name_en' => 'India', 'name_ar' => 'الهند', 'code' => 'IN'],
            ['name_en' => 'Indonesia', 'name_ar' => 'إندونيسيا', 'code' => 'ID'],
            ['name_en' => 'Iran', 'name_ar' => 'إيران', 'code' => 'IR'],
            ['name_en' => 'Iraq', 'name_ar' => 'العراق', 'code' => 'IQ'],
            ['name_en' => 'Ireland', 'name_ar' => 'أيرلندا', 'code' => 'IE'],
            ['name_en' => 'Israel', 'name_ar' => 'إسرائيل', 'code' => 'IL'],
            ['name_en' => 'Italy', 'name_ar' => 'إيطاليا', 'code' => 'IT'],
            ['name_en' => 'Jamaica', 'name_ar' => 'جامايكا', 'code' => 'JM'],
            ['name_en' => 'Japan', 'name_ar' => 'اليابان', 'code' => 'JP'],
            ['name_en' => 'Jordan', 'name_ar' => 'الأردن', 'code' => 'JO'],
        ];

        Country::insert($countries);
    }
}
