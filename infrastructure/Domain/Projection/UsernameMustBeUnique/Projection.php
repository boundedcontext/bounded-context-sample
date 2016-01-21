<?php namespace Infrastructure\Domain\Projection;

use BoundedContext\Laravel\Illuminate\Projection\AbstractProjection;
use BoundedContext\Laravel\ValueObject\Uuid;
use Domain\Test\ValueObject\Username;

class Projection extends AbstractProjection implements \Domain\Test\Projection\Invariant\UsernameMustBeUnique\Projection\Projection
{
    protected $table = 'projections_domain_test_active_usernames';

    public function get(Uuid $id)
    {
        $username_row = $this->query()
            ->where('user_id', $id->serialize())
            ->first();

        if(!$username_row)
        {
            throw new \Exception("The id [".$id->serialize()."] does not have an active username.");
        }

        return $username_row->username;
    }

    public function add(Uuid $id, Username $username)
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

    public function remove(Uuid $id)
    {
        $username = $this->get($id);

        $this->query()
            ->where('username', $username)
            ->delete();
    }

    public function replace(Uuid $id, Username $old_username, Username $new_username)
    {
        $this->remove($id);
        $this->add($id, $new_username);
    }
}
