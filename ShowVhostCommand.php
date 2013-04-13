<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ShowVhostCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'vhost:show';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Outputs your vhost configuration file.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$hostFile = 'C:\Windows\System32\drivers\etc\hosts';
		$content = file_get_contents($hostFile);
		$this->line("Opening your host file ... \n");
		$this->info($content);
	}

	
}