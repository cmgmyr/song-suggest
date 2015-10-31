<?php

namespace Ss\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Commander\Events\EventGenerator;

abstract class BaseModel extends Model
{
    use EventGenerator;
}
