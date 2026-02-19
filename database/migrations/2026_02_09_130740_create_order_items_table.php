<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $isPostgres = DB::connection()->getDriverName() === 'pgsql';
        
        if ($isPostgres) {
            DB::statement('
                CREATE TABLE order_items (
                    id BIGSERIAL PRIMARY KEY,
                    order_id BIGINT NOT NULL REFERENCES orders(id) ON DELETE CASCADE,
                    product_id BIGINT NOT NULL REFERENCES products(id) ON DELETE CASCADE,
                    quantity INTEGER,
                    price DECIMAL(15, 2),
                    discount DECIMAL(15, 2) DEFAULT 0,
                    size VARCHAR(255),
                    color VARCHAR(255),
                    created_at TIMESTAMP NULL,
                    updated_at TIMESTAMP NULL
                )
            ');
        } else {
            Schema::create('order_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('order_id')->constrained()->onDelete('cascade');
                $table->foreignId('product_id')->constrained()->onDelete('cascade');
                $table->integer('quantity');
                $table->decimal('price', 15, 2);
                $table->decimal('discount', 15, 2)->default(0);
                $table->string('size')->nullable();
                $table->string('color')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};