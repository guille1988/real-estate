<?php

declare(strict_types=1);

namespace App\Responses;

use App\Support\ArrayHelper;
use Illuminate\Contracts\Support\Arrayable;
use Inertia\Response;
use Inertia\ResponseFactory;

final class InertiaResponse extends ResponseFactory
{
    /**
     * @param  array<string, mixed>|Arrayable<string, mixed>  $props
     */
    public function render(string $component, $props = []): Response // @pest-ignore-type
    {
        if ($props instanceof Arrayable) {
            $props = $props->toArray();
        }

        /**
         * @var array<int|string, mixed> $properties
         */
        $properties = ArrayHelper::transformKeysToCamelCase($props);

        return new Response(
            $component,
            array_merge($this->sharedProps, $properties),
            $this->rootView,
            $this->getVersion(),
            (bool) ($this->encryptHistory ?? config('inertia.history.encrypt', false)),
            $this->urlResolver,
        );
    }
}
