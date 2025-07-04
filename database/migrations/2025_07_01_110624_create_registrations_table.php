<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('registrations', function (Blueprint $table) {
        $table->id();
        $table->string('first_name');
        $table->string('last_name');
        $table->string('email')->unique();
        $table->string('phone')->nullable();
        $table->string('job_title')->nullable();
        $table->string('company')->nullable();
        $table->string('country')->nullable();
        $table->string('linkedin')->nullable();
        $table->string('industry')->nullable();
        $table->string('company_size')->nullable();
        $table->string('experience')->nullable();
        $table->json('interests')->nullable();
        $table->json('meeting_topics')->nullable();
        $table->boolean('consent_newsletter')->default(false);
        $table->boolean('consent_thirdparty')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
