import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::index
* @see app/Http/Controllers/Admin/PropertyMessageController.php:19
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
* @see app/Http/Controllers/Admin/PropertyMessageController.php:19
* @route '/admin/property-messages'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::index
* @see app/Http/Controllers/Admin/PropertyMessageController.php:19
* @route '/admin/property-messages'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\PropertyMessageController::index
* @see app/Http/Controllers/Admin/PropertyMessageController.php:19
* @route '/admin/property-messages'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

const PropertyMessageController = { index }

export default PropertyMessageController