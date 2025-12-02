import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::index
* @see app/Http/Controllers/Admin/PropertyMessageController.php:22
* @route '/admin/property-messages'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/property-messages',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::index
* @see app/Http/Controllers/Admin/PropertyMessageController.php:22
* @route '/admin/property-messages'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::index
* @see app/Http/Controllers/Admin/PropertyMessageController.php:22
* @route '/admin/property-messages'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::index
* @see app/Http/Controllers/Admin/PropertyMessageController.php:22
* @route '/admin/property-messages'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::show
* @see app/Http/Controllers/Admin/PropertyMessageController.php:38
* @route '/admin/property-messages/{property_message}'
*/
export const show = (args: { property_message: string | number } | [property_message: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/admin/property-messages/{property_message}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::show
* @see app/Http/Controllers/Admin/PropertyMessageController.php:38
* @route '/admin/property-messages/{property_message}'
*/
show.url = (args: { property_message: string | number } | [property_message: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { property_message: args }
    }

    if (Array.isArray(args)) {
        args = {
            property_message: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        property_message: args.property_message,
    }

    return show.definition.url
            .replace('{property_message}', parsedArgs.property_message.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::show
* @see app/Http/Controllers/Admin/PropertyMessageController.php:38
* @route '/admin/property-messages/{property_message}'
*/
show.get = (args: { property_message: string | number } | [property_message: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::show
* @see app/Http/Controllers/Admin/PropertyMessageController.php:38
* @route '/admin/property-messages/{property_message}'
*/
show.head = (args: { property_message: string | number } | [property_message: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::destroy
* @see app/Http/Controllers/Admin/PropertyMessageController.php:59
* @route '/admin/property-messages/{property_message}'
*/
export const destroy = (args: { property_message: string | number } | [property_message: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/property-messages/{property_message}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::destroy
* @see app/Http/Controllers/Admin/PropertyMessageController.php:59
* @route '/admin/property-messages/{property_message}'
*/
destroy.url = (args: { property_message: string | number } | [property_message: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { property_message: args }
    }

    if (Array.isArray(args)) {
        args = {
            property_message: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        property_message: args.property_message,
    }

    return destroy.definition.url
            .replace('{property_message}', parsedArgs.property_message.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::destroy
* @see app/Http/Controllers/Admin/PropertyMessageController.php:59
* @route '/admin/property-messages/{property_message}'
*/
destroy.delete = (args: { property_message: string | number } | [property_message: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::bulkDestroy
* @see app/Http/Controllers/Admin/PropertyMessageController.php:48
* @route '/admin/property-messages/bulk-delete'
*/
export const bulkDestroy = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: bulkDestroy.url(options),
    method: 'post',
})

bulkDestroy.definition = {
    methods: ["post"],
    url: '/admin/property-messages/bulk-delete',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::bulkDestroy
* @see app/Http/Controllers/Admin/PropertyMessageController.php:48
* @route '/admin/property-messages/bulk-delete'
*/
bulkDestroy.url = (options?: RouteQueryOptions) => {
    return bulkDestroy.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::bulkDestroy
* @see app/Http/Controllers/Admin/PropertyMessageController.php:48
* @route '/admin/property-messages/bulk-delete'
*/
bulkDestroy.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: bulkDestroy.url(options),
    method: 'post',
})

const PropertyMessageController = { index, show, destroy, bulkDestroy }

export default PropertyMessageController