<?php

namespace App\Infrastructure\Projection;

use BoundedContext\Projection\AbstractProjection;
use BoundedContext\ValueObject\Uuid;

class ActiveEmails extends AbstractProjection implements \App\BoundedContext\Test\Projection\ActiveEmails\Projection
{
    private $active_emails;
    private $aggregate_index;

    public function __construct()
    {
        parent::__construct();

        $this->active_emails = [];
        $this->aggregate_index = [];
    }

    public function reset()
    {
        parent::reset();

        $this->active_emails = [];
        $this->aggregate_index = [];
    }

    public function exists($email)
    {
        return array_key_exists($email, $this->active_emails);
    }

    public function add(Uuid $id, $email)
    {
        if($this->exists($email))
        {
            throw new \Exception("The email [$email] is an active email.");
        }

        $this->aggregate_index[$id->toString()] = $email;
        $this->active_emails[$email] = 1;
    }

    public function remove(Uuid $id)
    {
        $email = $this->aggregate_index[$id->toString()];

        if(!$this->exists($email))
        {
            throw new \Exception("The email [$email] is not an active email.");
        }

        unset($this->active_emails[$email]);
        unset($this->aggregate_index[$id->toString()]);
    }

    public function replace(Uuid $id, $old_email, $new_email)
    {
        $this->remove($id, $old_email);
        $this->add($id, $new_email);
    }
}
