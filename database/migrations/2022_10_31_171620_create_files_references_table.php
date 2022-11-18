<?php

use App\Models\File;
use App\Models\FileReference;
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
        Schema::create(FileReference::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(File::class, 'file_id')->nullable(false);
            $table->string('model_name', 40);
            $table->integer('model_id')->nullable();
            $table->string('type', 20)->nullable();
            $table->integer('sort_index');
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
        Schema::dropIfExists(FileReference::TABLE_NAME);
    }
};
