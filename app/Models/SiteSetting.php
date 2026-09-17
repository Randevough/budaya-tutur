<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    use HasFactory;

    protected $table = 'site_settings';

    protected $fillable = [
        'is_donation_active',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'qris_image',
        'contact_whatsapp',
    ];

    protected $casts = [
        'is_donation_active' => 'boolean',
    ];

    public static function normalizeWhatsApp(?string $number): string
    {
        if (blank($number)) {
            return '';
        }

        $digits = preg_replace('/\D+/', '', $number);

        if (str_starts_with($digits, '0')) {
            $digits = '62' . substr($digits, 1);
        }

        return $digits;
    }

    public function setContactWhatsappAttribute($value): void
    {
        $this->attributes['contact_whatsapp'] = self::normalizeWhatsApp($value);
    }

    public static function current(): self
    {
        try {
            return Cache::remember('site_settings', 3600, function () {
                return self::firstOrCreate(
                    ['id' => 1],
                    [
                        'is_donation_active' => true,
                        'bank_name' => 'Bank Central Asia (BCA)',
                        'bank_account_number' => '123-456-7890',
                        'bank_account_name' => 'Yayasan Budaya Tutur Nusantara',
                        'contact_whatsapp' => '6281234567890',
                    ]
                );
            });
        } catch (\Throwable $e) {
            return new self([
                'id' => 1,
                'is_donation_active' => false,
                'bank_name' => 'Bank Central Asia (BCA)',
                'bank_account_number' => '123-456-7890',
                'bank_account_name' => 'Yayasan Budaya Tutur Nusantara',
                'contact_whatsapp' => '6281234567890',
            ]);
        }
    }

    protected static function booted(): void
    {
        static::saved(function () {
            Cache::forget('site_settings');
        });

        static::deleted(function () {
            Cache::forget('site_settings');
        });
    }
}
