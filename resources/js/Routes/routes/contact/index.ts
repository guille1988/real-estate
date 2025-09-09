import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../wayfinder'
/**
* @see \App\Http\Controllers\ContactMessageController::__invoke
* @see app/Http/Controllers/ContactMessageController.php:13
* @route '/contact/messages'
*/
export const messages = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: messages.url(options),
    method: 'post',
})

messages.definition = {
    methods: ["post"],
    url: '/contact/messages',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\ContactMessageController::__invoke
* @see app/Http/Controllers/ContactMessageController.php:13
* @route '/contact/messages'
*/
messages.url = (options?: RouteQueryOptions) => {
    return messages.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ContactMessageController::__invoke
* @see app/Http/Controllers/ContactMessageController.php:13
* @route '/contact/messages'
*/
messages.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: messages.url(options),
    method: 'post',
})

const contact = {
    messages: Object.assign(messages, messages),
}

export default contact