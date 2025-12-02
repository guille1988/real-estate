import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::index
* @see app/Http/Controllers/Admin/PropertyMessageController.php:21
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
* @see app/Http/Controllers/Admin/PropertyMessageController.php:21
* @route '/admin/property-messages'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::index
* @see app/Http/Controllers/Admin/PropertyMessageController.php:21
* @route '/admin/property-messages'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::index
* @see app/Http/Controllers/Admin/PropertyMessageController.php:21
* @route '/admin/property-messages'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::destroy
* @see app/Http/Controllers/Admin/PropertyMessageController.php:48
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
* @see app/Http/Controllers/Admin/PropertyMessageController.php:48
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
* @see app/Http/Controllers/Admin/PropertyMessageController.php:48
* @route '/admin/property-messages/{property_message}'
*/
destroy.delete = (args: { property_message: string | number } | [property_message: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::bulkDelete
* @see app/Http/Controllers/Admin/PropertyMessageController.php:37
* @route '/admin/property-messages/bulk-delete'
*/
export const bulkDelete = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: bulkDelete.url(options),
    method: 'post',
})

bulkDelete.definition = {
    methods: ["post"],
    url: '/admin/property-messages/bulk-delete',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::bulkDelete
* @see app/Http/Controllers/Admin/PropertyMessageController.php:37
* @route '/admin/property-messages/bulk-delete'
*/
bulkDelete.url = (options?: RouteQueryOptions) => {
    return bulkDelete.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::bulkDelete
* @see app/Http/Controllers/Admin/PropertyMessageController.php:37
* @route '/admin/property-messages/bulk-delete'
*/
bulkDelete.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: bulkDelete.url(options),
    method: 'post',
})

const propertyMessages = {
    index: Object.assign(index, index),
    destroy: Object.assign(destroy, destroy),
    bulkDelete: Object.assign(bulkDelete, bulkDelete),
}

export default propertyMessages