<?
namespace App\Console\Commands;

use App\Http\Controllers\CurrenciesController;
use Illuminate\Console\Command;

class Update_data_currencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update_data_currencies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currency exchange rates';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $drip;

    /**
     * Create a new command instance.
     *
     * @param  DripEmailer  $drip
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(CurrenciesController $Currencies)
    {
        $Currencies->ConsoleInfo();
    }
}

?>