import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\AmenityController::index
* @see app/Http/Controllers/Admin/AmenityController.php:19
* @route '/admin/amenities'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/amenities',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\AmenityController::index
* @see app/Http/Controllers/Admin/AmenityController.php:19
* @route '/admin/amenities'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AmenityController::index
* @see app/Http/Controllers/Admin/AmenityController.php:19
* @route '/admin/amenities'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\AmenityController::index
* @see app/Http/Controllers/Admin/AmenityController.php:19
* @route '/admin/amenities'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\AmenityController::destroy
* @see app/Http/Controllers/Admin/AmenityController.php:45
* @route '/admin/amenities/{amenity}'
*/
export const destroy = (args: { amenity: string | { uuid: string } } | [amenity: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/amenities/{amenity}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\AmenityController::destroy
* @see app/Http/Controllers/Admin/AmenityController.php:45
* @route '/admin/amenities/{amenity}'
*/
destroy.url = (args: { amenity: string | { uuid: string } } | [amenity: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { amenity: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'uuid' in args) {
        args = { amenity: args.uuid }
    }

    if (Array.isArray(args)) {
        args = {
            amenity: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        amenity: typeof args.amenity === 'object'
        ? args.amenity.uuid
        : args.amenity,
    }

    return destroy.definition.url
            .replace('{amenity}', parsedArgs.amenity.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AmenityController::destroy
* @see app/Http/Controllers/Admin/AmenityController.php:45
* @route '/admin/amenities/{amenity}'
*/
destroy.delete = (args: { amenity: string | { uuid: string } } | [amenity: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\Admin\AmenityController::bulkDelete
* @see app/Http/Controllers/Admin/AmenityController.php:34
* @route '/admin/amenities/bulk-delete'
*/
export const bulkDelete = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: bulkDelete.url(options),
    method: 'post',
})

bulkDelete.definition = {
    methods: ["post"],
    url: '/admin/amenities/bulk-delete',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\AmenityController::bulkDelete
* @see app/Http/Controllers/Admin/AmenityController.php:34
* @route '/admin/amenities/bulk-delete'
*/
bulkDelete.url = (options?: RouteQueryOptions) => {
    return bulkDelete.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AmenityController::bulkDelete
* @see app/Http/Controllers/Admin/AmenityController.php:34
* @route '/admin/amenities/bulk-delete'
*/
bulkDelete.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: bulkDelete.url(options),
    method: 'post',
})

const amenities = {
    index: Object.assign(index, index),
    destroy: Object.assign(destroy, destroy),
    bulkDelete: Object.assign(bulkDelete, bulkDelete),
}

export default amenities