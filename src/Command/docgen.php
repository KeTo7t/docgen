<?php

namespace KeTo7t\docgen;

use Illuminate\Console\Command;
use KeTo7t\docgen\Excel\ExcelWriter;


class docgen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:DBdocument {--name=DB_definition}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate DBinfo tables Difinision';


    private $collector, $writer;

    /**
     * Create a new command instance.
     *
     * @param DbSettingCollector $collector
     * @param ExcelWriter $writer
     */
    public function __construct( DbSettingCollector $collector, ExcelWriter $writer)
    {
        $this->collector =  $collector;
        $this->writer = $writer;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $filename=  $this->option("name");
        $this->collector->execute();
        $this->writer->run($this->collector->getTableDefinitions(),$filename);
    }
}
