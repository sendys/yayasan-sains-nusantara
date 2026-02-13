<?php

namespace App\Console\Commands;

use App\Models\Perusahaan;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateExpiredLicenses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'license:update-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update is_status to 0 for companies with expired licenses';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for expired licenses...');

        // Cari lisensinya expired dan masih aktif (is_status = 1)
        $expiredCompanies = Perusahaan::where('end_date', '<', Carbon::now())
            ->where('is_status', '1')
            ->get();

        if ($expiredCompanies->count() > 0) {
            // Update is_status menjadi 0 untuk expired
            $updated = Perusahaan::where('end_date', '<', Carbon::now())
                ->where('is_status', '1')
                ->update(['is_status' => '0']);

            $this->info("Updated {$updated} companies with expired licenses.");

            // Tampilkan daftar perusahaan yang diupdate
            foreach ($expiredCompanies as $company) {
                $this->line("- {$company->name} (expired: {$company->end_date->format('d/m/Y')})");
            }
        } else {
            $this->info('No expired licenses found.');
        }

        $this->info('License update completed.');

        return 0;
    }
}
