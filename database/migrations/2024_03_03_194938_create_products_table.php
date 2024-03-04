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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('created_by')->constrained('users');
            $table->string('name');
            $table->string('description');
            $table->string('sku');
            $table->string('barcode');
            $table->string('brand');
            $table->string('model');
            $table->string('unit');
            $table->decimal('price', 10, 2);
            $table->decimal('quantity', 10, 2);
            $table->decimal('alert_quantity', 10, 2);
            $table->string('image')->nullable();
            $table->string('status')->default('active');
            $table->boolean('is_expirable')->default(false);
            $table->date('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
