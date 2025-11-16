import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\ImageController::index
* @see app/Http/Controllers/Admin/ImageController.php:26
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
* @see app/Http/Controllers/Admin/ImageController.php:26
* @route '/admin/images'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ImageController::index
* @see app/Http/Controllers/Admin/ImageController.php:26
* @route '/admin/images'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\ImageController::index
* @see app/Http/Controllers/Admin/ImageController.php:26
* @route '/admin/images'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\ImageController::create
* @see app/Http/Controllers/Admin/ImageController.php:44
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
* @see app/Http/Controllers/Admin/ImageController.php:44
* @route '/admin/images/create'
*/
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ImageController::create
* @see app/Http/Controllers/Admin/ImageController.php:44
* @route '/admin/images/create'
*/
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\ImageController::create
* @see app/Http/Controllers/Admin/ImageController.php:44
* @route '/admin/images/create'
*/
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\ImageController::store
* @see app/Http/Controllers/Admin/ImageController.php:59
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
* @see app/Http/Controllers/Admin/ImageController.php:59
* @route '/admin/images'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ImageController::store
* @see app/Http/Controllers/Admin/ImageController.php:59
* @route '/admin/images'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Admin\ImageController::destroy
* @see app/Http/Controllers/Admin/ImageController.php:75
* @route '/admin/images/{image}'
*/
export const destroy = (args: { image: string | { uuid: string } } | [image: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/images/{image}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\ImageController::destroy
* @see app/Http/Controllers/Admin/ImageController.php:75
* @route '/admin/images/{image}'
*/
destroy.url = (args: { image: string | { uuid: string } } | [image: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { image: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'uuid' in args) {
        args = { image: args.uuid }
    }

    if (Array.isArray(args)) {
        args = {
            image: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        image: typeof args.image === 'object'
        ? args.image.uuid
        : args.image,
    }

    return destroy.definition.url
            .replace('{image}', parsedArgs.image.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ImageController::destroy
* @see app/Http/Controllers/Admin/ImageController.php:75
* @route '/admin/images/{image}'
*/
destroy.delete = (args: { image: string | { uuid: string } } | [image: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\Admin\ImageController::bulkDelete
* @see app/Http/Controllers/Admin/ImageController.php:66
* @route '/admin/images/bulk-delete'
*/
export const bulkDelete = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: bulkDelete.url(options),
    method: 'post',
})

bulkDelete.definition = {
    methods: ["post"],
    url: '/admin/images/bulk-delete',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\ImageController::bulkDelete
* @see app/Http/Controllers/Admin/ImageController.php:66
* @route '/admin/images/bulk-delete'
*/
bulkDelete.url = (options?: RouteQueryOptions) => {
    return bulkDelete.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ImageController::bulkDelete
* @see app/Http/Controllers/Admin/ImageController.php:66
* @route '/admin/images/bulk-delete'
*/
bulkDelete.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: bulkDelete.url(options),
    method: 'post',
})

const images = {
    index: Object.assign(index, index),
    create: Object.assign(create, create),
    store: Object.assign(store, store),
    destroy: Object.assign(destroy, destroy),
    bulkDelete: Object.assign(bulkDelete, bulkDelete),
}

export default images