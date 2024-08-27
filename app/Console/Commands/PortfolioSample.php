<?php

namespace App\Console\Commands;
use App\Models\User;
use Illuminate\Console\Command;
use function Laravel\Prompts\info;
use function Laravel\Prompts\text;
use function Laravel\Prompts\progress;

class PortfolioSample extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:portfolio-sample';

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
        $introduction = [
"            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea, illum.
"        ];

        foreach($introduction as $item)
        {
            echo info($item);
        }
    }
}
