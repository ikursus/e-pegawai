<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateStatusUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:status-update {status=pending}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status kesemua user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::query()->update(['status' => $this->argument('status')]);

        $this->info("Rekod telah dikemaskini kepada " . $this->argument('status'));
    }
}
