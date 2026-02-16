public function up()
{
    Schema::create('finances', function (Blueprint $table) {
        $table->id();
        $table->string('transaction_type');
        $table->decimal('amount', 10, 2);
        $table->text('description');
        $table->timestamps();
    });
}