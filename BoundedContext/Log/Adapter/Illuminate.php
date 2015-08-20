<?php namespace BoundedContext\Log\Adapter;

use BoundedContext\Log\Appendable;
use BoundedContext\Map\Map;
use BoundedContext\Collection\Collection;
use BoundedContext\Log\Item;
use Illuminate\Database\Capsule\Manager as Capsule;

class Illuminate extends Abstracted
{

    private $capsule;
    private $connection_name;
    private $log_table_name;
    private $stream_table_name;

    public function __construct(Map $map, Capsule $capsule, $connection_name = 'default', $log_table_name = 'event_log', $stream_table_name = 'event_stream')
    {
        parent::__construct($map);

        $this->capsule = $capsule;
        $this->connection_name = $connection_name;
        $this->log_table_name = $log_table_name;
        $this->stream_table_name = $stream_table_name;
    }

    public function log_table_name()
    {
        return $this->log_table_name;
    }
    
    public function stream_table_name()
    {
        return $this->stream_table_name;
    }

    public function capsule()
    {
        return $this->capsule;
    }

    protected function append_item(Item $item)
    {
        $this->capsule->getConnection($this->connection_name)->transaction(
            function ($connectionManager) use ($item) {

            $connectionManager->table($this->log_table_name())->insert(
                [
                    'item' => json_encode($item->to_array())
                ]
            );
            
            $connectionManager->table($this->stream_table_name())->insert(
                [
                    'event_id' => $item->id()->toString(),
                    'event_occured_at' => $item->occured_at(),
                    'event_type_id' => $item->type_id()->toString(),
                    'event_version' => $item->version(),
                    'aggregate_id' => $item->payload()->id()->toString(),
                    'payload' => json_encode($item->payload()->to_array())
                ]
            );
        });
    }

    public function append_collection(Collection $collection)
    {
        $this->capsule->getConnection($this->connection_name)->transaction(
            function ($connectionManager) use ($collection) {

            foreach ($collection as $element) {
                if (!$element instanceof Appendable) {
                    throw new \Exception('A Log can only append appendable Items.');
                }

                $item = $this->generate_item($element);

                $connectionManager->table($this->log_table_name())->insert(
                    [
                        'item' => json_encode($item->to_array())
                    ]
                );
                
                $connectionManager->table($this->stream_table_name())->insert(
                    [
                        'event_id' => $item->id()->toString(),
                        'event_occured_at' => $item->occured_at(),
                        'event_type_id' => $item->type_id()->toString(),
                        'event_version' => $item->version(),
                        'aggregate_id' => $item->payload()->id()->toString(),
                        'payload' => json_encode($item->payload()->to_array())
                    ]
                );
            }
        });
    }
}
