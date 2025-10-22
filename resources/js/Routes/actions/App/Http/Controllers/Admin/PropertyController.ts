import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\PropertyController::index
* @see app/Http/Controllers/Admin/PropertyController.php:30
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
* @see app/Http/Controllers/Admin/PropertyController.php:30
* @route '/admin/properties'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PropertyController::index
* @see app/Http/Controllers/Admin/PropertyController.php:30
* @route '/admin/properties'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\PropertyController::index
* @see app/Http/Controllers/Admin/PropertyController.php:30
* @route '/admin/properties'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\PropertyController::create
* @see app/Http/Controllers/Admin/PropertyController.php:49
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
* @see app/Http/Controllers/Admin/PropertyController.php:49
* @route '/admin/properties/create'
*/
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PropertyController::create
* @see app/Http/Controllers/Admin/PropertyController.php:49
* @route '/admin/properties/create'
*/
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\PropertyController::create
* @see app/Http/Controllers/Admin/PropertyController.php:49
* @route '/admin/properties/create'
*/
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\PropertyController::store
* @see app/Http/Controllers/Admin/PropertyController.php:74
* @route '/admin/properties'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/properties',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\PropertyController::store
* @see app/Http/Controllers/Admin/PropertyController.php:74
* @route '/admin/properties'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PropertyController::store
* @see app/Http/Controllers/Admin/PropertyController.php:74
* @route '/admin/properties'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Admin\PropertyController::show
* @see app/Http/Controllers/Admin/PropertyController.php:64
* @route '/admin/properties/{property}'
*/
export const show = (args: { property: string | { uuid: string } } | [property: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/admin/properties/{property}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\PropertyController::show
* @see app/Http/Controllers/Admin/PropertyController.php:64
* @route '/admin/properties/{property}'
*/
show.url = (args: { property: string | { uuid: string } } | [property: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { property: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'uuid' in args) {
        args = { property: args.uuid }
    }

    if (Array.isArray(args)) {
        args = {
            property: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        property: typeof args.property === 'object'
        ? args.property.uuid
        : args.property,
    }

    return show.definition.url
            .replace('{property}', parsedArgs.property.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PropertyController::show
* @see app/Http/Controllers/Admin/PropertyController.php:64
* @route '/admin/properties/{property}'
*/
show.get = (args: { property: string | { uuid: string } } | [property: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\PropertyController::show
* @see app/Http/Controllers/Admin/PropertyController.php:64
* @route '/admin/properties/{property}'
*/
show.head = (args: { property: string | { uuid: string } } | [property: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\PropertyController::edit
* @see app/Http/Controllers/Admin/PropertyController.php:57
* @route '/admin/properties/{property}/edit'
*/
export const edit = (args: { property: string | { uuid: string } } | [property: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/admin/properties/{property}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\PropertyController::edit
* @see app/Http/Controllers/Admin/PropertyController.php:57
* @route '/admin/properties/{property}/edit'
*/
edit.url = (args: { property: string | { uuid: string } } | [property: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { property: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'uuid' in args) {
        args = { property: args.uuid }
    }

    if (Array.isArray(args)) {
        args = {
            property: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        property: typeof args.property === 'object'
        ? args.property.uuid
        : args.property,
    }

    return edit.definition.url
            .replace('{property}', parsedArgs.property.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PropertyController::edit
* @see app/Http/Controllers/Admin/PropertyController.php:57
* @route '/admin/properties/{property}/edit'
*/
edit.get = (args: { property: string | { uuid: string } } | [property: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\PropertyController::edit
* @see app/Http/Controllers/Admin/PropertyController.php:57
* @route '/admin/properties/{property}/edit'
*/
edit.head = (args: { property: string | { uuid: string } } | [property: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\PropertyController::update
* @see app/Http/Controllers/Admin/PropertyController.php:92
* @route '/admin/properties/{property}'
*/
export const update = (args: { property: string | { uuid: string } } | [property: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put","patch"],
    url: '/admin/properties/{property}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \App\Http\Controllers\Admin\PropertyController::update
* @see app/Http/Controllers/Admin/PropertyController.php:92
* @route '/admin/properties/{property}'
*/
update.url = (args: { property: string | { uuid: string } } | [property: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { property: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'uuid' in args) {
        args = { property: args.uuid }
    }

    if (Array.isArray(args)) {
        args = {
            property: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        property: typeof args.property === 'object'
        ? args.property.uuid
        : args.property,
    }

    return update.definition.url
            .replace('{property}', parsedArgs.property.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PropertyController::update
* @see app/Http/Controllers/Admin/PropertyController.php:92
* @route '/admin/properties/{property}'
*/
update.put = (args: { property: string | { uuid: string } } | [property: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\Admin\PropertyController::update
* @see app/Http/Controllers/Admin/PropertyController.php:92
* @route '/admin/properties/{property}'
*/
update.patch = (args: { property: string | { uuid: string } } | [property: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

/**
* @see \App\Http\Controllers\Admin\PropertyController::destroy
* @see app/Http/Controllers/Admin/PropertyController.php:99
* @route '/admin/properties/{property}'
*/
export const destroy = (args: { property: string | { uuid: string } } | [property: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/properties/{property}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\PropertyController::destroy
* @see app/Http/Controllers/Admin/PropertyController.php:99
* @route '/admin/properties/{property}'
*/
destroy.url = (args: { property: string | { uuid: string } } | [property: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { property: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'uuid' in args) {
        args = { property: args.uuid }
    }

    if (Array.isArray(args)) {
        args = {
            property: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        property: typeof args.property === 'object'
        ? args.property.uuid
        : args.property,
    }

    return destroy.definition.url
            .replace('{property}', parsedArgs.property.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PropertyController::destroy
* @see app/Http/Controllers/Admin/PropertyController.php:99
* @route '/admin/properties/{property}'
*/
destroy.delete = (args: { property: string | { uuid: string } } | [property: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

const PropertyController = { index, create, store, show, edit, update, destroy }

export default PropertyController