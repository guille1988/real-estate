import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\AmenityController::index
* @see app/Http/Controllers/Admin/AmenityController.php:29
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
* @see app/Http/Controllers/Admin/AmenityController.php:29
* @route '/admin/amenities'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AmenityController::index
* @see app/Http/Controllers/Admin/AmenityController.php:29
* @route '/admin/amenities'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\AmenityController::index
* @see app/Http/Controllers/Admin/AmenityController.php:29
* @route '/admin/amenities'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\AmenityController::create
* @see app/Http/Controllers/Admin/AmenityController.php:47
* @route '/admin/amenities/create'
*/
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/admin/amenities/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\AmenityController::create
* @see app/Http/Controllers/Admin/AmenityController.php:47
* @route '/admin/amenities/create'
*/
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AmenityController::create
* @see app/Http/Controllers/Admin/AmenityController.php:47
* @route '/admin/amenities/create'
*/
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\AmenityController::create
* @see app/Http/Controllers/Admin/AmenityController.php:47
* @route '/admin/amenities/create'
*/
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\AmenityController::store
* @see app/Http/Controllers/Admin/AmenityController.php:82
* @route '/admin/amenities'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/amenities',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\AmenityController::store
* @see app/Http/Controllers/Admin/AmenityController.php:82
* @route '/admin/amenities'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AmenityController::store
* @see app/Http/Controllers/Admin/AmenityController.php:82
* @route '/admin/amenities'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Admin\AmenityController::show
* @see app/Http/Controllers/Admin/AmenityController.php:59
* @route '/admin/amenities/{amenity}'
*/
export const show = (args: { amenity: string | { uuid: string } } | [amenity: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/admin/amenities/{amenity}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\AmenityController::show
* @see app/Http/Controllers/Admin/AmenityController.php:59
* @route '/admin/amenities/{amenity}'
*/
show.url = (args: { amenity: string | { uuid: string } } | [amenity: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions) => {
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

    return show.definition.url
            .replace('{amenity}', parsedArgs.amenity.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AmenityController::show
* @see app/Http/Controllers/Admin/AmenityController.php:59
* @route '/admin/amenities/{amenity}'
*/
show.get = (args: { amenity: string | { uuid: string } } | [amenity: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\AmenityController::show
* @see app/Http/Controllers/Admin/AmenityController.php:59
* @route '/admin/amenities/{amenity}'
*/
show.head = (args: { amenity: string | { uuid: string } } | [amenity: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\AmenityController::edit
* @see app/Http/Controllers/Admin/AmenityController.php:69
* @route '/admin/amenities/{amenity}/edit'
*/
export const edit = (args: { amenity: string | { uuid: string } } | [amenity: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/admin/amenities/{amenity}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\AmenityController::edit
* @see app/Http/Controllers/Admin/AmenityController.php:69
* @route '/admin/amenities/{amenity}/edit'
*/
edit.url = (args: { amenity: string | { uuid: string } } | [amenity: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions) => {
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

    return edit.definition.url
            .replace('{amenity}', parsedArgs.amenity.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AmenityController::edit
* @see app/Http/Controllers/Admin/AmenityController.php:69
* @route '/admin/amenities/{amenity}/edit'
*/
edit.get = (args: { amenity: string | { uuid: string } } | [amenity: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\AmenityController::edit
* @see app/Http/Controllers/Admin/AmenityController.php:69
* @route '/admin/amenities/{amenity}/edit'
*/
edit.head = (args: { amenity: string | { uuid: string } } | [amenity: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\AmenityController::update
* @see app/Http/Controllers/Admin/AmenityController.php:101
* @route '/admin/amenities/{amenity}'
*/
export const update = (args: { amenity: string | { uuid: string } } | [amenity: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put","patch"],
    url: '/admin/amenities/{amenity}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \App\Http\Controllers\Admin\AmenityController::update
* @see app/Http/Controllers/Admin/AmenityController.php:101
* @route '/admin/amenities/{amenity}'
*/
update.url = (args: { amenity: string | { uuid: string } } | [amenity: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions) => {
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

    return update.definition.url
            .replace('{amenity}', parsedArgs.amenity.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AmenityController::update
* @see app/Http/Controllers/Admin/AmenityController.php:101
* @route '/admin/amenities/{amenity}'
*/
update.put = (args: { amenity: string | { uuid: string } } | [amenity: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\Admin\AmenityController::update
* @see app/Http/Controllers/Admin/AmenityController.php:101
* @route '/admin/amenities/{amenity}'
*/
update.patch = (args: { amenity: string | { uuid: string } } | [amenity: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

/**
* @see \App\Http\Controllers\Admin\AmenityController::destroy
* @see app/Http/Controllers/Admin/AmenityController.php:112
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
* @see app/Http/Controllers/Admin/AmenityController.php:112
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
* @see app/Http/Controllers/Admin/AmenityController.php:112
* @route '/admin/amenities/{amenity}'
*/
destroy.delete = (args: { amenity: string | { uuid: string } } | [amenity: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\Admin\AmenityController::bulkDelete
* @see app/Http/Controllers/Admin/AmenityController.php:90
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
* @see app/Http/Controllers/Admin/AmenityController.php:90
* @route '/admin/amenities/bulk-delete'
*/
bulkDelete.url = (options?: RouteQueryOptions) => {
    return bulkDelete.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AmenityController::bulkDelete
* @see app/Http/Controllers/Admin/AmenityController.php:90
* @route '/admin/amenities/bulk-delete'
*/
bulkDelete.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: bulkDelete.url(options),
    method: 'post',
})

const amenities = {
    index: Object.assign(index, index),
    create: Object.assign(create, create),
    store: Object.assign(store, store),
    show: Object.assign(show, show),
    edit: Object.assign(edit, edit),
    update: Object.assign(update, update),
    destroy: Object.assign(destroy, destroy),
    bulkDelete: Object.assign(bulkDelete, bulkDelete),
}

export default amenities