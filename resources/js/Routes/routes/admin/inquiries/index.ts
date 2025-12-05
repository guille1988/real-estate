import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\InquiryController::index
* @see app/Http/Controllers/Admin/InquiryController.php:19
* @route '/admin/inquiries'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/inquiries',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\InquiryController::index
* @see app/Http/Controllers/Admin/InquiryController.php:19
* @route '/admin/inquiries'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\InquiryController::index
* @see app/Http/Controllers/Admin/InquiryController.php:19
* @route '/admin/inquiries'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\InquiryController::index
* @see app/Http/Controllers/Admin/InquiryController.php:19
* @route '/admin/inquiries'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\InquiryController::destroy
* @see app/Http/Controllers/Admin/InquiryController.php:45
* @route '/admin/inquiries/{inquiry}'
*/
export const destroy = (args: { inquiry: string | { uuid: string } } | [inquiry: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/inquiries/{inquiry}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\InquiryController::destroy
* @see app/Http/Controllers/Admin/InquiryController.php:45
* @route '/admin/inquiries/{inquiry}'
*/
destroy.url = (args: { inquiry: string | { uuid: string } } | [inquiry: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { inquiry: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'uuid' in args) {
        args = { inquiry: args.uuid }
    }

    if (Array.isArray(args)) {
        args = {
            inquiry: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        inquiry: typeof args.inquiry === 'object'
        ? args.inquiry.uuid
        : args.inquiry,
    }

    return destroy.definition.url
            .replace('{inquiry}', parsedArgs.inquiry.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\InquiryController::destroy
* @see app/Http/Controllers/Admin/InquiryController.php:45
* @route '/admin/inquiries/{inquiry}'
*/
destroy.delete = (args: { inquiry: string | { uuid: string } } | [inquiry: string | { uuid: string } ] | string | { uuid: string }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\Admin\InquiryController::bulkDelete
* @see app/Http/Controllers/Admin/InquiryController.php:34
* @route '/admin/inquiries/bulk-delete'
*/
export const bulkDelete = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: bulkDelete.url(options),
    method: 'post',
})

bulkDelete.definition = {
    methods: ["post"],
    url: '/admin/inquiries/bulk-delete',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\InquiryController::bulkDelete
* @see app/Http/Controllers/Admin/InquiryController.php:34
* @route '/admin/inquiries/bulk-delete'
*/
bulkDelete.url = (options?: RouteQueryOptions) => {
    return bulkDelete.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\InquiryController::bulkDelete
* @see app/Http/Controllers/Admin/InquiryController.php:34
* @route '/admin/inquiries/bulk-delete'
*/
bulkDelete.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: bulkDelete.url(options),
    method: 'post',
})

const inquiries = {
    index: Object.assign(index, index),
    destroy: Object.assign(destroy, destroy),
    bulkDelete: Object.assign(bulkDelete, bulkDelete),
}

export default inquiries