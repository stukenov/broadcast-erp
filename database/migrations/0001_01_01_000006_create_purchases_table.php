public function up()
{
    Schema::create('purchases', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('inventory_id');
        $table->integer('quantity');
        $table->decimal('total_price', 10, 2);
        $table->timestamps();
        
        $table->foreign('user_id')->references('id')->on('users');
        $table->foreign('inventory_id')->references('id')->on('inventories');
    });
}