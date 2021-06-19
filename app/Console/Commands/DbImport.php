<?php

namespace App\Console\Commands;

use App\Enums\OrderStatus;
use App\Models\Dish;
use App\Models\MenuCategory;
use App\Models\Order;
use App\Models\OrderDish;
use App\Models\User;
use DB;
use Illuminate\Console\Command;
use Str;

class DbImport extends Command
{
    private const EXTRA_RICE = ' (met witte rijst)';

    private const BTW = 9;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:import {database} {--seed} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import the old database of GoudenDraak to the new database';

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
     * @return int
     */
    public function handle()
    {
        if (config('app.env') == 'production') {
            if (! $this->confirm('Are you sure you want to import old data in production?', false)) {
                return 0;
            }
        }

        $connectionConf = config('database.connections.mysql');
        $connectionConf['database'] = $this->argument('database');

        config(['database.connections.old' => $connectionConf]);

        $this->call('migrate:fresh', ['--force']);

        DB::purge('old');
        $connection = DB::connection('old');

        // Categories
        $categories = $connection->table('menu')->distinct()->get('soortgerecht');
        $this->info('Found '.$categories->count().' old categories');

        $categories->each(function ($category) {
            MenuCategory::create([
                'name' => $this->convertCategory($category->soortgerecht),
                'extra_option' => Str::contains($category->soortgerecht, self::EXTRA_RICE),
            ]);
        });
        $this->info('Created '.MenuCategory::count().' categories in the new database');

        // Dishes
        $dishes = $connection->table('menu')->whereRaw('IFNULL(`menunummer`, `menu_toevoeging`) IS NOT NULL')->get();
        $this->info('Found '.$dishes->count().' old dishes');

        $dishes->each(function ($dish) {
            Dish::create([
                'id' => $dish->id,
                'category_id' => MenuCategory::firstWhere('name', $this->convertCategory($dish->soortgerecht))->id,
                'number' => $dish->menunummer ?? $dish->menu_toevoeging,
                'addition' => $dish->menunummer == null ? null : $dish->menu_toevoeging,
                'name' => html_entity_decode($dish->naam),
                'description' => html_entity_decode($dish->beschrijving ?? ''),
                'price' => round(($dish->price / (100 + self::BTW)) * 100, 2),
                'btw' => self::BTW,
            ]);
        });
        $this->info('Created '.Dish::count().' dishes in the new database');

        // Orders
        $orders = $connection->table('sales')->distinct()->get('saleDate');
        $this->info('Found '.$orders->count().' old orders');

        $importUser = User::create([
            'name' => 'Oude database',
            'email' => 'old@goudendraak.nl',
            'password' => 'invalid',
        ]);

        $orders->each(function ($order) use ($connection, $importUser) {
            $items = $connection->table('sales')->where('saleDate', $order->saleDate)->get();

            $newOrder = Order::create([
                'user_id' => $importUser->id,
                'table_number' => null,
                'status' => OrderStatus::CLOSED(),
                'created_at' => $order->saleDate,
                'updated_at' => $order->saleDate,
            ]);

            $items->each(function ($item) use ($newOrder) {
                OrderDish::create([
                    'dish_id' => $item->itemId,
                    'order_id' => $newOrder->id,
                    'amount' => $item->amount,
                ]);
            });
        });

        $this->call('db:seed', ['--force']);

        return 0;
    }

    private function convertCategory($old)
    {
        return Str::ucfirst(Str::lower(Str::replace(self::EXTRA_RICE, '', $old)));
    }
}
