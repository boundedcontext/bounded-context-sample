<?php namespace Infrastructure\Domain\Projection\EmailAddressMustBeUnique;

use BoundedContext\Laravel\Illuminate\Projection\AbstractQueryable;
use Domain\Test\ValueObject\EmailAddress;

class Queryable extends AbstractQueryable implements \Domain\Test\Invariant\EmailAddressMustBeUnique\Projection\Queryable
{
    protected $table = 'projections_domain_test_active_emails';

    public function exists(EmailAddress $email)
    {
        $email_count = $this->query()
            ->where('email', $email->serialize())
            ->count();

        return $email_count > 0;
    }
}
