<?php

declare(strict_types=1);

namespace App\Exceptions\Traits;

trait Traceable
{
    public function getTraceMessage(): string
    {
        return app()->isProduction() ?
            $this->message :
            "'File: {$this->getFile()} | Line: {$this->getLine()} | Message: $this->message";
    }
}
