class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'inventory_id', 'quantity', 'total_price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}