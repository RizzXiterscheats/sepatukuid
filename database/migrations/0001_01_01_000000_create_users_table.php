<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if using PostgreSQL
        $isPostgres = DB::connection()->getDriverName() === 'pgsql';
        
        if ($isPostgres) {
            // PostgreSQL: Use raw SQL for better transaction handling
            DB::statement('
                CREATE TABLE users (
                    id BIGSERIAL PRIMARY KEY,
                    name VARCHAR(255) NOT NULL,
                    email VARCHAR(255) NOT NULL UNIQUE,
                    email_verified_at TIMESTAMP NULL,
                    password VARCHAR(255) NOT NULL,
                    remember_token VARCHAR(100),
                    created_at TIMESTAMP NULL,
                    updated_at TIMESTAMP NULL
                )
            ');
            
            DB::statement('
                CREATE TABLE password_reset_tokens (
                    email VARCHAR(255) PRIMARY KEY,
                    token VARCHAR(255) NOT NULL,
                    created_at TIMESTAMP NULL
                )
            ');
            
            DB::statement('
                CREATE TABLE sessions (
                    id VARCHAR(255) PRIMARY KEY,
                    user_id BIGINT,
                    ip_address VARCHAR(45),
                    user_agent TEXT,
                    payload TEXT NOT NULL,
                    last_activity INTEGER NOT NULL
                )
            ');
            
            // Create indexes for PostgreSQL
            DB::statement('CREATE INDEX IF NOT EXISTS sessions_user_id_index ON sessions(user_id)');
            DB::statement('CREATE INDEX IF NOT EXISTS sessions_last_activity_index ON sessions(last_activity)');
        } else {
            // MySQL: Use Schema Builder
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });

            Schema::create('password_reset_tokens', function (Blueprint $table) {
                $table->string('email')->primary();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });

            Schema::create('sessions', function (Blueprint $table) {
                $table->string('id')->primary();
                $table->foreignId('user_id')->nullable()->index();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->longText('payload');
                $table->integer('last_activity')->index();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
