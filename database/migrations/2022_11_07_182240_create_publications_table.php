<?php

use App\Models\Publication;
use App\Models\Section;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Publication::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Section::class, 'section_id')->nullable(false);
            $table->dateTime('date');
            $table->string('caption');
            $table->text('annotation')->nullable(true);
            $table->text('body')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Publication::TABLE_NAME);
    }
};
