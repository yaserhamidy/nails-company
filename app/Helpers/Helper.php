<?php
namespace App\Helpers;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Carbon;

class Helper
{

    public static function IDGenerator($model, $trow, $length = 4, $prefix) {
        $data = $model::orderBy('student_id', 'desc')->first();
        if (!$data) {
            $increment_last_number = 1;
            $og_length = $length - 1;
        } else {
            $code = substr($data->$trow, strlen($prefix) + 1);
            $actial_last_number = ($code / 1) * 1;
            $increment_last_number = ((int)$actial_last_number) + 1;
            if ($increment_last_number == 0) {
                $increment_last_number = 1;
            }
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
        }
        $zeros = "";
        for ($i = 0; $i < $og_length; $i++) {
            $zeros .= "0";
        }
        return $prefix . $zeros . $increment_last_number;
    }





    public static function convertToGregorian($date, $dateFormat)
    {
        if ($dateFormat === 'shamsi') {
            if ($date) {
                // تبدیل اعداد فارسی به لاتین
                $latinDate = self::persian_to_latin($date);
    
                try {
                    // تبدیل تاریخ شمسی به میلادی
                    return Jalalian::fromFormat('Y/m/d', $latinDate)->toCarbon();
                } catch (\Exception $e) {
                    // در صورت خطا در تبدیل تاریخ، مقدار پیش‌فرض میلادی برمی‌گردد
                    return Carbon::now()->format('Y-m-d');
                }
            } else {
                // اگر تاریخ ورودی وجود نداشت، تاریخ کنونی میلادی برگردانده می‌شود
                return Carbon::now()->format('Y-m-d');
            }
        } else {
            // اگر تاریخ به میلادی است، بدون تغییر برگردانده می‌شود
            if ($date) {
                return Carbon::parse($date)->format('Y-m-d');
            } else {
                // اگر تاریخ ورودی وجود نداشت، تاریخ کنونی میلادی برگردانده می‌شود
                return Carbon::now()->format('Y-m-d');
            }
        }
    }
    
    public static function persian_to_latin($input)
    {
        // تبدیل اعداد فارسی به لاتین
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $latin = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    
        return str_replace($persian, $latin, $input);
    }
    

    public static function is_persian_date($date)
{
    // بررسی فرمت تاریخ برای شناسایی شمسی بودن
    return preg_match('/^[\x{06F0}-\x{06F9}0-9]{4}\/[\x{06F0}-\x{06F9}0-9]{2}\/[\x{06F0}-\x{06F9}0-9]{2}$/u', $date);
}









    public static function numberToPersianWords($number)
    {
        $units = [
            __('layout.zero'), __('layout.one'), __('layout.two'), __('layout.three'), 
            __('layout.four'), __('layout.five'), __('layout.six'), __('layout.seven'), 
            __('layout.eight'), __('layout.nine')
        ];
        $teens = [
            __('layout.ten'), __('layout.eleven'), __('layout.twelve'), __('layout.thirteen'), 
            __('layout.fourteen'), __('layout.fifteen'), __('layout.sixteen'), __('layout.seventeen'), 
            __('layout.eighteen'), __('layout.nineteen')
        ];
        $tens = [
            __('layout.twenty'), __('layout.thirty'), __('layout.forty'), __('layout.fifty'), 
            __('layout.sixty'), __('layout.seventy'), __('layout.eighty'), __('layout.ninety')
        ];
        $hundreds = [
            __('layout.hundred'), __('layout.two_hundred'), __('layout.three_hundred'), __('layout.four_hundred'), 
            __('layout.five_hundred'), __('layout.six_hundred'), __('layout.seven_hundred'), __('layout.eight_hundred'), 
            __('layout.nine_hundred')
        ];
        $thousands = [__('layout.thousand')];
        $millions = [__('layout.million')];
        $billions = [__('layout.billion')];

        if ($number < 0) return '';
        if ($number == 0) return $units[0];

        $words = '';

        if ($number >= 1000000000) {
            $billionPart = floor($number / 1000000000);
            if ($billionPart > 0) {
                $words .= self::convertToWords($billionPart) . ' ' . $billions[0] . ' ';
                $number %= 1000000000;
            }
        }

        if ($number >= 1000000) {
            $millionPart = floor($number / 1000000);
            if ($millionPart > 0) {
                $words .= self::convertToWords($millionPart) . ' ' . $millions[0] . ' ';
                $number %= 1000000;
            }
        }

        if ($number >= 1000) {
            $thousandPart = floor($number / 1000);
            if ($thousandPart > 0) {
                $words .= self::convertToWords($thousandPart) . ' ' . $thousands[0] . ' ';
                $number %= 1000;
            }
        }

        if ($number > 0) {
            $words .= self::convertToWords($number);
        }

        return trim($words);
    }

    public static function convertToWords($number)
    {
        $units = [
            __('layout.zero'), __('layout.one'), __('layout.two'), __('layout.three'), 
            __('layout.four'), __('layout.five'), __('layout.six'), __('layout.seven'), 
            __('layout.eight'), __('layout.nine')
        ];
        $teens = [
            __('layout.ten'), __('layout.eleven'), __('layout.twelve'), __('layout.thirteen'), 
            __('layout.fourteen'), __('layout.fifteen'), __('layout.sixteen'), __('layout.seventeen'), 
            __('layout.eighteen'), __('layout.nineteen')
        ];
        $tens = [
            __('layout.twenty'), __('layout.thirty'), __('layout.forty'), __('layout.fifty'), 
            __('layout.sixty'), __('layout.seventy'), __('layout.eighty'), __('layout.ninety')
        ];
        $hundreds = [
            __('layout.hundred'), __('layout.two_hundred'), __('layout.three_hundred'), __('layout.four_hundred'), 
            __('layout.five_hundred'), __('layout.six_hundred'), __('layout.seven_hundred'), __('layout.eight_hundred'), 
            __('layout.nine_hundred')
        ];

        if ($number < 0) return '';
        if ($number == 0) return $units[0];

        $words = '';

        $hundredDigit = floor($number / 100);
        $remainder = $number % 100;

        if ($hundredDigit > 0) {
            $words .= $hundreds[$hundredDigit - 1];
        }

        if ($remainder > 0) {
            if ($hundredDigit > 0) {
                $words .= ' ' . __('layout.and') . ' ';
            }

            if ($remainder >= 20) {
                $tenDigit = floor($remainder / 10);
                $unitDigit = $remainder % 10;
                $words .= $tens[$tenDigit - 2];

                if ($unitDigit > 0) {
                    $words .= ' ' . __('layout.and') . ' ' . $units[$unitDigit];
                }
            } elseif ($remainder >= 10) {
                $words .= $teens[$remainder - 10];
            } elseif ($remainder > 0) {
                $words .= $units[$remainder];
            }
        }

        return trim($words);
    }
}
?>