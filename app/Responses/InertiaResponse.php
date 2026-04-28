<?php

declare(strict_types=1);

namespace App\Responses;

use App\Support\InertiaResponseHelper;
use BackedEnum;
use Illuminate\Contracts\Support\Arrayable;
use Inertia\Response;
use Inertia\ResponseFactory;
use InvalidArgumentException;
use UnitEnum;

final class InertiaResponse extends ResponseFactory
{
    /**
     * @param  array<string, mixed>|Arrayable<string, mixed>  $props
     */
    public function render($component, $props = []): Response // @pest-ignore-type
    {
        $component = $this->transformComponent($component);

        $component = match (true) {
            $component instanceof BackedEnum => $component->value,
            $component instanceof UnitEnum => $component->name,
            default => $component,
        };

        if (! is_string($component)) {
            throw new InvalidArgumentException('Component argument must be of type string or a string BackedEnum');
        }

        if ($props instanceof Arrayable) {
            $props = $props->toArray();
        }

        /**
         * @var array<int|string, mixed> $properties
         */
        $properties = app()->call(
            InertiaResponseHelper::class,
            ['data' => $props],
        );

        return new Response(
            $component,
            $this->sharedProps,
            $properties,
            $this->rootView,
            $this->getVersion(),
            (bool) ($this->encryptHistory ?? config('inertia.history.encrypt', false)),
            $this->urlResolver,
        );
    }
}
