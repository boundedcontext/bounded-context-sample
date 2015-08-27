<?php

namespace Infrastructure\Domain\Projection;

use BoundedContext\Laravel\Illuminate\Projection\AbstractProjection;
use BoundedContext\ValueObject\Uuid;
use Domain\Test\ValueObject\Username;

class ActiveUsernames extends AbstractProjection implements \Domain\Test\Projection\ActiveUsernames\Projection
{
    protected function table()
    {
        return 'projections_domain_test_active_usernames';
    }

    public function exists(Username $username)
    {
        $username_count = $this->query()
            ->where('username', $username->serialize())
            ->count();

        return $username_count > 0;
    }

    public function add(Uuid $id, Username $username)
    {
        if($this->exists($username))
        {
            throw new \Exception("The username [".$username->serialize()."] is already active.");
        }

        $this->query()->insert([
            'aggregate_id' => $id->serialize(),
            'username' => $username->serialize()
        ]);
    }

    public function remove(Uuid $id)
    {
        $username_row = $this->query()
            ->where('aggregate_id', $id->serialize())
            ->first();

        if(!$username_row)
        {
            throw new \Exception("The id [".$id->serialize()."] does not have an active username.");
        }

        $this->query()
            ->where('aggregate_id', $id->serialize())
            ->delete();
    }

    public function replace(Uuid $id, Username $old_username, Username $new_username)
    {
        $this->remove($id);
        $this->add($id, $new_username);
    }
}
