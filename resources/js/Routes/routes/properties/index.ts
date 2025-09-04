import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../wayfinder'
/**
* @see \App\Http\Controllers\PropertyController::index
* @see app/Http/Controllers/PropertyController.php:32
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
* @see app/Http/Controllers/PropertyController.php:32
* @route '/properties'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PropertyController::index
* @see app/Http/Controllers/PropertyController.php:32
* @route '/properties'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\PropertyController::index
* @see app/Http/Controllers/PropertyController.php:32
* @route '/properties'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\PropertyController::store
* @see app/Http/Controllers/PropertyController.php:91
* @route '/properties'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/properties',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\PropertyController::store
* @see app/Http/Controllers/PropertyController.php:91
* @route '/properties'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PropertyController::store
* @see app/Http/Controllers/PropertyController.php:91
* @route '/properties'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\PropertyController::show
* @see app/Http/Controllers/PropertyController.php:60
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
* @see app/Http/Controllers/PropertyController.php:60
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
* @see app/Http/Controllers/PropertyController.php:60
* @route '/properties/{property}'
*/
show.get = (args: { property: string | { uuid: string } } | [property: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\PropertyController::show
* @see app/Http/Controllers/PropertyController.php:60
* @route '/properties/{property}'
*/
show.head = (args: { property: string | { uuid: string } } | [property: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

const properties = {
    index,
    store,
    show,
}

export default properties