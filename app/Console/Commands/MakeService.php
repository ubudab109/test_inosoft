<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeService extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service ${name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a new services';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Service';

    /**
     * > This function returns the path to the stub file that will be used to generate the service
     * class
     * 
     * @return string The path to the stub file.
     */
    public function getStub()
    {
        return __DIR__.'./../Stubs/service.plain.stub';
    }

    /**
     * > This function returns the default namespace for the service classes
     * 
     * @param string rootNameSpace The root namespace of your application.
     * 
     * @return string The default namespace for the service class.
     */
    public function getDefaultNamespace($rootNameSpace)
    {
        return $rootNameSpace . '\Services';
    }
}
