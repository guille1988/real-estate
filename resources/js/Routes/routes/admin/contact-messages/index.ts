import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\ContactMessageController::index
* @see app/Http/Controllers/Admin/ContactMessageController.php:13
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
* @see app/Http/Controllers/Admin/ContactMessageController.php:13
* @route '/admin/contact-messages'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ContactMessageController::index
* @see app/Http/Controllers/Admin/ContactMessageController.php:13
* @route '/admin/contact-messages'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\ContactMessageController::index
* @see app/Http/Controllers/Admin/ContactMessageController.php:13
* @route '/admin/contact-messages'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

const contactMessages = {
    index: Object.assign(index, index),
}

export default contactMessages