import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\PropertyController::index
* @see app/Http/Controllers/PropertyController.php:33
* @route '/properties'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/properties',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\PropertyController::index
* @see app/Http/Controllers/PropertyController.php:33
* @route '/properties'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PropertyController::index
* @see app/Http/Controllers/PropertyController.php:33
* @route '/properties'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\PropertyController::index
* @see app/Http/Controllers/PropertyController.php:33
* @route '/properties'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\PropertyController::show
* @see app/Http/Controllers/PropertyController.php:64
* @route '/properties/{property}'
*/
export const show = (args: { property: string | { uuid: string } } | [property: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/properties/{property}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\PropertyController::show
* @see app/Http/Controllers/PropertyController.php:64
* @route '/properties/{property}'
*/
show.url = (args: { property: string | { uuid: string } } | [property: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { property: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'uuid' in args) {
        args = { property: args.uuid }
    }

    if (Array.isArray(args)) {
        args = {
            property: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        property: typeof args.property === 'object'
        ? args.property.uuid
        : args.property,
    }

    return show.definition.url
            .replace('{property}', parsedArgs.property.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\PropertyController::show
* @see app/Http/Controllers/PropertyController.php:64
* @route '/properties/{property}'
*/
show.get = (args: { property: string | { uuid: string } } | [property: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\PropertyController::show
* @see app/Http/Controllers/PropertyController.php:64
* @route '/properties/{property}'
*/
show.head = (args: { property: string | { uuid: string } } | [property: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\PropertyController::inquire
* @see app/Http/Controllers/PropertyController.php:95
* @route '/properties/inquiries'
*/
export const inquire = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: inquire.url(options),
    method: 'post',
})

inquire.definition = {
    methods: ["post"],
    url: '/properties/inquiries',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\PropertyController::inquire
* @see app/Http/Controllers/PropertyController.php:95
* @route '/properties/inquiries'
*/
inquire.url = (options?: RouteQueryOptions) => {
    return inquire.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PropertyController::inquire
* @see app/Http/Controllers/PropertyController.php:95
* @route '/properties/inquiries'
*/
inquire.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: inquire.url(options),
    method: 'post',
})

const PropertyController = { index, show, inquire }

export default PropertyController