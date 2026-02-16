class Inventory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'quantity', 'price'];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}