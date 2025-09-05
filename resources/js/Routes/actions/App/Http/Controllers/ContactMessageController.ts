import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\ContactMessageController::__invoke
* @see app/Http/Controllers/ContactMessageController.php:13
* @route '/contact/messages'
*/
const ContactMessageController = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: ContactMessageController.url(options),
    method: 'post',
})

ContactMessageController.definition = {
    methods: ["post"],
    url: '/contact/messages',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\ContactMessageController::__invoke
* @see app/Http/Controllers/ContactMessageController.php:13
* @route '/contact/messages'
*/
ContactMessageController.url = (options?: RouteQueryOptions) => {
    return ContactMessageController.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ContactMessageController::__invoke
* @see app/Http/Controllers/ContactMessageController.php:13
* @route '/contact/messages'
*/
ContactMessageController.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: ContactMessageController.url(options),
    method: 'post',
})

export default ContactMessageController