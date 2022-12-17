<?php

use App\Models\Project;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_projects', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('description');
            $table->foreignIdFor(Project::class)->constrained()->cascadeOnDelete();
            $table->decimal('lat', 8, 6);
            $table->decimal('lon', 9, 6);
            $table->timestamp('date');
            $table->string('image_path');
            $table->longText('params');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_projects');
    }
}
