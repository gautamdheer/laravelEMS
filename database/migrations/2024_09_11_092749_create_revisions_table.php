<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('revisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('talk_proposal_id')->constrained('talk_proposals')->onDelete('cascade');
            $table->json('changes');
            $table->timestamp('revision_timestamp')->useCurrent(); // The correct usage of the timestamp() method
            $table->timestamps(); // Adds 'created_at' and 'updated_at' columns
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revisions');
    }
};
