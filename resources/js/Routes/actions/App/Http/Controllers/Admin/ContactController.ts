import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\ContactController::index
* @see app/Http/Controllers/Admin/ContactController.php:13
* @route '/admin/contact'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/contact',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\ContactController::index
* @see app/Http/Controllers/Admin/ContactController.php:13
* @route '/admin/contact'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ContactController::index
* @see app/Http/Controllers/Admin/ContactController.php:13
* @route '/admin/contact'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\ContactController::index
* @see app/Http/Controllers/Admin/ContactController.php:13
* @route '/admin/contact'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

const ContactController = { index }

export default ContactController