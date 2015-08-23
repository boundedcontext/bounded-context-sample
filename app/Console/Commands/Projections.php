<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\File;

class Projections extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bc:projections';

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

        foreach($projector_files as $file)
        {
            $projector_class = str_replace('/', '\\', ucfirst(rtrim($file, '.php')));
            $bounded_context = explode('/', $file)[1];
            $projector_name = explode('/', $file)[3];

            $projector = $app->make($projector_class);

            $current_version = $projector->projection()->version();
            $current_stream_count = $projector->projection()->count();

            $projector_status =
                ' Version: ' .
                $current_version .
                ' | Items Streamed: ' .
                $current_stream_count .
                ''
            ;

            $bc_title = '||| '. $bounded_context . '::' . $projector_name . " |||" . $projector_status . " |||";

            $this->info(str_repeat('-', strlen($bc_title)));
            $this->comment($bc_title);
            $this->info(str_repeat('-', strlen($bc_title)));

            $last_id  = (is_null($projector->last_id()) ? 'null' : $projector->last_id()->serialize());

            $this->comment('=> Last Uuid applied: ' . $last_id);
            $this->comment('=> Playing...');

            $projector->play();

            $new_version = $projector->projection()->version();
            $new_stream_count = $projector->projection()->count();

            $this->comment('=> Applied '. ($new_stream_count - $current_stream_count) . ' items.');

            if($new_version > $current_version)
            {
                $this->comment('=> Moved to Version ' . $new_version . '.');
                $this->comment('=> New last Uuid applied: ' . $projector->last_id()->serialize());
            }

            $this->info('');
        }
    }
}
