import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\SubscriberController::index
* @see app/Http/Controllers/Admin/SubscriberController.php:19
* @route '/admin/subscribers'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/subscribers',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\SubscriberController::index
* @see app/Http/Controllers/Admin/SubscriberController.php:19
* @route '/admin/subscribers'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\SubscriberController::index
* @see app/Http/Controllers/Admin/SubscriberController.php:19
* @route '/admin/subscribers'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\SubscriberController::index
* @see app/Http/Controllers/Admin/SubscriberController.php:19
* @route '/admin/subscribers'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\SubscriberController::destroy
* @see app/Http/Controllers/Admin/SubscriberController.php:45
* @route '/admin/subscribers/{subscriber}'
*/
export const destroy = (args: { subscriber: string | { uuid: string } } | [subscriber: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/subscribers/{subscriber}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\SubscriberController::destroy
* @see app/Http/Controllers/Admin/SubscriberController.php:45
* @route '/admin/subscribers/{subscriber}'
*/
destroy.url = (args: { subscriber: string | { uuid: string } } | [subscriber: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { subscriber: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'uuid' in args) {
        args = { subscriber: args.uuid }
    }

    if (Array.isArray(args)) {
        args = {
            subscriber: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        subscriber: typeof args.subscriber === 'object'
        ? args.subscriber.uuid
        : args.subscriber,
    }

    return destroy.definition.url
            .replace('{subscriber}', parsedArgs.subscriber.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\SubscriberController::destroy
* @see app/Http/Controllers/Admin/SubscriberController.php:45
* @route '/admin/subscribers/{subscriber}'
*/
destroy.delete = (args: { subscriber: string | { uuid: string } } | [subscriber: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\Admin\SubscriberController::bulkDelete
* @see app/Http/Controllers/Admin/SubscriberController.php:34
* @route '/admin/subscribers/bulk-delete'
*/
export const bulkDelete = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: bulkDelete.url(options),
    method: 'post',
})

bulkDelete.definition = {
    methods: ["post"],
    url: '/admin/subscribers/bulk-delete',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\SubscriberController::bulkDelete
* @see app/Http/Controllers/Admin/SubscriberController.php:34
* @route '/admin/subscribers/bulk-delete'
*/
bulkDelete.url = (options?: RouteQueryOptions) => {
    return bulkDelete.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\SubscriberController::bulkDelete
* @see app/Http/Controllers/Admin/SubscriberController.php:34
* @route '/admin/subscribers/bulk-delete'
*/
bulkDelete.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: bulkDelete.url(options),
    method: 'post',
})

const subscribers = {
    index: Object.assign(index, index),
    destroy: Object.assign(destroy, destroy),
    bulkDelete: Object.assign(bulkDelete, bulkDelete),
}

export default subscribers