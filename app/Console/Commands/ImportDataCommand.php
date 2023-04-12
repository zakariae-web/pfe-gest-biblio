<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class ImportDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:data';



    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from Excel file';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = public_path('excel/users.xlsx'); // remplacez data.xlsx par le nom de votre fichier
        $import = new UsersImport(); // remplacez UsersImport par votre classe d'importation
        Excel::import($import, $file);
        $this->info('Data imported successfully.');
    }
}
