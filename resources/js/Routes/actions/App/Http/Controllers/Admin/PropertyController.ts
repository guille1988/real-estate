import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\PropertyController::index
* @see app/Http/Controllers/Admin/PropertyController.php:25
* @route '/admin/properties'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/properties',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\PropertyController::index
* @see app/Http/Controllers/Admin/PropertyController.php:25
* @route '/admin/properties'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PropertyController::index
* @see app/Http/Controllers/Admin/PropertyController.php:25
* @route '/admin/properties'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\PropertyController::index
* @see app/Http/Controllers/Admin/PropertyController.php:25
* @route '/admin/properties'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\PropertyController::create
* @see app/Http/Controllers/Admin/PropertyController.php:44
* @route '/admin/properties/create'
*/
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/admin/properties/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\PropertyController::create
* @see app/Http/Controllers/Admin/PropertyController.php:44
* @route '/admin/properties/create'
*/
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PropertyController::create
* @see app/Http/Controllers/Admin/PropertyController.php:44
* @route '/admin/properties/create'
*/
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\PropertyController::create
* @see app/Http/Controllers/Admin/PropertyController.php:44
* @route '/admin/properties/create'
*/
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

const PropertyController = { index, create }

export default PropertyController