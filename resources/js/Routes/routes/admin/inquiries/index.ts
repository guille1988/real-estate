import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\InquiryController::index
* @see app/Http/Controllers/Admin/InquiryController.php:13
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
* @see app/Http/Controllers/Admin/InquiryController.php:13
* @route '/admin/inquiries'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\InquiryController::index
* @see app/Http/Controllers/Admin/InquiryController.php:13
* @route '/admin/inquiries'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\InquiryController::index
* @see app/Http/Controllers/Admin/InquiryController.php:13
* @route '/admin/inquiries'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

const inquiries = {
    index: Object.assign(index, index),
}

export default inquiries