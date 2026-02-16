class Finance extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_type', 'amount', 'description'];
}