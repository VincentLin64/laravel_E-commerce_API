<?php

namespace App\Console\Commands;

use App\Exports\OrdersExport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ExportOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:export-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $now = now()->toDateTimeString();
        Excel::store(new OrdersExport, 'excels/'.$now.'訂單清單.xlsx');
    }
}
