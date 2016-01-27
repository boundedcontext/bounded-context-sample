<?php namespace Infrastructure\Domain\Projection\UsernameMustBeUnique;

use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Laravel\Illuminate\Projection\AbstractProjection;
use Domain\Test\ValueObject\Username;

class Projection extends AbstractProjection implements \Domain\Test\Invariant\UsernameMustBeUnique\Projection\Projection
{
    protected $table = 'projections_domain_test_active_usernames';

    public function add(Identifier $id, Username $username)
    {
        if($this->exists($username))
        {
            throw new \Exception("The username [".$username->serialize()."] is already active.");
        }

        $this->query()->insert([
            'user_id' => $id->serialize(),
            'username' => $username->serialize()
        ]);
    }

    public function remove(Identifier $id)
    {
        $username = $this->get($id);

        $this->query()
            ->where('username', $username)
            ->delete();
    }

    public function replace(Identifier $id, Username $old_username, Username $new_username)
    {
        $this->remove($id);
        $this->add($id, $new_username);
    }
}
