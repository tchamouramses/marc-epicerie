<?php

use App\Models\SubCategory;
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
            $table->string('name');
            $table->string('code')->unique();
            $table->string('image_path');
            $table->text('description');
            $table->unsignedBigInteger('price');
            $table->unsignedInteger('rate')->default(1);
            $table->unsignedInteger('discount')->default(0);
            $table->unsignedInteger('quantity')->default(0);
            $table->unsignedInteger('min_quantity')->default(5);
            $table->foreignIdFor(SubCategory::class)->constrained()->cascadeOnDelete();
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
