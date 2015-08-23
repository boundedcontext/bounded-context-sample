<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\File;

class ProjectionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bc:projections:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display an inspiring quote';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Application $app)
    {
        $projector_files = File::glob('domain/*/Projection/*/Projector.php');

        $this->info('');
        $this->info('Application');
        $this->info('');

        $this->info('');
        $this->info('Domain');

        foreach($projector_files as $file)
        {
            $projector_class = str_replace('/', '\\', ucfirst(rtrim($file, '.php')));
            $bounded_context = explode('/', $file)[1];
            $projector_name = explode('/', $file)[3];

            $projector = $app->make($projector_class);
            $projector->play();

            $current_version = $projector->projection()->version();
            $current_stream_count = $projector->projection()->count();

            $last_id  = (is_null($projector->last_id()) ? 'null' : $projector->last_id()->serialize());

            $projector_status =
                ' Version: ' .
                $current_version .
                ' | Items Streamed: ' .
                $current_stream_count
            ;

            $bc_title = '||| '. $bounded_context . '::' . $projector_name . " |||" . $projector_status . " |||";

            $this->info(str_repeat('-', strlen($bc_title)));
            $this->comment($bc_title);
        }

        $this->info(str_repeat('-', strlen($bc_title)));
        $this->info('');
    }
}
