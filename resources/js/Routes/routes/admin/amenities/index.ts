import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\AmenityController::index
* @see app/Http/Controllers/Admin/AmenityController.php:17
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
* @see app/Http/Controllers/Admin/AmenityController.php:17
* @route '/admin/amenities'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AmenityController::index
* @see app/Http/Controllers/Admin/AmenityController.php:17
* @route '/admin/amenities'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\AmenityController::index
* @see app/Http/Controllers/Admin/AmenityController.php:17
* @route '/admin/amenities'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

const amenities = {
    index: Object.assign(index, index),
}

export default amenities