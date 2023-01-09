<?php

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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->index()->constrained('types');
            $table->string('title');

            $table->date('creation_date');
            $table->date('signing_the_contract');
            $table->date('deadline')->nullable();

            $table->boolean('chain_stores')->nullable();
            $table->boolean('has_outsource')->nullable();
            $table->boolean('has_investors')->nullable();
            $table->boolean('delivery_on_time')->nullable();

            $table->integer('first_step_payment')->nullable();
            $table->integer('second_step_payment')->nullable();
            $table->integer('third_step_payment')->nullable();
            $table->integer('fourth_step_payment')->nullable();

            $table->integer('worker_count')->nullable();
            $table->integer('service_count')->nullable();

            $table->text('comment')->nullable();
            $table->decimal('performance_indicator', 13, 10)->nullable();

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
        Schema::dropIfExists('projects');
    }
};
