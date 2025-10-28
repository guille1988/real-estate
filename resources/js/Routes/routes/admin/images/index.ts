import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\ImageController::index
* @see app/Http/Controllers/Admin/ImageController.php:17
* @route '/admin/images'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/images',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\ImageController::index
* @see app/Http/Controllers/Admin/ImageController.php:17
* @route '/admin/images'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ImageController::index
* @see app/Http/Controllers/Admin/ImageController.php:17
* @route '/admin/images'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\ImageController::index
* @see app/Http/Controllers/Admin/ImageController.php:17
* @route '/admin/images'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

const images = {
    index: Object.assign(index, index),
}

export default images