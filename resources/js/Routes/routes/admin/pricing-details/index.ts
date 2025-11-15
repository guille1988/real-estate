import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\PricingDetailController::index
* @see app/Http/Controllers/Admin/PricingDetailController.php:30
* @route '/admin/pricing-details'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/pricing-details',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::index
* @see app/Http/Controllers/Admin/PricingDetailController.php:30
* @route '/admin/pricing-details'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::index
* @see app/Http/Controllers/Admin/PricingDetailController.php:30
* @route '/admin/pricing-details'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::index
* @see app/Http/Controllers/Admin/PricingDetailController.php:30
* @route '/admin/pricing-details'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::create
* @see app/Http/Controllers/Admin/PricingDetailController.php:49
* @route '/admin/pricing-details/create'
*/
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/admin/pricing-details/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::create
* @see app/Http/Controllers/Admin/PricingDetailController.php:49
* @route '/admin/pricing-details/create'
*/
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::create
* @see app/Http/Controllers/Admin/PricingDetailController.php:49
* @route '/admin/pricing-details/create'
*/
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::create
* @see app/Http/Controllers/Admin/PricingDetailController.php:49
* @route '/admin/pricing-details/create'
*/
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::store
* @see app/Http/Controllers/Admin/PricingDetailController.php:77
* @route '/admin/pricing-details'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/pricing-details',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::store
* @see app/Http/Controllers/Admin/PricingDetailController.php:77
* @route '/admin/pricing-details'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::store
* @see app/Http/Controllers/Admin/PricingDetailController.php:77
* @route '/admin/pricing-details'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::show
* @see app/Http/Controllers/Admin/PricingDetailController.php:62
* @route '/admin/pricing-details/{pricing_detail}'
*/
export const show = (args: { pricing_detail: string | number } | [pricing_detail: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/admin/pricing-details/{pricing_detail}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::show
* @see app/Http/Controllers/Admin/PricingDetailController.php:62
* @route '/admin/pricing-details/{pricing_detail}'
*/
show.url = (args: { pricing_detail: string | number } | [pricing_detail: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { pricing_detail: args }
    }

    if (Array.isArray(args)) {
        args = {
            pricing_detail: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        pricing_detail: args.pricing_detail,
    }

    return show.definition.url
            .replace('{pricing_detail}', parsedArgs.pricing_detail.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::show
* @see app/Http/Controllers/Admin/PricingDetailController.php:62
* @route '/admin/pricing-details/{pricing_detail}'
*/
show.get = (args: { pricing_detail: string | number } | [pricing_detail: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::show
* @see app/Http/Controllers/Admin/PricingDetailController.php:62
* @route '/admin/pricing-details/{pricing_detail}'
*/
show.head = (args: { pricing_detail: string | number } | [pricing_detail: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::edit
* @see app/Http/Controllers/Admin/PricingDetailController.php:69
* @route '/admin/pricing-details/{pricing_detail}/edit'
*/
export const edit = (args: { pricing_detail: string | number } | [pricing_detail: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/admin/pricing-details/{pricing_detail}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::edit
* @see app/Http/Controllers/Admin/PricingDetailController.php:69
* @route '/admin/pricing-details/{pricing_detail}/edit'
*/
edit.url = (args: { pricing_detail: string | number } | [pricing_detail: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { pricing_detail: args }
    }

    if (Array.isArray(args)) {
        args = {
            pricing_detail: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        pricing_detail: args.pricing_detail,
    }

    return edit.definition.url
            .replace('{pricing_detail}', parsedArgs.pricing_detail.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::edit
* @see app/Http/Controllers/Admin/PricingDetailController.php:69
* @route '/admin/pricing-details/{pricing_detail}/edit'
*/
edit.get = (args: { pricing_detail: string | number } | [pricing_detail: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::edit
* @see app/Http/Controllers/Admin/PricingDetailController.php:69
* @route '/admin/pricing-details/{pricing_detail}/edit'
*/
edit.head = (args: { pricing_detail: string | number } | [pricing_detail: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::update
* @see app/Http/Controllers/Admin/PricingDetailController.php:96
* @route '/admin/pricing-details/{pricing_detail}'
*/
export const update = (args: { pricing_detail: string | number } | [pricing_detail: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put","patch"],
    url: '/admin/pricing-details/{pricing_detail}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::update
* @see app/Http/Controllers/Admin/PricingDetailController.php:96
* @route '/admin/pricing-details/{pricing_detail}'
*/
update.url = (args: { pricing_detail: string | number } | [pricing_detail: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { pricing_detail: args }
    }

    if (Array.isArray(args)) {
        args = {
            pricing_detail: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        pricing_detail: args.pricing_detail,
    }

    return update.definition.url
            .replace('{pricing_detail}', parsedArgs.pricing_detail.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::update
* @see app/Http/Controllers/Admin/PricingDetailController.php:96
* @route '/admin/pricing-details/{pricing_detail}'
*/
update.put = (args: { pricing_detail: string | number } | [pricing_detail: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::update
* @see app/Http/Controllers/Admin/PricingDetailController.php:96
* @route '/admin/pricing-details/{pricing_detail}'
*/
update.patch = (args: { pricing_detail: string | number } | [pricing_detail: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::destroy
* @see app/Http/Controllers/Admin/PricingDetailController.php:104
* @route '/admin/pricing-details/{pricing_detail}'
*/
export const destroy = (args: { pricing_detail: string | number } | [pricing_detail: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/pricing-details/{pricing_detail}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::destroy
* @see app/Http/Controllers/Admin/PricingDetailController.php:104
* @route '/admin/pricing-details/{pricing_detail}'
*/
destroy.url = (args: { pricing_detail: string | number } | [pricing_detail: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { pricing_detail: args }
    }

    if (Array.isArray(args)) {
        args = {
            pricing_detail: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        pricing_detail: args.pricing_detail,
    }

    return destroy.definition.url
            .replace('{pricing_detail}', parsedArgs.pricing_detail.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::destroy
* @see app/Http/Controllers/Admin/PricingDetailController.php:104
* @route '/admin/pricing-details/{pricing_detail}'
*/
destroy.delete = (args: { pricing_detail: string | number } | [pricing_detail: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::bulkDelete
* @see app/Http/Controllers/Admin/PricingDetailController.php:85
* @route '/admin/pricing-details/bulk-delete'
*/
export const bulkDelete = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: bulkDelete.url(options),
    method: 'post',
})

bulkDelete.definition = {
    methods: ["post"],
    url: '/admin/pricing-details/bulk-delete',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::bulkDelete
* @see app/Http/Controllers/Admin/PricingDetailController.php:85
* @route '/admin/pricing-details/bulk-delete'
*/
bulkDelete.url = (options?: RouteQueryOptions) => {
    return bulkDelete.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PricingDetailController::bulkDelete
* @see app/Http/Controllers/Admin/PricingDetailController.php:85
* @route '/admin/pricing-details/bulk-delete'
*/
bulkDelete.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: bulkDelete.url(options),
    method: 'post',
})

const pricingDetails = {
    index: Object.assign(index, index),
    create: Object.assign(create, create),
    store: Object.assign(store, store),
    show: Object.assign(show, show),
    edit: Object.assign(edit, edit),
    update: Object.assign(update, update),
    destroy: Object.assign(destroy, destroy),
    bulkDelete: Object.assign(bulkDelete, bulkDelete),
}

export default pricingDetails