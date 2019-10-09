<?php

namespace KeTo7t\docgen;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class docgen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:DBdocument {--name=DB_definition} {--type=excel} {--source=DB} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate DBinfo tables Difinision';


    private $collector, $writer;

    /**
     * Create a new command instance.
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
    public function handle()
    {
      //  $this->validate();

        $filename = $this->option("name");
        $source= $this->option("source");
        $type=$this->option("type");



        $factory = new Factory();
        $writer=$factory->createWriter($type);
        $collector=$factory->createCollector($source);


        $writer->run($collector->fetchSettings(), $filename);
    }

    private function validate($input){
        $rule=[


        ];

        $validator = Validator::make();

    }
}
