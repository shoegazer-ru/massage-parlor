<?php

use App\Models\Field;
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
        Schema::create(Field::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Field::class, 'parent_id')->nullable();
            $table->string('name');
            $table->dateTime('date')->nullable(true);
            $table->string('caption')->nullable(true);
            $table->string('value')->nullable(true);
            $table->text('body')->nullable(true);
            $table->text('data')->nullable(true);
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
        Schema::dropIfExists(Field::TABLE_NAME);
    }
};
