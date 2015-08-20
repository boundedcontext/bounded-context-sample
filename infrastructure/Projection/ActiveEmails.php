<?php

namespace Infrastructure\Projection;

use BoundedContext\Projection\AbstractProjection;
use BoundedContext\ValueObject\Uuid;
use Domain\Test\ValueObject\EmailAddress;

class ActiveEmails extends AbstractProjection implements \Domain\Test\Projection\ActiveEmails\Projection
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

    public function exists(EmailAddress $email)
    {
        return array_key_exists($email->toString(), $this->active_emails);
    }

    public function add(Uuid $id, EmailAddress $email)
    {
        if($this->exists($email))
        {
            throw new \Exception("The email [$email->toString()] is an active email.");
        }

        $this->aggregate_index[$id->toString()] = $email->toString();
        $this->active_emails[$email->toString()] = 1;
    }

    public function remove(Uuid $id)
    {
        $email = $this->aggregate_index[$id->toString()];

        if(!$this->exists(new EmailAddress($email)))
        {
            throw new \Exception("The email [$email] is not an active email.");
        }

        unset($this->active_emails[$email]);
        unset($this->aggregate_index[$id->toString()]);
    }

    public function replace(Uuid $id, EmailAddress $old_email, EmailAddress $new_email)
    {
        $this->remove($id);
        $this->add($id, $new_email);
    }
}
