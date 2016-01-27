<?php namespace Infrastructure\Domain\Projection\EmailAddressMustBeUnique;

use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Laravel\Illuminate\Projection\AbstractProjection;
use Domain\Test\ValueObject\EmailAddress;

class Projection extends AbstractProjection implements \Domain\Test\Invariant\EmailAddressMustBeUnique\Projection\Projection
{
    protected $table = 'projections_domain_test_active_emails';

    public function add(Identifier $id, EmailAddress $email)
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

    public function remove(Identifier $id)
    {
        $email = $this->get($id);

        $this->query()
            ->where('email', $email)
            ->delete();
    }

    public function replace(Identifier $id, EmailAddress $old_email, EmailAddress $new_email)
    {
        $this->remove($id);
        $this->add($id, $new_email);
    }
}
