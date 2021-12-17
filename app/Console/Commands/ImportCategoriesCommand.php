<?php

namespace App\Console\Commands;

use App\Models\Category;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class ImportCategoriesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import categories from API';

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
        $this->output->info('Start categories import');

        $response = $this->client->get(
            Config::get('eonet.endpoint') . Config::get('eonet.paths.category'),
            [
                'headers' => Config::get('eonet.headers')
            ]
        );
        $this->output->info('Categories importing');


        $arrayResponse = json_decode($response->getBody()->getContents(), true);

        foreach ($arrayResponse['categories'] as $category) {
            if (Category::query()->find($category['id'])) {
                $this->output->info('Category ' . $category['title'] . ' already exists, continue import');
                continue;
            }
            $categoryModel = new Category();
            $categoryModel->id = $category['id'];
            $categoryModel->title = $category['title'];
            $categoryModel->save();
            $this->output->info('Category ' . $category['title'] . ' imported');

        }
        $this->output->info('Categories import finished ');

        return Command::SUCCESS;
    }
}
