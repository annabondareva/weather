<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\Geometry;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class ImportEventsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import events from API';

    private $client;

    /**
     * Create a new command instance.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws GuzzleException
     */
    public function handle(): int
    {
        $this->output->info('Start events import');

        $response = $this->client->get(
            Config::get('eonet.endpoint') . Config::get('eonet.paths.event'),
            [
                'headers' => Config::get('eonet.headers')
            ]
        );

        $this->output->info('Events importing');

        $arrayResponse = json_decode($response->getBody()->getContents(), true);

        $this->output->info('Count of events: ' . count($arrayResponse['events']));

        foreach ($arrayResponse['events'] as $event) {
            if (Event::query()->find($event['id'])) {
                $this->output->info('Event ' . $event['id'] . ' already exists, continue import');
                continue;
            }

            $eventModel = new Event();
            $eventModel->id = $event['id'];
            $eventModel->title = $event['title'];
            $eventModel->category_id = $event['categories'][0]['id'];
            $eventModel->save();
            $this->output->info('Count geometries for event ' . count($event['geometries']));
            foreach ($event['geometries'] as $geometry) {
                $geometryModel = new Geometry();
                $geometryModel->date_and_time = $geometry['date'];
                $geometryModel->event_id = $event['id'];
                $geometryModel->coordinates = json_encode($geometry['coordinates']);
                $geometryModel->save();
            }

            $this->output->info('Event ' . $event['id'] . ' imported');
        }
        $this->output->info('Events import finished ');

        return Command::SUCCESS;
    }
}
