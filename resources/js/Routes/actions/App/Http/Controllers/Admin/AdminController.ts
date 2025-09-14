import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\AdminController::__invoke
* @see app/Http/Controllers/Admin/AdminController.php:14
* @route '/admin'
*/
const AdminController = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: AdminController.url(options),
    method: 'get',
})

AdminController.definition = {
    methods: ["get","head"],
    url: '/admin',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\AdminController::__invoke
* @see app/Http/Controllers/Admin/AdminController.php:14
* @route '/admin'
*/
AdminController.url = (options?: RouteQueryOptions) => {
    return AdminController.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AdminController::__invoke
* @see app/Http/Controllers/Admin/AdminController.php:14
* @route '/admin'
*/
AdminController.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: AdminController.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\AdminController::__invoke
* @see app/Http/Controllers/Admin/AdminController.php:14
* @route '/admin'
*/
AdminController.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: AdminController.url(options),
    method: 'head',
})

export default AdminController