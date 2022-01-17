<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\Course;

use Application\Queries\Course\GetCoursesQuery;
use Domain\Adapters\CommandAdapter;
use Illuminate\Http\Request;

class GetCoursesAdapter extends CommandAdapter
{
    public function adapt(Request $request): GetCoursesQuery
    {
        return new GetCoursesQuery();
    }
}
