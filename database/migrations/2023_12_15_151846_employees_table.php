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
        Schema::create("employees", function (Blueprint $table)
        {
            $table->id();
            $table->string("emp_id")->unique;
            $table->string("name",100);
            $table->string("email",50)->unique;
            $table->string("phone",15)->unique;
            $table->enum("gender",["male","female","other"])->nullable();
            $table->date("dob");
            $table->string("address",250);
            $table->string("destination",150);
            $table->date("date_of_join");
            $table->enum("status",["active","inactive"])->default("active");
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
