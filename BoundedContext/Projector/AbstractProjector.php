<?php namespace BoundedContext\Projector;

use BoundedContext\Contracts\Log;
use BoundedContext\Contracts\Projection;
use BoundedContext\Contracts\Projector;

abstract class AbstractProjector implements Projector
{
    use Projecting;

    protected $log;
    protected $projection;

    public function __construct(Log $log, Projection $projection)
    {
        $this->log = $log;
        $this->projection = $projection;
    }

    public function version()
    {
        return $this->projection->version();
    }

    public function last_id()
    {
        return $this->projection->last_id();
    }

    public function reset()
    {
        $this->projection->reset();
    }

    public function play()
    {
        $stream = $this->log->get_stream(
            $this->projection->last_id()
        );

        while($stream->has_next())
        {
            $item = $stream->next();

            $this->apply($item);

            $this->projection->increment(
                $item->id(),
                $this->can_apply($item)
            );
        }
    }

    public function projection()
    {
        return $this->projection;
    }
}
