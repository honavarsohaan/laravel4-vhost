<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateVhostCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'vhost:create';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a virtual host for your new project';

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
	protected $value = array();
	public function fire()
	{
		
		$this->line('Welcome to the vhost generator.');
		$option = $this->ask("Do you want to create vhost [y/n] ?");
		$option = strtolower($option);
		if($option == 'y' || $option == 'yes'){
			$this->line('Great lets create vhost for you');
			$hostFile = 'C:\Windows\System32\drivers\etc\hosts';
			if (file_exists($hostFile)) {
				$this->line("Your host found at $hostFile");
				$content = file_get_contents($hostFile);
				$this->comment($content);
				$hostMap = $this->ask('Write host map');
				$this->value = explode(" ", $hostMap);
				$this->comment("writing to host file \n");
				file_put_contents($hostFile, PHP_EOL.$hostMap, FILE_APPEND | LOCK_EX);
				$content = file_get_contents($hostFile);
				$this->comment($content);
				$this->info('vhost created');
				$this->write_to_xampp_apacheconf();
			} else {
				$this->error(" Oops !!! We didn't find your hosts file");

				}
				
			}
			
		else{
			$this->error('error try again ');
		}
	}

	public function write_to_xampp_apacheconf(){
		$val = $this->value;
		$confirm_edit_apacheconf = $this->ask('Do you want to edit apache conf file [y/n]');
		$confirm_edit_apacheconf = strtolower($confirm_edit_apacheconf);
		if($confirm_edit_apacheconf == 'y' || $confirm_edit_apacheconf ='yes'){

			if ($this->confirm('use default apache httpd-vhost.conf [y/n]',true)) {
				$apache_conf_path = 'C:\xampp\apache\conf\extra\httpd-vhosts.conf';
			} else {
				$apache_conf_path = $this->ask('Please give path to httpd-vhost');
			}
			
			$publicPath = public_path();
			
			$vconf = <<<CONF
<VirtualHost $val[0]:80>
DocumentRoot '$publicPath'
ServerName $val[1]
##ServerAlias www.dummy-host.localhost
##ErrorLog "logs/dummy-host.localhost-error.log"
##CustomLog "logs/dummy-host.localhost-access.log" combined
</VirtualHost>
CONF;
			file_put_contents($apache_conf_path, PHP_EOL.$vconf, FILE_APPEND | LOCK_EX);
			$this->comment($vconf);
			$this->info("virtual host created for $val[1] at $val[0] visit http:\\\\$val[1] in your browser ");

		}
		else{
			$this->line("we are done");
		}
	}
}
