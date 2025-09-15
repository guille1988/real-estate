import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\ProfileController::edit
* @see app/Http/Controllers/Admin/ProfileController.php:14
* @route '/admin/profile'
*/
export const edit = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/admin/profile',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\ProfileController::edit
* @see app/Http/Controllers/Admin/ProfileController.php:14
* @route '/admin/profile'
*/
edit.url = (options?: RouteQueryOptions) => {
    return edit.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\ProfileController::edit
* @see app/Http/Controllers/Admin/ProfileController.php:14
* @route '/admin/profile'
*/
edit.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\ProfileController::edit
* @see app/Http/Controllers/Admin/ProfileController.php:14
* @route '/admin/profile'
*/
edit.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(options),
    method: 'head',
})

const profile = {
    edit: Object.assign(edit, edit),
}

export default profile