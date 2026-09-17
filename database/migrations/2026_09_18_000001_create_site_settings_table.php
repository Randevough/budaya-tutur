<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_donation_active')->default(true);
            $table->string('bank_name')->default('Bank Central Asia (BCA)');
            $table->string('bank_account_number')->default('123-456-7890');
            $table->string('bank_account_name')->default('Yayasan Budaya Tutur Nusantara');
            $table->string('qris_image')->nullable();
            $table->string('contact_whatsapp')->nullable()->default('6281234567890');
            $table->timestamps();
        });

        DB::table('site_settings')->insert([
            'id' => 1,
            'is_donation_active' => true,
            'bank_name' => 'Bank Central Asia (BCA)',
            'bank_account_number' => '123-456-7890',
            'bank_account_name' => 'Yayasan Budaya Tutur Nusantara',
            'qris_image' => null,
            'contact_whatsapp' => '6281234567890',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
