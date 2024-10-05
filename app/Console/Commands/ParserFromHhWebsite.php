<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Region;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ParserFromHhWebsite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:parser-from-hh-website';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get('https://api.hh.ru/areas');
        $countries = $response->collect();
        $regions = $countries->where('name', '=', 'Россия')->flatMap(function (array $values) {
            return $values['areas'];
        });
        Region::insert($regions->map(function (array $values) {
            $model = new Region();
            $model->name = $values['name'];
            (new SlugService())->slug($model, true);
            return ['id' => $values['id'], 'name' => $values['name'], 'slug' => $model->slug];
        })->toArray());
        City::insert($regions->flatMap(function (array $values) {
            return $values['areas'];
        })
            ->map(function (array $values) {
                $model = new City();
                $model->name = $values['name'];
                (new SlugService())->slug($model, true);
                return ['id' => $values['id'], 'name' => $values['name'], 'slug' => $model->slug, 'region_id' => $values['parent_id']];
            })->toArray());
    }
}
