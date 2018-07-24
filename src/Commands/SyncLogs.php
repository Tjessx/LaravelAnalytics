<?php
/**
 * Created by PhpStorm.
 * User: bertbijnens
 * Date: 11/12/17
 * Time: 19:33
 */

namespace BertBijnens\LaravelAnalytics\Commands;

use BertBijnens\LaravelAnalytics\Parsers\LogsParser;
use BertBijnens\LaravelAnalytics\Models\Site;

use Illuminate\Console\Command;

class SyncLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Script to synchronize all our sites on this server';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handleSiteLog(LogsParser $logsParser, $siteLog) {

        $logsParser->handle($siteLog);
    }

    public function handleSite(Site $site) {

        $this->info(' Detecting site: ' . $site->name);
        $siteLogs = $site->list_logs();
        $logsParser = new LogsParser($this);

        foreach($siteLogs as $k=>$siteLog) {

            if($siteLog->synced_at != null && $siteLog->modified_at < $siteLog->synced_at) {
                continue;
            }

            if($siteLog->type != 'access') {
                continue;
            }

            $this->handleSiteLog($logsParser, $siteLog);
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {

        $this->info('Starting log sync at: ' . date('Y-m-d H:i:s'));
        $startTime = time();

        $sites = Site::detect();
        $bar = $this->output->createProgressBar(count($sites));
        foreach($sites as $k=>$site) {

            $bar->advance();
            $this->handleSite($site);
        }

        $bar->finish(); $this->info('');
        $this->info('Done at: ' . date('Y-m-d H:i:s'));
        $this->info('Done in: ' . (time() - $startTime) . 's');
    }
}