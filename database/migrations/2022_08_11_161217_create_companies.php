<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 'pid' => $this->get_pid("COMP"),
        // 'company_name' => $this->name,
        // 'company_sort_name' => $this->sort_name,
        // 'address' => $this->address,
        // 'register_date' => $this->register_date,
        // 'url_server' => $this->url_server,
        Schema::create('companies', function (Blueprint $table) {
            $table->string('pid')->unique();
            $table->string('company_name');
            $table->string('company_sort_name');
            $table->timestamp('register_date', 0)->nullable();
            $table->string('url_server')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
