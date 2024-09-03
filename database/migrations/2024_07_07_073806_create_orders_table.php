<?php

use App\Models\Order;
use App\Models\Sight;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->string('payment_method');
            $table->timestamps();
        });

        Schema::create('order_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->cascade();
            $table->foreignIdFor(Sight::class)->cascade();
            $table->integer('quantity')->default(1);
            $table->string('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_tickets');
        Schema::dropIfExists('orders');
    }
};