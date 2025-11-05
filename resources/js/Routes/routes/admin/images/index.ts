import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\ImageController::index
* @see app/Http/Controllers/Admin/ImageController.php:29
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
* @see app/Http/Controllers/Admin/ImageController.php:29
* @route '/admin/images'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ImageController::index
* @see app/Http/Controllers/Admin/ImageController.php:29
* @route '/admin/images'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\ImageController::index
* @see app/Http/Controllers/Admin/ImageController.php:29
* @route '/admin/images'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\ImageController::create
* @see app/Http/Controllers/Admin/ImageController.php:47
* @route '/admin/images/create'
*/
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/admin/images/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\ImageController::create
* @see app/Http/Controllers/Admin/ImageController.php:47
* @route '/admin/images/create'
*/
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ImageController::create
* @see app/Http/Controllers/Admin/ImageController.php:47
* @route '/admin/images/create'
*/
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\ImageController::create
* @see app/Http/Controllers/Admin/ImageController.php:47
* @route '/admin/images/create'
*/
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\ImageController::store
* @see app/Http/Controllers/Admin/ImageController.php:62
* @route '/admin/images'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/images',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\ImageController::store
* @see app/Http/Controllers/Admin/ImageController.php:62
* @route '/admin/images'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ImageController::store
* @see app/Http/Controllers/Admin/ImageController.php:62
* @route '/admin/images'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

const images = {
    index: Object.assign(index, index),
    create: Object.assign(create, create),
    store: Object.assign(store, store),
}

export default images