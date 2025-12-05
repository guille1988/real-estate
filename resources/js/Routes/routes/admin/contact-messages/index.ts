import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\ContactMessageController::index
* @see app/Http/Controllers/Admin/ContactMessageController.php:23
* @route '/admin/contact-messages'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/contact-messages',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\ContactMessageController::index
* @see app/Http/Controllers/Admin/ContactMessageController.php:23
* @route '/admin/contact-messages'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ContactMessageController::index
* @see app/Http/Controllers/Admin/ContactMessageController.php:23
* @route '/admin/contact-messages'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\ContactMessageController::index
* @see app/Http/Controllers/Admin/ContactMessageController.php:23
* @route '/admin/contact-messages'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\ContactMessageController::show
* @see app/Http/Controllers/Admin/ContactMessageController.php:40
* @route '/admin/contact-messages/{contact_message}'
*/
export const show = (args: { contact_message: string | number } | [contact_message: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/admin/contact-messages/{contact_message}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\ContactMessageController::show
* @see app/Http/Controllers/Admin/ContactMessageController.php:40
* @route '/admin/contact-messages/{contact_message}'
*/
show.url = (args: { contact_message: string | number } | [contact_message: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { contact_message: args }
    }

    if (Array.isArray(args)) {
        args = {
            contact_message: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        contact_message: args.contact_message,
    }

    return show.definition.url
            .replace('{contact_message}', parsedArgs.contact_message.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ContactMessageController::show
* @see app/Http/Controllers/Admin/ContactMessageController.php:40
* @route '/admin/contact-messages/{contact_message}'
*/
show.get = (args: { contact_message: string | number } | [contact_message: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\ContactMessageController::show
* @see app/Http/Controllers/Admin/ContactMessageController.php:40
* @route '/admin/contact-messages/{contact_message}'
*/
show.head = (args: { contact_message: string | number } | [contact_message: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\ContactMessageController::destroy
* @see app/Http/Controllers/Admin/ContactMessageController.php:64
* @route '/admin/contact-messages/{contact_message}'
*/
export const destroy = (args: { contact_message: string | number } | [contact_message: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/contact-messages/{contact_message}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\ContactMessageController::destroy
* @see app/Http/Controllers/Admin/ContactMessageController.php:64
* @route '/admin/contact-messages/{contact_message}'
*/
destroy.url = (args: { contact_message: string | number } | [contact_message: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { contact_message: args }
    }

    if (Array.isArray(args)) {
        args = {
            contact_message: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        contact_message: args.contact_message,
    }

    return destroy.definition.url
            .replace('{contact_message}', parsedArgs.contact_message.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ContactMessageController::destroy
* @see app/Http/Controllers/Admin/ContactMessageController.php:64
* @route '/admin/contact-messages/{contact_message}'
*/
destroy.delete = (args: { contact_message: string | number } | [contact_message: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\Admin\ContactMessageController::bulkDelete
* @see app/Http/Controllers/Admin/ContactMessageController.php:53
* @route '/admin/contact-messages/bulk-delete'
*/
export const bulkDelete = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: bulkDelete.url(options),
    method: 'post',
})

bulkDelete.definition = {
    methods: ["post"],
    url: '/admin/contact-messages/bulk-delete',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\ContactMessageController::bulkDelete
* @see app/Http/Controllers/Admin/ContactMessageController.php:53
* @route '/admin/contact-messages/bulk-delete'
*/
bulkDelete.url = (options?: RouteQueryOptions) => {
    return bulkDelete.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ContactMessageController::bulkDelete
* @see app/Http/Controllers/Admin/ContactMessageController.php:53
* @route '/admin/contact-messages/bulk-delete'
*/
bulkDelete.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: bulkDelete.url(options),
    method: 'post',
})

const contactMessages = {
    index: Object.assign(index, index),
    show: Object.assign(show, show),
    destroy: Object.assign(destroy, destroy),
    bulkDelete: Object.assign(bulkDelete, bulkDelete),
}

export default contactMessages