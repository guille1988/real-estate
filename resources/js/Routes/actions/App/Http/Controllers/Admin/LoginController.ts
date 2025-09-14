import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\LoginController::create
* @see app/Http/Controllers/Admin/LoginController.php:15
* @route '/admin/login'
*/
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/admin/login',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\LoginController::create
* @see app/Http/Controllers/Admin/LoginController.php:15
* @route '/admin/login'
*/
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LoginController::create
* @see app/Http/Controllers/Admin/LoginController.php:15
* @route '/admin/login'
*/
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\LoginController::create
* @see app/Http/Controllers/Admin/LoginController.php:15
* @route '/admin/login'
*/
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\LoginController::store
* @see app/Http/Controllers/Admin/LoginController.php:20
* @route '/admin/login'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/login',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\LoginController::store
* @see app/Http/Controllers/Admin/LoginController.php:20
* @route '/admin/login'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LoginController::store
* @see app/Http/Controllers/Admin/LoginController.php:20
* @route '/admin/login'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Admin\LoginController::destroy
* @see app/Http/Controllers/Admin/LoginController.php:33
* @route '/admin/login'
*/
export const destroy = (options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/login',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\LoginController::destroy
* @see app/Http/Controllers/Admin/LoginController.php:33
* @route '/admin/login'
*/
destroy.url = (options?: RouteQueryOptions) => {
    return destroy.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\LoginController::destroy
* @see app/Http/Controllers/Admin/LoginController.php:33
* @route '/admin/login'
*/
destroy.delete = (options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(options),
    method: 'delete',
})

const LoginController = { create, store, destroy }

export default LoginController