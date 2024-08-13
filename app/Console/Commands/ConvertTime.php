<?php

namespace App\Console\Commands;

use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ConvertTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:convert-time';

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
        $members = Member::query()->get();
        foreach ($members as $member) {
            // Convert the created_at time to UTC+7
            $member->created_at = Carbon::parse($member->created_at)->addHours(7);
            $member->save(); // Save the updated timestamp
        }

        $this->info('Time conversion completed successfully.');
    }
}
