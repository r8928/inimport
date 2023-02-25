<?php

use App\Models\Config;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();

            $table->string('key')->unique();
            $table->json('value')->nullable();

            $table->timestamps();
        });

        Config::set('demo-mode', 1);

        Config::set('company-name', 'OrangeSoft');
        Config::set('company-address', '420, 9211 Street');
        Config::set('company-phone', '1800-234-124');
        Config::set('company-email', 'example@gmail.com');

        Config::set('email-subject', '[customer] your Company Name invoice for $[amount]');
        Config::set('email-body', '<p>Hello [customer]</p><p><br/></p><p>Please find your Company Name invoice for the amount $[amount].</p>');

        Config::set('send-from-email', 'info@invoicify.pk');
        Config::set('force-to-email', 'rashid8928@gmail.com');
        Config::set('max-mails-per-day', 20);
        Config::set('max-file-size', 1);
        Config::set('application-title', 'OrangeSoft Invoice to Email');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configs');
    }
};
