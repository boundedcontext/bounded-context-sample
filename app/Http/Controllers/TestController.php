<?php namespace App\Http\Controllers;

use BoundedContext\Contracts\Bus\Dispatcher;

use Domain\Shopping\Aggregate\Cart\Command\Create;
use Domain\Shopping\Aggregate\Cart\Command\AddProduct;
use Domain\Shopping\Aggregate\Cart\Command\ChangeProductQuantity;
use Domain\Shopping\Aggregate\Cart\Command\RemoveProduct;
use Domain\Shopping\Aggregate\Cart\Command\CheckOut;

use Domain\Shopping\Entity\Cart;
use Domain\Shopping\Entity\Product;
use Domain\Shopping\ValueObject\Quantity;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

use BoundedContext\Laravel\ValueObject\Uuid;

class TestController extends Controller
{
    protected $bus;
    protected $app;

    public function __construct(Dispatcher $bus, Application $app)
    {
        $this->bus = $bus;
        $this->app = $app;
    }

    public function create(Request $request)
    {
        // Reset Event Log/Stream
        $log = $this->app->make('EventLog');
        $log->reset();

        // Reset Command Log/Stream
        $log = $this->app->make('CommandLog');
        $log->reset();

        // Reset Aggregate State Snapshot
        $connection = $this->app->make('db');
        $connection->table('snapshots_aggregate_state')->delete();

        $player_builder = $this->app->make('BoundedContext\Laravel\Player\Collection\Builder');

        $player = $player_builder
            ->all()
            ->get();

        $player->reset();

        $this->bus->dispatch(new Create(
            new Cart(
                new Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f6'),
                new Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f7')
            )
        ));

        $this->bus->dispatch(new AddProduct(
            new Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f6'),
            new Product(
                new Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f9'),
                new Quantity(1)
            )
        ));

        $this->bus->dispatch(new AddProduct(
            new Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f6'),
            new Product(
                new Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f0'),
                new Quantity(5)
            )
        ));

        $this->bus->dispatch(new ChangeProductQuantity(
            new Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f6'),
            new Product(
                new Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f0'),
                new Quantity(7)
            )
        ));

        $this->bus->dispatch(new RemoveProduct(
            new Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f6'),
            new Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f9')
        ));

        $this->bus->dispatch(new CheckOut(
            new Uuid('b98540d7-c3f9-4af3-8d77-e46662fcb3f6')
        ));

        dd('roflolol');

        $player = $player_builder
            ->all()
            ->get();

        $player->play();
    }
}
