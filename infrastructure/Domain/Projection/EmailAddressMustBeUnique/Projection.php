<?php namespace Infrastructure\Domain\Projection;

use BoundedContext\Laravel\Illuminate\Projection\AbstractProjection;
use BoundedContext\Laravel\ValueObject\Uuid;
use Domain\Test\ValueObject\EmailAddress;

class Projection extends AbstractProjection implements \Domain\Test\Projection\Invariant\EmailAddressMustBeUnique\Projection\Projection
{
    protected $table = 'projections_domain_test_active_emails';

    public function exists(EmailAddress $email)
    {
        $email_count = $this->query()
            ->where('email', $email->serialize())
            ->count();

        return $email_count > 0;
    }

    public function get(Uuid $id)
    {
        $email_row = $this->query()
            ->where('user_id', $id->serialize())
            ->first();

        if(!$email_row)
        {
            throw new \Exception("The id [".$id->serialize()."] does not have an active email.");
        }

        return $email_row->email;
    }

    public function add(Uuid $id, EmailAddress $email)
    {
        if($this->exists($email))
        {
            throw new \Exception("The email [".$email->serialize()."] is an active email.");
        }

        $this->query()->insert([
            'user_id' => $id->serialize(),
            'email' => $email->serialize()
        ]);
    }

    public function remove(Uuid $id)
    {
        $email = $this->get($id);

        $this->query()
            ->where('email', $email)
            ->delete();
    }

    public function replace(Uuid $id, EmailAddress $old_email, EmailAddress $new_email)
    {
        $this->remove($id);
        $this->add($id, $new_email);
    }
}
