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
            // PostgreSQL: Use raw SQL
            DB::statement("CREATE TYPE role_enum AS ENUM ('admin', 'petugas', 'user')");
            DB::statement("ALTER TABLE users ADD COLUMN role role_enum DEFAULT 'user'");
            DB::statement("ALTER TABLE users ADD COLUMN phone VARCHAR(20)");
            DB::statement("ALTER TABLE users ADD COLUMN address TEXT");
            DB::statement("ALTER TABLE users ADD COLUMN is_active BOOLEAN DEFAULT true");
        } else {
            // MySQL: Use Schema Builder
            Schema::table('users', function (Blueprint $table) {
                $table->enum('role', ['admin', 'petugas', 'user'])->default('user')->after('email');
                $table->string('phone', 20)->nullable()->after('role');
                $table->text('address')->nullable()->after('phone');
                $table->boolean('is_active')->default(true)->after('address');
            });
        }
    }

    public function down(): void
    {
        $isPostgres = DB::connection()->getDriverName() === 'pgsql';
        
        if ($isPostgres) {
            DB::statement("ALTER TABLE users DROP COLUMN role");
            DB::statement("DROP TYPE IF EXISTS role_enum");
            DB::statement("ALTER TABLE users DROP COLUMN phone");
            DB::statement("ALTER TABLE users DROP COLUMN address");
            DB::statement("ALTER TABLE users DROP COLUMN is_active");
        } else {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn(['role', 'phone', 'address', 'is_active']);
            });
        }
    }
};