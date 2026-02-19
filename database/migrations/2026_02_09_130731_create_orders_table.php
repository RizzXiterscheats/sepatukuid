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
                CREATE TABLE orders (
                    id BIGSERIAL PRIMARY KEY,
                    user_id BIGINT NOT NULL REFERENCES users(id),
                    order_number VARCHAR(255) NOT NULL UNIQUE,
                    total DECIMAL(12, 2),
                    status VARCHAR(255) DEFAULT \'pending\',
                    payment_status VARCHAR(255) DEFAULT \'unpaid\',
                    shipping_status VARCHAR(255) DEFAULT \'pending\',
                    shipping_address TEXT,
                    payment_method VARCHAR(255),
                    created_at TIMESTAMP NULL,
                    updated_at TIMESTAMP NULL
                )
            ');
        } else {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained();
                $table->string('order_number')->unique();
                $table->decimal('total', 12, 2);
                $table->string('status')->default('pending');
                $table->string('payment_status')->default('unpaid');
                $table->string('shipping_status')->default('pending');
                $table->text('shipping_address');
                $table->string('payment_method')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};